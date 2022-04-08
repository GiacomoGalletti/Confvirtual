<?php
class DbConn {
    private static $pdo;
    private static $currentDbConn = null;

    private function __construct($pdo){
        self::$pdo = $pdo;
        self::$pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if(self::$currentDbConn == null)
        {
            try {
                self::$currentDbConn = new DbConn(new PDO('mysql:host=localhost;dbname=confvirtual;charset=utf8','root','root'));
                return self::$currentDbConn;
            } catch (PDOException $e) {
                echo("<h1>ACCESSO FALLITO</h1> <br>");
                echo($e);
            }
        }
        return self::$currentDbConn;
    }

    public static function getPDO(){
        return  self::$pdo;
    }
    public function close(){
        self::$pdo = null;
    }
}
