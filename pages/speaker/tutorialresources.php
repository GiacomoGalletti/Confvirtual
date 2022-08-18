<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/permission/SessionSpeakerPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
$index =  $_POST['article_tutorial_btn'];
$numeroSequenza = $_POST['numeroSequenza'][$index];
$orainizio_presentazione = $_POST['orainizio_presentazione'][$index];
$orafine_presentazione = $_POST['orafine_presentazione'][$index];
$codice_presentazione = $_POST['codice_presentazione'][$index];
$codice_sessione = $_POST['codice_sessione'][$_POST['presentationbtn']];
$data = $_POST['data'][$_POST['presentationbtn']];

$risorse_tutorial = PresentationQueryController::getTutorialResources($codice_sessione,$codice_presentazione);

try {
    Session::start();
    if (Session::read('msg_presentazione_1') != false) {
        echo Session::read('msg_presentazione_1');
        Session::delete('msg_presentazione_1');
        Session::commit();
    }
    if (Session::read('msg_presentazione_2') != false) {
        echo Session::read('msg_presentazione_2');
        Session::delete('msg_presentazione_2');
        Session::commit();
    }
} catch (ExpiredSessionException|Exception $e) {
    echo $e;
}

?>
<body>
<form method="post" action="/logic/upload_resources.php" autocomplete="off">
        <div class="container">
            <h4 class="conferenceInfo">Tutorial selezionato: </h4>
            <p class="conferenceInfo">
                <?php
                print ('giorno: ' . $data . ' numero di sequenza: ' . $numeroSequenza . ', inizio: ' . $orainizio_presentazione
                    . ', fine: ' . $orafine_presentazione . '<br>codice presentazione: ' . $codice_presentazione . ' codice sessione: ' . $codice_sessione.'</p>');
                sendData();
                ?>
            <table style="margin: 20px">
                <tr>
                    <td>
                        <h3><b>Link risorsa</b></h3>
                            <input type="text" name="titolo_new" maxlength="260" placeholder="<?php  print $risorse_tutorial['link']; ?>" >
                        </label>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h3><b>Descrizione</b></h3><br>
                        <textarea id="input_abstract_tutorial" class="form_tutorial" maxlength="100" name="input_abstract_tutorial" rows="2" cols="50" placeholder="<?php print $risorse_tutorial['descrizione'] ?>"></textarea>
                    </td>
                </tr>
            </table>
        </div>
        <div class="container">
            <table style="margin: 20px">
                <tr>
                    <td><button type="submit" id="confirm_mod_btn" name="confirm_mod_btn">Conferma modifica</button></td>
                    <td><button type="submit" id="delete_btn" name="delete_btn" style="background-color: red;opacity: 50" value="">Elimina tutorial</button></td>
                </tr>
            </table>
        </div>
        </form>
<?php

function sendData(): void
{
    for ($i = 0; $i<sizeof($_POST['codice_sessione']); $i++) {
        print('<input type="hidden" name="codice_sessione[]" value="'.$_POST['codice_sessione'][$i].'">');
        print('<input type="hidden" name="data[]" value="'.$_POST['data'][$i].'">');
    }

    for ($i = 0; $i<sizeof($_POST['orainizio_sessione']); $i++) {
        print('<input type="hidden" name="orainizio_sessione[]" value="'.$_POST['orainizio_sessione'][$i].'">');
        print('<input type="hidden" name="orafine_sessione[]" value="'.$_POST['orafine_sessione'][$i].'">');
    }

    for ($i = 0; $i< sizeof($_POST['tipologia']); $i++) {
        ?>
        <input type="hidden" name="tipologia[]" value="<?php print $_POST['tipologia'][$i] ?>">
        <input type="hidden" name="numeroSequenza[]" value="<?php print $_POST['numeroSequenza'][$i] ?>">
        <input type="hidden" name="orafine_presentazione[]" value="<?php print $_POST['orafine_presentazione'][$i] ?>">
        <input type="hidden" name="orainizio_presentazione[]" value="<?php print $_POST['orainizio_presentazione'][$i] ?>">
        <input type="hidden" name="titolo[]" value="<?php print $_POST['titolo'][$i] ?>">
        <input type="hidden" name="codice_presentazione[]" value="<?php print $_POST['codice_presentazione'][$i] ?>">
        <input type="hidden" name="numeroPagine[]" value="<?php print $_POST['numeroPagine'][$i] ?>">
        <input type="hidden" name="filePDF[]" value="<?php print $_POST['filePDF'][$i] ?>">
        <input type="hidden" name="abstract[]" value="<?php print $_POST['abstract'][$i] ?>">
    <?php } ?>
    <input type="hidden" name="article_tutorial_btn" value="<?php print $_POST['article_tutorial_btn'] ?>">
    <input type="hidden" id="presentationbtn" name="presentationbtn" value="<?php print $_POST['presentationbtn'] ?>">
    <?php
}
