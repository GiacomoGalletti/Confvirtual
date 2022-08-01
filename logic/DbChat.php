<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");

class DbChat {

    public static function getMessagesOfSession($codice_sessione)
    {
        try
        {
            $sql = 'CALL ritornaMessaggi(\'' . $codice_sessione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function sendMessage($codice_sessione,$username_mittente,$testo,$timestamp): bool
    {
        try {
            $sql = 'CALL creaMessaggio(\'' . $codice_sessione . '\',\'' . $username_mittente . '\',\'' . $testo . '\',\'' . $timestamp . '\');';
            $res = DbConn::getInstance()->query($sql);
            $res -> closeCursor();
            return true;
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }
}