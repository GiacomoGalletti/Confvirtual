<!DOCTYPE html>
<html lang="en">
<?php
include_once (sprintf("%s/logic/permission/SessionAdminPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once(sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once(sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once(sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
require (sprintf("%s/logic/Upload.php", $_SERVER["DOCUMENT_ROOT"]));
require (sprintf("%s/logic/FileTypeEnum.php", $_SERVER["DOCUMENT_ROOT"]));

if(isset($_POST['submit'])){
    try {
        $upload = new Upload($_FILES['fileToUpload'], FileTypeEnum::IMG);
    } catch (Exception $e) {
        echo '<h4>Upload fallito</h4>' . '<p>'. $e .'</p>';
    }
    if (!empty($upload)) {
        ConferenceQueryController::createConference($_POST["name"],$_POST["acronimo"],$upload->getFilePath(),$_POST["date"]);
    } else {
        echo '<h4>Conferenza non creata</h4>';
    }
}
?>
<body>
<form action="createconference.php" method="post" autocomplete="off" enctype="multipart/form-data">
    <?php
        include_once(sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
    ?>
    <div class="container">
        <h3>Creazione conferenza</h3>
        <div class="container">
            <p>Riempire i campi per creare la conferenza.</p>
            <hr>
            <label for="name"><b>Nome Conferenza <sup>*</sup></b></label>
            <input type="text" placeholder="nome della conferenza" name="name" id="name" required>
            <label for="acronimo"><b>Acronimo Conferenza <sup>*</sup></b></label>
            <input type="text" placeholder="acronimo della conferenza" name="acronimo" id="acronimo" required>
            <label for="fileToUpload"><b>Logo Conferenza</b></label><br>
            <input class="form_articolo" type="file" name="fileToUpload" id="fileToUpload"><br>
            <label for="date"><b>Date di svolgimento <sup>*</sup></b></label>
            <input type="text" class="form-control date" placeholder="Inserisci tutte le date in cui si svolgerà" name="date" id="date">
            <hr>
            <p><sup>*</sup> campi obbligatori</p>
            <button type="submit" class="registerbtn" name="submit">Conferma</button>
        </div>

    </div>

</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
    $('.date').datepicker({
        multidate: true,
        format: 'yyyy-mm-dd'
    });
</script>
</body>
<footer>

</footer>
</html>