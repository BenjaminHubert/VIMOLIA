<?php
class indexController extends baseController {

    public function index(){
        $this->registry->template->listVideo = $this->registry->db->getListVideo();
        $this->registry->template->listArticle = $this->registry->db->getListArticle(true);
        $this->registry->template->show('index');
    }
}
?>