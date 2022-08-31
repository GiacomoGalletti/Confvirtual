<!DOCTYPE html>
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/permission/SessionLoggedUserPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/SessioneQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/debug.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
$userNameUtente = $_SESSION['userName'];
$presentazioni_favorite = PresentationQueryController::getFavoritesGlobal($userNameUtente);
if (isset($presentazioni_favorite) && sizeof($presentazioni_favorite) >0 ) {
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center mb-4">Le tue presentazioni favorite</h4>

            <div class="table-wrap">
                <table class="table">
                    <thead class="thead-primary">
                    <tr>
                        <th>Acronimo</th>
                        <th>Edizione</th>
                        <th>Giorno</th>
                        <th>Codice Presentazione</th>
                        <th>Titolo</th>
                        <th>Tipologia</th>
                        <th>Ora Inizio</th>
                        <th>Ora Fine</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($presentazioni_favorite as $presentazione_corrente) {
                        $info_presentazione = PresentationQueryController::getPresentationInfo($presentazione_corrente['codicePresentazione'])[0];
                        ?>
                        <tr>
                            <td><?php  print $info_presentazione['acronimoConferenza'] ?></td>
                            <td><?php  print $info_presentazione['annoEdizioneConferenza'] ?></td>
                            <td><?php  print $info_presentazione['giornoData'] ?></td>
                            <td><?php  print $info_presentazione['codice']?></td>
                            <td><?php  print $info_presentazione['titolo']?></td>
                            <td><?php  print $info_presentazione['tipoPresentazione']?></td>
                            <td><?php  print DateTime::createFromFormat("H:i:s",$info_presentazione['oraInizio'])->format("H:i")?></td>
                            <td><?php  print DateTime::createFromFormat("H:i:s",$info_presentazione['oraFine'])->format("H:i")?></td>

                        </tr>
                    <?php   }  ?>

                    </tbody>
                </table>
            </div>
            <?php   } else {
                ?>             <h4 class="text-center mb-4">Al momento non ci sono Presentazioni aggiunte alle Presentazioni Favorite !</h4>
                <?php
            } ?>

