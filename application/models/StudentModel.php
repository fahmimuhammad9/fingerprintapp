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
    function get_where($table, $cond)
    {
        $this->db->where('id_user', $cond);
        return $this->db->get($table)->row_array();
    }

    public function get_current_class()
    {
        $this->db->where('id_user', $this->session->userdata['id']);
        $back =  $this->db->get('classassign')->row_array();

        $this->db->join('user', 'user.id = class.author');
        $this->db->where('class.classid', $back['id_class']);
        return $this->db->get('class')->row_array();
    }
    public function select_class_joined()
    {
        $this->db->join('user', 'user.id = class.author');
        $this->db->where('status', 1);
        return $this->db->get('class')->result_array();
    }
    public function disembark()
    {
        $this->db->where('id_user', $this->session->userdata['id']);
        $this->db->delete('classassign');
    }
    public function get_all_class_joined()
    {
        $this->db->join('user', 'user.id = class.author');
        return $this->db->get('class')->result_array();
    }
}
