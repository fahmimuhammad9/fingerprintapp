<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ArduinoModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_data($id)
    {
        $this->db->where('id_device', $id);
        return $this->db->get('device')->row_array();
    }

    function get_by_ip($ip)
    {
        $this->db->where('deviceip', $ip);
        return $this->db->get('device')->row_array();
    }

    function validate($student)
    {
        $this->db->join('session', 'session.sessionid = sesshandshake.session_id');
        $this->db->where('entity_id', $student);
        $data = $this->db->get('sesshandshake')->row_array();

        if ($data == null) {
            return null;
        } else {
            return $data;
        }
    }

    function getres($end)
    {
        $endtime = strtotime($end);
        $now = date("Y/m/d H:i:s");
        $nowformat = strtotime($now);
        $late = $nowformat + (60 * 5);
        $format = date("Y/m/d H:i:s", $late);
        if ($endtime > $nowformat) {
            return "OnTime";
        } else {
            if ($late > $nowformat) {
                return "Late";
            } else {
                return "No Record Allowed";
            }
        }
    }

    function getfinger($id)
    {
        $this->db->where('studentid', $id);
        return $this->db->get('finger')->row_array();
    }

    function checkses($id)
    {
        $this->db->where('session_id', $id);
        return $this->db->get('sesshandshake')->row_array();
    }

    function addfinger($student, $finger, $device)
    {
        $in  = [
            'studentid' => $student,
            'memoryid' => $finger,
            'device_id' => $device
        ];
        $this->db->insert('finger', $in);
    }

    function updatecommand($device)
    {
        $this->db->where('device_id', $device);
        $check  = $this->db->get('sesshandshake')->row_array();

        if ($check == null) {
            $in = [
                'command' => 'pre',
                'command2' => 'pre'
            ];
            $this->db->where('iddevice', $device);
            $this->db->update('devicecommand', $in);
        } else {
            $in = [
                'command' => 'absent',
                'command2' => ''
            ];
            $this->db->where('iddevice', $device);
            $this->db->update('devicecommand', $in);
        }
    }
}
