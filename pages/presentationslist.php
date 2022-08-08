<!DOCTYPE html>
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/SessioneQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/debug.php", $_SERVER["DOCUMENT_ROOT"]));
$index = $_POST['presentations_list_btn'];
$srcImg = $_POST['immagineLogo'][$index];
$nome = $_POST['nome'][$index];
$anno_edizione = $_POST['annoEdizione'][$index];
$acronimo = $_POST['acronimo'][$index];
//print_r($_POST);
?>
<body>
<div class="container">
    <?php
    $array_sessioni = SessioneQueryController::getSessions($acronimo,$anno_edizione);
    ?>
</div>
<form method="post" action="">
    <?php
    include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
    ?>
    <div class="container">
        <div style="margin-top: 40px">
            <div style="display: block">
                <h4 style="display: inline-block; margin-right: 10px">Nome: </h4>
                <p style="display: inline-block; margin-right: 80px"><?php print ($nome); ?></p>
                <?php if(!empty($srcImg)){
                    echo '<td><img style="display: inline-block" id="currentPhoto" title="userImg personalizzata" width="120" height="160" src="'.$srcImg.'" alt=""> </td>';
                } else { echo '<td><img style="display: inline-block" title="no img" width="120" height="160" src="/resources/images/noImgDefault.jpg" alt="default_img"></td>';} ?>

            </div>

            <div style="display: block">
                <h4 style=" display:inline-block; margin-right: 10px">Acronimo: </h4>
                <p style=" display:inline-block; margin-right: 80px"><?php print ( $acronimo ); ?></p>
            </div>
            <div style="display: block">
                <h4 style="display: inline-block; margin-right: 10px">Anno Edizione: </h4>
                <p style="display: inline-block; margin-right: 80px"><?php print ( $anno_edizione ); ?></p>
            </div>

            <?php
            if (isset($array_sessioni)) {
                ?> <h4 class="text-center mb-4">Sessioni della conferenza: </h4> <?php
                foreach ($array_sessioni as $a) {
                    $array_presentazione = PresentationQueryController::getAllPresentationInfo($a['codice']);
                    if (isset($array_presentazione)) {?>

                        <div style="display: block">
                            <h4 style="display: inline-block; margin-right: 10px">Codice Sessione: </h4>
                            <p style="display: inline-block; margin-right: 80px"><?php print ( $a['codice'] ); ?></p>
                            <h4 style="display: inline-block; margin-right: 10px">Giorno: </h4>
                            <p style="display: inline-block; margin-right: 80px"><?php print ( $a['giornoData'] ); ?></p>
                        </div>
                        <div class="table-wrap">
                            <table class="table">
                                <thead class="thead-primary">
                                <tr>
                                    <th>Sequenza</th>
                                    <th>Titolo</th>
                                    <th>Tipologia</th>
                                    <th>Ora Inizio</th>
                                    <th>Ora Fine</th>
                                    <th>Media Valutazioni</th>
                                    <th>Note Valutazioni</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($array_presentazione as $presentazione_corrente) {
                                        $info_aticolo_tutorial = PresentationQueryController::getPresentationInfo($presentazione_corrente['codice'])[0];
                                        $media_valutazioni_presentazione = PresentationQueryController::getMediaValutazioniPresentazione($a['codice'], $presentazione_corrente['codice']);
                                        $array_info_presentazione = PresentationQueryController::getInfoValutazioni($a['codice'], $presentazione_corrente['codice']);
                                        //pre_r($array_note_presentazione);
                                    ?>
                                    <tr>
                                        <td><?php  print $presentazione_corrente['numeroSequenza']?></td>
                                        <td><?php  print $info_aticolo_tutorial['titolo']?></td>
                                        <td><?php  print $info_aticolo_tutorial['tipoPresentazione']?></td>
                                        <td><?php  print $presentazione_corrente['oraInizio']?></td>
                                        <td><?php  print $presentazione_corrente['oraFine']?></td>
                                        <td><?php  if ($media_valutazioni_presentazione[0]['mediaVoti'] == null) { print "nessuna valutazione";
                                        } else { print round($media_valutazioni_presentazione[0]['mediaVoti']); }?></td>
                                        <td><?php
                                            if($array_info_presentazione == null){
                                                print "nessuna valutazione";
                                            }else{
                                                foreach($array_info_presentazione as $info_corrente){
                                                    ?><p> <?php print '<b>'.$info_corrente['userNameUtente'].'</b> VALUTAZIONE: '.$info_corrente['voto'].'  NOTE: '.$info_corrente['note']; ?> </p><?php
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php }
                }
            } else {
                ?> <p>Nessuna sessione in programma al momento!</p> <?php
            } ?>
        </div>
    </div>
</form>
</body>