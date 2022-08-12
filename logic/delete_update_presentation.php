<?php
include_once (sprintf("%s/logic/FileTypeEnum.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Upload.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
$index = $_POST['article_tutorial_btn'];
print_r($_POST);

// modifica delle informazioni della presentazione
if (isset($_POST['confirm_mod_btn'])) {

    $tipologia = $_POST['tipologia'][$index];
    $codice_presentazione = $_POST['codice_presentazione'][$index];
    $codice_sessione = $_POST['codice_sessione'][$_POST['presentationbtn']];
    $titolo_new = $_POST['titolo_new'];
    $_n_pagine = $_POST['n_pagine_tb'];
    $abstract_new = $_POST['input_abstract_tutorial'];

    if ((!isset($_POST['titolo_new']) || $_POST['titolo_new'] == '')){
        $titolo_new = $_POST['titolo'][$index];
    }

    if ((!isset($_n_pagine) || $_n_pagine == '')){
        $_n_pagine = $_POST['numeroPagine'][$index];
    }

    if ($tipologia=='tutorial') {
        $_POST['fileToUpload'] = 'placeholder';
    }

    $filePath = '';

//    if ((!isset($_POST['fileToUpload']) || $_POST['fileToUpload'] != '') && ($tipologia!='tutorial')){
//        try {
//            $upload = new Upload($_FILES['fileToUpload'], FileTypeEnum::PDF);
//            $filePath = $upload->getFilePath();
//        } catch (Exception $e) {
//            echo '<div class="container" style="background-color: red;opacity: 50"> <h4>Upload fallito.</h4> </div>';
//        }
//    }

    if ($tipologia === 'articolo'){
        try {
            $upload = new Upload($_FILES['fileToUpload'], FileTypeEnum::PDF);
            $filePath = $upload->getFilePath();
        } catch (Exception $e) {
            echo '<div class="container" style="background-color: red;opacity: 50"> <h4>Upload fallito.</h4> </div>';
        }
    }

    if ((!isset($abstract_new) || $abstract_new == '')){
        $abstract_new = $_POST['abstract'][$index];
    }

    if (PresentationQueryController::updatePresentation($tipologia,$codice_presentazione, $codice_sessione,$titolo_new,$filePath,$_n_pagine,$abstract_new))
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

    $debug = "TIPOLOGIA: ".$tipologia
        ."<br>CODICE PRESENTAZIONE: ".$codice_presentazione
        ."<br>CODICE SESSIONE:  ".$codice_sessione
        ."<br>TITOLO NUOVO:  ".$titolo_new
        ."<br>PDF:  ".$filePath
        ."<br>NUM PAG NUOVO: ".$_n_pagine
        ."<br>ABSTRACT NUOVO:  ".$abstract_new;
    header('HTTP/1.1 307 Temporary Redirect');
    //header('Location: /pages/admin/modifypresentation.php');
    header('Location: /pages/admin/addpresentation.php');

}

// eliminazione della presentazione
if(isset($_POST['delete_btn'])) {
    PresentationQueryController::deletePresentation($_POST['codice_presentazione'][$index], $_POST['codice_sessione'][$_POST['presentationbtn']]);
    PresentationQueryController::orderPresentation($_POST['codice_sessione'][$_POST['presentationbtn']]);
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: /pages/admin/addpresentation.php');
}

?>
    <html>
    <h1> pagina </h1>
    <p>
<?php print($debug); ?>