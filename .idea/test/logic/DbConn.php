<?php
class DbConn {
    private static $pdo;

    private function __construct(){}

    public static function getInstance()
    {
        if(self::$pdo == null)
        {
            try {
                self::$pdo = new PDO('mysql:host=localhost;dbname=confvirtual;charset=utf8','root','root');
                self::$pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                return self::$pdo;
            } catch (PDOException $e) {
                echo("<h1>ACCESSO FALLITO</h1> <br>");
                echo($e);
            }
        }
        return self::$pdo;
    }

    public function close(){
        self::$pdo = null;
    }
}
