<?php
function login(){
    $username = $_GET["username"];
    $password = $_GET["password"];

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
        echo("<p>RISULTATO DELL' ACCESSO: " . $res . "</p>");
        exit;
    } catch (PDOException $e) {
        echo ($e);
    }
}
?>