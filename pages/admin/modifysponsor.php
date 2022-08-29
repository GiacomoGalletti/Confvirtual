<?php

include_once (sprintf("%s/logic/permission/SessionAdminPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
$index  = $_POST['sponsor_btn'];
?>
    <body>
    <form method="post" action="/logic/delete_update_sponsor.php" autocomplete="off">
        <?php
        try {
            Session::start();
            if (Session::read('msg_sessione') != false) {
                echo Session::read('msg_sessione');
                Session::delete('msg_sessione');
                Session::commit();
            }
        } catch (ExpiredSessionException|Exception $e) {
            echo $e;
        } ?>
        <input type="hidden" name="sponsor_btn" value="<?php print ( $_POST['sponsor_btn']); ?>">
        <input type="hidden" name="nome[]" value="<?php print ( $_POST['nome'][$index]); ?>">
        <input type="hidden" name="immagineLogo[]" value="<?php print ( $_POST['immagineLogo'][$index]); ?>">

        <div class="container">
            <div style="margin-top: 40px">
                <h4 style="display: inline-block; margin-right: 10px">Sponsor selezionato: </h4>
                <p style="display: inline-block; margin-right: 80px"><?php print ( $_POST['nome'][$index]); ?></p>
                <?php if(!empty($_POST['immagineLogo'][$index])){
                    echo '<img id="currentPhoto" title="userImg personalizzata" width="120" height="160" src="' .  $_POST['immagineLogo'][$index] . '">';}
                else { echo '<img title="no img" width="120" height="160" src="/resources/images/noImgDefault.jpg" alt="no_img">';} ?>
            </div>
            <div class="input-group">
                <div style="display: inline-block">
                    <div style="display: block">
                        <label for="inputGroupSelect04"><b>Aggiungi sponsorizzazione</b></label>
                        <select class="custom-select" id="inputGroupSelect04" name="dati_conferenza">
                            <option selected>Scegli conferenza</option>
                            <?php receiveConference(); ?>
                        </select>
                    </div>
                    <input name="importo" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" pattern="[0-9]+" placeholder="euro importo">
                </div>
            </div>
            <table style="margin: 20px;">
                <tr>
                    <td><button type="submit" id="confirm_mod_btn" name="confirm_mod_btn">Inserisci sponsorizzazione</button></td>
                    <td><button type="submit" id="delete_btn" name="delete_btn" style="background-color: red;opacity: 50" value="">Elimina sponsor</button></td>
                    <td><input type="checkbox" name="check"><p>il tasto elimina eliminerà lo sponsor<br> e le relative sponsorizzazioni</p></td>
                </tr>
            </table>
        </div>
    </form>
    </body>

<?php

function receiveConference()
{
    $conferences = ConferenceQueryController::getConferenceFuture();
    foreach ($conferences as $c) {
        print('<option value="'. $c['acronimo'].','.$c['annoEdizione'] .'">'. 'acronimo: <b>' .$c['acronimo'] .'</b>'. ' anno edizione: ' . $c['annoEdizione'] .'</option>');
    }
}

