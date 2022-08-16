<?php
//creo i documenti JSON

class Logger {

    private static $bulk;

    private function __construct() {
        $bulk = new MongoDB\Driver\BulkWrite;
    }

    public static function getInstance() {
        if ( !isset(self::$bulk) ) {
            self::$bulk = new Logger();
        }
        return self::$bulk;
    }

    public function putLog($nome_utente,$query,$data,$orario)
    {
        $log = [
            'utente' => $nome_utente,
            'operazione' => $query,
            'data' => $data,
            'ora' => $orario
        ];
        $bulk = self::getInstance();
        $bulk->insert($log);
        $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
        $manager->executeBulkWrite('logger.confvirtual_logs', $bulk);
    }

}