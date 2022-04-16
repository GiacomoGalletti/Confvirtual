<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UsersInsert.php", $_SERVER["DOCUMENT_ROOT"]));
if(isset($_POST['submit'])) {
    registerUser($_POST["uname"], $_POST["name"], $_POST["surname"], $_POST["psw"], $_POST["luogoNascita"], $_POST["dataNascita"]);
}
?>
<body>
<form action="register.php" method="post" >
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
        <p>Hai già un account? <a href="/.idea/pages/pages/login.php">Accedi</a>.</p>
    </div>
</form>
<?php
include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
?>
</body>
</html>