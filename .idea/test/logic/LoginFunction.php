<?php
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
            echo ("credenziali errate");
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