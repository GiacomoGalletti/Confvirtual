<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Conference.php");

class DbConference
{
    static function getConference($acronimo, $anno_edizione): Conference
    {
        $sql = 'CALL ritornaConferenza(\'' . $acronimo . '\', \'' . $anno_edizione . '\');';
        $res = DbConn::getInstance() -> query($sql);
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

    static function createConference($nome, $acronimo, $immagine, $date): bool
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
                echo '<link rel="stylesheet" href="/css/style.css">
                  <div class="container"> </div>
                  <h1>Le date devono essere dello stesso anno</h1> 
                  </div> <div class="container" </div>';
                return false;
            }

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
            header("refresh:3;url= " . "/pages/admin/createconference.php");
            echo '<link rel="stylesheet" href="/css/style.css">
              <div class="container"> </div>
              <h1>Conferenza Inserita</h1> 
              </div> <div class="container" </div>';
            return true;
        } catch (PDOException $e) {
          return false;
        }

    }
}

