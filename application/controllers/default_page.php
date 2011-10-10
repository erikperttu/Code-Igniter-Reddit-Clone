<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Default_page extends CI_Controller {

    function __construct(){

        parent::__construct();
        $this->is_logged_in();

    }


    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {

        /*
         * Returning views as data
         * There is a third optional parameter lets you change the behavior of the function so that it returns data as
         * a string rather than sending it to your browser. This can be useful if you want to process the data in some
         * way. If you set the parameter to true (boolean) it will return data. The default behavior is false, which
         * sends it to your browser. Remember to assign it to a variable if you want the data returned:
         *
         * $string = $this->load->view('myfile', '', true);
         */

        $disptext  = "Location stuff happens in here somewhere.";


        $tmp_data['menu_data_array'] = $this->_generate_menu_data();
        $this->data['main_menu_view'] = $this->load->view ('common/create_table_main_menu', $tmp_data, TRUE);
        $this->data['header'] = $this->load->view('common/header', '', TRUE);
        $this->data['main_content_view'] = $disptext;
        $this->data['footer'] = $this->load->view('common/footer', '', TRUE);
        $this->load->view ('default', $this->data);

    }

    public function is_logged_in(){

                        /*'username' => $this->input->post('username'),
                'is_logged_in' => true */


        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) | $is_logged_in != TRUE){
            
            echo "not logged in durr";
            die();
        }
    }



    private function  _generate_menu_data ()  {
        $menu_data_array = array (
            "Lobby" => array (
                "Front page"              => "meta/lobby",
                "About this site"         => "meta/about",
            ),
            "Messaging" => array (
                "Public Forums"           => "forum",
                "Private Mail"            => "mail/inbox",
            ));


        $admin_menu_data_array = array (
            "Admin Stuff" => array (
                "Log analysis"           => "admin/activity",
                "Recent changes"         => "admin/changes",
                "User management"        => "admin/users",
            ),
        );

        /// If we're logged in, we get an extra menu item under People
        if ($this->session->userdata('login_name'))
            $menu_data_array["People"]["My details"] = "people/view/".
                                                       $this->session->userdata('login_name');

        /// If we're admin, we get the special menu additions!
        /// (We merge, rather than a straight insert, as one day the admin menu
        /// additions may interweave with the user ones above.)
        if ($this->session->userdata('admin'))  {
            $admin_menu_array = array_merge_recursive ( $admin_menu_data_array , $menu_data_array );
            return ($admin_menu_array);
        }

        /// Otherwise, the boring ol' menu gets delivered.

        return ($menu_data_array);

    }
    /*public function login() {
        $data['main_content_view'] = 'user/login_form.php';
        $this->load->view('default', $data);

    }*/

}

/* End of file default.php */
/* Location: ./application/controllers/default.php */