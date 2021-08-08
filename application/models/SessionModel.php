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
        $this->db->join('globalstatus', 'globalstatus.statusid = session.sessionstat');
        $this->db->where('sessionauthor', $this->session->userdata['id']);
        return $this->db->get('session')->result_array();
    }
    function getall()
    {
        $this->db->join('user', 'user.userid = session.sessionauthor');
        $this->db->join('globalstatus', 'globalstatus.statusid = session.sessionstat');
        $this->db->order_by('sessionstat', 'ASC');
        return $this->db->get('session')->result_array();
    }
    function getmysess()
    {
        $this->db->join('globalstatus', 'globalstatus.statusid = session.sessionstat');
        $this->db->join('class', 'class.classid = session.sessclass');
        $this->db->where('sessionauthor', $this->session->userdata['id']);
        $this->db->where('sessionstat!=', 3);
        return $this->db->get('session')->result_array();
    }
    function checkfingerid($id)
    {
        $this->db->join('');
        $this->db->where('entity_id', $id);
        $a  = $this->db->get('sesshandshake')->row_array();
    }
    function getdevice()
    {
        $this->db->join('devicecommand', 'devicecommand.iddevice = device.id_device');
        return $this->db->get('device')->result_array();
    }
    function countend($duration)
    {
        $now = date("Y-m-d H:i:s");
        $currentDate = strtotime($now);
        $futureDate = $currentDate + (60 * $duration);
        return date("Y-m-d H:i:s", $futureDate);
    }
    function updatesession($ses, $end)
    {
        $this->db->set('sessionstart', date("Y-m-d H:i:s"));
        $this->db->set('sessionend', $end);
        $this->db->set('sessionstat', 1);
        $this->db->where('sessionid', $ses);
        $this->db->update('session');
    }
    function addEntity($idses, $device)
    {
        $this->db->join('session', 'session.sessclass = classhandshake.classid');
        $this->db->where('session.sessionid', $idses);
        $get = $this->db->get('classhandshake')->result_array();

        foreach ($get as $key) {
            $insert = [
                'session_id' => $idses,
                'device_id' => $device,
                'entity_id' => $key['studentid']
            ];
            $this->db->insert('sesshandshake', $insert);
        }
        return $device;
    }

    function updatearduino($stat, $device)
    {
        $this->db->where('iddevice', $device);
        $check  = $this->db->get('devicecommand');

        if ($check == null) {
            $in = [
                'iddevice' => $device,
                'command' => $stat,
                'command2' => null
            ];
            $this->db->insert('devicecommand', $in);
        } else {
            $up = [
                'command' => $stat,
                'command2' => null
            ];
            $this->db->where('iddevice', $device);
            $this->db->update('devicecommand', $up);
        }
    }
    function getrunningsess()
    {
        $this->db->join('sesshandshake', 'sesshandshake.session_id = session.sessionid');
        $this->db->join('device', 'device.id_device = sesshandshake.device_id');
        $this->db->join('user', 'user.userid = session.sessionauthor');
        $this->db->group_by('session_id');
        return $this->db->get('session')->result_array();
    }
    function checkauthor($id)
    {
        $this->db->join('session', 'session.sessionid = sesshandshake.session_id');
        $this->db->where('session.sessionauthor', $id);
        return $this->db->get('sesshandshake')->row_array();
    }
    function seerecent()
    {
        $this->db->join('student', 'student.studentid = result.entityid');
        $this->db->join('session', 'session.sessionid = result.sessionid');
        $this->db->order_by('timestamp', 'DESC');
        return $this->db->get('result')->result_array();
    }
    function checkactivesess($id)
    {
        $this->db->where('sessclass', $id);
        $check = $this->db->get('session')->row_array();

        if ($check['sessionstat'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
