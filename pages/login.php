<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));

?>
<body>
<form method="post" >
<?php
if(isset($_POST['submit'])) {
     UserQueryController::login($_POST["uname"], $_POST["psw"]);
}
try {
    Session::start();
    if (Session::read('msg_user') != false) {
        echo Session::read('msg_user');
        Session::delete('msg_user');
        Session::commit();
    }
} catch (ExpiredSessionException|Exception $e) {
    echo $e;
}
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