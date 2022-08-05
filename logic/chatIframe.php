<?php
ob_start();
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ChatQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"]));

Session::start();
    if(Session::read('post')) {$_POST = Session::read('post'); Session::delete('post');}
    if(isset($_POST) & count($_POST)) { Session::write('post',$_POST);}
    global $id;
    $id = 0;
    $codice_sessione = $_POST['chatbtn'];
    foreach (ChatQueryController::getMessages($codice_sessione) as $m) {
        $userName_sender = $m['userNameUtente'];

        if (Session::read('userName') != $m['userNameUtente']) {

            $type_sender = UserQueryController::getUserType($userName_sender);
            if ($type_sender !== 'amministratore') {
                $foto = UserQueryController::getUserImgProfile($userName_sender,$type_sender);
                if ($foto == null OR $foto == '') {
                    $foto = '/resources/images/noImgDefault.jpg';
                }
            } else {
                $foto = '/resources/images/noImgDefault.jpg';
            }

            print('
                     <div class="row messaggio">
                     <div class="col-1"></div>
                      <div class="col-6" style="border: 2px solid #f2bd3f; border-radius: 2px; margin-top: 2%; background-color: #f1d38d; max-width: 40%; max-height: 80px">
                        <img style="display: inline; margin-right: 5%; margin-top: 2%; border-radius: 50%;" height="60px" src="'.$foto.'" alt="imgProfile">
                        <p style="display: inline; margin-right: 20%;" ><b>'.$m['userNameUtente'].'</b> ['.$type_sender.']</p>
                        <p style="display: block; position: relative; top: -25px;text-align: center" >'.$m['testo'].'</p>
                      <span style="display: block; margin-right: 2px; position: relative; top: -60px; text-align: right" class="time-right">'.$m['dataInvio'].'</span>
                      </div>
                    </div>');
        } else {
            $foto = '/resources/images/adminDefaultImg.png';
            print('
                     <div class="row messaggio">
                     <div class="col-6"></div>
                      <div class="col-6" style="border: 2px solid #202040; border-radius: 2px; margin-top: 2%; background-color: #e3e2e7; max-width: 40%; max-height: 80px">
                        <img style="display: inline; margin-right: 5%; margin-top: 2%; border-radius: 50%;" height= "60px" src="' . $foto . '" alt="imgProfile">
                        <p style="display: inline; margin-right: 20%;" ><b>' . $m['userNameUtente'] . '</b></p>
                        <p style="display: block; position: relative; top: -25px;text-align: center" >' . $m['testo'] . '</p>
                      <span style="display: block; margin-right: 2px; position: relative; top: -60px; text-align: right">' . $m['dataInvio'] . '</span>
                      </div>
                    </div>
                    ');
        }
    } ?>
<script>
    var nodes = document.querySelectorAll('.messaggio');
    var last = nodes[nodes.length- 1];
    window.addEventListener('load', function(e) {
        last.focus();
    })
    setTimeout(function () {
        window.location.href= '/logic/chatIframe.php'; // the redirect goes here

    },7000);
</script>
<?php
 //   header('refresh: 5');



