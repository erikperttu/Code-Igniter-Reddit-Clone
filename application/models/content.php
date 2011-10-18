<?php

class Content extends CI_model {

    function latest(){
        //$this->db->where('username', $username);
        $query = $this->db->get('links', 10);

        if ($query->num_rows() > 0 ){
            return $query->result();
        }
        return false;
    }


    function get_comments($post_id){
        $this->db->where('post_id', $post_id);
        $query = $this->db->get('comments', 10);
        if ($query->num_rows() > 0 ){
            return $query->result();
        }
        return false;
    }




}