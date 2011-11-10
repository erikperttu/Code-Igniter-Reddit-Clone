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


                $content[] =  array ($row->link_id,
                                     $row->link,
                                     $row->link_description,
                                     $row->link_rating,
                                     $row->date_added,
                                     anchor('user/comments', ' Comments '),
                );

            }
            //var_dump($content);
            return $content;

        }

        else {
            $content =  array (
                ' for ',
                ' ever ',
                ' alone ',
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
                $content=  array (
                    $row->comment_id,
                    $row->comment_user,
                    $row->comment_text,
                    $row->comment_rating,
                    $row->date_added,
                    anchor('user/reply', ' Reply '),
                );

            }
            return $content;

        }

        else {
            $content =  array (
                " No one has commented yet :( ",
                anchor('user/add_comment', ' Add comment '),
            );
            return $content;
        }



    }
    function generate_content_array($data) {
        if ($data == 'main'){

            $content = $this->index();
            $this->format_main_content($content);
        }
        if ($data == 'comments'){

            $content = $this->get_comments_for_post();
            $this->format_comments($content);


        }
    }



    function format_main_content($aContent = array()) {
        $html = "";

        for($i=0;$i<count($aContent);$i++) {

                foreach($aContent[$i] as $foo){
                 var_dump($aContent[$i]);
                        @list($iLinkID, $sLink, $sDescription, $iRating, $sDateAdded, $sComments) = $foo;
                        $html .= "$iLinkID<br/>";
                        $html .= "$iRating<br/>";
                        $html .= "$sDateAdded";
                        $html .= "<h1> $sLink </h1>";
                        $html .= "<p>$sDescription</p>";
                        $html .= "$sComments<br/>";
                }
        }
        echo $html;

    }



    function format_comments($aContent = array()) {

        $html = "";
        @list($iCommentD, $sCommentUser, $sCommentText, $iCommentRating, $sDateAdded, $sReply) = $aContent;

        $html .= "$iCommentD";
        $html .= "$sDateAdded";
        $html .= "$iCommentRating";
        $html .= "<h1> $sCommentUser </h1>";
        $html .= "<p>$sCommentText</p>";
        $html .= "$sReply";
        echo $html;
    }

}