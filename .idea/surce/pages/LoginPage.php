<!DOCTYPE html>
<html lang="it">
<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . '/logic/Session.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/templates/head.html');
Session::start();
?>
<body>
<title>Login</title>
<form action="LoginPage.php" method="post" >
<?php
if(isset($_POST['submit'])) {
    include_once ('../logic/UsersQuery.php');
    login();
}
include_once ($_SERVER["DOCUMENT_ROOT"] . '/templates/navbar.php');
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
include_once ($_SERVER["DOCUMENT_ROOT"] . '/templates/navbarScriptReference.html');
?>
</body>
<footer>
    <div class="container">
        <span class="psw"><p>Registra un<a href="Register.php"> nuovo account</a>.</p><a href="https://www.iubenda.com/privacy-policy/39459755" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Privacy Policy ">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
        </span>
    </div>
</footer>
</html>