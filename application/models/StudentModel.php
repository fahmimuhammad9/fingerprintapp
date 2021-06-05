<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class StudentModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function validate()
    {
        if ($this->session->userdata['email'] == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
            redirect('login');
        } else if ($this->session->userdata['role'] != '2') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
            redirect('logout');
        }
    }
    public function get($table)
    {
        return $this->db->get($table)->result_array();
    }
    function get_student()
    {
        return $this->db->get('student')->result_array();
    }
}
