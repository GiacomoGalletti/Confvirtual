<?php
include_once('../logic/DbConn.php');
include_once('Conference.php');

// TODO: le conferenze future e passate devono essere selezionate tramite lo stato della conferenza e non la data

class DbConference
{

    static function getConference($acronimo, $anno_edizione) {
        $sql = 'CALL ritornaConferenza(\'' . $acronimo . '\', \'' . $anno_edizione . '\');';
        $res = DbConn::getInstance()::getPDO() -> query($sql);
        foreach ($res -> fetch() as $key) {
            $anno_edizione = $key[0];
            $acronimo = $key[1];
            $tot_sponsorizzazioni = $key[2];
            $immagine_logo = $key[3];
            $stato_svolgimento = $key[4];
            $nome = $key[5];
        }
        $res -> closeCursor();
        return new Conference($anno_edizione, $acronimo, $tot_sponsorizzazioni, $immagine_logo, $stato_svolgimento, $nome);
    }

    static function conferenceActive()
    {
        $sql = 'CALL ritornaConferenzeFuture();';
        $res = DbConn::getInstance()::getPDO() -> query($sql);
        $output = $res -> fetchAll(PDO::FETCH_ASSOC);
        $res -> closeCursor();
        return $output;
    }

    static function conferenceClosed()
    {
        $sql = 'CALL ritornaConferenzePassate();';
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

?>