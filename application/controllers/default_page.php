<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Default_page extends CI_Controller {

    function __construct(){

        parent::__construct();
        generate_user_menu_data();

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

        $data = generate_content_data();
        $this->load->view ('default', $data);

    }

    /*public function get_comments(){
        $data = generate_comment_data();
        $this->load->view ('default', $data);
    }*/

}
