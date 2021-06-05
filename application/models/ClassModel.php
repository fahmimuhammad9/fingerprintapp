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
        $this->db->join('globalstatus', 'globalstatus.statusid = class.classstatus');
        $this->db->where('classstatus', 1);
        return $this->db->get('class')->result_array();
    }
    function get_reserved()
    {
        $this->db->join('globalstatus', 'globalstatus.statusid = class.classstatus');
        $this->db->where('classstatus !=', 1);
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
}
