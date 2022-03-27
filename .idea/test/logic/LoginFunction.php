<?php
if(isset($_POST['submit'])){
    login();
}
function login(){

    $username = $_POST["uname"];
    $password = $_POST["psw"]; //TODO: RICORDARSI DI CRIPTARE CON md5()
    include ("DbConn.php");

    $pdo = connect();

    try{
        $sql = 'CALL login(\'' . $username . '\',\'' . $password . '\');';

        $res = $pdo -> query($sql);

        while($row = $res -> fetch()) {
            $user[] = $row['res'];
        }

        if ($user[0] == 0){
//            echo ("<p style='color: crimson'>credenziali errate</p>");
//            $page = file_get_contents("../pages/LoginPage.html");
//            echo ($page);
            header("Location: ../pages/LoginPage.html");
        } else {
//            $page = file_get_contents("../pages/UserMainPage.php");
//            echo ($page);
            header("Location: ../pages/UserMainPage.php");
        }

        exit();
    } catch (PDOException $e) {
        echo ($e);
    }
}
?>