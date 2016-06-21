<div class="row">
	<div class="col s12">
		<h4>Besoin de plus de détails sur votre question ?</h4>
		<p>N'hésiter pas à prendre rendez-vous avec un médecin spécialisé de votre choix afin d'effectuer une consultation</p>
	</div>
</div>

<h5>Choissiez un médecin parmi la liste définie pour vous par votre expert <?php echo APP_TITLE;?></h5>
<?php foreach($proposedDoctors as $doctor){?>
<div class="row" style="border: black 1px solid; padding: 10px;">
	<div class="col s12 m3">
		<h4 class="ellipsis" style="direction: rtl;"><?php echo htmlentities($doctor['first_name_praticien'].' '.$doctor['last_name_praticien']);?></h4>
		<ul style="direction: rtl;">
			<?php foreach($doctor['skills'] as $skill){?>
			<li><?php echo $skill;?></li>
			<?php }?>
		</ul>
	</div>
	<div class="col s12 m7">
		<p class="ellipsis"><?php echo htmlentities($doctor['presentation_praticien']);?></p>
	</div>
	<div class="col s12 m2">
		<p>
			<img class="responsive-img materialboxed" src="<?php echo $doctor['url_avatar_praticien'];?>" data-caption="<?php echo $doctor['first_name_praticien'].' '.$doctor['last_name_praticien'];?>">
		</p>
		<p>
			<a href="#methodRDV" class="waves-effect waves-light btn blue-grey btn modal-trigger" style="width: 100%">
				<i class="material-icons">done</i>
			</a>
		</p>
	</div>
</div>
<?php }?>

<!-- Modal Structure -->
<div id="methodRDV" class="modal bottom-sheet">
	<div class="modal-content">
		<h4>Modal Header</h4>
		<p>A bunch of text</p>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
	</div>
</div>