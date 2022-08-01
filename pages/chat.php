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
    <?php
    include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));

    function getMessages()
    {
        global $id;
        $id = 0;
        $codice_sessione = $_POST['chatbtn'];
        foreach (ChatQueryController::getMessages($codice_sessione) as $m) {
            $userName_sender = $m['userNameUtente'];
            $type_sender = UserQueryController::getUserType($userName_sender);
            $foto = UserQueryController::getUserImgProfile($userName_sender,$type_sender);
            if ($foto == null OR $foto == '') {
                $foto = '/resources/images/noImgDefault.jpg';
            }
            if (Session::read('userName') != $m['userNameUtente']) {
                print('
                     <div class="row messaggio">
                     <div class="col-1"></div>
                      <div class="col-6" style="border: 2px solid #f2bd3f; border-radius: 2px; margin-top: 2%; background-color: #f1d38d; max-width: 40%; max-height: 80px">
                        <img style="display: inline; margin-right: 5%; margin-top: 2%; border-radius: 50%;" height="60px" src="'.$foto.'" alt="imgProfile">
                        <p style="display: inline; margin-right: 20%;" ><b>'.$m['userNameUtente'].'</b> ['.$type_sender.']</p>
                        <p style="display: block; position: relative; top: -25px; margin-right: 20%;text-align: center" >'.$m['testo'].'</p>
                      <span style="display: block; margin-right: 2px; position: relative; top: -60px; text-align: right" class="time-right">'.$m['dataInvio'].'</span>
                      </div>
                    </div>');
            } else {
                print('
                     <div class="row messaggio">
                     <div class="col-6"></div>
                      <div class="col-6" style="border: 2px solid #202040; border-radius: 2px; margin-top: 2%; background-color: #e3e2e7; max-width: 40%; max-height: 80px">
                        <img style="display: inline; margin-right: 5%; margin-top: 2%; border-radius: 50%;" height= "60px" src="'.$foto.'" alt="imgProfile">
                        <p style="display: inline; margin-right: 20%;" ><b>'.$m['userNameUtente'].'</b></p>
                        <p style="display: block; position: relative; top: -25px; margin-right: 20%;text-align: center" >'.$m['testo'].'</p>
                      <span style="display: block; margin-right: 2px; position: relative; top: -60px; text-align: right" class="time-right">'.$m['dataInvio'].'</span>
                      </div>
                    </div>
                    ');
            }
        }
    } ?>
    <div class="container">
        <?php print '<h2>Chat Sessione '. $_POST['chatbtn'] .'</h2>';
        checkServerMessages();  ?>
        <iframe name="myFrame" src="/logic/chatIframe.php" style=" width: available; width: 100%; height:448px;background:#fff;">
            <?php getMessages(); ?>
        </iframe>
        <form method="post" action="/logic/sendMessage.php">
            <input type="hidden" name="chatbtn" value="<?php print $_POST['chatbtn'] ?>">
            <input type="text" name="messaggio" placeholder="scrivi il messaggio qui..." autocomplete="off">
            <button name = "submit" type="submit">INVIA</button>
        </form>
    </div>
    <?php include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"])); ?>
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
