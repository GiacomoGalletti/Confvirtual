<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Upload.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/FileTypeEnum.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/hourchecker.php", $_SERVER["DOCUMENT_ROOT"]));

header('HTTP/1.1 307 Temporary Redirect');
header('Location: /pages/admin/addpresentation.php');

$index = $_POST['presentationbtn'];
function checkSessionHour(): bool
{
    $orainizio_sessione = $_POST['orainizio_sessione'][$_POST['presentationbtn']];
    $orafine_sessione = $_POST['orafine_sessione'][$_POST['presentationbtn']];

    if ($_POST['oraini'] < $orainizio_sessione || $_POST['orafin'] > $orafine_sessione) {
        return true;
    } else {
        return false;
    }
}
if ((!hourAviable(DateTime::createFromFormat("H:i", $_POST['oraini'])->format("H:i"),DateTime::createFromFormat("H:i", $_POST['orafin'])->format("H:i"),$_POST['arrayHours'])) OR checkSessionHour())
{
    Session::start();
    Session::write('msg_presentazione', '
                    <div class="container" style="background-color: red;opacity: 50"> <h4>
                        Orario non disponibile
                    </h4> </div>');
} else {
    switch ($_POST['radius']) {
        case 'articolo':
            try {
                $upload = new Upload($_FILES['fileToUpload'], FileTypeEnum::PDF);
            } catch (Exception $e) {
                Session::write('msg_presentazione', '
                    <div class="container" style="background-color: red;opacity: 50"> <h4>
                    Upload fallito.
                    </h4> </div>');
            }
            if (PresentationQueryController::createArticle($_POST['codice_sessione'][$index],$_POST['oraini'],$_POST['orafin'],$_POST['titolo_articolo'],$upload->getFilePath(),$_POST['pagenum'])) {
                try {
                    Session::write('msg_presentazione',
                        '<div class="container" style="background-color: limegreen;opacity: 50"> <h4>
                        Articolo creato con successo.
                        </h4> </div>');
                    PresentationQueryController::orderPresentation($_POST['codice_sessione'][$index]);
                    exit;
                } catch (ExpiredSessionException|Exception $e) {}
            } else {
                Session::write('msg_presentazione', '
                    <div class="container" style="background-color: red;opacity: 50"> <h4>
                    Creazione articolo fallita.
                    </h4> </div>');
            }
            break;

        case 'tutorial':
            if (PresentationQueryController::createTutorial($_POST['codice_sessione'][$index],$_POST['oraini'],$_POST['orafin'],$_POST['titolo_tutorial'],$_POST['input_abstract_tutorial'])) {
                Session::write('msg_presentazione', '
                    <div class="container" style="background-color: limegreen;opacity: 50"> <h4>
                    Tutorial creato con successo.
                    </h4> </div>');
                PresentationQueryController::orderPresentation($_POST['codice_sessione'][$index]);
                exit;
            } else {
                Session::write('msg_presentazione', '
                    <div class="container" style="background-color: red;opacity: 50"> <h4>
                    Creazione tutorial fallita.
                    </h4> </div>');
            }
            break;

        default:
            Session::write('msg_presentazione', '
                    <div class="container" style="background-color: red;opacity: 80"> <h4>
                                        Seleziona una tipologia di presentazione</h4> </div>');;
    }
}