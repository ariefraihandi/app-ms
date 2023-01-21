<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_m extends CI_Model
{

    function getUnder($idsub)
    {
        $q = $this->db->where('SELECT * FROM user_under_sub_menu WHERE id_submenu =' . $idsub . ';');
        $response = $q->result_array();
        return $response;
    }
}
