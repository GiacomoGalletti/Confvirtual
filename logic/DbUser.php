<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");

class DbUser
{
    static function UsersList()
    {
        try{
            $sql = 'CALL ritornaUtenti();';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    static function promotionToSpeaker($username): bool
    {
        try {
            $sql = 'CALL promuoviUtenteASpeaker(\'' . $username . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();
            return true;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    static function promotionToPresenter($username): bool
    {
        try {
            $sql = 'CALL promuoviUtenteAPresenter(\'' . $username . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();
            return true;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function PresenterList()
    {
        try {
            $sql = 'CALL ritornaPresenter();';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function SpeakerList()
    {
        try {
            $sql = 'CALL ritornaSpeaker();';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }
}
