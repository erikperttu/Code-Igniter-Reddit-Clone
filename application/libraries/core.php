<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Core {

    var $CI;
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

    function __construct(){


        $this->CI =& get_instance();


    }



    public function index()
    {
        #load latest content
        $this->CI->load->model('content');
        $query = $this->CI->content->latest();

        if($query == TRUE) {

            foreach($query as $row){

                $content[] =  array (
                    "Link_id" => $row->link_id,
                    "Link" => $row->link,
                    "Link_description" => $row->link_description,
                    "Link_rating" => $row->link_rating,
                    "Date_added" => $row->date_added,
                    "Comments" => anchor('user/comments', ' Comments '),
                );

            }
            return $content;

        }

        else {
                $content[] =  array (
                    "for" => ' for ',
                    "ever" => ' ever ',
                    "alone" => ' alone ',
                );
            return $content;
        }



    }

    public function get_comments_for_post(){
        $this->CI->load->model('content');
        $link_id = 1; //temp
        $query = $this->CI->content->get_comments($link_id);

        if($query == TRUE) {
            foreach($query as $row){
                $content[] =  array (
                    "Comment_id" => $row->comment_id,
                    "Comment_user" => $row->comment_user,
                    "Comment_text" => $row->comment_text,
                    "Comment_rating" => $row->comment_rating,
                    "Date_added" => $row->date_added,
                    "Comments" => anchor('user/reply', ' Reply '),
                );

            }
            //return $content;
            //echo $content;
            var_dump($content);        }

        else {
               redirect('default_page');
        }



    }
    function generate_content_array() {
        //$navigation_menu_data_array = generate_navigation_menu_data();
        $content = $this->index();
        //if (vad det nu är) $data
        $string = "";
        foreach ($content as $content_item) {
            foreach ($content_item as $content2) {
                $string .= $content2;
            }
        }
        return $string;
    }



}