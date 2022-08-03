<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Presentation.php");

class DbStats
{
    public static function contaConferenzeRegistrate()

    {
        try {
            $sql = 'CALL contaConferenzeRegistrate();';
            $res = DbConn::getInstance()->query($sql);

            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output;
            } else
            {
                echo '<pre>

                <p>nessuna conferenza resgistrata.</p>

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

    public static function contaConferenzeAttive()

    {
        try {
            $sql = 'CALL contaConferenzeAttive();';
            $res = DbConn::getInstance()->query($sql);

            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output;
            } else
            {
                echo '<pre>

                <p>nessuna conferenza attiva.</p>

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

    public static function contaUtentiTotali()

    {
        try {
            $sql = 'CALL contaUtentiTotali();';
            $res = DbConn::getInstance()->query($sql);

            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if  (sizeof($output) > 0)
            {
                return $output;
            } else
            {
                echo '<pre>

                <p>nessun utente registrato.</p>

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

    public static function getRankingSpeaker()
    {
        try {
            $sql = 'CALL classificaSpeaker()';
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

    public static function getRankingPresenter()
    {
        try {
            $sql = 'CALL classificaPresenter()';
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
}

