<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/DbConn.php");
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/debug.php", $_SERVER["DOCUMENT_ROOT"]));
include_once($_SERVER["DOCUMENT_ROOT"] . "/logic/Logger.php");

class DbUser
{
    static function getUsersList()
    {
        try{
            $sql = 'CALL ritornaUtenti();';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    static function nonCreatorAdminList($username, $annoConferenza, $acronimoConferenza)
    {
        try{
            $sql = 'CALL ritornaAmministratoriNonCreatori(\'' . $username . '\',\'' . $annoConferenza . '\',\'' . $acronimoConferenza . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    static function addConferenceCreator($username, $annoConferenza, $acronimoConferenza): bool
    {
        try{
            $sql = 'CALL aggiungiCreatoreConferenza(\'' . $username . '\',\'' . $annoConferenza . '\',\'' . $acronimoConferenza . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();

            Logger::getInstance()->writeMongo(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));

            return true;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    static function promotionToSpeaker($username): bool
    {
        try {
            $sql = 'CALL promuoviUtenteASpeaker(\'' . $username . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();

            Logger::getInstance()->writeMongo(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));
            return true;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    static function promotionToPresenter($username): bool
    {
        try {
            $sql = 'CALL promuoviUtenteAPresenter(\'' . $username . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();

            Logger::getInstance()->writeMongo(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));

            return true;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function PresenterList()
    {
        try {
            $sql = 'CALL ritornaPresenter();';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function SpeakerList()
    {
        try {
            $sql = 'CALL ritornaSpeaker();';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            return $output;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function registerUser($username, $name, $surname, $password, $luogoNascita, $dataNascita): bool
    {
        try {
            $sql = 'CALL register(\'' . $username . '\',\'' . $name . '\',\'' . $surname . '\',\'' . $password . '\',\'' . $luogoNascita . '\',\'' . $dataNascita . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $res -> closeCursor();

            Logger::getInstance()->writeMongo(Session::read('userName'),$sql,date("Y-m-d"),date("h:i:sa"));

            return true;
        } catch (PDOException $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function userExists($username): bool
    {
        try {
            $sql = 'CALL checkUserExists(\'' . $username . '\');';
            $res = DbConn::getInstance()->query($sql);
            if ($res->fetch()) {
                $res->closeCursor();
                return true;
            }
            $res->closeCursor();
            return false;
        }catch (PDOException $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql . '</b></p>';
            echo $e;
            return false;
        }
    }

    public static function login($username, $password): bool
    {
        try {
            Session::start();
            if (DbUser::loginUser($username, $password)) {
                Session::write('userName',$username);
                $sql = 'CALL checkUserType(\'' . $username . '\');';
                $res = DbConn::getInstance() -> query($sql);
                $row = $res -> fetch();
                Session::write('type',$row['res_type']);
                $res -> closeCursor();
                Session::commit();
                header("Location: /index.php");
                return true;
            } else {
                Session::write('msg_user', '
                    <div class="container" style="background-color: red;opacity: 50"> <h4>
                        Utente non registrato.
                    </h4> </div>');
                return false;
            }
        } catch (PDOException|ExpiredSessionException|Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }

    }

    public static function getUserImgProfile($userName,$type)
    {
        try{
            $sql = 'CALL ritornaImmagineProfilo(\''.$userName . '\',\'' . $type .'\');';
            $res = DbConn::getInstance() -> query($sql);
            $output = $res -> fetchAll(PDO::FETCH_ASSOC);
            $res -> closeCursor();
            if (!isset($output)) {
                return null;
            }
            if ($output[0]['foto']===''){
                return null;
            }
            return $output[0]['foto'];
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return null;
        }
    }

    public static function getUserType($userName)
    {
        try {
            $sql = 'CALL checkUserType(\'' . $userName . '\');';
            $res = DbConn::getInstance() -> query($sql);
            $row = $res -> fetch();
            return $row['res_type'];
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function getInfoUser($userName)
    {
        try {
            $sql = 'CALL ritornaInfoUtente(\'' . $userName . '\');';
            $res = DbConn::getInstance() -> query($sql);
            return $res -> fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql .'</b></p>';
            echo $e;
            return false;
        }
    }

    public static function updateUser($nomeUtente, $curriculum, $nomeDipartimento, $nomeUniversita, $filePath): bool
    {
        try {
            $tipo_utente = Session::read('type');
            $sql = 'CALL modificaUtente(\'' . $nomeUtente . '\',\'' . $tipo_utente . '\',\'' . $curriculum . '\',\'' . $nomeDipartimento  . '\',\'' . $nomeUniversita  . '\',\'' . $filePath  . '\');';
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

    private static function loginUser($username, $password)
    {
        try {
            $sql = 'CALL loginUser(\'' . $username . '\',\'' . $password . '\');';
            $res = DbConn::getInstance()->query($sql);
            if ($res->fetch()) {
                $res->closeCursor();
                return true;
            }
            $res->closeCursor();
            return false;
        } catch (Exception $e) {
            echo '<h1>HO PROVATO AD ESEGUIRE:</h1><p><b>' . $sql . '</b></p>';
            echo $e;
            return false;
        }
    }
}
