<?php
include_once ('DbConn.php');
include_once ('Session.php');

function login()
{
        $username = $_POST["uname"];
        $password = $_POST["psw"];
        try
        {
            $sql = 'CALL checkUserExists(\'' . $username . '\',\'' . $password . '\');';
            $res = DbConn::getInstance()::getPDO() -> query($sql);
            while ($row = $res->fetch())
            {
                Session::write('userName',$row['userName']);
                $res -> closeCursor();
                $sql = 'CALL checkUserType(\'' . $username . '\');';
                $res = DbConn::getInstance()::getPDO() -> query($sql);
                while ($row = $res -> fetch())
                {
                    Session::write('type',$row['res_type']);
                    $res -> closeCursor();
                    $type = Session::read('type');
                    Session::write('loggedIN','loggedIN');
                    if ($type == 'utente' || $type == 'presenter' || $type == 'speaker') {
                       //header("Location: ../pages/UserMainPage.php");
                    } else {
                        header("Location: ../pages/AdminMainPage.php");
                    }
                    exit();
                }
            }
            header("refresh:2;url= " . "../pages/LoginPage.php");
            echo '<link rel="stylesheet" href="../css/style.css">
              <h1>credenziali errate</h1>
              <img src="https://dm0qx8t0i9gc9.cloudfront.net/watermarks/image/rDtN98Qoishumwih/graphicstock-exhausted-and-tired-office-worker-in-the-office-to-much-work-and-no-motivation-place-your-own-text-on-the-notes_HOrinLsGog_SB_PM.jpg" alt="wrong credential imag" class="avatar">';

            exit();
        } catch (PDOException $e)
        {
            echo($e);
        }

}
function userExists()
{
    if(isset($_POST['submit']))
    {
        $username = $_POST["userName"];
        $password = md5($_POST["psw"]);
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
}
?>