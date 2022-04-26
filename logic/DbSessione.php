<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Sessione.php");

class DbSessione
{
    // TODO: sistemare con quello che sara la stored per le sessioni di una conferenza
    static function getSessione($codice): Sessione
    {
        $sql = 'CALL ritornaSessione(\'' . $codice . '\');';
        $res = DbConn::getInstance()::getPDO() -> query($sql);
        foreach ($res -> fetch() as $key) {
            $codice = $key[0];
            $ora_inizio = $key[1];
            $ora_fine = $key[2];
            $titolo = $key[3];
            $link_stanza = $key[4];
            $numero_presentazioni = $key[5];
            $giorno_data = $key[6];
            $anno_edizione = $key[7];
            $acronimo_conferenza = $key[8];
        }
        $res -> closeCursor();
        return new Sessione(
            $codice,
            $ora_inizio,
            $ora_fine,
            $titolo,
            $link_stanza,
            $numero_presentazioni,
            $giorno_data,
            $anno_edizione,
            $acronimo_conferenza
        );
    }

    static function createSessione(
        $ora_inizio,
        $ora_fine,
        $titolo,
        $link_stanza,
        $giorno_data,
        $anno_edizione,
        $acronimo_conferenza
    ) : bool
    {
        try
        {
            $date = DateTime::createFromFormat("d-m-Y", $giorno_data);
            $date = $date->format("Y-m-d");
            $sql = 'CALL createSession(
                \'' . $ora_inizio . '\',
                \'' . $ora_fine . '\',
                \'' . $titolo . '\',
                \'' . $link_stanza . '\',
                \'' . $date . '\',
                \'' . $anno_edizione . '\',
                \'' . $acronimo_conferenza . '\');';
            $res = DbConn::getInstance()::getPDO() -> query($sql);
            $res -> closeCursor();
            return true;
        } catch (PDOException $e) {
            echo ($e);
            return false;
        }
    }

    static function getSessionsFromConfrernce($acronimo,$annoEdizione)
    {
        $sql = 'CALL getSessionsFromConfrernce( \'' . $acronimo . '\',\'' . $annoEdizione . '\');';
        $res = DbConn::getInstance()::getPDO() -> query($sql);
        $output = $res -> fetchAll(PDO::FETCH_ASSOC);
        $res -> closeCursor();
        if  (sizeof($output) > 0)
        {
            return $output;
        } else
        {
            return null;
        }

    }
}

