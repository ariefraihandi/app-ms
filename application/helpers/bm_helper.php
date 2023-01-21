<?php
function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('username')) {
        $params = $_SERVER['QUERY_STRING'];
        $ci->session->set_flashdata('url', current_url() . '?' . $params);
        redirect('auth');
    } else {
        $role_id    = $ci->session->userdata('role_id');
        $menu       = $ci->uri->segment(1);

        $queryMenu  = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id    = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id'       => $role_id,
            'menu_id'       => $menu_id,
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('user');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci =  get_instance();
    $result = $ci->db->get_where('user_access_menu', [
        'role_id'   =>  $role_id,
        'menu_id'   =>  $menu_id,
    ]);

    if ($result->num_rows()  > 0) {
        return "checked='cheked'";
    }
}

function check_subaccess($role_id, $submenu_id)
{
    $ci =  get_instance();
    $result = $ci->db->get_where('user_access_submenu', [
        'role_id'      =>  $role_id,
        'submenu_id'   =>  $submenu_id,
    ]);

    if ($result->num_rows()  > 0) {
        return "checked='cheked'";
    }
}

function check_undersubaccess($role_id, $submenu_id)
{
    $ci =  get_instance();
    $result = $ci->db->get_where('user_access_undersub', [
        'role_id'      =>  $role_id,
        'under_id'   =>  $submenu_id,
    ]);

    if ($result->num_rows()  > 0) {
        return "checked='cheked'";
    }
}
