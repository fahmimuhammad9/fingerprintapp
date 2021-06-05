<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        date_default_timezone_set('Asia/Bangkok');
        $this->load->model('UserModel');
    }

    public function index()
    {
        $this->UserModel->validate();
        $data['title'] = 'Finger Print Attendance';
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pages/homepage', $data);
        $this->load->view('template/footer');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Kolom Harus Diisi',
            'valid_email' => 'Masukkan Email dengan benar'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        $user = $this->UserModel->validatepassword($this->input->post('email'));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Finger Print Attendance Login';
            $this->load->view('pages/landing', $data);
        } else {
            if ($user) {
                if (password_verify($this->input->post('password'), $user['userpassword'])) {
                    $data = [
                        'id' => $user['userid'],
                        'email' => $user['useremail'],
                        'name' => $user['username'],
                    ];
                    $this->session->set_userdata($data);
                    redirect('lecture');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata Sandi Salah!</div>');
                    var_dump($user);
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Tidak Terdaftar!</div>');
                redirect('login');
            }
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.useremail]');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('confirm', 'Confirm', 'required|trim|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied</div>');
            redirect('user');
        } else {
            $in = [
                'username' => $this->input->post('name'),
                'useremail' => htmlspecialchars($this->input->post('email', true)),
                'userpassword' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];
            $this->db->insert('user', $in);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Mendaftarkan Akun Anda! Silahkan Masuk</div>');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('role');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out</div>');
        redirect('user');
    }
}
