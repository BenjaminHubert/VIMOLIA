<h4>Questions publiques</h4>
<div class="row">
	<div class="col s12 right">
		<a href="<?php echo BASE_URL;?>question/add" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>QUESTION</a>
	</div>
<?php foreach($questions as $question){?>
<?php if($question['is_public'] == 1){?>
<div class="question col s12 card">
	<h5><?php echo htmlentities($question['question_title']);?></h5>
	<div class="question_text">
		<?php 
			
			if(strlen($question['question_text']) > 150){
				$tmp = substr($question['question_text'], 0, 150);
				echo substr($tmp, 0, strrpos($tmp, ' ')).'[...]';
			}else echo $question['question_text'];
		?>
	</div>
	<a href="<?php echo BASE_URL.'question/afficher/'.$question['id'];?>">Lire la suite</a>
</div>
<?php }?>
<?php }?>
</div>