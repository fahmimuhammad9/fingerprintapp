<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getinput($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('user');
    }
}
