<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/permission/SessionAdminPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));

?>
    <body>
        <form method="post" method="post" action="/logic/addAuthorKeywords.php" autocomplete="off">
            <?php include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));

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
                <p class="conferenceInfo"> <?php print ('codice: ' . $_POST['codice_presentazione'][0]); ?> </p>
                <h4 class="conferenceInfo">Sessione: </h4>
                <p class="conferenceInfo"> <?php print ('codice: ' . $_POST['codice_sessione']); ?> </p>
                <br>
                <?php
                $authors_previous = PresentationQueryController::getAuthors($_POST['codice_presentazione'],$_POST['codice_sessione']);
                $key_words_previous = PresentationQueryController::getKeyWord($_POST['codice_presentazione'],$_POST['codice_sessione']);

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

                <input type="hidden" name="codice_sessione" value="<?php print $_POST['codice_sessione'] ?>">
                <input type="hidden" name="codice_presentazione" value="<?php print $_POST['codice_presentazione']?>">

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
<?php
include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
?>
    </body>
</html>
