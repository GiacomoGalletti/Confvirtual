<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Presentation.php");

class DbPresentation
{
    public static function getPresentetionsOfSession($codice_sessione)
    {
        $sql = 'CALL getPresentationInfo(\'' . $codice_sessione . '\');';
        $res = DbConn::getInstance()::getPDO()->query($sql);
        $output = $res -> fetchAll(PDO::FETCH_ASSOC);
        $res -> closeCursor();
        return $output;
    }
}