<div class="container">
    <div class="row justify-content-between">
        <div class="imgcontainer">
            <img src="/.idea/surce/resources/images/confvirtualTitle.png" alt="immagine logo" class="logo">
        </div>
    </div>
</div>
<?php
include_once ($_SERVER["DOCUMENT_ROOT"] .'/.idea/surce/logic/Session.php');
if(isset($_POST['logout'])){
    Session::start();
    Session::destroy();
    // header("Location: /.idea/surce/pages/LoginPage.php");
    // header("Refresh:0");
}
switch(Session::read('type')){
    case 'amministratore': ?>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="/.idea/surce/index.php" class="nav-link">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conferenze</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                <a class="dropdown-item" href="/.idea/surce/pages/FutureConferences.php">Prossime confereze</a>
                                <a class="dropdown-item" href="#">Conferenze passate</a>
                                <a class="dropdown-item" href="#">Iscrizioni</a>
                                <a class="dropdown-item" href="/.idea/surce/pages/admin/AdminCreateConference.php">Crea una conferenza</a>
                                <a class="dropdown-item" href="/.idea/surce/pages/admin/ConferenceSelection.php">Aggiungi sessione</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Utenti</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                <a class="dropdown-item" href="#">Registra utente Speaker</a>
                                <a class="dropdown-item" href="#">Registra utente Presenter</a>
                            </div>
                        </li>
                        <li class="nav-item"><button name='logout' class="nav-link">logout</button></li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
        break;
        case 'speaker':?>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="/.idea/surce/index.php" class="nav-link">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conferenze</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                <a class="dropdown-item" href="#">Prossime confereze</a>
                                <a class="dropdown-item" href="#">Conferenze passate</a>
                            </div>
                        </li>
                        <li class="nav-item"><a name='logout' href="/.idea/surce/pages/LoginPage.php" class="nav-link">logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php
        break;
        case 'presenter':?>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="/.idea/surce/index.php" class="nav-link">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conferenze</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                <a class="dropdown-item" href="#">Prossime confereze</a>
                                <a class="dropdown-item" href="#">Conferenze passate</a>
                            </div>
                        </li>
                        <li class="nav-item"><a name='logout' href="/.idea/surce/pages/LoginPage.php" class="nav-link">logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php
        break;
        default : ?>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="/.idea/surce/index.php" class="nav-link">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conferenze</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                <a class="dropdown-item" href="/.idea/surce/pages/FutureConferences.php">Prossime confereze</a>
                                <a class="dropdown-item" href="/.idea/surce/pages/NotLoggedPastConferences.php">Conferenze passate</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a name="informazioni" href="/.idea/surce/pages/Info.php" class="nav-link">Informazioni</a>
                        </li>
                        <li class="nav-item"><a href="/.idea/surce/pages/LoginPage.php" class="nav-link">accedi</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php
}
?>