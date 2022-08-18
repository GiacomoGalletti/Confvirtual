<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/permission/SessionAdminPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
$index = $_POST['article_tutorial_btn'];
$codice_sessione = $_POST['codice_sessione'][$_POST['presentationbtn']];
$codice_presentazione = $_POST['codice_presentazione'][$index];

?>
    <body>
        <form method="post" method="post" action="/logic/addAuthorKeywords.php" autocomplete="off">
            <?php

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
            <div class="container">

                <h4 class="conferenceInfo">Presentazione selezionata: </h4>
                <p class="conferenceInfo"> <?php print ('codice: ' . $codice_presentazione); ?> </p>
                <h4 class="conferenceInfo">Sessione: </h4>
                <p class="conferenceInfo"> <?php print ('codice: ' . $codice_sessione); ?> </p>
                <br>
                <?php
                $authors_previous = PresentationQueryController::getAuthors($codice_presentazione,$codice_sessione);
                $key_words_previous = PresentationQueryController::getKeyWord($codice_presentazione,$codice_sessione);

                if (sizeof($key_words_previous) > 0)
                {
                    print ('<h3>Parole Chiave già inserite:</h3>');
                    foreach ($key_words_previous as $k) { print('<p style="display: inline"> '.$k['parola'].' </p>');}
                    ?><input type="hidden" name="sostituisci_parolechiave"><?php
                }

                if (sizeof($authors_previous) > 0)
                {
                    print ('<h3>Autori già inseriti:</h3>');
                    foreach ($authors_previous as $a) { print('<p style="display: inline"> '.$a['nome'].' '.$a['cognome'].'  </p><br>');}
                    ?><input type="hidden" name="sostituisci_autori"><?php
                }
                ?>
                <br>
                <label class="form_articolo" for="paroleChiave"><b>Parole chiave</b></label>
                <input class="form_articolo" type="text" id="pagenum" name="paroleChiave" pattern='[a-z,a-z]+' placeholder="inserisci le parole chiave">
                <b class="form_articolo">Autore</b>
                <div class="input-group form_articolo" id="input_group">
                    <div class="input-group-prepend" id="autore_input">
                        <span class="input-group-text">Nome e cognome</span>
                        <input autocomplete="off" type="text" class="form-control" name="nome[]" id="nome_cognome" style="margin: 0!important;">
                        <input autocomplete="off" type="text" class="form-control" name="cognome[]" id="nome_cognome" style="margin: 0!important;">
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                    <div class="col-sm">
                    </div>
                    <div class="col-sm">
                    </div>
                    <div class="col-sm">
                        <button type="button" id="aggiungiAutore">Aggiungi campo autore</button>
                    </div>
                </div>
                <?php  sendData(); ?>
                <button name="auth_keywords_btn" type="submit">Conferma</button>
            </div>
        </form>
        <script>
            const rows = '<div class="input-group-prepend" id="autore_input" style="margin-top: 3px;"> <span class="input-group-text">Nome e cognome</span> <input autocomplete="off" type="text" class="form-control" name="nome[]" id="nome_cognome" style="margin: 0!important;"> <input autocomplete="off" type="text" class="form-control" name="cognome[]" id="nome_cognome" style="margin: 0!important;"> </div>';

            $('#aggiungiAutore').on('click', function handleClick() {
                let template = document.createElement('div');
                document.getElementById('input_group').appendChild(template);
                template.innerHTML = rows;
            });
        </script>
    </body>
</html>
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
