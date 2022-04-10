<?php
include_once ('../logic/DbConn.php');
class ConferenceQueryController
{
    static function conferenceFuture()
    {
        $sql = 'CALL ritornaConferenzeFuture(\'' . date('Y-m-d') . '\');';
        $res = DbConn::getInstance()::getPDO() -> query($sql);
        $output = $res -> fetchAll(PDO::FETCH_ASSOC);
        $res -> closeCursor();
        return $output;
    }

    static function conferencePassed()
    {
        $sql = 'CALL ritornaConferenzePassate(\'' . date('Y-m-d') . '\');';
        $res = DbConn::getInstance()::getPDO() -> query($sql);
        $output = $res -> fetchAll(PDO::FETCH_ASSOC);
        $res -> closeCursor();
        return $output;
    }

    static function daysConference($acronimoConferenza,$annoEdizione)
    {
        if (isset($acronimoConferenza) && isset($annoEdizione)) {
            $sql = 'CALL ritornaGiorniConferenza(\'' . $acronimoConferenza . '\',\'' . $annoEdizione . '\');';
            $res = DbConn::getInstance()::getPDO()->query($sql);
            $output = $res->fetchAll(PDO::FETCH_ASSOC);
            $res->closeCursor();
            return $output;
        }else {
            return null;
        }
    }
}