<?php
/**
 * Created by JetBrains PhpStorm.
 * User: emp-
 * Date: 10/6/11
 * Time: 4:37 PM
 * To change this template use File | Settings | File Templates.
 */

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

    public function get_username($username = NULL) {

        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() == 0 ){
            return true;
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