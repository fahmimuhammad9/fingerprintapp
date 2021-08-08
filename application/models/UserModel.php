<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function validate()
    {
        if ($this->session->userdata['email'] == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Go Login Access</div>');
            redirect('login');
        }
    }

    function validatepassword($email)
    {
        $this->db->where('useremail', $email);
        return $this->db->get('user')->row_array();
    }
}
