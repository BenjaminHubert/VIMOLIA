<?php
class articleController extends baseController {
	protected $registry;
	public function __construct($registry){
		// default behavior
		parent::__construct($registry);
		// check rights
		if(!in_array($_SESSION['role'], [
			'Administrateur',
			'Auteur'
		])){
			$registry->template->show('403', true);
			die();
		}
	}
    public function index(){
        // Liste des articles
        $this->registry->template->listArticle = $this->registry->db->getListArticle();
        $this->registry->template->show('index');
    }

    public function add($args){   
        // Ajouter un article
        $postExpected = ['title', 'main_picture', 'description', 'content', 'date_publish', 'date_publish_submit', 'hour_publish', 'minute_publish', 'submit'];
        $fileExpected = ['main_picture_file'];

        if($postExpected == array_keys($_POST) && $fileExpected == array_keys($_FILES)){

            $info = pathinfo($_FILES['main_picture_file']['name']);
            $ext = $info['extension'];

            $_POST['main_picture'] = '/img/articleImage/'.preg_replace("/[^A-Za-z0-9]/", "", $_POST['title']).'_'.time().'.'.$ext;
            $_POST['date_publish'] = date('Y-m-d H:i:s', strtotime($_POST['date_publish_submit']."+".$_POST['hour_publish']." hours +".$_POST['minute_publish']." minutes"));
            $_POST['id_user'] = $_SESSION['id'];

            foreach($postExpected as $var){
                $$var = $_POST[$var];
            }
            uploadFile($_FILES, 'main_picture_file', $_POST['main_picture']);
            $this->registry->db->addArticle($_POST);
            header('Location:'.$this->registry->config['base_url'].'/admin/article');
        }
        else $this->registry->template->show('add');
    }

    public function edit($args){
        if(isset($args[0]) && is_numeric($args[0])){
            if(!empty($article = $this->registry->db->getArticleById($args[0]))){
                $this->registry->template->article = $article;
                
                // Modifier un article
                $postExpected = ['title', 'original_file', 'main_picture', 'description', 'content', 'date_publish', 'date_publish_submit', 'hour_publish', 'minute_publish', 'submit'];
                $fileExpected = ['main_picture_file'];

                if($postExpected == array_keys($_POST) && $fileExpected == array_keys($_FILES)){
                    $editFile = $_FILES['main_picture_file']['name'];
                    if($editFile != ''){
                        $info = pathinfo($_FILES['main_picture_file']['name']);
                        $ext = $info['extension'];

                        $_POST['main_picture'] = '/img/articleImage/'.preg_replace("/[^A-Za-z0-9]/", "", $_POST['title']).'_'.time().'.'.$ext;
                        uploadFile($_FILES, 'main_picture_file', $_POST['main_picture']);
                    } else{$_POST['main_picture'] = $_POST['original_file'];}

                    $_POST['date_publish'] = date('Y-m-d H:i:s', strtotime($_POST['date_publish_submit']."+".$_POST['hour_publish']." hours +".$_POST['minute_publish']." minutes"));
                    $_POST['id_user'] = $_SESSION['id'];

                    foreach($postExpected as $var){
                        $$var = $_POST[$var];
                    }

                    $this->registry->db->editArticle($_POST, $args[0]);
                    header('Location:'.$this->registry->config['base_url'].'/admin/article');
                }else $this->registry->template->show('edit');
            }else $this->registry->template->show('404', true);
        }else $this->registry->template->show('404', true);
    }
}
?>