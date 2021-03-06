<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ClassModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_class()
    {
        $this->db->join('globalstatus', 'globalstatus.statusid = class.classstatus');
        return $this->db->get('class')->result_array();
    }
    function get_class_info($id)
    {
        $this->db->where('classid', $id);
        return $this->db->get('class')->row_array();
    }
    function get_status()
    {
        return $this->db->get('globalstatus')->result_array();
    }
    function get_active()
    {
        $this->db->where('classauthor', $this->session->userdata['id']);
        $this->db->join('globalstatus', 'globalstatus.statusid = class.classstatus');
        $this->db->group_start();
        $this->db->where('classstatus', 1);
        $this->db->group_end();
        return $this->db->get('class')->result_array();
    }
    function get_myclass()
    {
        $this->db->where('classauthor', $this->session->userdata['id']);
        $this->db->join('globalstatus', 'globalstatus.statusid = class.classstatus');
        $this->db->group_start();
        $this->db->where('classstatus', 1);
        $this->db->or_where('classstatus', 3);
        $this->db->group_end();
        return $this->db->get('class')->result_array();
    }
    function get_reserved()
    {
        $this->db->where('classauthor', $this->session->userdata['id']);
        $this->db->join('globalstatus', 'globalstatus.statusid = class.classstatus');
        $this->db->where('classstatus', 2);
        return $this->db->get('class')->result_array();
    }
    function update_class_status($id, $status)
    {
        $this->db->where('classid', $id);
        $temp = $this->db->get('class')->row_array();

        $arr = [
            'classauthor' => $temp['classauthor'],
            'classname' => $temp['classname'],
            'classstatus' => $status
        ];
        $this->db->where('classid', $id);
        $this->db->update('class', $arr);
    }
    function get_assigned_student($idclass)
    {
        $this->db->join('student', 'student.studentid = classhandshake.studentid', 'left');
        $this->db->where('classid', $idclass);
        return $this->db->get('classhandshake')->result_array();
    }
    function deleteclass($id)
    {
        $this->db->where('classid', $id);
        $this->db->delete('class');
    }
    function deleteassigned($id)
    {
        $this->db->where('classid', $id);
        $this->db->delete('classhandshake');
    }
    function countstudent($data)
    {
        foreach ($data as $key) {
            $this->db->where('classid', $key['classid']);
            return $this->db->count_all('classhandshake');
        }
    }
    function checkclass($idclass)
    {
        $this->db->where('classid', $idclass);
        $o = $this->db->get('class')->row_array();

        if ($o['classstatus'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
