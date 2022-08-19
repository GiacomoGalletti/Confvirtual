<?php
class Logger {
    private static $instance;
    private $managerMongoDB;

    private function __construct() {}

    public static function getInstance(): Logger
    {
        if (!self::$instance) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }

    function writeMongo($nome_utente,$query,$data,$orario): bool
    {
        if (empty($this->managerMongoDB)) {
            $this->managerMongoDB = new MongoDB\Driver\Manager();
        }
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $bulk = new MongoDB\Driver\BulkWrite();

        $log = [
            'utente' => $nome_utente,
            'operazione' => $query,
            'data' => $data,
            'ora' => $orario
        ];

        $bulk->insert($log);
        try {
            $result = $this->managerMongoDB->executeBulkWrite('logger.confvirtual_logs', $bulk, $writeConcern);
        } catch (MongoDB\Driver\Exception\BulkWriteException|MongoDB\Driver\Exception\Exception $e) {
            echo $e;
        }
        return $result->getInsertedCount() > 0;
    }
}