<?php
include_once (sprintf("%s/logic/FileTypeEnum.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Upload.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"])); // da modificare
print_r($_POST);
// modifica delle informazioni della presentazione
if (isset($_POST['confirm_btn'])) {

    $nomeUtente = Session::read('userName');

    if ((!isset($_POST['curriculum']) || $_POST['curriculum'] == '')){
        $curriculum = $_POST['curriculum_original'];
    } else {
        $curriculum = $_POST['curriculum'];
    }

    if ((!isset($_POST['nomeDipartimento']) || $_POST['nomeDipartimento'] == '')){
        $nomeDipartimento = $_POST['nomeDipartimento_original'];
    } else {
        $nomeDipartimento = $_POST['nomeDipartimento'];
    }

    if ((!isset($_POST['nomeUniversita']) || $_POST['nomeUniversita'] == '')){
        $nomeUniversita = $_POST['nomeUniversita_original'];
    } else {
        $nomeUniversita = $_POST['nomeUniversita'];
    }

    if (isset($_FILES['fileToUpload']) AND $_FILES['fileToUpload'] != '') {
        $upload = new Upload($_FILES['fileToUpload'], FileTypeEnum::IMG);
        $filePath = $upload->getFilePath();
    } else {
        $filePath = $_POST['fileToUpload_original'];
    }

    if (UserQueryController::updateUser($nomeUtente,$curriculum, $nomeDipartimento,$nomeUniversita,$filePath))
    {
        Session::write('msg_modifica', '
                        <div class="container" style="background-color: limegreen;opacity: 50"> <h4>
                            Modifiche salvate con successo.
                        </h4> </div>');

    } else {
        Session::write('msg_modifica', '
                        <div class="container" style="background-color: red;opacity: 50"> <h4>
                            Nessuna modifica eseguita.
                        </h4> </div>');

    }

    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: /pages/editprofile.php');
}
