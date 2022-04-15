<!DOCTYPE html>
<html lang="it">
<?php
include_once(sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once(sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>
<title>Home</title>
<form method="post">
    <?php
    include_once(sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
    switch(Session::read('type')){
        case 'amministratore': ?>
            <div class="container">
                <h2>Benvenuto <?php echo(Session::read('userName'))?></h2>
                <h3>Menu amministratore</h3>
                <p>
                    questa è la tua dashboard.
                    qui puoi creare e modificare le conferenze e gli utenti iscritti alla piattaforma
                </p>
            </div>
            <?php
            break;
        case 'speaker':?>
            <div class="container">
                <h2>Benvenuto <?php echo(Session::read('userName'))?></h2>
                <h3>Menu speaker</h3>
                <p>
                    questa è la tua dashboard.
                    qui puoi creare e modificare le conferenze e gli utenti iscritti alla piattaforma
                </p>
            </div>
            <?php
            break;
        case 'presenter': ?>
            <div class="container">
                <h2>Benvenuto <?php echo(Session::read('userName'))?></h2>
                <h3>Menu presenter</h3>
                <p>
                    questa è la tua dashboard.
                    qui puoi creare e modificare le conferenze e gli utenti iscritti alla piattaforma
                </p>
            </div>
            <?php
            break;
        default: ?>
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
                <img src="/resources/images/laptop-screen-webcam-view-diverse-people-engaged-in-group-videocall-picture-id1220226068.jpg" alt="meeting">
            </div>
        <?php
    }
    ?>
</form>
<?php
include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
?>
</body>
</html>