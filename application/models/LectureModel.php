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
        } else if ($this->session->userdata['role'] != 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
            redirect('logout');
        }
    }

    function get_active_class($stat)
    {
        $this->db->where('author', $this->session->userdata['id']);
        $this->db->where('status', $stat);
        return $this->db->get('class')->result_array();
    }

    function get($tables)
    {
        return $this->db->get($tables)->result_array();
    }

    function update_class_status($id, $status)
    {
        $this->db->where('classid', $id);
        $temp = $this->db->get('class')->row_array();

        $arr = [
            'classname' => $temp['classname'],
            'classcaption' => $temp['classcaption'],
            'created_at' => $temp['created_at'],
            'author' => $temp['author'],
            'status' => $status
        ];
        $this->db->where('classid', $id);
        $this->db->update('class', $arr);
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
}
