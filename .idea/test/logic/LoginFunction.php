<?php
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
            echo ("<p style='color: crimson'>credenziali errate</p>");
            $page = file_get_contents("../pages/LoginPage.php");
            echo ($page);
        } else {
            $page = file_get_contents("../pages/UserMainPage.php");
            echo ($page);
        }

        exit;
    } catch (PDOException $e) {
        echo ($e);
    }
}
?>