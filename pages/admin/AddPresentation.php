<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/Login.css"/>
</head>
<body>
<form action="../AddSession.php" method="post" >
<?php
include('../templates/titleimg.html');
?>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="../../index.php" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conferenze</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="../NotLoggedFutureConferences.php">Prossime confereze</a>
                            <a class="dropdown-item" href="../pastconferences.php">Conferenze passate</a>
                        </div>
                    </li>
                    <li class="nav-item"><a href="/.idea/pages/Info.html" class="nav-link">Informazioni</a></li>
                    <li class="nav-item active"><a href="/.idea/pages/pages/login.php" class="nav-link">accedi</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Per poter aggiungere una sessione bisogna prima aver selezionato una conferenza -->
        <label for="ttl"><b>Titolo sessione</b></label>
        <input id = "titolo" type="text" placeholder="Inserisci titolo" name="ttl" required>
        <!-- I giorni da poter selezionare devono essere quelli della conferenza -->
        <label for="giorno"><b>Selezionare giorno della conferenza: </b></label>
        <select Name="lb_selezione_giorno" Size="Number_of_options">
            <option> Giorno 1 </option>
            <option> Giorno 2 </option>
            <option> Giorno 3 </option>
            <option> Giorno N </option>
        </select>
        <br>
        <label for="oraini"><b>Orario di inizio sessione</b></label>
        <input type="time" id="appt1" name="appt1" min="07:00" max="23:00" required>
        <small>Inserire un orario tra le 7:00 e le 23:00</small>
        <br>
        <label for="orafin"><b>Orario di fine sessione</b></label>
        <input type="time" id="appt2" name="appt2" min="07:00" max="23:00" required>
        <small>Inserire un orario tra le 7:00 e le 23:00</small>
        <br>
        <label for="stanza"><b>Link della stanza</b></label>
        <input id = "linkstanza" type="text" placeholder="Inserisci link della stanza" name="stanza" required>
    </div>

</form>
<script src="../../js/jquery.min.js"></script>
<script src="../../js/popper.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/main.js"></script>
</body>
<footer>
</footer>
</html>