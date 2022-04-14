<?php
include_once ('DbConn.php');
include_once ('Session.php');


function login($username, $password)
{
        Session::start();
        try
        {
            if (userExists($username, $password))
            {
                Session::write('userName',$username);
                $sql = 'CALL checkUserType(\'' . $username . '\');';
                $res = DbConn::getInstance()::getPDO() -> query($sql);
                while ($row = $res -> fetch())
                {
                    Session::write('type',$row['res_type']);
                    $res -> closeCursor();
                    $type = Session::read('type');
                    Session::write('loggedIN','loggedIN');
                    Session::commit();
                    header("Location: /.idea/surce/index.php");
                    exit();
                }
            }
            header("Location: /.idea/surce/pages/LoginPage.php");
            include $_SERVER["DOCUMENT_ROOT"] . '/.idea/surce/templates/incorrectcredentials.html';

            exit();
        } catch (PDOException $e)
        {
            echo($e);
        }

}
function userExists($username, $password)
{   
    try
    {
        $sql = 'CALL checkUserExists(\'' . $username . '\',\'' . $password . '\');';
        $res = DbConn::getInstance()::getPDO() -> query($sql);
        while ($row = $res->fetch())
        {
            $res -> closeCursor();
            return true;
        }
        $res -> closeCursor();
        return false;
    } catch (PDOException $e)
    {
        echo($e);
    }
}
?>