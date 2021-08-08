<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arduino extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Bangkok');
        $this->load->model('SessionModel');
    }

    public function index()
    {
    }

    public function getfinger()
    {
    }

    public function postfinger($id, $finger)
    {
        $in = [
            'finger' =>  $finger,
            'studentid' => $id
        ];
        $this->db->insert('finger', $in);
        redirect();
    }
}
