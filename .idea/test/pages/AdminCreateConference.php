<?php
session_start();

if(isset($_POST['logout'])){
    session_abort();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Creazione Conferenza</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/CreationConference.css"/>
</head>
<body>
<form>
    <div class="container">
        <div class="row justify-content-between">
            <div class="imgcontainer">
                <img src="../resources/images/confvirtualTitle.png" alt="Avatar" class="avatar">
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="AdminMainPage.php" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conferenze</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="#">Prossime confereze</a>
                            <a class="dropdown-item" href="#">Conferenze passate</a>
                            <a class="dropdown-item" href="#">Iscrizioni</a>
                            <a class="dropdown-item active" href="AdminCreateConference.php" >Crea una conferenza</a>
                        </div>
                    </li>
                    <li class="nav-item" name="logout"><a href="LoginPage.php" class="nav-link">logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h3>Creazione conferenza</h3>
        <div class="container">
            <p>Riempire i campi per creare la conferenza.</p>
            <hr>

            <label for="annoEdizione"><b>Anno Edizione <sup>*</sup></b></label>
            <input type="text" placeholder="anno di svolgimento" name="annoEdizione" id="annoEdizione" required>

            <label for="name"><b>Nome Conferenza <sup>*</sup></b></label>
            <input type="text" placeholder="nome della conferenza" name="name" id="name" required>

            <label for="acronimo"><b>Acronimo Conferenza <sup>*</sup></b></label>
            <input type="text" placeholder="acronimo della conferenza" name="acronimo" id="acronimo" required>

            <label for="immagine"><b>Immagine Conferenza </b></label>
            <input type="text" placeholder="inserisci il percorso dell'immagine" name="immagine" id="immagine">


            <label><b>Date di svolgimento <sup>*</sup></b></label>
            <input type="text" class="form-control date" placeholder="Inserisci tutte le date in cui si svolgerà">

            <hr>
            <p><sup>*</sup> campi obbligatori</p>
            <button type="submit" class="registerbtn" name="submit">Conferma</button>
        </div>

    </div>

</form>
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
    $('.date').datepicker({
        multidate: true,
        format: 'dd-mm-yyyy'
    });
</script>
</body>
<footer>

</footer>
</html>
