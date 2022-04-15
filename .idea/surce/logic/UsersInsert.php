<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . "/.idea/surce/logic/DbConn.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/.idea/surce/logic/UsersQuery.php");

    function registerUser($username, $name, $surname, $password, $luogoNascita, $dataNascita)
    {
        if (!userExists($username, $password))
        {
            try
                {
                    $sql = 'CALL register(\'' . $username . '\',\'' . $name . '\',\'' . $surname . '\',\'' . $password . '\',\'' . $luogoNascita . '\',\'' . $dataNascita . '\');';
                    $res = DbConn::getInstance()::getPDO() -> query($sql);
                    $res -> closeCursor();
                    header("refresh:2;url= " . "../pages/LoginPage.php");
                    ?>
                    <link rel="stylesheet" href="../css/style.css">
                    <div class="container"> </div>
                    <h1>Grazie per la registrazione!</h1> 
                    </div> <div class="container">
                    <img src="https://www.angeliinmoto.it/wp-content/uploads/2020/04/ok-spunta.png" class="avatar"> </div>
                    <?php
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
?>