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

    public static function createPresentation($codice_sessione, $orainizio, $orafine): bool
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

    public static function createArticle($codice_sessione, $orainizio, $orafine,$titolo,$filePDF,$numero_pagine): bool
    {
        try
        {
            $sql = 'CALL addPresentationArticle(\'' . $codice_sessione . '\',\'' . $orainizio . '\',\'' . $orafine . '\',\'' . $titolo . '\',\'' . $filePDF . '\',\'' . $numero_pagine . '\');';
            $res = DbConn::getInstance()::getPDO()->query($sql);
            $res -> closeCursor();
            return true;
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function createTutorial($codice_sessione, $orainizio, $orafine,$titolo,$abstract): bool
    {
        try
        {
            $sql = 'CALL addPresentationTutorial(\'' . $codice_sessione . '\',\'' . $orainizio . '\',\'' . $orafine . '\',\'' . $titolo . '\',\'' . $abstract . '\');';
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