<?php
include_once ('logic/Session.php');
Session::start();
Session::dump();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Info Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">

	<title>Login</title>
</head>
<body>
<form>
	<div class="container">
		<div class="row justify-content-between">
			<div class="imgcontainer">
				<img src="resources/images/confvirtualTitle.png" alt="Avatar" class="avatar">
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fa fa-bars"></span> Menu
			</button>
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conferenze</a>
						<div class="dropdown-menu" aria-labelledby="dropdown04">
							<a class="dropdown-item" href="pages/NotLoggedFutureConferences.php">Prossime confereze</a>
							<a class="dropdown-item" href="pages/NotLoggedPastConferences.php">Conferenze passate</a>
						</div>
					</li>
					<li class="nav-item"><a href="pages/Info.html" class="nav-link">Informazioni</a></li>
					<li class="nav-item"><a href="pages/LoginPage.php" class="nav-link">accedi</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<h1>COSA È CONFVIRTUAL?</h1>
		<p>
			<strong>Confvirtual</strong>
			è una piattaforma per la gestione di conferenze online. La piattaforma supporta l’organizzazione di conferenze
			svolte mediante video-conferenze da remoto. In particolare, consente agli utenti organizzatori la creazione
			di conferenze con sessioni di presentazioni di articoli/tutorial, e relativi link	alle stanze	Teams per
			la partecipazione	alle stesse.Gli	utenti	possono	registrarsi alle conferenze, aggiungere i propri dati
			nel caso di speaker/presenter ed interagire con altri utenti	mediante servizi di	messaggistica interni.
		</p>
	</div>
	<div class="container">
		<img src="resources/images/laptop-screen-webcam-view-diverse-people-engaged-in-group-videocall-picture-id1220226068.jpg">
	</div>
</form>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>