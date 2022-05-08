<?php
include_once('DbConn.php');
include_once('Session.php');
function login($username, $password)
{
    Session::start();
    if (userExists($username, $password))
    {
        Session::write('userName',$username);
        $sql = 'CALL checkUserType(\'' . $username . '\');';
        $res = DbConn::getInstance() -> query($sql);
        if ($row = $res -> fetch())
        {
            Session::write('type',$row['res_type']);
            $res -> closeCursor();
            Session::commit();
            header("Location: /index.php");
            exit();
        }
    }
    else
    {
        header("Location: /pages/login.php");
        include sprintf("%s/templates/incorrectcredentials.html", $_SERVER["DOCUMENT_ROOT"]);
    }

}
function userExists($username, $password): bool
{
    $sql = 'CALL checkUserExists(\'' . $username . '\',\'' . $password . '\');';
    $res = DbConn::getInstance() -> query($sql);
    if ($res->fetch())
    {
        $res -> closeCursor();
        return true;
    }
    $res -> closeCursor();
    return false;

}
