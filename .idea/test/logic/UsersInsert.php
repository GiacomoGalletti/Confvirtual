<?php
function registerUser()
{
    include_once('UsersQuery.php');
    if(isset($_POST['submit']))
    {
        if (!userExists())
        {
            $username = $_POST["userName"];
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $password = $_POST["psw"];
            $luogoNascita = $_POST["luogoNascita"];
            $dataNascita = $_POST["dataNascita"];
            include_once("DbConn.php");

            try
            {
                $sql = 'CALL register(\'' . $username . '\',\'' . $name . '\',\'' . $surname . '\',\'' . $password . '\',\'' . $luogoNascita . '\',\'' . $dataNascita . '\');';
                $res = DbConn::getInstance()::getPDO() -> query($sql);
                header("refresh:2;url= " . "../pages/LoginPage.php");
                echo '<link rel="stylesheet" href="../css/style.css">
              <div class="container"> </div>
              <h1>Grazie per la registrazione!</h1> 
              </div> <div class="container" 
              <img src="https://www.angeliinmoto.it/wp-content/uploads/2020/04/ok-spunta.png" class="avatar"> </div>';
                exit();
            } catch (PDOException $e)
            {
                echo("<h3 style='color: crimson'>PROVATO AD ESEGUIRE </h3>" . "<p>$sql</p>");
                echo($e);
            }
        } else {
            echo '<link rel="stylesheet" href="../css/style.css">
              <div class="container"> </div>
              <h4>Utente già registrato</h4> 
              </div>';
        }
    }
}