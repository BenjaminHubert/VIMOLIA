<?php
class videoController extends baseController {
    public function index(){
        $postExpected = ['id_category', 'id_thematic'];
        if($postExpected == array_keys($_POST)){
            $filter = false;
            foreach($_POST as $key => $val){
                if($val != -1){
                    $filter[$key] = $val;
                }
            }
        }else $filter = false;

        $this->registry->template->listCategory = $this->registry->db->listVideoCategory();
        $this->registry->template->listThematic = $this->registry->db->listVideoThematic();
        $this->registry->template->listVideo = $this->registry->db->getListVideo($filter);
        $this->registry->template->show('index');
    }

    public function display($args){
        if(isset($args[0]) && is_numeric($args[0])){
            $video = $this->registry->db->getVideoById($args[0]);
            if($video){
                $this->registry->template->video = $video;
                $this->registry->template->show('display');
            }else{
                $this->registry->template->show('404', true);
            }
        }else{
            $this->registry->template->show('404', true);
        }
    }
}