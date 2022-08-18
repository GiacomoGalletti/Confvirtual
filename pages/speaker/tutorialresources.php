<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/debug.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/permission/SessionSpeakerPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));

//print_r($_POST);
$index =  $_POST['modificabtn'];
$codice_presentazione = $_POST['codicepresentazione'][$index];
$codice_sessione = $_POST['codicesessione'][$index];

try {
    Session::start();
    if (Session::read('msg_tutorial_resources') != false) {
        echo Session::read('msg_tutorial_resources');
        Session::delete('msg_tutorial_resources');
        Session::commit();
    }
} catch (ExpiredSessionException|Exception $e) {
    echo $e;
}

?>
<body>
<form method="post" action="/logic/upload_resources.php" autocomplete="off">
    <div class="container">

        <h4 class="conferenceInfo">Presentazione selezionata: </h4>
        <p class="conferenceInfo"> <?php print ('codice: ' . $codice_presentazione); ?> </p>
        <h4 class="conferenceInfo">Sessione: </h4>
        <p class="conferenceInfo"> <?php print ('codice: ' . $codice_sessione); ?> </p>
        <br>
        <?php
        $risorse_tutorial = PresentationQueryController::getTutorialResources($codice_sessione,$codice_presentazione);
        if ($risorse_tutorial !== null AND sizeof($risorse_tutorial) > 0)
        {
            print ('<h3>Risorse già inserite:</h3>');
            foreach ($risorse_tutorial as $a) { print('<p><b>Link: </b><a target="_blank" href="'.$a['link'].'">'.$a['link'].'</a> <b> Descrizione: </b> '.$a['descrizione'].'  <br>');}
            ?><input type="hidden" name="sostituisci_risorsa"><?php
        }
        ?>
        <br>
        <b class="form_articolo">Link Risorse</b>
        <div class="input-group form_articolo" id="input_group">
            <div class="input-group-prepend" id="risorsa_input">
                <span class="input-group-text">Link e Descrizione</span>
                <input autocomplete="off" type="url" class="form-control" name="link[]" id="link_descrizione" style="margin: 0!important;">
                <input autocomplete="off" type="text" class="form-control" name="descrizione[]" id="link_descrizione" style="margin: 0!important;">
            </div>
        </div>
        <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
            <div class="col-sm">
            </div>
            <div class="col-sm">
            </div>
            <div class="col-sm">
                <button type="button" id="aggiungiRisorsa">Aggiungi risorsa</button>
            </div>
        </div>
        <?php  sendData(); ?>
    </div>
    <div class="container">
        <table style="margin: 20px">
            <tr>
                <td><button type="submit" id="confirm_mod_btn" name="confirm_mod_btn">Conferma modifica</button></td>
            </tr>
        </table>
    </div>
</form>
<script>
    const rows = '<div class="input-group-prepend" id="risorsa_input" style="margin-top: 3px;"> <span class="input-group-text">Link e Descrizione</span> <input autocomplete="off" type="url" class="form-control" name="link[]" id="link_descrizione" style="margin: 0!important;"> <input autocomplete="off" type="text" class="form-control" name="descrizione[]" id="link_descrizione" style="margin: 0!important;"> </div>';

    $('#aggiungiRisorsa').on('click', function handleClick() {
        let template = document.createElement('div');
        document.getElementById('input_group').appendChild(template);
        template.innerHTML = rows;
    });
</script>
</body>
<?php

function sendData(): void
{
    for ($i = 0; $i<sizeof($_POST['codicesessione']); $i++) {
        print('<input type="hidden" name="codicesessione[]" value="'.$_POST['codicesessione'][$i].'">');
        print('<input type="hidden" name="codicepresentazione[]" value="'.$_POST['codicepresentazione'][$i].'">');
    }
    print('<input type="hidden" name="modificabtn" value="'.$_POST['modificabtn'].'">');
}
