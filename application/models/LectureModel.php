<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LectureModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function validate()
    {
        if ($this->session->userdata['email'] == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
            redirect('login');
        }
    }

    function get_active_class($stat)
    {
        $this->db->where('author', $this->session->userdata['id']);
        $this->db->where('status', $stat);
        return $this->db->get('class')->result_array();
    }

    function get()
    {
        $this->db->join('class', 'class.classid = student.studentclass');
        $this->db->join('globalstatus', 'globalstatus.status.id = student.studnetstatus', 'left');
        return $this->db->get('student')->result_array();
    }

    function get_class_info($id)
    {
        $this->db->join('user', 'user.id = class.author');
        $this->db->where('classid', $id);
        return $this->db->get('class')->result_array();
    }

    function delete_by_id($table, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }

    function get_author_class()
    {
        $this->db->where('sess_author', $this->session->userdata['id']);
        return $this->db->get('session')->result_array();
    }
}
