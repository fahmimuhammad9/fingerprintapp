<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Session extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('SessionModel');
        date_default_timezone_set('Asia/Bangkok');
        // $this->load->model('LectureModel');
    }

    public function index()
    {
        $this->SessionModel->validate();
    }
}
