<?php
class videoController extends baseController {
    public function index(){
        $this->registry->template->listVideo = $this->registry->db->getListVideo();
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