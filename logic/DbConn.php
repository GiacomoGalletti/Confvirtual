<?php
class DbConn {
    private static $PDO;
    private static $currentDbConn = null;

    private function __construct($PDO){
        self::setPDO($PDO);
        self::$PDO -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance():PDO
    {
        try {

            if(self::$currentDbConn == null)
            {
                self::$currentDbConn = new DbConn(new PDO('mysql:host=127.0.0.1;dbname=confvirtual;charset=utf8','root','radice'));

            }
            return self::$currentDbConn::getPDO();
        } catch (PDOException $exception){
            header('Location: /templates/Error500.php');
            self::close();
            exit();
        }

    }

    private static function getPDO(){
        return  self::$PDO;
    }

    public static function close(){
        self::$currentDbConn = null;
        self::$PDO = null;
    }

    private static function setPDO($PDO): void
    {
        self::$PDO = $PDO;
    }

}
