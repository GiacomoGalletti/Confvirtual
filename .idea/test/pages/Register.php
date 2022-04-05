<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Page</title>
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
 include ('../logic/UsersInsert.php');
 registerUser();
?>
<form action="Register.php" method="post" >
    <div class="container">
        <div class="row justify-content-between">
            <div class="imgcontainer">
                <img src="../resources/images/confvirtualTitle.png" alt="Avatar" class="avatar">
            </div>
        </div>
    </div>


    <div class="container">
        <h1>Registrazione</h1>
        <p>Riempire tutti i campi per creare l'account.</p>
        <hr>

        <label for="userName"><b>UserName <sup>*</sup></b></label>
        <input type="text" placeholder="inserisci userName" name="userName" id="userName" required>

        <label for="name"><b>Nome <sup>*</sup></b></label>
        <input type="text" placeholder="nome" name="name" id="name" required>

        <label for="surname"><b>Cognome <sup>*</sup></b></label>
        <input type="text" placeholder="cognome" name="surname" id="surname" required>

        <label for="psw"><b>Password <sup>*</sup></b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

        <label for="luogoNascita"><b>Luogo di nascita</b></label>
        <input type="text" placeholder="inserisci provincia" name="luogoNascita" id="luogoNascita">

        <label for="dataNascita"><b>Data di nascita <sup>*</sup></b></label>
        <input type="date" placeholder="inserisci data di nascita" name="dataNascita" id="dataNascita" required>
        <hr>
        <p><sup>*</sup> campi obbligatori</p>
        <button type="submit" class="registerbtn" name="submit">Submit</button>
    </div>

    <div class="container signin">
        <p>Hai già un account? <a href="LoginPage.php">Accedi</a>.</p>
    </div>
</form>
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
</body>
<footer>
    <a href="https://www.iubenda.com/privacy-policy/39459755"
       class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe "
       title="Privacy Policy ">Privacy Policy</a><script type="text/javascript">
        (function (w,d) {var loader = function () {
            var s = d.createElement("script"),
            tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js";
            tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);
        }else if(w.attachEvent){
                w.attachEvent("onload", loader);
        }else{
                w.onload = loader;
        }
        })
        (window, document);</script>
</footer>
</html>