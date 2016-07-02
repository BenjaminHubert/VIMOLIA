<form action="" method="post">
	<div class="row">
		<div class="input-field col s12">
			<h5>Choix de l'abonnement</h5>
			<img style="width: 30%;" class="responsive-img" src="<?php echo BASE_URL;?>img/paypal.png">
		</div>
		<div class="col s12">
			<?php foreach($subscription_types as $subscriptionType){?>
	        <div class="input-field col s12 m4 l4">
		        <h6 class="center-align" style="font-weight:bold"><?php echo htmlentities($subscriptionType['name']);?></h6>
		        <div class="card-panel light-blue lighten-5">
			        <p class="center-align"><?php echo htmlentities($subscriptionType['description']);?></p>
			        <p class="center-align"><?php echo htmlentities($subscriptionType['amount'].$subscriptionType['currencycode']);?> pour <?php echo htmlentities($subscriptionType['duration_days']);?> jours</p>
			        <p>
				        <input class="with-gap" name="subscription_type" value="<?php echo $subscriptionType['id'];?>" type="radio" id="<?php echo htmlentities($subscriptionType['name']);?>">
				        <label for="<?php echo htmlentities($subscriptionType['name']);?>">Je choisis cette option</label>
			        </p>
		        </div>
	        </div>
	        <?php }?>
		</div>
		<div class="input-field col s12 m4 offset-m8">
			<button class="btn waves-effect waves-light BUTTON_BACKGROUND-COLOR" type="submit" style="width:100%" name="valid">Valider
				<i class="material-icons right">send</i>
			</button>
		</div>
	</div>
</form>