<h4>Questions publiques</h4>
<div class="row">
	<div class="col s12 right">
		<a href="<?php echo BASE_URL;?>question/add" class="waves-effect waves-light btn right"><i class="material-icons left">add</i>QUESTION</a>
	</div>
	<?php if(isset($_SESSION['id'])){?>
	<div class="col s12">
		<ul class="tabs">
			<li class="tab col s6"><a class="active" href="#allQuestions">Toutes les questions</a></li>
			<li class="tab col s6"><a href="#myQuestions">Mes questions</a></li>
		</ul>
	</div>
	<?php }?>

	<div id="allQuestions">
		<?php if(!(is_array($questions) && count($questions) > 0)){?>
		<p>Il n'y a actuellement aucune question posée. Soyez la première personne à poser une question!</p>
		<?php }else{?>
		<?php foreach($questions as $question){?>
		<!-- Seulement les questions autorisées à être publiées -->
		<?php if($question['is_public'] == 1){?> 
		<div class="question col s12">
			<h5><?php echo htmlentities($question['question_title']);?></h5>
			<div class="question_text">
				<?php
				
				if(strlen($question['question_text']) > 150){
					$tmp = substr($question['question_text'], 0, 150);
					echo substr($tmp, 0, strrpos($tmp, ' ')) . '[...]';
				}else
					echo $question['question_text'];
				?>
			</div>
			<a href="<?php echo BASE_URL.'question/afficher/'.$question['id'];?>">Lire la suite</a>
		</div>
		<?php }?>
		<?php }?>
		<?php }?>
	</div>

	<div id="myQuestions">
		<?php if(isset($_SESSION['id'])){?>
		<?php if(!(is_array($questions) && count($questions) > 0)){?>
		<p>Il n'y a actuellement aucune question posée. Soyez la première personne à poser une question!</p>
		<?php }else{?>
		<?php foreach($questions as $question){?>
		<!-- Seulement les questions autorisées à être publiées -->
		<?php if($question['is_public'] == 1 && $question['id_user'] == $_SESSION['id']){?> 
		<div class="question col s12">
			<h5><?php echo htmlentities($question['question_title']);?></h5>
			<div class="question_text">
				<?php
				
				if(strlen($question['question_text']) > 150){
					$tmp = substr($question['question_text'], 0, 150);
					echo substr($tmp, 0, strrpos($tmp, ' ')) . '[...]';
				}else
					echo $question['question_text'];
				?>
			</div>
			<a href="<?php echo BASE_URL.'question/afficher/'.$question['id'];?>">Lire la suite</a>
		</div>
		<?php }}}}?>
	</div>
</div>