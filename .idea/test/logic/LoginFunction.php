<?php
include('init.php');
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
            header("Location: ../pages/LoginPage.html");
        } else {
            /*
             * TODO: settare le variabili di sessione
             */
            header("Location: ../pages/UserMainPage.php");
        }

        exit();
    } catch (PDOException $e) {
        echo ($e);
    }
}
?>