<?php
include_once (sprintf("%s/logic/SponsorQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Upload.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/FileTypeEnum.php", $_SERVER["DOCUMENT_ROOT"]));
header('HTTP/1.1 307 Temporary Redirect');
header('Location: /pages/admin/managesponsor.php');
print_r($_POST);
if(isset($_POST['crea_sponsor_btn'])){
    try {
        $upload = new Upload($_FILES['fileToUpload'], FileTypeEnum::IMG);
        if ($_POST['nome_sponsor'] != '' && isset($_POST['nome_sponsor'])) {
            if (SponsorQueryController::createSponsor($_POST['nome_sponsor'],$upload->getFilePath()))
            {
                    Session::write('msg_sessione', '
                        <div class="container" style="background-color: limegreen;opacity: 50"> <h4>
                            Sponsor creato con successo.
                        </h4> </div>');

            } else {
                    Session::write('msg_sessione', '
                        <div class="container" style="background-color: red;opacity: 50"> <h4>
                            Creazione sponsor fallita.
                        </h4> </div>');

            }
        } else {
                Session::write('msg_sessione', '
                        <div class="container" style="background-color: red;opacity: 50"> <h4>
                            Campi inseriti non validi.
                        </h4> </div>');
        }
    } catch (Exception $e) {
        echo '<h4>Upload fallito</h4><br>' . '<p>'. $e .'</p>';
    }
}


