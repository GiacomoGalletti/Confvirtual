<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
ob_start();
print ('
<div class="container">
    <div class="row justify-content-between">
        <div class="imgcontainer">
            <img src="/resources/images/confvirtualTitle.png" alt="immagine logo" class="logo">
        </div>
    </div>
</div>
<form method="post">
');

if(isset($_POST['logout'])){
    Session::start();
    Session::destroy();
    header("Location: /index.php");
}
try {
    switch (Session::read('type')) {
        case 'amministratore': ?>
            <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars"></span> Menu
                    </button>
                    <div class="collapse navbar-collapse" id="ftco-nav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a href="/index.php" class="nav-link">Home</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">Conferenze</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown04">
                                    <a class="dropdown-item" href="/pages/futureconferences.php">Prossime confereze</a>
                                    <a class="dropdown-item" href="/pages/pastconferences.php">Conferenze passate</a>
                                    <a class="dropdown-item" href="/pages/subscribedconferences.php">Iscrizioni</a>
                                    <a class="dropdown-item" href="/pages/admin/createconference.php">Crea una
                                        conferenza</a>
                                    <a class="dropdown-item" href="/pages/admin/myconferences.php">Le mie conferenze</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">Utenti</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown04">
                                    <a class="dropdown-item" href="/pages/admin/promoteuser.php">Promuovi utente</a>
                                    <a class="dropdown-item" href="/pages/admin/managespeaker.php">Gestisci Speaker</a>
                                    <a class="dropdown-item" href="/pages/admin/managepresenter.php">Gestisci Presenter</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">Sponsor</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown04">
                                    <a class="dropdown-item" href="/pages/admin/sponsorizationlist.php">Lista Sponsorizzazioni</a>
                                    <a class="dropdown-item" href="/pages/admin/managesponsor.php">Gestisci Sponsor</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <button name='logout' style="background-color: transparent !important;" class="nav-link">logout</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php
            break;
        case 'presenter':
        case 'speaker':
            ?>
            <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars"></span> Menu
                    </button>
                    <div class="collapse navbar-collapse" id="ftco-nav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a href="/index.php" class="nav-link">Home</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">Conferenze</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown04">
                                    <a class="dropdown-item" href="/pages/futureconferences.php">Prossime confereze</a>
                                    <a class="dropdown-item" href="/pages/pastconferences.php">Conferenze passate</a>
                                    <a class="dropdown-item" href="/pages/subscribedconferences.php">Iscrizioni</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">Profilo utente</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown04">
                                    <a class="dropdown-item" href="/pages/editprofile.php">Modifica profilo</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <button name='logout' style="background-color: transparent !important;" class="nav-link">logout</button>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php
            break;
        case 'utente':
            ?>
            <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars"></span> Menu
                    </button>
                    <div class="collapse navbar-collapse" id="ftco-nav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a href="/index.php" class="nav-link">Home</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">Conferenze</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown04">
                                    <a class="dropdown-item" href="/pages/futureconferences.php">Prossime confereze</a>
                                    <a class="dropdown-item" href="/pages/pastconferences.php">Conferenze passate</a>
                                    <a class="dropdown-item" href="/pages/subscribedconferences.php">Iscrizioni</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <button name='logout' style="background-color: transparent !important;" class="nav-link">logout</button>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php
            break;

        default : ?>
            <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars"></span> Menu
                    </button>
                    <div class="collapse navbar-collapse" id="ftco-nav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a href="/index.php" class="nav-link">Home</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="dropdown04" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">Conferenze</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown04">
                                    <a class="dropdown-item" href="/pages/futureconferences.php">Prossime confereze</a>
                                    <a class="dropdown-item" href="/pages/pastconferences.php">Conferenze passate</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="/pages/info.php" class="nav-link">Informazioni</a>
                            </li>
                            <li class="nav-item"><a href="/pages/login.php" class="nav-link">accedi</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php
    }
} catch (ExpiredSessionException|Exception $e) {
    echo $e;
}
include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));

?>
</form>
