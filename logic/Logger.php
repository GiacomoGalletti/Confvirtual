<?php

class Logger {
    private static $instances = [];
    private static $bulk;
    private static $manager;

    private function __construct() {
        self::$bulk = new MongoDB\Driver\BulkWrite;
        self::$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    }

    private static function getInstance()
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }
        return self::$instances[$cls];
    }

    private static function getBulk(): \MongoDB\Driver\BulkWrite
    {
        return self::$bulk;
    }

    private static function getManager(): \MongoDB\Driver\Manager
    {
        return self::$manager;
    }

    public static function putLog($nome_utente,$query,$data,$orario)
    {
        $log = [
            'utente' => $nome_utente,
            'operazione' => $query,
            'data' => $data,
            'ora' => $orario
        ];
        self::getInstance()::getBulk()->insert($log);
        self::getInstance()::getManager()->executeBulkWrite('logger.confvirtual_logs', self::getInstance()::getBulk());
    }



}