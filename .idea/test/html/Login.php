<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Login.css"/>
    <title>Title</title>
</head>
<body>
<?php

while(isset($_POST['login'])){
    login();
}

function login(){
    $username = $_POST["uname"];
    $password = $_POST["psw"];

    try{
        $pdo = new PDO('mysql:host=localhost;dbname=confvirtual;charset=utf8','root','root');
        $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo("ACCESSO FALLITO");
        echo ($e);
    }

    try{
        $sql = 'CALL login(\'' . $username . '\',\'' . $password . '\');';

        $res = $pdo -> query($sql);

        while($row = $res -> fetch()) {
            $user[] = $row['res'];
        }

        if ($user[0] == 0){
            $res = "credenziali errate";
        } else {
            $res = "benvenuto ";
        }
        echo("RISULTATO DELL' ACCESSO: " . $res);
        exit;
    } catch (PDOException $e) {
        echo ($e);
    }
}
?>
<form action="Login.php" method="post" >

    <div class="imgcontainer">
        <img src="confvirtualTitle.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input id = "userName" type="text" placeholder="Enter Username" name="uname" required>

        <label for="psw"><b>Password</b></label>
        <input id = "password" type="password" placeholder="Enter Password" name="psw" required>

        <button name = "login" type="submit">Login</button>

    </div>

    <div class="container" style="background-color:#f1f1f1">
        <button type="button" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
        <span class="psw"><p>Register new accoun <a href="Register.html">here</a>.</p></span>
    </div>
</form>

</body>
</html>