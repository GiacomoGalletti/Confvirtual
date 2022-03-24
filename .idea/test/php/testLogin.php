<?php
function login(){
    /**
     * metodo test per il login
     */
    $pdo = new PDO('mysql:host=localhost;dbname=confvirtual;charset=utf8','root','root');
    $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'CALL login(\'a\',\'b\');';

    $res = $pdo -> exec($sql);

    if ($res == 0){
        $res = "credenziali errate";
    } else {
        $res = "benvenuto";
    }
    echo("RISULTATO DELL' ACCESSO: " . $res);
    exit;
}
?>