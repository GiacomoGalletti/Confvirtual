<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Presentation.php");

class DbPresentation
{
    public static function getPresentationsOfSession($codice_sessione)
    {
        $sql = 'CALL getPresentationInfo(\'' . $codice_sessione . '\');';
        $res = DbConn::getInstance()::getPDO()->query($sql);
        $output = $res -> fetchAll(PDO::FETCH_ASSOC);
        $res -> closeCursor();
        return $output;
    }

    public static function createPresentation($codice_sessione, $orainizio, $orafine)
    {
        try {
            $sql = 'CALL createPresentation(\'' . $codice_sessione . '\',\'' . $orainizio . '\',\'' . $orafine . '\');';
            $res = DbConn::getInstance()::getPDO()->query($sql);
            $res -> closeCursor();
            return true;
        } catch (Exception $e)
        {
            echo $e;
            return false;
        }
    }


}