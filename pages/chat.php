<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/permission/SessionLoggedUserPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ChatQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));

// controllo che l'orario della chat tramite l'ora della sessione

    $index = $_POST['chatbtn'];
    $oraInizio = $_POST['oraInizio'][$index];
    $oraFine = $_POST['oraFine'][$index];
    $codice_sessione = $_POST['codice_sessione'][$index];

    // CONTROLLO ORARIO E GIORNO DELLA SESSIONE:
// if(strtotime(date('Y-m-d H:i:s'))<=strtotime($oraInizio)) {
    // CONTROLLO DEL SOLO ORARIO DELLA SESSIONE:
if (strtotime(date('H:i:s'))>=strtotime($oraInizio) AND strtotime(date('H:i:s'))<strtotime($oraFine)) {
    ?>
<body>
<form method="post" action="/logic/sendMessage.php">
    <div class="container">
        <?php print '<h2>Chat Sessione '. $codice_sessione .'</h2>';
        echo '<p style="display: inline">Utente: ' . Session::read('userName') .' </p>';
        echo '<p style="display: inline">Loggato come: ' . Session::read('type') .'</p>';
        checkServerMessages();  ?>
<!--        <iframe name="myFrame" src="/logic/chatIframe.php" style=" width: available; width: 100%; height:448px;background:#fff;"></iframe>-->
        <iframe name="myFrame" src="/logic/chatIframe.php" style="height:400px;width:100%;border:none;overflow:hidden;"></iframe>

        <input type="hidden" name="chatbtn" value="<?php print $_POST['chatbtn'] ?>">
        <?php
            foreach ($_POST['codice_sessione'] as $c) {
                print('<input type="hidden" name="codice_sessione[]" value="'.$c.'">');
            }
            for ($i=0; $i<sizeof($_POST['oraInizio']); $i++) {
                print('<input type="hidden" name="oraInizio[]" value="'.$_POST['oraInizio'][$i].'">');
                print('<input type="hidden" name="oraFine[]" value="'.$_POST['oraFine'][$i].'">');
            }
        ?>
        <div class="container" style="padding: 2%; display: block">
            <textarea style="display: inline-block; vertical-align: bottom; margin-left: auto; margin-right: auto; resize: none;" rows="2" cols="100" maxlength="500" type="text" name="messaggio" placeholder="scrivi il messaggio qui..." autocomplete="off"></textarea>
            <button style="display: inline-block;vertical-align: bottom; margin-left: auto; margin-right: auto; max-width: 20%" name = "submit" type="submit">INVIA</button>
        </div>

        <?php
        if(isset($_POST)) { Session::write('post',$_POST); Session::commit();}
        ?>
    </div>
</form>
</body>
</html>
<?php
} else {
    ?>
        <div class="container">
            <h2>Chat chiusa!</h2>
            <p><?php print 'Sessione aperta dalle ' . DateTime::createFromFormat("H:i:s", $oraInizio)->format("H:i") . ' alle ' . DateTime::createFromFormat("H:i:s", $oraFine)->format("H:i") ?></p>
        </div>
    <?php
}

function checkServerMessages()
{
    if (Session::read('server_message')) {
        print(Session::read('server_message'));
        Session::delete('server_message');
    }
}
