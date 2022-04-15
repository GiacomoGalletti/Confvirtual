<!DOCTYPE html>
<html lang="it">
<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . '/.idea/surce/logic/Session.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/.idea/surce/templates/head.html');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/.idea/surce/logic/UsersQuery.php');
Session::start();
?>
<body>
<title>Login</title>
<form method="post" >
<?php
if(isset($_POST['submit'])) {
    login($_POST["uname"], $_POST["psw"]);
}
include_once ($_SERVER["DOCUMENT_ROOT"] . '/.idea/surce/templates/navbar.php');
?>
    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input id = "userName" type="text" placeholder="Enter Username" name="uname" required>
        <label for="psw"><b>Password</b></label>
        <input id = "password" type="password" placeholder="Enter Password" name="psw" required>
        <button name = "submit" type="submit">Login</button>
    </div>
</form>
<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . '/.idea/surce/templates/navbarScriptReference.html');
?>
</body>
<footer>
    <div class="container">
        <span class="psw"><p>Registra un<a href="Register.php"> nuovo account</a>.</p>
        </span>
    </div>
</footer>
</html>