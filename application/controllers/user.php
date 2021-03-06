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
    }

    public function login() {
        $data = generate_content_data();
        $data['main_content_view'] = $this->load->view('user/login_form','', TRUE);
        $this->load->view ('default', $data);
    }

    public function create_link_form() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(isset($is_logged_in) || $is_logged_in == TRUE){
            $data = generate_content_data();
            $data['main_content_view'] = $this->load->view('user/create_link_form','', TRUE);
            $this->load->view ('default', $data);
        }if(!isset($is_logged_in) || $is_logged_in != TRUE){
            redirect('default_page');
        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('default_page');
    }


    public function validate_credentials ()  {

        $this->load->model('membership');
        $query = $this->membership->validate();

        if($query == TRUE) {
            $user_id = $this->membership->get_user_id($this->input->post('username'));
            $data = array(
                'username' => $this->input->post('username'),
                'is_logged_in' => TRUE,
                'user_id' => $user_id->user_id
            );

            $this->session->set_userdata($data);
            redirect('default_page');
        }

        else {
            redirect('default_page');
        }
    }


    public function signup() {
        $data = generate_content_data();
        $data['main_content_view'] = $this->load->view('user/register_form','', TRUE);
        $this->load->view('default', $data);
    }

    public function create_user(){

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|callback_unique_username');
        $this->form_validation->set_rules('user_email', 'E-mail address', 'trim|required|valid_email|callback_unique_user_email');
        $this->form_validation->set_rules('user_password', 'User password', 'trim|required|min_length[6]|max_length[10]');
        $this->form_validation->set_rules('user_password_same', 'Re-type password', 'trim|required|matches[user_password]');

        if($this->form_validation->run() == FALSE) {
            $this->signup();
        }
        else {
            $this->load->model('membership');
            if($query = $this->membership->create_user()){
                $data = generate_content_data();
                $data['main_content_view'] = $this->load->view('user/created_user', '', TRUE);
                $this->load->view('default', $data);
            }
            else {
                $this->signup();
            }

        }
    }


    public function unique_username($str){
        $this->load->model('membership');
        $username =  $this->membership->get_username($str);
        if ($username == FALSE)
        {
            $this->form_validation->set_message('unique_username', 'That %s is already taken, please choose another');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function unique_user_email($str){
        $this->load->model('membership');
        $user_email =  $this->membership->get_user_email($str);
        if ($user_email == FALSE)
        {
            $this->form_validation->set_message('unique_user_email', '%s is already taken, please choose another');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function create_link(){

        $this->form_validation->set_rules('link', 'Link', 'required|min_length[5]');
        $this->form_validation->set_rules('link_description', 'Link description', 'required|min_length_[10]');

        if($this->form_validation->run() == FALSE) {
            $this->create_link_form();
        }
        else {
            $this->load->model('membership');
            if($query = $this->membership->create_link()){
                $data = generate_content_data();
                $data['main_content_view'] = $this->load->view('user/post_successful', '', TRUE);
                $this->load->view ('default',$data);
            }
            else {
                $this->create_link_form();
            }

        }
    }

    public function comments() {
        $data = generate_content_data();
        $data['main_content_view'] = $this->core->generate_content_array('comments');
        $this->load->view('default', $data);
    }


}

/* End of file default.php */
/* Location: ./application/controllers/default.php */