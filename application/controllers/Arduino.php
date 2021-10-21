<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arduino extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ArduinoModel');
        date_default_timezone_set('Asia/Bangkok');
    }

    public function index()
    {
        if (isset($_GET['id'])) {
            $deviceid = $this->input->get('id');
        }
        $this->db->where('iddevice', $deviceid);
        $data = $this->db->get('devicecommand')->row_array();
        echo $data['idcommand'] . "/" .   $data['command'] . "/" . $data['command2'];
    }

    public function postabsent()
    {
        if (!empty($_GET['idcomm'])) {
            $commid = $this->input->get('idcomm');
            $student = $this->input->get('idstudent');
            $status = $this->input->get('status');

            if ($status == 'OK') {
                $checksess = $this->ArduinoModel->validate($student);
                if ($checksess != null) {
                    $stat = $this->ArduinoModel->getres($checksess['sessionend']);
                    $inputres = [
                        'sessionid' => $checksess['sessionid'],
                        'entityid' => $checksess['entity_id'],
                        'timestamp' => date("Y/m/d H:i:s"),
                        'result' => $stat
                    ];
                    $this->db->insert('result', $inputres);

                    $checkavail = $this->ArduinoModel->checkses($checksess['sessionid']);

                    if ($checkavail == null) {
                        $pre  = [
                            'command' => 'absen',
                            'command2' => 'pre'
                        ];
                        $this->db->where('idcommand', $commid);
                        $this->db->update('devicecommand', $pre);
                        echo "Updated";
                    }
                    echo "Updated";
                } else {
                    echo "No Running Session";
                }
            } else {
                echo "Faild to fetch data";
            }
        } else {
            echo 'No data';
        }
    }
    public function posttodb()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbtestnode";

        $conn = mysqli_connect("$servername", "$username", "$password", "$dbname");

        $result = mysqli_query($conn, "INSERT INTO datasensor (data) VALUES ('" . $_GET["data"] . "')");

        if (!$result) {
            die('Invalid query: ' . mysqli_error($conn));
        }
    }
    public function posting()
    {
        $command = $_GET['command'];
        $resp = $_GET['resp'];
        $device = $_GET['device'];
        $id = $_GET['id'];

        var_dump($command);
        var_dump($resp);
        var_dump($id);

        if ($command == "absent") {
            if ($resp == "OK") {
                $checksess = $this->ArduinoModel->validate($id);
                if ($checksess == null) {
                    var_dump('No Running Session Registered');
                } else {
                    if ($checksess['entity_id'] == $id) {
                        var_dump('Session Absent ! Time: ' . date('H:i:s'));

                        $stat = $this->ArduinoModel->getres($checksess['sessionend']);

                        $inputres = [
                            'sessionid' => $checksess['sessionid'],
                            'entityid' => $checksess['entity_id'],
                            'timestamp' => date("Y/m/d H:i:s"),
                            'result' => $stat
                        ];
                        $this->db->insert('result', $inputres);
                        echo 'Successful Absent ! Have a good day';
                    } else {
                        var_dump('No Student Registered');
                    }
                }
            } else {
                var_dump('NOT OK YOU FUCK');
            }
        }
    }
    public function getfinger()
    {
        if (isset($_GET['device'])) {
            $device = $_GET['device'];

            $this->db->where('device_id', $device);
            $check = $this->db->get('sesshandshake')->row_array();

            if ($check != null) {
                $up = [
                    'command' => 'absent',
                    'command2' => 'na'
                ];
                $this->db->where('iddevice', $device);
                $this->db->update('devicecommand', $up);
                echo 'Success Update';
            } else {
                $up = [
                    'command' => 'pre',
                    'command2' => 'pre'
                ];
                $this->db->where('iddevice', $device);
                $this->db->update('devicecommand', $up);
                echo 'Success Update';
            }
        } else {
            echo 'No Request';
        }
    }
    public function assignfinger($id)
    {
        $this->db->where('iddevice', $id);
        $check = $this->db->get('devicecommand');

        if ($check != null) {
            $up = [
                'command' => 'enroll',
                'command2' => $id
            ];
            $this->db->where('iddevice', 6);
            $this->db->update('devicecommand', $up);
            $this->session->set_flashdata('message', '<div class="alert alert-success mt-3" role="alert">Please Check Arduino Device!</div>');
            redirect('student');
        } else {
            $up = [
                'iddevice' => 6,
                'command' => 'enroll',
                'command2' => $id
            ];
            $this->db->insert('devicecommand', $up);
            $this->session->set_flashdata('message', '<div class="alert alert-success mt-3" role="alert">Please Check Arduino Device!</div>');
            redirect('student');
        }
    }
}
