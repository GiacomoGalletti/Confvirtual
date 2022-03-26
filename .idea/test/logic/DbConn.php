<?php
function connect(){
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=confvirtual;charset=utf8','root','root');
        $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo("<h1>ACCESSO FALLITO</h1> <br>");
        echo ($e);
    }
}