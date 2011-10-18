<?php

function  generate_user_menu_data()  {
    $CI =& get_instance();
    $is_logged_in = FALSE;
    if ($CI->session->userdata('is_logged_in')){
        $is_logged_in = TRUE;
    }

    if(isset($is_logged_in) || $is_logged_in == TRUE){
        $user_menu_data_array =
                array (
                    "Username" => $CI->session->userdata('username'),
                    "Create_new" => anchor('user/create_link_form', ' Create post '),
                    "Logout" => anchor('user/logout', ' Logout '),
                );
    }

    if(!isset($is_logged_in) || $is_logged_in != TRUE){
        $user_menu_data_array =
                array (
                    "Login" => anchor('user/Login', ' Login '),
                    "Signup" => anchor('user/Signup', ' Signup '),
                );
    }



    /*    $menu_data_array = array (
   "Lobby" => array (
       "Front page"              => "meta/lobby",
       "About this site"         => "meta/about",
   ),
   "Messaging" => array (
       "Public Forums"           => "forum",
       "Private Mail"            => "mail/inbox",

   )); */


    /*
      echo anchor('user/login', 'Login');
  echo anchor('user/signup', 'Register');
  echo anchor('user/logout', 'Logout');
  //echo $loggedinornot: */


    /*$admin_menu_data_array = array (
        "Admin Stuff" => array (
            "Log analysis"           => "admin/activity",
            "Recent changes"         => "admin/changes",
            "User management"        => "admin/users",
        ),
    );*/

    /// If we're logged in, we get an extra menu item under People




    /*if ($this->session->userdata('login_name'))
$menu_data_array["People"]["My details"] = "people/view/".
    $this->session->userdata('login_name');*/

    /// If we're admin, we get the special menu additions!
    /// (We merge, rather than a straight insert, as one day the admin menu
    /// additions may interweave with the user ones above.)
    /*if ($this->session->userdata('admin'))  {
        $admin_menu_array = array_merge_recursive ( $admin_menu_data_array , $menu_data_array );
        return ($admin_menu_array);
    }*/

    /// Otherwise, the boring ol' menu gets delivered.


    return $user_menu_data_array;
}

function generate_user_menu_array() {
    $user_menu_data_array = generate_user_menu_data();
    foreach ($user_menu_data_array as $user_menu_item) {
        echo $user_menu_item;
    }
}

function  generate_navigation_menu_data()  {
    $navigation_menu_data_array = array (
        "Lobby" => array (
            "Front page"              => "meta/lobby",
            "About this site"         => "meta/about",
        ),
        "Messaging" => array (
            "Public Forums"           => "forum",
            "Private Mail"            => "mail/inbox",

        ));


    return $navigation_menu_data_array;
}

function generate_navigation_menu_array() {
    $navigation_menu_data_array = generate_navigation_menu_data();

    foreach ($navigation_menu_data_array as $navigation_menu_item) {
        foreach ($navigation_menu_item as $v2) {
            echo $v2;
        }
    }
}


    