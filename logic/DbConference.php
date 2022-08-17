<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Logger.php");

class DbConference
{
    static function conferenceActive()
    {
        $sql = 'CALL ritornaConferenzeFuture();';
        $res = DbConn::getInstance() -> query($sql);
        $output = $res -> fetchAll(PDO::FETCH_ASSOC);
        $res -> closeCursor();
        return $output;
    }

    static function conferenceClosed()
    {
        $sql = 'CALL ritornaConferenzePassate();';
        $res = DbConn::getInstance() -> query($sql);
        $output = $res -> fetchAll(PDO::FETCH_ASSOC);
        $res -> closeCursor();
        return $output;
    }

    static function daysConference($acronimoConferenza,$annoEdizione)
    {
        if (isset($acronimoConferenza) && isset($annoEdizione)) {
            $sql = 'CALL ritornaGiorniConferenza(\'' . $acronimoConferenza . '\',\'' . $annoEdizione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res->fetchAll(PDO::FETCH_ASSOC);
            $res->closeCursor();
            return $output;
        }else {
            return null;
        }
    }

    static function getAdminConferences($nomeUtente)
    {
        $sql = 'CALL getAdminConferences(\'' . $nomeUtente . '\');';
        $res = DbConn::getInstance()->query($sql);
        $output = $res -> fetchAll(PDO::FETCH_ASSOC);
        $res -> closeCursor();
        return $output;
    }

    static function createConference($nome, $acronimo, $immagine, $date): ?bool
    {
        try{
            $arrayDate = explode(",",$date);
            $arrayYears = array();
            foreach ($arrayDate as $a) {
                $date = DateTime::createFromFormat("Y-m-d", $a);
                $arrayYears[] = $date->format("Y");
            }
            if(count(array_unique($arrayYears)) !== 1) {
                header("refresh:3;url= " . "/pages/admin/createconference.php");
                echo '<link rel="stylesheet" href="/style/css/style.css">
                  <div class="container"> </div>
                  <h1>Le date devono essere dello stesso anno</h1> 
                  </div> <div class="container" </div>';
                return false;
            }
            $sql='no query';
            $sql = 'CALL createConference(\''.$arrayYears[0].'\',\''.$acronimo.'\',\''.$immagine.'\',\''. $nome .'\',\''.Session::read('userName').'\');';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();
            foreach ($arrayDate as $a)
            {
                $date = DateTime::createFromFormat("Y-m-d", $a);
                $sql = 'CALL aggiungiData(\'' . $date->format("Y-m-d") . '\',\'' . $date->format("Y") . '\',\''. $acronimo . '\')';
                $res = DbConn::getInstance() -> query($sql);
                $res -> closeCursor();
            }

            Logger::putLog(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));

            header("refresh:3;url= " . "/pages/admin/createconference.php");
            echo '<link rel="stylesheet" href="/style/css/style.css">
              <div class="container"> </div>
              <h1>Conferenza Inserita</h1> 
              </div> <div class="container" </div>';
            return true;
        } catch (PDOException|ExpiredSessionException|Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }

    }

    static function createRating($codicePresentazione, $codiceSessione, $voto, $note): bool
    {
        Session::start();
        try{
            $sql='no query';
            $sql = 'CALL insertRating(\''.Session::read('userName').'\',\''.$codicePresentazione.'\',\''.$codiceSessione.'\',\''. $voto .'\',\''.$note.'\');';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();
            header("Location: /pages/admin/addrate.php");
            echo '<link rel="stylesheet" href="/style/css/style.css">
          <div class="container"> </div>
          <h4>Valutazione Inserita</h4> 
          ';
            Logger::putLog(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));
            return true;
        } catch (PDOException|ExpiredSessionException|Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function subscribeToConference($annoEdizione,$acronimoConferenza): bool
    {
        try {
            $sql='no query';
            $sql = 'CALL iscriviUtente(\''.Session::read('userName').'\',\''.$annoEdizione.'\',\''.$acronimoConferenza.'\')';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();
            Logger::putLog(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));
            return true;
        } catch (PDOException|ExpiredSessionException|Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function checkSubcription($annoEdizione,$acronimoConferenza): ?bool
    {
        Session::start();
        try {
            $sql='no query';
            $sql = 'CALL verificaIscrizione(\''.Session::read('userName').'\',\''.$acronimoConferenza.'\',\''.$annoEdizione.'\')';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res->fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if (sizeof($output) > 0) {
                return true;
            } else {
                return false;
            }

        } catch (PDOException|ExpiredSessionException|Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql . '</b></p>';
            echo $e;
            return null;
        }
    }

    public static function getConferenceSubscribed()
    {
        try {
            $sql='no query';
            $sql = 'CALL ritornaIscrizioniConferenze(\'' . Session::read('userName') . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (PDOException|ExpiredSessionException|Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql . '</b></p>';
            echo $e;
            return null;
        }
    }
}

