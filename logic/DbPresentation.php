<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Presentation.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Logger.php");

class DbPresentation
{
    public static function getAllPresentationInfo($codice_sessione)
    {
        try {
            $sql = 'CALL getAllPresentationInfo(\'' . $codice_sessione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output;
            } else
            {
                echo '<pre>
                <p>nessuna presentazione creata per la sessione codice: '.$codice_sessione.'</p>   
                </pre>';
                return null;
            }


        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function createPresentation($codice_sessione, $orainizio, $orafine): bool
    {
        try {
            $sql = 'CALL createPresentation(\'' . $codice_sessione . '\',\'' . $orainizio . '\',\'' . $orafine . '\');';
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

    public static function createArticle($codice_sessione, $orainizio, $orafine,$titolo,$filePDF,$numero_pagine): bool
    {
        if (empty($codice_sessione) || empty($titolo)) {
            return false;
        }
        try
        {
            $sql = 'CALL addPresentationArticle(\'' . $codice_sessione . '\',\'' . $orainizio . '\',\'' . $orafine . '\',\'' . $titolo . '\',\'' . $filePDF . '\',\'' . $numero_pagine . '\');';
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

    public static function createTutorial($codice_sessione, $orainizio, $orafine,$titolo,$abstract): bool
    {
        if (empty($codice_sessione) || empty($titolo)) {
            return false;
        }
        try
        {
            $sql = 'CALL addPresentationTutorial(\'' . $codice_sessione . '\',\'' . $orainizio . '\',\'' . $orafine . '\',\'' . $titolo . '\',\'' . $abstract . '\');';
            $res = DbConn::getInstance()->query($sql);
            $res = $res->fetch(PDO::FETCH_ASSOC);
            print_r($res);
            if (!isset($res['validity'])) {
                Logger::getInstance()->writeMongo(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));
                return true;
            } else {
                echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
                return false;
            }
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    /**
     * @param $codice_presentazione
     * @return array|false|null
     *  prende in input il codice della presentazione e seleziona tutte le informazioni da articolo o tutorial in base
     *  al tipo di presentazione a cui appartiene il codice in input
     */
    public static function getPresentationInfo($codice_presentazione)
    {
        try
        {
            $sql = 'CALL getPresentationInfo(\'' . $codice_presentazione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function uncoveredArticlesList()
    {
        try {
            $sql = 'CALL ritornaArticoli();';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output;
            } else
            {
                echo '<pre>

                <p>nessun articolo disponibile.</p>   

                </pre>';
                return null;
            }
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function ritornaTutorialAssegnabile($userName)
    {
        try {
            $sql = 'CALL ritornaTutorialAssegnabile(\'' . $userName . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output;
            } else
            {
                echo '<pre>

                <p>nessun tutorial disponibile.</p>   

                </pre>';
                return null;
            }
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function ordinamentoSequenzePresentazioni($codiceSessione): bool
    {
        try {
            $sql = 'CALL ordinamentoSequenzePresentazioni(\'' . $codiceSessione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $res -> closeCursor();
            return true;
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function eliminaPresentazione($codice_presentazione, $codice_sessione): bool
    {
        try {
            $sql = 'CALL eliminaPresentazione(\'' . $codice_presentazione . '\',\'' . $codice_sessione . '\');';
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

    public static function modificaPresentazione($tipologia,$codice_presentazione, $codice_sessione, $titolo, $filePDF, $numero_pagine, $abstract): bool
    {
        try {
            $sql = 'CALL modificaPresentazione(\'' . $tipologia . '\',\'' . $codice_presentazione . '\',\'' . $codice_sessione  . '\',\'' . $titolo  . '\',\'' . $filePDF  . '\',\'' . $numero_pagine  . '\',\'' .  $abstract . '\');';
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

    public static function mediaValutazioniPresentazione($codice_sessione, $codice_presentazione)
    {
        try {
            $sql = 'CALL ritornaMediaValutazioniPresentazione(\'' . $codice_sessione . '\',\'' .  $codice_presentazione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output;
            } else
            {
                echo '<pre>

                <p>nessuna valutazione disponibile!</p>

                </pre>';
                return null;
            }
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function checkCoveredPresentation($codicePresentazione, $codiceSessione, $tipo) : ?bool
    {
        try {
            //$tipo: articolo tutorial
            $sql = 'CALL controlloCoperturaPresentazioni(\'' . $codicePresentazione . '\',\'' . $codiceSessione . '\',\''  .  $tipo . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if (sizeof($output)>0){
                return true;
            } else {
                return false;
            }
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function addAuthor($codicePresentazione,$codiceSessione,$nome, $cognome) :bool
    {
        try {
            $sql = 'CALL addAuthor(\'' . $codicePresentazione . '\',\'' .$codiceSessione . '\',\'' . $nome . '\',\'' . $cognome . '\');';
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

    public static function addKeyWord($codicePresentazione,$codiceSessione,$word): bool
    {
        try {
            $sql = 'CALL addKeyWord(\'' . $codicePresentazione . '\',\'' . $codiceSessione . '\',\'' . $word . '\');';
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

    public static function getKeyWord($codicePresentazione,$codiceSessione)
    {
        try {
            $sql = 'CALL getKeyWord(\'' . $codicePresentazione . '\',\'' . $codiceSessione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function getAuthors($codicePresentazione,$codiceSessione)
    {
        try {
            $sql = 'CALL getAuthors(\'' . $codicePresentazione . '\',\'' . $codiceSessione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function deleteKeyWords($codicePresentazione, $codiceSessione)
    {
        try {
            $sql = 'CALL deleteKeyWords(\'' . $codicePresentazione . '\',\'' . $codiceSessione . '\');';
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

    public static function deleteAuthors($codicePresentazione, $codiceSessione)
    {
        try {
            $sql = 'CALL deleteAuthors(\'' . $codicePresentazione . '\',\'' . $codiceSessione . '\');';
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

    public static function getInfoValutazioni($codice_sessione, $codice_presentazione)
    {
        try {
            $sql = 'CALL ritornaInfoValutazioni(\'' . $codice_sessione . '\',\'' .  $codice_presentazione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output;
            }
                return null;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function getTutorialResources($codice_sessione, $codice_presentazione)
    {
        try {
            $sql = 'CALL ritornaRisorseTutorial(\'' . $codice_sessione . '\',\'' .  $codice_presentazione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function getTutorialsList($userName)
    {
        try {
            $sql = 'CALL ritornaTutorial(\'' . $userName . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output;
            } else
            {
                echo '<pre>

                <p>nessun tutorial disponibile.</p>   

                </pre>';
                return null;
            }
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function deleteResources($codice_presentazione, $codice_sessione)
    {
        try {
            $sql = 'CALL deleteResources(\'' . $codice_presentazione . '\',\'' . $codice_sessione . '\');';
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

    public static function addResources($codice_presentazione, $codice_sessione, $link, $descrizione)
    {
        try {
            $sql = 'CALL addResources(\'' . $codice_presentazione . '\',\'' .$codice_sessione . '\',\'' . $link . '\',\'' . $descrizione . '\');';
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

    public static function getFavorites($userName,$codice_sessione)
    {
        try {
            $sql = 'CALL ritornaFavoriti(\'' . $userName . '\',\'' . $codice_sessione . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function addFavorite($userName, $codice_sessione, $codice_presentazione)
    {
        try {
            $sql = 'CALL aggiungiFavorito(\'' . $userName . '\',\'' .$codice_sessione . '\',\'' . $codice_presentazione . '\');';
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

    public static function removeFavorite($userName, $codice_sessione, $codice_presentazione)
    {
        try {
            $sql = 'CALL rimuoviFavorito(\'' . $userName . '\',\'' .$codice_sessione . '\',\'' . $codice_presentazione . '\');';
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

    public static function getFavoritesGlobal($userName)
    {
        try {
            $sql = 'CALL ritornaFavoritiGlobale(\'' . $userName . '\');';
            $res = DbConn::getInstance()->query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }


}