<?php
    include_once ('../logic/UsersQuery.php');

    if(empty($_SESSION['userName'])){
        //header('Location:../pages/LoginPage.php');
        echo ('<h1>NON POSSO ACCEDERE</h1> <br>');
        Session::dump();
        exit();
    } else {
        echo ('<h1>ACCEDO ALLA PAGINA</h1> <br>');
        Session::dump();
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin-HomePage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Login</title>
</head>
<?php
if(empty($_POST['logout'])){
    session_abort();
}
include ('../templates/titleimg.html');
?>
<body>
<form>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a href="../pages/AdminMainPage.php" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conferenze</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="#">Prossime confereze</a>
                            <a class="dropdown-item" href="#">Conferenze passate</a>
                            <a class="dropdown-item" href="#">Iscrizioni</a>
                            <a class="dropdown-item" href="../pages/AdminCreateConference.php">Crea una conferenza</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Utenti</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="#">Registra utente Speaker</a>
                            <a class="dropdown-item" href="#">Registra utente Presenter</a>
                        </div>
                    </li>
                    <li class="nav-item" name="logout"><a href="LoginPage.php" class="nav-link">logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Benvenuto <?php echo($_SESSION['userName'])?></h2>
        <h3>Menu amministratore</h3>
        <p>
            questa è la tua dashboard.
            qui puoi creare e modificare le conferenze e gli utenti iscritti alla piattaforma
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