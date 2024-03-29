<!DOCTYPE html>
<html lang="it">
<?php
if(!isset($_POST['conferencebtn'])){
    header("Location: /index.php");
}
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
<form name="myform" method="post" action="/pages/chat.php">
    <input type="hidden" name="conferencebtn" value="<?php print $_POST['conferencebtn'] ?>">
    <?php

        for ($i = 0; $i<sizeof($_POST["nome"]); $i++){
            ?>
                <input type="hidden" name="immagineLogo[]" value="<?php print $_POST["immagineLogo"][$i] ?>">
                <input type="hidden" name="nome[]" value="<?php print $_POST["nome"][$i] ?>">
                <input type="hidden" name="annoEdizione[]" value="<?php print $_POST["annoEdizione"][$i] ?>">
                <input type="hidden" name="acronimo[]" value="<?php print $_POST["acronimo"][$i] ?>">
            <?php
        }

        try {
            if (Session::read('msg_fav') != false) {
                echo Session::read('msg_fav');
                Session::delete('msg_fav');
                Session::commit();
            }
        } catch (ExpiredSessionException|Exception $e) {
            echo $e;
        }
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
                $btn_value = 0;
                $fav_value =0;
                foreach ($array_sessioni as $a) {
                    $array_presentazioni_favorite = PresentationQueryController::getFavorites(Session::read('userName'),$a['codice']);
                    $presentazioni_favorite = [];
                    for ($i=0; $i<count($array_presentazioni_favorite); $i++) {
                        $presentazioni_favorite[] = $array_presentazioni_favorite[$i]['codicePresentazione'];
                    }
                    if ($array_presentazioni_favorite == null) {
                        $array_presentazioni_favorite = [];
                    }
                    $array_presentazione = PresentationQueryController::getAllPresentationsInfoFromSession($a['codice']);
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
                            foreach ($array_presentazione as $presentazione_corrente) {

                                $info_aticolo_tutorial = PresentationQueryController::getPresentationInfo($presentazione_corrente['codice'])[0]; ?>
                                    <input type="hidden" name="codice_presentazione[]" value="<?php print $presentazione_corrente['codice'] ?>">

                                    <tr>
                                        <td><?php  print $presentazione_corrente['numeroSequenza']?></td>
                                        <td><?php  print $presentazione_corrente['codice']?></td>
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
                                        print ('<tr><td><b>ABSTRACT: <br></b>' . $abstract . '<td>');
                                    }
                                    $risorse = PresentationQueryController::getTutorialResources($a['codice'],$presentazione_corrente['codice']);

                                    if (sizeof($risorse)>0) {

                                        print ('<td><p><b>Risorse:  </b></p>');
                                        foreach ($risorse as $r) {
                                            print ('<p><b>Link: </b><span><a href="' .$r['link'] . '">'.$r['link'].'</a><br><b>Descrizione: </b> ' . $r['descrizione'] . '</p>');
                                        }
                                        print ('</td>');
                                        print ('<td></td>');
                                        print ('<td></td>');
                                    } else {
                                        print ('<td></td>');
                                        print ('<td></td>');
                                        print ('<td></td>');
                                    }
                                    if (!in_array($presentazione_corrente['codice'],$presentazioni_favorite) OR $presentazioni_favorite == null) {
                                        print ('<td><button name="fav_btn_add" type="submit" class="btn btn-success" value="'.$btn_value.','.$fav_value.'"><span><i class="bi bi-heart"></i></span>Aggiungi ai favoriti</button></td>');
                                    } else {
                                        print ('<td><button name="fav_btn_remove" type="submit" class="btn btn-danger" value="'.$btn_value.','.$fav_value.'"><span><i class="bi bi-heart"></i></span>favorito!</button></td>');
                                    }
                                    print ('</tr>');

                                }
                                else if ($info_aticolo_tutorial['tipoPresentazione'] === 'articolo') {
                                    $filePDF = $info_aticolo_tutorial['filePdf'];
                                    $num_pag = $info_aticolo_tutorial['numeroPagine'];
                                    $autori = PresentationQueryController::getAuthors($presentazione_corrente['codice'],$a['codice']);
                                    $key_words = PresentationQueryController::getKeyWord($presentazione_corrente['codice'],$a['codice']);

                                    print ('<tr>');
                                        if ($filePDF !== '') {
                                            print ('<td>
                                                        <label><b>File PDF</b></label>
                                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                                                        <a type="submit" href="'.$filePDF.'" class="btn btn-outline-primary" target="_blank" style="margin-right: 100px"><i class="fa fa-download" style="font-size:48px;color:#202040"></i></a>
                                                    </td>');
                                        } else {
                                            print ('<td></td>');
                                        }

                                        if ($num_pag !== '') {
                                            print ('<td><b>Numero pagine: </b>' . $num_pag . '</td>');
                                        } else {
                                            print ('<td></td>');
                                        }
                                        if (sizeof($autori)>0) {

                                            print ('<td><b>Autori:  <br></b>');
                                            foreach ($autori as $auth) {
                                                print ($auth['nome'] . ' ' . $auth['cognome'] . '<br>');
                                            }
                                            print ('</td>');
                                        } else {
                                            print ('<td></td>');
                                        }
                                    if (sizeof($key_words)>0) {

                                        print ('<td><b>Prole chiave: <br></b>');
                                        foreach ($key_words as $kw) {
                                            print ($kw['parola'] . '<br>');
                                        }
                                        print ('</td>');
                                    } else {
                                        print ('<td></td>');
                                    }

                                    print ('<td></td>');

                                    if (!in_array($presentazione_corrente['codice'],$presentazioni_favorite) OR $presentazioni_favorite == null) {
                                        print ('<td><button name="fav_btn_add" type="submit" class="btn btn-success" value="'.$btn_value.','.$fav_value.'"><span><i class="bi bi-heart"></i></span>Aggiungi ai favoriti</button></td>');
                                    } else {
                                        print ('<td><button name="fav_btn_remove" type="submit" class="btn btn-danger" value="'.$btn_value.','.$fav_value.'"><span><i class="bi bi-heart"></i></span>favorito!</button></td>');
                                    }
                                    print ('</tr>');
                                }
                                $fav_value++;
                            }?>
                        </tbody>
                        </table>
                        </div>
                        <?php
                    }
                    $btn_value++;
                }
            } else {
                ?> <p>Nessuna sessione in programma al momento!</p> <?php
            } ?>
        </div>
    </div>
</form>
<script>

    var favoritebtn = document.getElementsByName('fav_btn_add');

    for (let i of favoritebtn) {
        i.onclick = function() {
            document.myform.action ="/logic/add_remove_favorite.php";
        }
    }

    favoritebtn = document.getElementsByName('fav_btn_remove');

    for (let i of favoritebtn) {
        i.onclick = function() {
            document.myform.action ="/logic/add_remove_favorite.php";
        }
    }
</script>
</body>
<?php



