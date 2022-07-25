<?php
include_once (sprintf("%s/logic/FileTypeEnum.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Upload.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
$index = $_POST['article_tutorial_btn'];
print_r($_POST);
header('HTTP/1.1 307 Temporary Redirect');
header('Location: /pages/admin/modifypresentation.php');
// modifica delle informazioni della presentazione
if (isset($_POST['confirm_mod_btn'])) {
    if ((!isset($_POST['titolo_new']) || $_POST['titolo_new'] == '')){
        $_POST['titolo_new'] = $_POST['titolo'][$index];
    }
    if ((!isset($_POST['n_pagine_tb']) || $_POST['n_pagine_tb'] == '')){
        $_POST['n_pagine_tb'] = $_POST['numeroPagine'][$index];
    }

    if ($_POST['tipologia'][$index]=='tutorial') {
        $_POST['fileToUpload'] = 'placeholder';
        //$_FILES['fileToUpload'] = 'placeholder';
    }
    if ((!isset($_POST['fileToUpload']) || $_POST['fileToUpload'] != '') && ($_POST['tipologia'][$index]!='tutorial')){
        try {
            $upload = new Upload($_FILES['fileToUpload'], FileTypeEnum::PDF);
        } catch (Exception $e) {
            echo '<div class="container" style="background-color: red;opacity: 50"> <h4>Upload fallito.</h4> </div>';
        }
    } else {
        $_POST['fileToUpload'] = $_POST['filePDF'][$index];
    }

    if ((!isset($_POST['input_abstract_tutorial'][$index]) || $_POST['input_abstract_tutorial'][$index] == '')){
        $_POST['input_abstract_tutorial'] = $_POST['abstract'][$index];
    }
    PresentationQueryController::updatePresentation($_POST['tipologia'][$index],$_POST['codice_presentazione'][$index], $_POST['codice_sessione'],$_POST['titolo_new'],$_POST['fileToUpload'],$_POST['n_pagine_tb'],$_POST['input_abstract_tutorial']);
    $debug = "TIPOLOGIA: ".$_POST['tipologia'][$index]
        ."<br>CODICE PRESENTAZIONE: ".$_POST['codice_presentazione'][$index]
        ."<br>CODICE SESSIONE:  ".$_POST['codice_sessione']
        ."<br>TITOLO NUOVO:  ".$_POST['titolo_new']
        ."<br>PDF:  ".$_POST['filePDF'][$index]
        ."<br>NUM PAG NUOVO: ".$_POST['n_pagine_tb']
        ."<br>ABSTRACT NUOVO:  ".$_POST['input_abstract_tutorial'];
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: /pages/admin/addpresentation.php');
}

// eliminazione della presentazione
if(isset($_POST['delete_btn'])) {
    PresentationQueryController::deletePresentation($_POST['codice_presentazione'][$index], $_POST['codice_sessione']);
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: /pages/admin/addpresentation.php');
}

?>
    <html>
    <h1> pagina </h1>
    <p>
<?php print($debug); ?>