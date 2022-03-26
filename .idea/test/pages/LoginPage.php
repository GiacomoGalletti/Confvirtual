<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../style/Login.css"/>
    <title>Login</title>
</head>
<body>
<?php
    include '../logic/LoginFunction.php';
    if(isset($_POST['submit'])){
        login();
    }
?>
<form action="LoginPage.php" method="post" >

    <div class="imgcontainer">
        <img src="../resources/confvirtualTitle.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input id = "userName" type="text" placeholder="Enter Username" name="uname" required>
        <label for="psw"><b>Password</b></label>
        <input id = "password" type="password" placeholder="Enter Password" name="psw" required>
        <button name = "submit" type="submit">Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <button type="button" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
        <span class="psw"><p>Register new accoun <a href="Register.html">here</a>.</p></span>
    </div>
</form>
</body>
</html>