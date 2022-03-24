<?php
function login(){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=confvirtual;charset=utf8','root','root');
        $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = 'CALL login(\'o chiatt\',\'bellaNapoli32\');';
        //$sql = 'CALL login(\'giggi\',\'bellaNapoli32\');';

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
login();
?>