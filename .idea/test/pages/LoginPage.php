<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/Login.css"/>
    <title>Login</title>
</head>
<body>
<?php
if(isset($_POST['submit'])) {
    include_once ('../logic/UsersQuery.php');
    login();
}
?>
<form action="LoginPage.php" method="post" >
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
                    <li class="nav-item"><a href="../index.html" class="nav-link">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Conferenze</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="#">Prossime confereze</a>
                            <a class="dropdown-item" href="NotLoggedPastConferences.php">Conferenze passate</a>
                        </div>
                    </li>
                    <li class="nav-item"><a href="../pages/Info.html" class="nav-link">Informazioni</a></li>
                    <li class="nav-item active"><a href="LoginPage.php" class="nav-link">accedi</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input id = "userName" type="text" placeholder="Enter Username" name="uname" required>
        <label for="psw"><b>Password</b></label>
        <input id = "password" type="password" placeholder="Enter Password" name="psw" required>
        <button name = "submit" type="submit">Login</button>
    </div>

</form>
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
</body>
<footer>
    <div class="container">
        <span class="psw"><p>Registra un<a href="../pages/Register.php"> nuovo account</a>.</p><a href="https://www.iubenda.com/privacy-policy/39459755" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Privacy Policy ">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
        </span>
    </div>
</footer>
</html>