<!DOCTYPE html>
<html lang="it">
<form id="iframeForm" target="myFrame"  action="/logic/chatIframe.php" method="POST">
    <input type="hidden" name="chatbtn" value="<?php print $_POST['chatbtn'] ?>" />
    <input type="submit">
</form>
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ChatQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>
<form method="post" action="/logic/sendMessage.php">
    <?php include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
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
    <?php include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"])); ?>
</form>
<script>
    $(document).ready(function(){
        var loginform= document.getElementById("iframeForm");
        loginform.style.display = "none";
        loginform.submit();
    });

</script>
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
