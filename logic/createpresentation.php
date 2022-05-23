<?php
require (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
require (sprintf("%s/logic/Upload.php", $_SERVER["DOCUMENT_ROOT"]));
require (sprintf("%s/logic/FileTypeEnum.php", $_SERVER["DOCUMENT_ROOT"]));
require (sprintf("%s/logic/hourchecker.php", $_SERVER["DOCUMENT_ROOT"]));

$index = $_POST['presentationbtn'];
print_r($_POST['arrayHours']);
if (!hourAviable(DateTime::createFromFormat("H:i", $_POST['oraini'])->format("H:i"),DateTime::createFromFormat("H:i", $_POST['orafin'])->format("H:i"),$_POST['arrayHours'])) {
    echo 'orario non disponibile';
} else {
    switch ($_POST['radius']) {
        case 'articolo':
            try {
                $upload = new Upload($_FILES['fileToUpload'], FileTypeEnum::PDF);
            } catch (Exception $e) {
                echo '<h4>Upload fallito</h4>' . '<p>'. $e .'</p>';
            }
            if (PresentationQueryController::createArticle($_POST['codice_sessione'][$index],$_POST['oraini'],$_POST['orafin'],$_POST['titolo_articolo'],$upload->getFilePath(),$_POST['pagenum'])) {
                echo 'articolo creato con successo';
            } else {
                echo 'articolo non creato.';
            }
            break;

        case 'tutorial':
            if (PresentationQueryController::createTutorial($_POST['codice_sessione'][$index],$_POST['oraini'],$_POST['orafin'],$_POST['titolo_tutorial'],$_POST['input_abstract_tutorial'])) {
                echo 'tutorial creato con successo';
            } else {
                echo 'tutorial non creato.';
            }
            break;

        default: echo '<p2>seleziona una tipologia di presentazione.</p2>';
    }
}

header('HTTP/1.1 307 Temporary Redirect');
header('Location: /pages/admin/addpresentation.php');