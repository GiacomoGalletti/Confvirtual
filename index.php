<?php
include_once(sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once(sprintf("%s/logic/StatsQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
echo '
<!DOCTYPE html>
<html lang="it">
';
include_once(sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>

<form method="post">
    <?php
    include_once(sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
    ?>

    <div class="container">
    <!-- statistiche visibili a tutti. -->

     <h3> Statistiche Confvirtual:</h3>

        <?php
        $confRegitrate= StatsQueryController::getContaConferenzeRegistrate() ;
        $confAttive= StatsQueryController::getContaConferenzeAttive();
        $utRegistrati= StatsQueryController::getContaUtentiTotali();
       // print_r($confRegitrate);

        echo "<p1>Tot. conferenze registrate: </p1>".$confRegitrate[0]['numConferenzeRegistrate'].'<br />';
        echo "<p1>Tot. conferenze attive: </p1>".$confAttive[0]['numConferenzeAttive'].'<br />';
        echo "<p1>Tot. utenti registrati: </p1>".$utRegistrati[0]['numUtentiTotali'].'<br />';


        ?>
    <h3> classifica presenter e speaker:</h3>
        <div style="display: inline;">
            <p>Speaker/Tutorial </p>
            <?php $speakers_rank = StatsQueryController::getRankingSpeaker();
            if(sizeof($speakers_rank) >0 ) {
                echo '<ol>';
                    for($i = 0;$i<5;$i++) {
                        if (isset($speakers_rank[$i])) {
                            echo '<li>utente: <b>'.$speakers_rank[$i]['userName'].'</b> media valutazioni: <b>'. round($speakers_rank[$i]['mediaVoti'],2).'</b></li>';
                        }
                    }
                echo '</ol>';
            } else {
                echo '<p>Nessuna Valutazione Disponibile</p>';
            } ?>
        </div>
        <div style="display: inline;">
            <p>Presenter/Articolo </p>
            <?php $presenters_rank = StatsQueryController::getRankingPresenter();
            if(sizeof($presenters_rank) >0 ) {
                echo '<ol>';
                    for($i = 0;$i<5;$i++) {
                        if (isset($presenters_rank[$i])) {
                            echo '<li>utente: <b>'.$presenters_rank[$i]['userName'].'</b> media valutazioni: <b>'. round($presenters_rank[$i]['mediaVoti'],2).'</b></li>';
                        }
                    }
                echo '</ol>';
            } else {
                echo '<p>Nessuna Valutazione Disponibile</p>';
            } ?>
        </div>
    </div>



    <?php
    try {
        switch (Session::read('type')) {
            case 'amministratore': ?>
                <div class="container">
                    <h2>Benvenuto <?php echo(Session::read('userName')) ?></h2>
                    <h3>Menu amministratore</h3>
                    <p>
                        questa è la tua dashboard.
                        qui puoi creare e modificare le conferenze e gli utenti iscritti alla piattaforma
                    </p>
                </div>
                <?php
                break;
            case 'speaker':
                ?>
                <div class="container">
                    <h2>Benvenuto <?php echo(Session::read('userName')) ?></h2>
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
                    <h2>Benvenuto <?php echo(Session::read('userName')) ?></h2>
                    <h3>Menu presenter</h3>
                    <p>
                        questa è la tua dashboard.
                        qui puoi creare e modificare le conferenze e gli utenti iscritti alla piattaforma
                    </p>
                </div>
                <?php
                break;
            case 'utente': ?>
                <div class="container">
                    <h2>Benvenuto <?php echo(Session::read('userName')) ?></h2>
                    <h3>Menu utente</h3>
                    <p>
                        questa è la tua dashboard.
                        qui puoi iscriverti alle conferenze più interessanti del momento
                    </p>
                </div>
                <?php
                break;
            default: ?>
                <div class="container">
                    <h1>COSA È CONFVIRTUAL?</h1>
                    <p>
                        <strong>Confvirtual</strong>
                        è una piattaforma per la gestione di conferenze online. La piattaforma supporta l’organizzazione
                        di conferenze
                        svolte mediante video-conferenze da remoto. In particolare, consente agli utenti organizzatori
                        la creazione
                        di conferenze con sessioni di presentazioni di articoli/tutorial, e relativi link alle stanze
                        Teams per
                        la partecipazione alle stesse.Gli utenti possono registrarsi alle conferenze, aggiungere i
                        propri dati
                        nel caso di speaker/presenter ed interagire con altri utenti mediante servizi di messaggistica
                        interni.
                    </p>
                </div>
                <div class="container">
                    <img src="/resources/images/laptop-screen-webcam-view-diverse-people-engaged-in-group-videocall-picture-id1220226068.jpg"
                         alt="meeting">
                </div>
            <?php
        }
    } catch (ExpiredSessionException|Exception $e) {
        echo $e;
    }
    ?>
</form>

</body>
</html>