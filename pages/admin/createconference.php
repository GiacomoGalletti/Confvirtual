<!DOCTYPE html>
<html lang="en">
<?php
include_once(sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once(sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once(sprintf("%s/logic/CreateConference.php", $_SERVER["DOCUMENT_ROOT"]));
if(isset($_POST['submit'])){
    createConference();
}
include_once(sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>
<form action="createconference.php" method="post" autocomplete="off">
    <div class="container">
        <h3>Creazione conferenza</h3>
        <div class="container">
            <p>Riempire i campi per creare la conferenza.</p>
            <hr>

            <label for="name"><b>Nome Conferenza <sup>*</sup></b></label>
            <input type="text" placeholder="nome della conferenza" name="name" id="name" required>

            <label for="acronimo"><b>Acronimo Conferenza <sup>*</sup></b></label>
            <input type="text" placeholder="acronimo della conferenza" name="acronimo" id="acronimo" required>

            <label for="immagine"><b>Immagine Conferenza </b></label>
            <input type="text" placeholder="inserisci il percorso dell'immagine" name="immagine" id="immagine">

<!--            <form action="upload.php" method="post" enctype="multipart/form-data">-->
<!--                Select image to upload:-->
<!--                <input type="file" name="fileToUpload" id="fileToUpload">-->
<!--                <input type="submit" value="Upload Image" name="submit">-->
<!--            </form>-->

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
