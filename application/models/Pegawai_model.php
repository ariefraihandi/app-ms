<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{

    // Get cities
    function getPegawai()
    {

        $response = array();

        // Select record
        $this->db->select('*');
        $q = $this->db->get('user');
        $response = $q->result_array();

        return $response;
    }

    function getJabatan()
    {

        $response = array();

        // Select record
        $this->db->select('*');
        $q = $this->db->get('tb_jabatan');
        $response = $q->result_array();

        return $response;
    }

    function getRole()
    {

        $response = array();

        // Select record
        $this->db->select('*');
        $q = $this->db->get('user_role');
        $response = $q->result_array();

        return $response;
    }

    function data_pegawai()
    {
        return $this->db->get('user')->num_rows();
    }

    function hakim()
    {
        $q = "SELECT COUNT(jabatan) as jabatan FROM `user` WHERE jabatan = 'Hakim'";
        $result = $this->db->query($q);
        return $result->row()->jabatan;
    }

    function pegawai()
    {
        $q = "SELECT COUNT(jabatan) as jabatan FROM `user` WHERE jabatan = 'Pegawai'";
        $result = $this->db->query($q);
        return $result->row()->jabatan;
    }

    function ppnpn()
    {
        $q = "SELECT COUNT(jabatan) as jabatan FROM `user` WHERE jabatan = 'PPNPN'";
        $result = $this->db->query($q);
        return $result->row()->jabatan;
    }

    function cpns()
    {
        $q = "SELECT COUNT(jabatan) as jabatan FROM `user` WHERE jabatan = 'CPNS'";
        $result = $this->db->query($q);
        return $result->row()->jabatan;
    }
}
