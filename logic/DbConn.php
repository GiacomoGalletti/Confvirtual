<?php
class DbConn {
    private static $instance;

    private function __construct(){}

    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            self::$instance = new PDO('mysql:host=127.0.0.1;dbname=confvirtual;charset=utf8', 'root', 'radice');
            self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        }
        return self::$instance;
    }
}
