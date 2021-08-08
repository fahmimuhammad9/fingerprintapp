<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lecture extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('LectureModel');
        $this->load->model('StudentModel');
        $this->load->model('SessionModel');
        $this->load->model('ClassModel');
        $this->load->model('ArduinoModel');
        date_default_timezone_set('Asia/Bangkok');

        // $this->load->model('LectureModel');
    }

    public function index()
    {
        $this->LectureModel->validate();

        $data['totaldevice'] = $this->db->count_all('device');
        $data['totalstudent'] = $this->db->count_all('student');
        $data['totalsession'] = $this->db->count_all('session');
        $data['totalclass'] = $this->db->count_all('class');

        $data['title'] = 'Homepage Section';
        $data['class'] = $this->ClassModel->get_myclass();
        $data['session'] = $this->SessionModel->get_session();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/homepage', $data);
        $this->load->view('template/footer');
    }

    public function class()
    {
        $this->LectureModel->validate();

        $data['totaldevice'] = $this->db->count_all('device');
        $data['totalstudent'] = $this->db->count_all('student');
        $data['totalsession'] = $this->db->count_all('session');
        $data['totalclass'] = $this->db->count_all('class');

        $data['title'] = 'Class Section';
        $data['status'] = $this->ClassModel->get_status();
        $data['activeclass'] = $this->ClassModel->get_myclass();
        $data['reservedclass'] = $this->ClassModel->get_reserved();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/class', $data);
        $this->load->view('template/footer');
    }

    public function lectureassign()
    {
        $this->LectureModel->validate();

        $data['class'] = $this->LectureModel->get_active_class(1);
        $data['reserve'] = $this->LectureModel->get_active_class(2);

        $data['classstat'] = $this->LectureModel->get('classstat');

        $data['title'] = 'Class | Lecturer';
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/lecturer', $data);
        $this->load->view('template/footer');
    }

    public function newclass()
    {
        $this->LectureModel->validate();

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Class name is needed'
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            redirect('class');
        } else {
            $in = [
                'classauthor' => $this->session->userdata['id'],
                'classname' => htmlspecialchars($this->input->post('name')),
                'classstatus' => $this->input->post('status')
            ];
            $this->db->insert('class', $in);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Adding New Class!</div>');
            redirect('class');
        }
    }

    public function activateclass($id)
    {
        $this->LectureModel->validate();
        $this->ClassModel->update_class_status($id, 1);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Activate a Class!</div>');
        redirect('class');
    }
    public function deactivateclass($id)
    {
        $this->LectureModel->validate();
        $chec = $this->SessionModel->checkactivesess($id);
        if ($chec) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Failed to Deactivating a Class! Session Running</div>');
            redirect('class');
        } else {
            $this->ClassModel->update_class_status($id, 2);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Deactivating a Class!</div>');
            redirect('class');
        }
    }
    public function reserveclass($id)
    {
        $this->LectureModel->validate();
        $this->ClassModel->update_class_status($id, 3);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Deactivating a Class!</div>');
        redirect('class');
    }

    public function student()
    {
        $this->LectureModel->validate();
        $data['totaldevice'] = $this->db->count_all('device');
        $data['totalstudent'] = $this->db->count_all('student');
        $data['totalsession'] = $this->db->count_all('session');
        $data['totalclass'] = $this->db->count_all('class');
        $data['title'] = 'Student List';
        $data['student'] = $this->StudentModel->getactive();
        $data['status'] = $this->ClassModel->get_status();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/stuview', $data);
        $this->load->view('template/footer');
    }

    public function deleteclass($id)
    {
        $this->LectureModel->validate();
        $this->ClassModel->deleteclass($id);
        $this->ClassModel->deleteassigned($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Deleting a Class!</div>');
        redirect('class');
    }

    public function session()
    {
        $this->LectureModel->validate();

        $data['totaldevice'] = $this->db->count_all('device');
        $data['totalstudent'] = $this->db->count_all('student');
        $data['totalsession'] = $this->db->count_all('session');
        $data['totalclass'] = $this->db->count_all('class');

        $data['status'] = $this->ClassModel->get_status();
        $data['session'] = $this->SessionModel->getall();
        $data['mysess'] = $this->SessionModel->getmysess();
        $data['device'] = $this->SessionModel->getdevice();
        $data['showdevice'] = $this->SessionModel->getrunningsess();
        $data['seerecent'] = $this->SessionModel->seerecent();

        $data['title'] = 'Session Section';

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/session', $data);
        $this->load->view('template/footer');
    }

    public function createsession()
    {
        $this->LectureModel->validate();

        $data['totaldevice'] = $this->db->count_all('device');
        $data['totalstudent'] = $this->db->count_all('student');
        $data['totalsession'] = $this->db->count_all('session');
        $data['totalclass'] = $this->db->count_all('class');

        $data['title'] = 'Register New Session';
        $data['student'] = $this->db->get('student')->result_array();
        $data['status'] = $this->ClassModel->get_status();
        $data['class'] = $this->ClassModel->get_active();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/createsession', $data);
        $this->load->view('template/footer');
    }

    public function sessactiva($idses)
    {
        $this->form_validation->set_rules('device', 'Device', 'required');
        $this->form_validation->set_rules('durasi', 'Durasi', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">No Direct Access Allowed</div>');
            redirect('session');
        } else {
            $checkclass = $this->ClassModel->checkclass($idses);
            if (!$checkclass) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Your Class is Deactive</div>');
                redirect('session');
            }
            $endtime = $this->SessionModel->countend($this->input->post('durasi'));

            if ($this->SessionModel->checkauthor($this->session->userdata['id']) != null) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">You Have Session Runnning! Failed to Activate Another Session</div>');
                redirect('session');
            }

            $device = $this->SessionModel->addentity($idses, $this->input->post('device'));
            $this->SessionModel->updatesession($idses, $endtime);
            $this->SessionModel->updatearduino('absent', $device);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Activate Session</div>');
            redirect('session');
        }
    }

    public function sessionexpired($idsess)
    {
        $this->db->where('sessionid', $idsess);
        $this->db->set('sessionstat', 2);
        $this->db->update('session');

        $this->db->where('session_id', $idsess);
        $getdevice = $this->db->get('sesshandshake')->row_array();

        $this->db->where('session_id', $idsess);
        $this->db->delete('sesshandshake');

        if ($getdevice['device_id'] != null) {
            $this->db->where('device_id', $getdevice['deviceid']);
            $pass = $this->db->get('sesshandshake')->result_array();

            if ($pass == null) {
                $ip = [
                    'command' => 'pre'
                ];
                $this->db->where('iddevice', $getdevice['device_id']);
                $this->db->update('devicecommand', $ip);
            }
        }

        redirect('session');
    }
    public function addsession()
    {
        $this->LectureModel->validate();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('class', 'Class', 'required');
        $this->form_validation->set_radio('remark', 'Remark', 'trim');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">No Direct Access Allowed</div>');
            redirect('registersession');
        } else {
            $in = [
                'sessiontitle' => $this->input->post('name'),
                'sessionauthor' => $this->session->userdata['id'],
                'sessionstart' => null,
                'sessionend' => null,
                'sessionstat' => 2,
                'sessclass' => $this->input->post('class'),
                'sessremark' => $this->input->post('remark')
            ];
            $this->db->insert('session', $in);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Add An Inactive Session!</div>');
            redirect('session');
        }
    }

    public function studentadd()
    {
        // $this->LectureModel->validate();
        $this->form_validation->set_rules('nim', 'Nim', 'required|is_unique[student.nim]', [
            'required' => 'Kolom ini harus diisi',
            'is_unique' => 'Nomor Induk Mahasiswa Telah Digunakan'
        ]);
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Kolom ini harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Something went wrong!</div>');
            redirect('student');
        } else {
            $in = [
                'nim' => $this->input->post('nim'),
                'studentname' => htmlspecialchars($this->input->post('name')),
                'studentstatus' => 1
            ];
            $this->db->insert('student', $in);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Add New Student!</div>');
            redirect('student');
        }
    }

    public function studentdelete($id)
    {
        $this->db->where('studentid', $id);
        $this->db->set('studentstatus', 3);
        $this->db->update('student');
        redirect('student');
    }
    public function assignmclass($idclass)
    {
        $this->LectureModel->validate();
        $data['title'] = 'Assign Class';

        $data['totaldevice'] = $this->db->count_all('device');
        $data['totalstudent'] = $this->db->count_all('student');
        $data['totalsession'] = $this->db->count_all('session');
        $data['totalclass'] = $this->db->count_all('class');

        $data['classinfo'] = $this->ClassModel->get_class_info($idclass);
        $data['assignedstudent'] = $this->ClassModel->get_assigned_student($idclass);
        $data['nastudent'] = $this->StudentModel->get_nastudent($idclass);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/assignclass', $data);
        $this->load->view('template/footer');
    }

    public function assigntoclass($student, $class)
    {
        $this->LectureModel->validate();
        $in = [
            'classid' => $class,
            'studentid' => $student
        ];
        $this->db->insert('classhandshake', $in);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Assign Student!</div>');
        redirect('lecture/assignmclass/' . $class);
    }
    public function kickfromclass($student, $class)
    {
        $this->db->where('classid', $class);
        $this->db->where('studentid', $student);
        $this->db->delete('classhandshake');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Kick Student!</div>');
        redirect('lecture/assignmclass/' . $class);
    }

    public function classinfo()
    {
        $this->LectureModel->validate();
        $data['title'] = 'Class Information';

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/classinfo', $data);
        $this->load->view('tempbote/footer');
    }

    public function adddevice()
    {
        $this->form_validation->set_rules('namaperangkat', 'Namaperangkat', 'required|trim');
        $this->form_validation->set_rules('ipaddress', 'Ipaddress', 'required');

        if ($this->form_validation->run() == false) {
            redirect('session');
        } else {
            $in = [
                'devicename' => htmlspecialchars($this->input->post('namaperangkat')),
                'deviceip' => htmlspecialchars($this->input->post('ipaddress'))
            ];
            $this->db->insert('device', $in);
            $getdevice = $this->ArduinoModel->get_by_ip($in['deviceip']);
            $in2 = [
                'iddevice' => $getdevice['id_device'],
                'command' => 'pre'
            ];
            $this->db->insert('devicecommand', $in2);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Succes Add Device!</div>');
            redirect('session');
        }
    }
    public function deletesession($id)
    {
        $update = [
            'sessionstat' => 3
        ];
        $this->db->where('sessionid', $id);
        $this->db->update('session', $update);
        redirect('session');
    }
}
