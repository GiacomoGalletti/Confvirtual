<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Sessione.php");

class DbSessione
{
    // TODO: sistemare con quello che sara la stored per le sessioni di una conferenza
    static function getSessione($codice): ?Sessione
    {
        $sql = 'CALL ritornaSessione(\'' . $codice . '\');';
        $res = DbConn::getInstance() -> query($sql);
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
        if (!empty($codice) && !empty($ora_inizio) && !empty($ora_fine) && !empty($titolo) && !empty($link_stanza) && !empty($numero_presentazioni) && !empty($giorno_data) && !empty($anno_edizione) && !empty($acronimo_conferenza)) {
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
        return  null;
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
            $date = DateTime::createFromFormat("d-m-Y", $giorno_data)->format("Y-m-d");
            $sql = 'CALL createSession(
                \'' . $ora_inizio . '\',
                \'' . $ora_fine . '\',
                \'' . $titolo . '\',
                \'' . $link_stanza . '\',
                \'' . $date . '\',
                \'' . $anno_edizione . '\',
                \'' . $acronimo_conferenza . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();
            return true;
        } catch (PDOException $e) {
            echo '<h1> ERRORE CREAZIONE SESSIONE CONFERENZA </h1> <p2>';
            echo '<br> <b>Stack ERROR:</b> <br>' . $e;
            echo '</p2>';
            echo'<p1>';
            echo '<br> <b>PROVATO AD ESEGUIRE:</b> <br>' . $sql;
            echo '</p1>';
            return false;
        }
    }

    static function getSessionsFromConfrernce($acronimo,$annoEdizione)
    {
        try
        {
            $sql = 'CALL getSessionsFromConfrernce( \'' . $acronimo . '\',\'' . $annoEdizione . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output;
            } else
            {
                echo '<pre>
    
                <p>nessuna sessione creata per la conferenza selezionata.</p>
    
                </pre>';
                return null;
            }
        } catch (PDOException $e) {
            echo '<h1> ERRORE RECUPERO INFO SESSIONE CONFERENZA </h1> <p2>';
            echo '<br> <b>Stack ERROR:</b> <br>' . $e;
            echo '</p2>';
            echo'<p1>';
            echo '<br> <b>PROVATO AD ESEGUIRE:</b> <br>' . $sql;
            echo '</p1>';
            return false;
        }
    }
}

