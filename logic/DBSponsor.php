<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Logger.php");

class DBSponsor
{
    public static function getAllSponsor()
    {
        try {
            $sql = 'SELECT * FROM SPONSOR';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output;
            } else
            {
                echo '<pre>
    
                <p>nessuno sponsor attivo.</p>
    
                </pre>';
                return null;
            }
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function calculateTotalSponsorization($nome): ?int
    {
        try {
            $sql = "SELECT sum(importo) as tot_importo FROM SPONSORIZZAZIONI,SPONSOR WHERE SPONSORIZZAZIONI.nomeSponsor = SPONSOR.nome AND SPONSOR.nome = ". "'" . $nome . "'";
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output[0]['tot_importo'];
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function createSponsor($nome_sponsor, $logo_sponsor): bool
    {
        try
        {
            $sql = 'CALL creaSponsor(
                \'' . $nome_sponsor . '\',
                \'' . $logo_sponsor . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();

            Logger::getInstance()->writeMongo(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));

            return true;
        } catch (PDOException $e) {
            echo '<h1> ERRORE CREAZIONE SPONSOR </h1> <p2>';
            echo '<br> <b>Stack ERROR:</b> <br>' . $e;
            echo '</p2>';
            echo'<p1>';
            echo '<br> <b>PROVATO AD ESEGUIRE:</b> <br>' . $sql;
            echo '</p1>';
            return false;
        }
    }

    public static function createSponsorization($importo, $int, $int1, $nome_sponsor): bool
    {
        try
        {
            $sql = 'CALL creaSponsorizzazione(
                \'' . $importo . '\',
                \'' . $int . '\',
                \'' . $int1 . '\',
                \'' . $nome_sponsor . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();

            Logger::getInstance()->writeMongo(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));

            return true;
        } catch (PDOException $e) {
            echo '<h1> ERRORE CREAZIONE SPONSOR </h1> <p2>';
            echo '<br> <b>Stack ERROR:</b> <br>' . $e;
            echo '</p2>';
            echo'<p1>';
            echo '<br> <b>PROVATO AD ESEGUIRE:</b> <br>' . $sql;
            echo '</p1>';
            return false;
        }

    }

    public static function deleteSponsor($name)
    {
        try
        {
            $sql = 'CALL eliminaSponsor(
                \'' . $name . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();

            Logger::getInstance()->writeMongo(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));

            return true;
        } catch (PDOException $e) {
            echo '<h1> ERRORE CREAZIONE SPONSOR </h1> <p2>';
            echo '<br> <b>Stack ERROR:</b> <br>' . $e;
            echo '</p2>';
            echo'<p1>';
            echo '<br> <b>PROVATO AD ESEGUIRE:</b> <br>' . $sql;
            echo '</p1>';
            return false;
        }

    }

    public static function getSponsorImg($nomeSponsor)
    {
        try {
            $sql = 'SELECT immagineLogo as immagine FROM SPONSOR WHERE SPONSOR.nome =' . '\'' . $nomeSponsor . '\'';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output[0];
            } else
            {
                return null;
            }
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function getAllSponsorizations()
    {
        try {
            $sql = 'SELECT * FROM SPONSORIZZAZIONI';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output;
            } else
            {
                echo '<pre>
    
                <p>nessuna sponsorizzazione.</p>
    
                </pre>';
                return null;
            }
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function deleteSponsorization($nomeSponsor, $acronimoConferenza, $annoEdizioneConferenza)
    {
        try
        {
            $sql = 'DELETE FROM SPONSORIZZAZIONI WHERE nomeSponsor ='.'\''.$nomeSponsor.'\'' . ' AND acronimoConferenza =' . '\'' . $acronimoConferenza . '\''. ' AND annoEdizioneConferenza =' . '\'' . $annoEdizioneConferenza . '\'';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();

            Logger::getInstance()->writeMongo(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));

            return true;
        } catch (PDOException $e) {
            echo '<h1> ERRORE CREAZIONE SPONSOR </h1> <p2>';
            echo '<br> <b>Stack ERROR:</b> <br>' . $e;
            echo '</p2>';
            echo'<p1>';
            echo '<br> <b>PROVATO AD ESEGUIRE:</b> <br>' . $sql;
            echo '</p1>';
            return false;
        }
    }
}

