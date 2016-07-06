<h2>Liste des pages</h2>
<?php
if(!empty($listPage)){ 
?>
<div class="row">
    <?php
    foreach($listPage as $page){
        $user = $this->registry->db->getUser($page['id_user']);
    ?>
    <div class="col s12">
        <a href="<?php echo BASE_URL.'page/display/'.$page['id']?>"><?php echo $page['title']; ?></a>
    </div>
    <?php   
    }
    ?>
</div>
<?php
} else{
?>
<h3>Aucune page pour le moment.</h3>
<?php 
}
?>
