<h4>Poser votre question</h4>
<p>Un expert qualifié y répondra dans les plus courts délais !</p>
<br>
<br>
<form action="" method="post">
	<div class="row">
		<div class="col s1">
			<img src="<?php echo $_SESSION['url_avatar'];?>" class="responsive-img">
		</div>
		<div class="col s11">
			<div class="row">
				<div class="input-field col s6">
					<input id="question_title" name="question_title" type="text" class="validate" placeholder="Votre question..." value="<?php echo (isset($_POST['question_title']))?$_POST['question_title']:'';?>" required>
					<label for="question_title">Question*</label>
				</div>
				<div class="input-field col s12">
					<textarea id="question_text" name="question_text" class="materialize-textarea ask" placeholder="Détails..." length="250"><?php echo (isset($_POST['question_text']))?$_POST['question_text']:'';?></textarea>
				</div>
			</div>
		</div>
		<div class="col s12">
			<a class="waves-effect waves-light btn right modal-trigger" href="#privacy"><i class="material-icons right">keyboard_arrow_right</i>Je valide ma question</a>
			<div id="privacy" class="modal">
				<div class="modal-content">
					<h4>Souhaitez-vous rendre votre question publique ?</h4>
					<p>Ainsi, d'autres visiteurs trouveront réponses à leurs questions grâce à vous !</p>
				</div>
				<div class="modal-footer">
					<a class="accept modal-action modal-close waves-effect waves-green btn-flat"> Oui, sans problème </a> <a class="refuse modal-action modal-close waves-effect waves-red btn-flat"> Non, je souhaite que ça reste privé </a>
				</div>
			</div>
		</div>
	</div>
	<input class="privacy" name="privacy" type="hidden" value="0">
</form>