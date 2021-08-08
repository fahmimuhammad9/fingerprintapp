<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class StudentModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getactive()
    {
        $this->db->where('studentstatus', 1);
        return $this->db->get('student')->result_array();
    }
    function get_student()
    {
        return $this->db->get('student')->result_array();
    }
    function get_nastudent($id)
    {
        return $this->db->query('SELECT * FROM student a WHERE studentid NOT IN (SELECT studentid FROM classhandshake WHERE classid = ' . $id . ')')->result_array();
    }
}
