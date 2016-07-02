<nav role="navigation" class="HEADER_BACKGROUND-COLOR">
	<div class="nav-wrapper container">
		<a id="logo-container" href="<?php echo BASE_URL;?>" class="brand-logo  center">
			<img src="<?php echo BASE_URL;?>img/logo.png" alt="<?php echo APP_TITLE;?>">
		</a>
		<ul id="slide-out" class="side-nav collapsible PRIMARY_BACKGROUND-COLOR" style="border-color: transparent;" data-collapsible="accordion">
			<!-- USER AVATAR -->
			<li>
				<?php if(isset($_SESSION['url_avatar'])){?>
					<img src="<?php echo htmlentities($_SESSION['url_avatar']);?>" style="width: 30%;display: block;margin-left: auto;margin-right: auto;border-radius: 100%;" alt="Picture not found">
					<p class="center truncate"><?php echo htmlentities($_SESSION['email']);?></p>
				<?php }else{?>
				<?php }?>
			</li>
			<!-- Displaying "login" or "logoff" -->
			<?php if(isset($_SESSION['id'])){?>
			<li class="row">
				<a class="col s6 center PRIMARY_COLOR" href="<?php echo BASE_URL_ADMIN;?>">Mon compte</a>
				<a class="col s6 center PRIMARY_COLOR" href="<?php echo BASE_URL.'login/logout?url='.getCurrentUrl();?>">Déconnexion</a>
			</li>
			<?php }else{?>
			<li class="row">
				<a class="col s6 center PRIMARY_COLOR" href="<?php echo BASE_URL.'login?url='.getCurrentUrl();?>">Connexion</a>
				<a class="col s6 center PRIMARY_COLOR" href="<?php echo BASE_URL;?>signup">Créer un compte</a>
			</li>
			<?php }?>
			<!-- EVERYONE -->
			<li class="active">
				<div class="collapsible-header active PRIMARY_COLOR"><i class="material-icons left ACCENT_COLOR">public</i>Espace Public<i class="material-icons right">arrow_drop_down</i></div>
				<div class="collapsible-body">
					<a href="<?php echo BASE_URL;?>search/praticien">Consulter nos praticiens</a>
					<a href="<?php echo BASE_URL;?>question">Consulter les questions</a>
					<a href="<?php echo BASE_URL;?>article">Nos articles</a>
					<a href="<?php echo BASE_URL;?>video">Nos vidéos</a>
				</div>
			</li>
			<!-- AUTHORS & ADMINISTRATORS -->
			<?php if(isset($_SESSION['id']) && in_array($_SESSION['role'], ['Auteur', 'Administrateur'])){?>
			<li class="divider"></li>
			<li>
				<div class="collapsible-header PRIMARY_COLOR"><i class="material-icons left ACCENT_COLOR">description</i>Espace Auteur<i class="material-icons right">arrow_drop_down</i></div>
				<div class="collapsible-body">
					<a href="<?php echo BASE_URL_ADMIN;?>article">Gérer les articles</a>
					<a href="<?php echo BASE_URL_ADMIN;?>page">Gérer les pages</a>
					<a href="<?php echo BASE_URL_ADMIN;?>video">Gérer les vidéos</a>
				</div>
			</li>
			<?php }?>
			<!-- DOCTORS & ADMINISTRATORS -->
			<?php if(isset($_SESSION['id']) && in_array($_SESSION['role'], ['Praticien', 'Administrateur'])){?>
			<li class="divider"></li>
			<li>
				<div class="collapsible-header PRIMARY_COLOR"><i class="material-icons left ACCENT_COLOR">content_paste</i>Espace Praticien<i class="material-icons right">arrow_drop_down</i></div>
				<div class="collapsible-body">
					<a href="<?php echo BASE_URL_ADMIN;?>mesRendezVous">Mes rendez-vous</a>
					<a href="<?php echo BASE_URL_ADMIN;?>monAbonnement">Mon abonnements</a>
				</div>
			</li>
			<?php }?>
			<!-- MEMBERS & ADMINISTRATORS -->
			<?php if(isset($_SESSION['id']) && in_array($_SESSION['role'], ['Membre', 'Administrateur'])){?>
			<li class="divider"></li>
			<li>
				<div class="collapsible-header PRIMARY_COLOR"><i class="material-icons left ACCENT_COLOR">assignment_ind</i>Espace Membre<i class="material-icons right">arrow_drop_down</i></div>
				<div class="collapsible-body">
					<a href="<?php echo BASE_URL;?>question/index?mesQuestions">Mes questions</a>
					<a href="<?php echo BASE_URL_ADMIN;?>mesRendezVous">Mes rendez-vous</a>
				</div>
			</li>
			<?php }?>
			<!-- EXPERTS & ADMINISTRATORS -->
			<?php if(isset($_SESSION['id']) && in_array($_SESSION['role'], ['Administrateur', 'Expert'])){?>
			<li class="divider"></li>
			<li>
				<div class="collapsible-header PRIMARY_COLOR"><i class="material-icons left ACCENT_COLOR">dvr</i>Espace Expert<i class="material-icons right">arrow_drop_down</i></div>
				<div class="collapsible-body">
					<a href="<?php echo BASE_URL_ADMIN;?>question/list">Gérer les questions</a>
				</div>
			</li>
			<?php }?>
			<!-- ADMINISTRATORS -->
			<?php if(isset($_SESSION['id']) && in_array($_SESSION['role'], ['Administrateur'])){?>
			<li class="divider"></li>
			<li>
				<div class="collapsible-header PRIMARY_COLOR"><i class="material-icons left ACCENT_COLOR">settings_applications</i>Espace Admin<i class="material-icons right">arrow_drop_down</i></div>
				<div class="collapsible-body">
					<a href="<?php echo BASE_URL_ADMIN;?>utilisateur">Utilisateurs</a>
					<a href="<?php echo BASE_URL_ADMIN;?>reglage">Réglages</a>
					<a href="<?php echo BASE_URL_ADMIN;?>reglage/advanced">Réglages avancés</a>
				</div>
			</li>
			<?php }?>
		</ul>

		<!-- RIGHT MENU -->

		<!-- if non loggued in -->
		<?php if(!isset($_SESSION['id'])){?>
		<ul class="right hide-on-med-and-down">
			<li>
				<a href="<?php echo BASE_URL.'login?url='.getCurrentUrl();?>">Connexion</a>
			</li>
			<li>
				<a href="<?php echo BASE_URL;?>signup">Créer un compte</a>
			</li>
		</ul>
		<?php }?>		
		<!-- if loggued in -->
		<?php if(isset($_SESSION['id'])){?>
		<ul id="logguedIn" class="dropdown-content">
			<li>
				<a href="<?php echo BASE_URL_ADMIN;?>">
					<i class="material-icons left">account_circle</i>
					Mon compte
				</a>
			</li>
			<?php if(in_array($_SESSION['role'], ['Membre', 'Administrateur'])){?><li>
				<a href="<?php echo BASE_URL;?>question/index?mesQuestions">
					<i class="material-icons left">feedback</i>
					Mes questions
				</a>
			</li><?php }?>
			<li class="divider"></li>
			<li>
				<a href="<?php echo BASE_URL.'login/logout?url='.getCurrentUrl();?>">
					<i class="material-icons left">exit_to_app</i>
					Déconnexion
				</a>
			</li>
		</ul>
		<ul class="right hide-on-med-and-down">
			<li>
				<a class="dropdown-button" href="#!" data-activates="logguedIn">
					<i class="material-icons left">person</i><?php echo ($_SESSION['pseudo'] != null)?htmlentities($_SESSION['pseudo']):htmlentities($_SESSION['first_name'].' '.$_SESSION['last_name']);?><i class="material-icons right">arrow_drop_down</i>
				</a>
			</li>
		</ul>
		<?php }?>
		
		
		<a href="#" data-activates="slide-out" class="button-collapse show-on-large">
			<i class="material-icons">menu</i>
		</a>
	</div>
</nav>