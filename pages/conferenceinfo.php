<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/SessioneQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
$index = $_POST['conferencebtn'];
$srcImg = $_POST['immagineLogo'][$index];
$nome = $_POST['nome'][$index];
$anno_edizione = $_POST['annoEdizione'][$index];
$acronimo = $_POST['acronimo'][$index];
// all'inizio bisogna reperire tutti i codici delle sessioni riferiti alla conferenza selezionata
?><body>
<div class="container"><?php
    $array_sessioni = SessioneQueryController::getSessions($acronimo,$anno_edizione);
    // ora posso andare a reperire gli articoli ed i tutorial di tutte le sessioni trovate
    ?>
</div>
<form method="post" action="/pages/chat.php">
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
                $btn_value = 0;
                foreach ($array_sessioni as $a) {
                    $array_presentazione = PresentationQueryController::getAllPresentationInfo($a['codice']);
                    if (isset($array_presentazione)) {?>
                        <div style="display: block">
                            <h4 style="display: inline-block; margin-right: 10px">Codice Sessione: </h4>
                            <p style="display: inline-block; margin-right: 80px"><?php print ( $a['codice'] ); ?></p>
                            <h4 style="display: inline-block; margin-right: 10px">Giorno: </h4>
                            <p style="display: inline-block; margin-right: 60px"><?php print ( $a['giornoData'] ); ?></p>
                            <h4 style="display: inline-block; margin-right: 10px">Orario: </h4>
                            <p style="display: inline-block; margin-right: 80px"><?php print 'dalle ' . DateTime::createFromFormat("H:i:s", $a['oraInizio'])->format("H:i") . ' alle ' . DateTime::createFromFormat("H:i:s", $a['oraFine'])->format("H:i") ?></p>
                            <h4 style="display: inline-block; margin-right: 10px">Link stanza: </h4>
                            <a style="display: inline-block;" href="https://<?php print ( $a['linkStanza'] ); ?>" target="_blank"> LINK </a>

                            <input type="hidden" name="oraInizio[]" value="<?php print $a['oraInizio'] ?>">
                            <input type="hidden" name="oraFine[]" value="<?php print $a['oraFine'] ?>">
                            <input type="hidden" name="codice_sessione[]" value="<?php print $a['codice'] ?>">

                            <button style="display: inline-block;" type="submit" name="chatbtn" value="<?php print $btn_value ?>">vai alla chat</button>
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
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $btn_value++;
                            foreach ($array_presentazione as $presentazione_corrente) {

                            $info_aticolo_tutorial = PresentationQueryController::getPresentationInfo($presentazione_corrente['codice'])[0]; ?>
                            <tr>
                                <td><?php  print $presentazione_corrente['numeroSequenza']?></td>
                                <td><?php  print $info_aticolo_tutorial['titolo']?></td>
                                <td><?php  print $info_aticolo_tutorial['tipoPresentazione']?></td>
                                <td><?php  print DateTime::createFromFormat("H:i:s", $presentazione_corrente['oraInizio'])->format("H:i")?></td>
                                <td><?php  print DateTime::createFromFormat("H:i:s", $presentazione_corrente['oraFine'])->format("H:i")?></td>
                                <td></td>
                            </tr>
                            <?php
                            if ($info_aticolo_tutorial['tipoPresentazione'] === 'tutorial') {
                                $abstract = $info_aticolo_tutorial['abstract'];
                                if ($abstract !== '') {
                                    print ('<tr><td><b>ABSTRACT: <br></b>' . $abstract . '</td><td></td><td></td><td></td><td></td><td></td></tr>');
                                }
                            }
                            else if ($info_aticolo_tutorial['tipoPresentazione'] === 'articolo') {
                                $filePDF = $info_aticolo_tutorial['filePdf'];
                                $num_pag = $info_aticolo_tutorial['numeroPagine'];
                                $autori = PresentationQueryController::getAuthors($presentazione_corrente['codice'],$a['codice']);
                                $key_words = PresentationQueryController::getKeyWord($presentazione_corrente['codice'],$a['codice']);
                                //print ('<br> codice Sessione : ' . $a['codice'] . '<br>codice Presentazione : ' .$presentazione_corrente['codice'] .'<br>');
                                //print_r(PresentationQueryController::getAuthors($presentazione_corrente['codice'],$a['codice']));
                                print ('<tr>');
                                    if ($filePDF !== '') {
                                        print ('<td>
                                                    <label><b>File PDF</b></label>
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                    <a type="submit" href="'.$filePDF.'" class="btn btn-outline-primary" target="_blank" style="margin-right: 100px"><i class="fa fa-download" style="font-size:48px;color:#202040"></i></a>
                                                </td>');
                                    }

                                    if ($num_pag !== '') {
                                        print ('<td><b>Numero pagine: </b>' . $num_pag . '</td>');
                                    }
                                    if (sizeof($autori)>0) {

                                        print ('<td><b>Autori:  <br></b>');
                                        foreach ($autori as $auth) {
                                            print ($auth['nome'] . ' ' . $auth['cognome'] . '<br>');
                                        }
                                        print ('</td>');
                                    }

                                if (sizeof($key_words)>0) {

                                    print ('<td><b>Prole chiave: <br></b>');
                                    foreach ($key_words as $kw) {
                                        print ($kw['parola'] . '<br>');
                                    }
                                    print ('</td>');
                                }
                                print ('</tr>');
                            } }?>
                        </tbody>
                        </table>
                        </div>
                        <?php
                    }
                }
            } else {
                ?> <p>Nessuna sessione in programma al momento!</p> <?php
            } ?>
        </div>
    </div>
</form>
</body>
<?php



