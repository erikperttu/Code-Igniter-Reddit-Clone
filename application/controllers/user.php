<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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

       //$data['main_content_view'] = 'user/login_form.php';
       //$this->load->view('default', $data);

    }


    public function login() {
        //$tmp_data['menu_data_array'] = $this->load->default_>_generate_menu_data();
        //$this->data['main_menu_view'] = $this->load->view ('common/create_table_main_menu', $tmp_data, TRUE);


        $data['header'] = $this->load->view('common/header', '', TRUE);
        $data['footer'] = $this->load->view('common/footer', '', TRUE);
        //$data['main_menu_view'] = $this->load->view ('common/create_table_main_menu', $tmp_data, TRUE);
        $data['main_content_view'] = $this->load->view('user/login_form','', TRUE);
        $this->load->view('default', $data);

    }

    public function validate_credentials ()  {

        $this->load->model('membership');
        $query = $this->membership->validate();

        if($query == true) {
            $data = array(
                'username' => $this->input->post('username'),
                'is_logged_in' => true
                //'user_password' => $this->input->post('user_password')
            );

            $this->session->set_userdata($data);
            echo "logged in";
            // redirect('default_page');
        }

        else {
            echo "feeel";
            //$this->load->view('default');
        }

    }

    public function signup() {

        $data['header'] = $this->load->view('common/header', '', TRUE);
        $data['footer'] = $this->load->view('common/footer', '', TRUE);
        //$data['main_menu_view'] = $this->load->view ('common/create_table_main_menu', $tmp_data, TRUE);
        $data['main_content_view'] = $this->load->view('user/register_form','', TRUE);
        $this->load->view('default', $data);
    }

    public function create_user(){

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('user_email', 'User email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_password', 'User password', 'trim|required|min_length[6]|max_length[10]');
        $this->form_validation->set_rules('user_password_same', 'Re-type password', 'trim|required|matches[user_password]');

        if($this->form_validation->run() == FALSE) {
            $this->signup();
        }
        else {
            $this->load->model('membership');
            if($query = $this->membership->create_user()){
                $data['main_content_view'] = $this->load->view('user/created_user', '', TRUE);
                $data['header'] = $this->load->view('common/header', '', TRUE);
                $data['footer'] = $this->load->view('common/footer', '', TRUE);
                $this->load->view('default', $data);
            }
         else {
             $this->signup();
         }

        }
    }
}

/* End of file default.php */
/* Location: ./application/controllers/default.php */