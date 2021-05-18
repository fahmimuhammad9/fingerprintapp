
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('StudentModel');
        date_default_timezone_set('Asia/Bangkok');
        // $this->load->model('LectureModel');
    }

    public function index()
    {
        $this->StudentModel->validate();

        $data['class'] = $this->db->get('class')->result_array();

        $data['title'] = 'Dashboard | Student Pages';
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar2', $data);
        $this->load->view('pages/stuhome', $data);
        $this->load->view('template/footer');
    }

    public function classes()
    {
        $this->StudentModel->validate();

        $data['current'] = $this->StudentModel->get_current_class();
        $data['title'] = 'Class | Student Pages';

        $data['class'] = $this->StudentModel->select_class_joined();
        $data['allclass'] = $this->StudentModel->get_all_class_joined();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar2', $data);
        $this->load->view('pages/stuclass', $data);
        $this->load->view('template/footer');
    }

    public function join($id)
    {
        $this->StudentModel->validate();

        $in = [
            'id_user' => $this->session->userdata['id'],
            'id_class' => $id
        ];
        $this->db->insert('classassign', $in);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Assign A Class!</div>');
        redirect('classes');
    }

    public function disembark()
    {
        $this->StudentModel->validate();

        $check = $this->StudentModel->disembark();
        if ($check) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Disembarking Class</div>');
            redirect('classes');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed Disembarking Class</div>');
            redirect('classes');
        }
    }

    public function session()
    {
        $this->StudentModel->validate();

        $data['title'] = 'Session History';

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar2', $data);
        $this->load->view('pages/stusess', $data);
        $this->load->view('template/footer');
    }
}
