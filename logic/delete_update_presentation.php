<?php
print_r($_POST);
header('HTTP/1.1 307 Temporary Redirect');
header('Location: /pages/admin/addpresentation.php');

include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
$index = $_POST['presentationbtn'];
// modifica delle informazioni della presentazione
if (isset($_POST['confirm_mod_btn'])) {
    PresentationQueryController::updatePresentation($_POST['tipologia'][$index],$_POST['codice_presentazione'][$index], $_POST['codice_sessione'],$_POST['titolo'][$index],$_POST['filePDF'][$index],$_POST['numeroPagine'][$index],$_POST['abstract'][$index]);
}
// eliminazione della presentazione
if(isset($_POST['delete_btn'])) {
    PresentationQueryController::deletePresentation($_POST['codice_presentazione'][$index], $_POST['codice_sessione']);
}

