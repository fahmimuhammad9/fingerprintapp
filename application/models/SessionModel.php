<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SessionModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function validate()
    {
        if ($this->session->userdata['role'] == 1) {
            redirect('sessionlec');
        } else if ($this->session->userdata['role'] == 2) {
            redirect('sessionstu');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Access Denied!</div>');
            redirect('login');
        }
    }
}
