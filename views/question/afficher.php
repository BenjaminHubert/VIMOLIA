<div class="row">
	<div class="col s12">
		<h4>Question:</h4>
	</div>
	<div class="col s12">
		<p style="font-weight:bold"><?php echo $question['question_title'];?></p>
	</div>
	<div class="col s12 card grey">
		<p><?php echo $question['question_text'];?></p>
	</div>
</div>
<p style="font-weight:bold">Réponse de notre expert</p>
<div class="row">
<?php if($answers){?>
<?php foreach($answers as $answer){?>
	<div class="col s12 card grey">
		<p><?php echo $answer['answer_text'];?></p>
		<p style="text-align:right"><?php echo ($answer['pseudo'] !== NULL)?$answer['pseudo']:$answer['first_name'].' '.$answer['last_name'];?>, expert <?php echo APP_TITLE;?></p>
	</div>
<?php }?>
<?php }else{?>
	<div class="col s12">
		<p>Cette question n'a pas encore trouvé réponse</p>
	</div>
<?php }?>
</div>