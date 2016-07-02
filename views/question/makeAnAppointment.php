<div class="row">
	<div class="col s12">
		<h4>Besoin de plus de détails sur votre question ?</h4>
		<p>N'hésiter pas à prendre rendez-vous avec un médecin spécialisé de votre choix afin d'effectuer une consultation</p>
	</div>
</div>

<h5>Choisissez un médecin parmi la liste définie pour vous par votre expert <?php echo APP_TITLE;?></h5>
<?php foreach($proposedDoctors as $doctor){?>
<div class="row" style="border: black 1px solid; padding: 10px;">
	<div class="col s12 m3">
		<h4 class="ellipsis" style="direction: rtl;"><?php echo htmlentities($doctor['first_name_praticien'].' '.$doctor['last_name_praticien']);?></h4>
		<ul style="direction: rtl;">
			<?php foreach($doctor['skills'] as $skill){?>
			<li><?php echo htmlentities($skill);?></li>
			<?php }?>
		</ul>
	</div>
	<div class="col s12 m7">
		<p class="ellipsis"><?php echo htmlentities($doctor['presentation_praticien']);?></p>
	</div>
	<div class="col s12 m2">
		<p>
			<img class="responsive-img materialboxed" src="<?php echo $doctor['url_avatar_praticien'];?>" data-caption="<?php echo htmlentities($doctor['first_name_praticien'].' '.$doctor['last_name_praticien']);?>">
		</p>
		<p>
			<a href="#methodRDV" class="waves-effect waves-light btn modal-trigger BUTTON_BACKGROUND-COLOR"  data-id-doctor="<?php echo $doctor['id_praticien'];?>" style="width: 100%">
				<i class="material-icons">done</i>
			</a>
		</p>
	</div>
</div>
<?php }?>

<!-- Modal Structure -->
<div id="methodRDV" class="modal bottom-sheet" data-id-question="<?php echo $doctor['id_question'];?>" data-id-doctor="">
	<div class="modal-content">
		<div class="container">
			<div class="row step-1">
				<div class="col s12">
					<div class="progress" style="display:none">
						<div class="indeterminate"></div>
					</div>
					<p class="error red-text"></p>
				</div>
				<div class="col s6 center hoverable visio-conference" style="cursor:pointer">
					<i class="material-icons large">laptop_mac</i>
					<br>
					<p>Visio-conférence</p>
				</div>
				<div class="col s6 center hoverable physique" style="cursor:pointer">
					<i class="material-icons large">directions_walk</i>
					<br>
					<p>Se déplacer dans son cabinet</p>
				</div>
			</div>
			<div class="row step-2" style="display:none">
				<div class="col s12 center green lighten-2">
					<p>Votre demande de rendez-vous a été indiquée à votre praticien</p>
					<p>Pour définir une date, veuillez contacter votre praticien à l'aide des coordonnées ci-dessous</p>
				</div>
				<div class="col s12 m6">
					<p class="name"></p>
					<p class="address"></p>
					<p class="skills"></p>
				</div>
				<div class="col s12 m6">
					<p class="phone"></p>
					<p class="mobile"></p>
					<p class="email"></p>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-green btn-flat ">Annuler</a>
    </div>
</div>