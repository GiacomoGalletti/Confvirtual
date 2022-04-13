<!DOCTYPE html>
<html lang="en">
<head>
    <title>FutureConferences</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<?php
session_start();

if(isset($_POST['logout'])){
    session_abort();
}
include ('../templates/titleimg.html');
?>
<body>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="UserMainPage.php" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conferenze</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item active" href="UserFutureConferences.php">Prossime confereze</a>
                        <a class="dropdown-item" href="UserPastConferences.php">Conferenze passate</a>
                        <a class="dropdown-item" href="#">Iscrizioni</a>
                    </div>
                </li>
                <li class="nav-item" name="logout"><a href="LoginPage.php" class="nav-link">logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<form class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center mb-4">Programmazione Conferenze</h4>
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr>
                            <th>Acronimo</th>
                            <th>Nome</th>
                            <th>Anno</th>
                            <th>Giorni</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row" class="scope" >inf1</th>
                            <td>Informatica-1</td>
                            <td>2022</td>
                            <td>05/04 - 07/04</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="../js/jquery.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>