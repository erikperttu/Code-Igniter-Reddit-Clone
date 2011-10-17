<?php

class Membership extends CI_model {

    function validate(){

        $this->db->where('username', $this->input->post('username'));
        $this->db->where('user_password', sha1($this->input->post('user_password')));
        $query = $this->db->get('users');

        if($query->num_rows == 1){
            return true;
        }
    }

    public function create_user() {

        $new_member_insert_data = array (

            'username' => $this->input->post('username'),
            'user_email' =>$this->input->post('user_email'),
            'user_password' =>sha1($this->input->post('user_password'))

        );

        $insert = $this->db->insert('users', $new_member_insert_data);
        return $insert;
    }

    public function create_link() {

        $new_link_insert_data = array (

            'link' => $this->input->post('link'),
            'link_description' =>$this->input->post('link_description'),
            //'user_password' =>sha1($this->input->post('user_password'))
        );

        $insert = $this->db->insert('links', $new_link_insert_data);

        $new_link_user_data = array (

            'user_id' => $this->session->userdata('user_id'),
            'link_id' => $this->db->insert_id(),

        );
        $this->db->insert('link_user_rel', $new_link_user_data);

        return $insert;
    }

    public function get_username($username = NULL) {

        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() == 0 ){
            return true;
        }
        return false;

    }


    public function get_user_id($username = NULL) {

        $this->db->select('user_id');
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if ($query->num_rows() != 0 ){
            return $query->row();
        }
        return false;

    }


    public function get_user_email($user_email = NULL) {

        $this->db->where('user_email', $user_email);
        $query = $this->db->get('users');

        if ($query->num_rows() == 0 ){
            return true;
        }
        return false;

    }


}