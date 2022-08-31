<?php
include_once (sprintf("%s/logic/PresentazionePresenterSpeakerController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));

if(isset($_POST['associationbtn'])) {
    $index = $_POST['associationbtn'];
    $index_btn = $_POST['btn'];
//    print('Value of index: '.$index);
//    print_r($_POST);
    if (!isset($_POST['tipo_presentazione'])) {
        exit();
    }
    if ($_POST['tipo_presentazione']==='tutorial') {
        if(PresentazionePresenterSpeakerController::associateSpeaker($_POST['username'][$index_btn],$_POST['codicepresentazione'][$index],$_POST['codicesessione'][$index])) {
            try {
                Session::write('msg_sessione', '
                        <div class="container" style="background-color: limegreen;opacity: 50"> <h4>
                            Speaker associato con successo.
                        </h4> </div>');
            } catch (ExpiredSessionException|Exception $e) {
                echo $e;
            }
        } else {
            try {
                Session::write('msg_sessione', '<div class="container" style="background-color: red;opacity: 50"> <h4>Associazione Speaker fallita.</h4> </div>');
            } catch (ExpiredSessionException|Exception $e) {
                echo $e;
            }
        }
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: /pages/admin/tutorialslist.php');
    }

    if ($_POST['tipo_presentazione']==='articolo') {
        if(PresentazionePresenterSpeakerController::addAuthorAndAssociatePresenter($_POST['username'][$index_btn],$_POST['codicepresentazione'][$index],$_POST['codicesessione'][$index])) {
            try {
                Session::write('msg_sessione', '
                        <div class="container" style="background-color: limegreen;opacity: 50"> <h4>
                            Presenter associato con successo.
                        </h4> </div>');
            } catch (ExpiredSessionException|Exception $e) {
                echo $e;
            }
        } else {
            try {
                Session::write('msg_sessione', '<div class="container" style="background-color: red;opacity: 50"> <h4>Associazione Presenter fallita.</h4> </div>');
            } catch (ExpiredSessionException|Exception $e) {
                echo $e;
            }

        }
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: /pages/admin/listarticle.php');
    }
}