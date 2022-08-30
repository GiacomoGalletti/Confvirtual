<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Logger.php");

class DbPresentazionePresenterSpeaker
{

    public static function associateSpeaker($username, $codice_presentazione, $codice_sessione) :bool
    {
        try
        {
            $sql = 'CALL associateSpeaker(\'' . $username . '\',\'' . $codice_presentazione  . '\',\'' . $codice_sessione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $res -> closeCursor();

            Logger::getInstance()->writeMongo(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));

            return true;
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function associatePresenter($username, $codice_presentazione, $codice_sessione) : bool
    {
        try
        {
            $sql = 'CALL associatePresenter(\'' . $username . '\',\'' . $codice_presentazione  . '\',\'' . $codice_sessione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $res -> closeCursor();

            Logger::getInstance()->writeMongo(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));

            return true;
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function addAuthorAndAssociatePresenter($username, $codice_presentazione, $codice_sessione)
    {
        try
        {
            $sql = 'CALL addAuthorAndAssociatePresenter(\'' . $username . '\',\'' . $codice_presentazione  . '\',\'' . $codice_sessione . '\');';
            $res = DbConn::getInstance()->query($sql);

            if (!isset($res->fetch(PDO::FETCH_ASSOC)['risultato'])) {
                $res -> closeCursor();

                Logger::getInstance()->writeMongo(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));

                return true;
            }
            $res -> closeCursor();
            return false;
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }
}