<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SessionModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_session()
    {
        $this->db->where('sessionauthor', $this->session->userdata['id']);
        return $this->db->get('session')->result_array();
    }
    function checkactive()
    {
        $this->db->where('sessionstat', 1);
        return $this->db->get('session')->result_array();
    }
    function checkfingerid($id)
    {
        $this->db->join('');
        $this->db->where('entity_id', $id);
        $a  = $this->db->get('sesshandshake')->row_array();
    }
}
