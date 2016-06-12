<div class="row">
	<div class="col s12">
		<h4>Question:</h4>
	</div>
	<div class="col s12">
		<p><?php echo $question['question_title'];?></p>
	</div>
	<div class="col s12 ">
		<p><?php echo $question['question_text'];?></p>
	</div>
</div>
<p style="font-weight: bold">Réponse de notre expert</p>
<div class="row">
<?php if($answers){?>
<?php foreach($answers as $answer){?>
<div class="col s12 card grey">
		<div class="row">
			<div class="col s2">
				<img style="width: 100%; margin: 10px" src="<?php echo ($answer['url_avatar'] !== NULL)?$answer['url_avatar']:BASE_URL.'img/avatar/user.png';?>" alt="">
			</div>
			<div class="col s10">
				<p><?php echo $answer['answer_text'];?></p>
				<p style="text-align: right"><?php echo ($answer['pseudo'] !== NULL)?$answer['pseudo']:$answer['first_name'].' '.$answer['last_name'];?>, expert <?php echo APP_TITLE;?></p>
			</div>
		</div>
	</div>
<?php }?>
<?php }else{?>
	<div class="col s12 card grey">
		<p>Cette question n'a pas encore trouvé réponse</p>
	</div>
<?php }?>
</div>