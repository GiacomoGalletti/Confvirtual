<?php
ob_start();
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ChatQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
Session::start();
if(Session::read('post')) {$_POST = Session::read('post'); Session::delete('post');}

global $id;
$id = 0;
if (isset($_POST['chatbtn'])) {
    $codice_sessione = $_POST['codice_sessione'][$_POST['chatbtn']];
    Session::write('codice_sessione',$codice_sessione);
} else {
    $codice_sessione = Session::read('codice_sessione');
}

if(isset($_POST)) { Session::write('post',$_POST); Session::commit();}
print '<style>

.dont-break-out {

  /* These are technically the same, but use both */
  overflow-wrap: break-word;
  word-wrap: break-word;

  -ms-word-break: break-all;
  /* This is the dangerous one in WebKit, as it breaks things wherever */
  word-break: break-all;
  /* Instead use this non-standard one: */
  word-break: break-word;

  /* Adds a hyphen where the word breaks, if supported (No Blink) */
  -ms-hyphens: auto;
  -moz-hyphens: auto;
  -webkit-hyphens: auto;
  hyphens: auto;

}
</style>';
foreach (ChatQueryController::getMessages($codice_sessione) as $m) {
    $userName_sender = $m['userNameUtente'];
    $type_sender = UserQueryController::getUserType($userName_sender);

    if (Session::read('userName') != $m['userNameUtente']) {

        $foto = imagesSetter($type_sender, $userName_sender);

        print('
                     <div class="row messaggio">
                     <div class="col-1"></div>
                      <div class="col-6" style="border: 2px solid #f2bd3f; border-radius: 2px; margin-top: 2%; background-color: #f1d38d;">
                        <img style="display: inline; margin-right: 5%; margin-top: 2%; border-radius: 50%;" height="60px" src="' . $foto . '" alt="imgProfile">
                        <p style="display: inline; margin-right: 20%;" ><b>' . $m['userNameUtente'] . '</b> [' . $type_sender . ']</p>
                        <p class="dont-break-out" style="display: block; position: relative; bottom: 2px; text-align: center; padding-right: 5%" >' . $m['testo'] . '</p>
                      <span style="display: block; margin-right: 2px; bottom: 2px; position: relative; text-align: right" class="time-right">' . $m['dataInvio'] . '</span>
                      </div>
                    </div>');
    } else {

        $foto = imagesSetter($type_sender, $userName_sender);

        print('
                     <div class="row messaggio">
                     <div class="col-6"></div>
                      <div class="col-6" style="border: 2px solid #202040; border-radius: 2px; margin-top: 2%; background-color: #e3e2e7;">
                        <img style="display: inline; margin-right: 5%; margin-top: 2%; border-radius: 50%;" height= "60px" src="' . $foto . '" alt="imgProfile">
                        <p style="display: inline; margin-right: 20%;" ><b>' . $m['userNameUtente'] . '</b></p>
                        <p class="dont-break-out" style="display: block; position: relative; bottom: 2px;text-align: center; padding-right: 5%" >' . $m['testo'] . '</p>
                      <span style="display: block; margin-right: 2px; position: relative; bottom: 2px; text-align: right">' . $m['dataInvio'] . '</span>
                      </div>
                    </div>
                    ');
    }
}
header("Refresh: 5;");

function imagesSetter($type_sender, $userName_sender) {
    if ($type_sender === 'amministratore') {
        return '/resources/images/adminDefaultImg.png';
    }
    if ($type_sender === 'utente') {
        return '/resources/images/userDefaultImg.png';
    }
    // altri casi: speaker / presenter
    if ($type_sender !== 'amministratore' AND $type_sender !== 'utente') {
        $foto = UserQueryController::getUserImgProfile($userName_sender,$type_sender);
        // se non hanno immagini personalizzate ottengono l'immagine dell'utente
        if ($foto == null OR $foto == '') {
            $foto = '/resources/images/userDefaultImg.png';
            return $foto;
        }
        return $foto;
    }
}

