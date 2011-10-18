<?php

function  generate_content_data()  {

    $CI =& get_instance();
    $CI->load->library('core');

    $user_menu_data['user_menu_data_array'] = generate_user_menu_data();
    $data['user_menu_view'] = $CI->load->view ('common/user_menu', $user_menu_data, TRUE);
    $navigation_menu_data['navigation_menu_data_array'] = generate_navigation_menu_data();
    $data['navigation_menu_view'] = $CI->load->view ('common/navigation_menu', $navigation_menu_data, TRUE);
    $data['header'] = $CI->load->view('common/header', '', TRUE);
    $data['main_content_view'] = $CI->core->generate_content_array();
    $data['footer'] = $CI->load->view('common/footer', '', TRUE);
    return $data;
}


function is_logged_in(){
    $CI =& get_instance();
    $is_logged_in = $CI->session->userdata('is_logged_in');
    return $is_logged_in;

}