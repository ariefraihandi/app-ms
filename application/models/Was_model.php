<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Was_model extends CI_Model
{

    // Get ikm
    function getWas()
    {

        $response = array();

        // Select record
        $this->db->select('*');
        $q = $this->db->get('pengawasan');
        $response = $q->result_array();

        return $response;
    }

    function data_responden()
    {
        return $this->db->get('pengawasan')->num_rows();
    }

    function data_tindak()
    {
        return $this->db->get('pengawasan_tindaklanjut')->num_rows();
    }
}
