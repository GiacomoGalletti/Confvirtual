<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Login</title>
</head>
<body>
<form>
    <?php
        if(isset($_POST['logout'])){
            session_abort();
        }
    ?>
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
                    <li class="nav-item active"><a href="UserMainPage.html" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conferenze</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="#">Prossime confereze</a>
                            <a class="dropdown-item" href="#">Conferenze passate</a>
                            <a class="dropdown-item" href="#">Iscrizioni</a>
                        </div>
                    </li>
                    <li class="nav-item" name="logout"><a href="LoginPage.php" class="nav-link">logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Benvenuto <?php echo($_SESSION['userName'])?></h2>
        <h3>QUESTO MENÙ DEVE CAMBIARE IN BASE AL TIPO DI UTENTE LOGGATO</h3>
        <p>
            questa è la tua dashboard. qui è possibile trovare le tue informazioni e magari le conferenze che
            stanno per iniziare, così puoi avere l'ultima possibilità di iscriverti ;)
        </p>
    </div>

</form>
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
</body>
<footer>

</footer>
</html>