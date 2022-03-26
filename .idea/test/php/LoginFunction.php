<?php
function login(){

    $username = $_POST["userName"];
    $password = $_POST["password"];

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

        if ($res == "benvenuto ") {
            sleep(4);
            header("Location: https://example.com/myOtherPage.php");
            die();
        } else {
            sleep(4);
            header("Location: https://example.com/myOtherPage.php");
            die();
        }

        exit;
    } catch (PDOException $e) {
        echo ($e);
    }
}
?>