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
        date_default_timezone_set('Asia/Bangkok');
        // $this->load->model('LectureModel');
    }

    public function index()
    {
        $this->LectureModel->validate();

        $data['title'] = 'Homepage | Lecturer';
        $data['class'] = $this->ClassModel->get_class();
        $data['session'] = $this->SessionModel->get_session();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/homepage', $data);
        $this->load->view('template/footer');
    }

    public function class()
    {
        $this->LectureModel->validate();

        $data['title'] = 'Class Assign';
        $data['status'] = $this->ClassModel->get_status();
        $data['activeclass'] = $this->ClassModel->get_active();
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
        $this->ClassModel->update_class_status($id, 2);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Deactivating a Class!</div>');
        redirect('class');
    }

    public function student()
    {
        $this->LectureModel->validate();
        $data['title'] = 'Student List';
        $data['student'] = $this->StudentModel->get_student();
        $data['class'] = $this->ClassModel->get_active();
        $data['status'] = $this->ClassModel->get_status();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/stuview', $data);
        $this->load->view('template/footer');
    }

    public function deleteclass($id)
    {
        $this->LectureModel->validate();
        $this->LectureModel->delete_by_id('class', $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Deleting a Class!</div>');
        redirect('lectureassign');
    }

    public function classinfo($id)
    {
        $this->LectureModel->validate();

        $data['title'] = 'Class Detail Information';

        $data['info'] = $this->LectureModel->get_class_info($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/classinfo', $data);
        $this->load->view('template/footer');
    }

    public function session()
    {
        $this->LectureModel->validate();

        $data['active'] = $this->SessionModel->checkactive();
        $data['status'] = $this->ClassModel->get_status();

        $data['title'] = 'Session Page | Lecturer';

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/session', $data);
        $this->load->view('template/footer');
    }

    public function createsession()
    {
        $this->LectureModel->validate();
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Register New Session';
            $data['student'] = $this->db->get('student')->result_array();

            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('pages/createsession', $data);
            $this->load->view('template/footer');
        } else {
            $in = [
                'sessiontitle' => $this->input->post('title'),
                'sessionauthor' => $this->session->userdata['id'],
                'sessionstart' => time(),
                'sessionend' => null,
                'sessionstat' => $this->input->post['status']
            ];
            $this->db->insert('session', $in);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Registering Your Session! Go Activate!</div>');
            redirect('session');
        }
    }

    public function studentadd()
    {
        $this->LectureModel->validate();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Something went wrong!</div>');
            redirect('student');
        } else {
            $in = [
                'studentname' => htmlspecialchars($this->input->post('name')),
                'studentstatus' => 1
            ];
            $this->db->insert('student', $in);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Add New Student!</div>');
            redirect('student');
        }
    }

    public function assignmclass($idclass)
    {
        $this->LectureModel->validate();
        $data['title'] = 'Assign Class';
        $data['classinfo'] = $this->ClassModel->get_class_info($idclass);
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/assignclass', $data);
        $this->load->view('template/footer');
    }
}
