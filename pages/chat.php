<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/permission/SessionLoggedUserPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ChatQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>
<form method="post" action="/logic/sendMessage.php">
    <?php
    if(isset($_POST) & count($_POST)) { Session::write('post',$_POST);}
    ?>

    <div class="container">
        <?php print '<h2>Chat Sessione '. $_POST['chatbtn'] .'</h2>';
        echo '<p style="display: inline">Utente: ' . Session::read('userName') .' </p>';
        echo '<p style="display: inline">Loggato come: ' . Session::read('type') .'</p>';
        checkServerMessages();  ?>
        <iframe name="myFrame" src="/logic/chatIframe.php" style=" width: available; width: 100%; height:448px;background:#fff;"></iframe>
            <input type="hidden" name="chatbtn" value="<?php print $_POST['chatbtn'] ?>">
            <input type="text" name="messaggio" placeholder="scrivi il messaggio qui..." autocomplete="off">
            <button name = "submit" type="submit">INVIA</button>

    </div>
</form>
</body>
</html>
<?php

function checkServerMessages()
{
    if (Session::read('server_message')) {
        print(Session::read('server_message'));
        Session::delete('server_message');
    }
}
