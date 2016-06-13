<nav class="light-blue lighten-1" role="navigation">
	<div class="nav-wrapper container">
		<a id="logo-container" href="<?php echo BASE_URL;?>" class="brand-logo  center"> <img src="<?php echo BASE_URL;?>img/logo.png" alt="<?php echo APP_TITLE;?>"></a>
		<ul id="slide-out" class="side-nav">
			<li><img src="<?php echo BASE_URL;?>img/logo.png" style="width: 100%;" alt="<?php echo APP_TITLE;?>"></li>
			<!-- Display "login" or "logoff" -->
			<?php if(isset($_SESSION['id'])){?>
			<li><a href="<?php echo BASE_URL;?>login/logout"><i class="material-icons left">exit_to_app</i> Déconnexion</a></li>
			<?php }else{?>
			<li><a href="<?php echo BASE_URL;?>login"><i class="material-icons left">lock_open</i>Connexion</a></li>
			<li><a href="<?php echo BASE_URL;?>signup"><i class="material-icons left">add_circle</i>Créer un compte</a></li>
			<?php }?>
			<li class="divider"></li>
			<!-- EVERYONE -->
			<li><a href="<?php echo BASE_URL;?>search/praticien"><i class="material-icons left">search</i>Consulter nos praticiens</a></li>
			<li><a href="<?php echo BASE_URL;?>question"><i class="material-icons left">question_answer</i>Consulter les questions</a></li>
			<!-- MEMBERS, AUTHORS, DOCTORS, EXPERTS & ADMINISTRATORS -->
			<?php if(isset($_SESSION['id'])){?>
			<li class="divider"></li>
			<li><a href="<?php echo BASE_URL_ADMIN;?>"><i class="material-icons left">account_circle</i> Mon compte</a></li>
			<?php }?>
			<!-- AUTHORS & ADMINISTRATORS -->
			<?php if(isset($_SESSION['id']) && in_array($_SESSION['role'], ['Auteur', 'Administrateur'])){?>
			<li class="divider"></li>
			<li><a href="<?php echo BASE_URL_ADMIN;?>article"><i class="material-icons left">description</i>Gérer les articles</a></li>
            <li><a href="<?php echo BASE_URL_ADMIN;?>page"><i class="material-icons left">description</i>Gérer les pages</a></li>
			<?php }?>
			<!-- MEMBERS & ADMINISTRATORS -->
			<?php if(isset($_SESSION['id']) && in_array($_SESSION['role'], ['Member', 'Administrateur'])){?>
			<li class="divider"></li>
				<li><a href="<?php echo BASE_URL;?>question/index?mesQuestions"><i class="material-icons left">feedback</i> Mes questions</a></li>
			<?php }?>
			<!-- EXPERTS & ADMINISTRATORS -->
			<?php if(isset($_SESSION['id']) && in_array($_SESSION['role'], ['Administrateur', 'Expert'])){?>
			<li class="divider"></li>
			<li><a href="<?php echo BASE_URL_ADMIN;?>question/list"><i class="material-icons left">feedback</i>Gérer les questions</a></li>
			<?php }?>
			<!-- ADMINISTRATORS -->
			<?php if(isset($_SESSION['id']) && in_array($_SESSION['role'], ['Administrateur'])){?>
			<li class="divider"></li>
			<li><a href="<?php echo BASE_URL_ADMIN;?>utilisateur"><i class="material-icons left">supervisor_account</i>Utilisateurs</a></li>
			<li><a href="<?php echo BASE_URL_ADMIN;?>reglage"><i class="material-icons left">build</i>Réglages</a></li>
			<?php }?>
		</ul>
		
		<!-- RIGHT MENU -->
		
		<!-- if non loggued in -->
		<?php if(!isset($_SESSION['id'])){?>
		<ul class="right hide-on-med-and-down">
			<li><a href="<?php echo BASE_URL;?>login">Connexion</a></li>
			<li><a href="<?php echo BASE_URL;?>signup">Créer un compte</a></li>
		</ul>
		<?php }?>		
		<!-- if loggued in -->
		<?php if(isset($_SESSION['id'])){?>
		<ul id="logguedIn" class="dropdown-content">
			<li><a href="<?php echo BASE_URL_ADMIN;?>"><i class="material-icons left">account_circle</i> Mon compte</a></li>
			<li><a href="<?php echo BASE_URL;?>question/index?mesQuestions"><i class="material-icons left">feedback</i> Mes questions</a></li>
			<li class="divider"></li>
			<li><a href="<?php echo BASE_URL;?>login/logout"><i class="material-icons left">exit_to_app</i> Déconnexion</a></li>
		</ul>
		<ul class="right hide-on-med-and-down">
			<li><a class="dropdown-button" href="#!" data-activates="logguedIn"><i class="material-icons left">person</i><?php echo ($_SESSION['pseudo'] != null)?$_SESSION['pseudo']:$_SESSION['first_name'].' '.$_SESSION['last_name']?><i class="material-icons right">arrow_drop_down</i></a></li>
		</ul>
		<?php }?>
		
		
		<a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
	</div>
</nav>