<!DOCTYPE html>
<html lang="it">
<?php
//include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UsersQuery.php", $_SERVER["DOCUMENT_ROOT"]));

//Session::start();
?>
<body>
<form method="post" >
<?php
if(isset($_POST['submit'])) {
    login($_POST["uname"], $_POST["psw"]);
}
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
?>
    <div class="container">
        <label for="uname"><b>Username</b></label>
        <label for="userName"></label><input id = "userName" type="text" placeholder="Enter Username" name="uname" required>
        <label for="psw"><b>Password</b></label>
        <label for="password"></label><input id = "password" type="password" placeholder="Enter Password" name="psw" required>
        <button name = "submit" type="submit">Login</button>
    </div>
</form>
<?php
include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
?>
</body>
<footer>
    <div class="container">
        <span class="psw"><p>Registra un<a href="register.php"> nuovo account</a>.</p>
        </span>
    </div>
</footer>
</html>