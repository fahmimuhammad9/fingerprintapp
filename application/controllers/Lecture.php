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
        date_default_timezone_set('Asia/Bangkok');
        // $this->load->model('LectureModel');
    }

    public function index()
    {
        $this->LectureModel->validate();

        $data['title'] = 'Homepage | Lecturer';
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/homepage', $data);
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
        $this->form_validation->set_rules('caption', 'Caption', 'required|trim', [
            'required' => 'Class caption is needed'
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            redirect('lecture');
        } else {
            $in = [
                'classname' => htmlspecialchars($this->input->post('name')),
                'classcaption' => htmlspecialchars($this->input->post('caption')),
                'created_at' => date("Y-m-d"),
                'author' => $this->session->userdata['id'],
                'status' => $this->input->post('status')
            ];
            $this->db->insert('class', $in);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Adding New Class!</div>');
            redirect('lecture');
        }
    }

    public function activateclass($id)
    {
        $this->LectureModel->validate();
        $this->LectureModel->update_class_status($id, 1);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Activate a Class!</div>');
        redirect('lectureassign');
    }
    public function deactivateclass($id)
    {
        $this->LectureModel->validate();
        $this->LectureModel->update_class_status($id, 2);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Deactivating a Class!</div>');
        redirect('lectureassign');
    }

    public function stuview()
    {
        $this->LectureModel->validate();
        $data['title'] = 'Student List';
        $data['student'] = $this->StudentModel->get_student();

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

        $data['title'] = 'Session Page | Lecturer';

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/session', $data);
        $this->load->view('template/footer');
    }
}
