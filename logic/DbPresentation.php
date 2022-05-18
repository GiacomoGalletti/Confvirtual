<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Presentation.php");

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

                <p>nessuna presentazione creata per la sessione selezionata.</p>   

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
        try
        {
            $sql = 'CALL addPresentationArticle(\'' . $codice_sessione . '\',\'' . $orainizio . '\',\'' . $orafine . '\',\'' . $titolo . '\',\'' . $filePDF . '\',\'' . $numero_pagine . '\');';
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

    public static function createTutorial($codice_sessione, $orainizio, $orafine,$titolo,$abstract): bool
    {
        try
        {
            $sql = 'CALL addPresentationTutorial(\'' . $codice_sessione . '\',\'' . $orainizio . '\',\'' . $orafine . '\',\'' . $titolo . '\',\'' . $abstract . '\');';
            $res = DbConn::getInstance()->query($sql);

            if ($res->fetch(PDO::FETCH_ASSOC)['risultato'] != 'ERROR') {
                $res -> closeCursor();
                return true;
            }
            $res -> closeCursor();
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';

            return false;
        } catch (Exception $e)
        {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function getTypePresentation($codice_presentazione)
    {
        try
        {
            $sql = 'CALL getTypePresentation(\'' . $codice_presentazione . '\');';
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

    public static function articlesList($userName)
    {
        try {
            $sql = 'CALL ritornaArticoli(\'' . $userName . '\');';
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

    public static function tutorialsList($userName)
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

}