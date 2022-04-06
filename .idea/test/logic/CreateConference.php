<?php

function createConference(){

    $name = $_POST["name"];
    $acronimo = $_POST["acronimo"];
    $immagine = $_POST["immagine"];
    $date = $_POST["date"];
    include_once ('DbConn.php');

    $arrayDate = explode(",",$date);
    try {
        foreach ($arrayDate as $a)
        {
            $date = DateTime::createFromFormat("d-m-Y", $a);
            $sql = 'CALL aggiungiData(\'' . $date->format("d-m-Y") . '\',\'' . $date->format("Y") . '\',\''. $acronimo . '\')';
            $res = DbConn::getInstance()::getPDO() -> query($sql);
            $res -> closeCursor();
        }
    } catch (PDOException $e) {
        echo("<h3 style='color: crimson'>PROVATO AD ESEGUIRE </h3>" . "<p>$sql</p>");
        echo($e);
        exit();
    }

    try{
        $sql = 'CALL createConference(\''.$date->format("Y").'\',\''.$name.',\''.$acronimo.',\''. $immagine .'\');';
        $res = DbConn::getInstance()::getPDO() -> query($sql);
        $res -> closeCursor();

    } catch (PDOException $e) {
        echo("<h3 style='color: crimson'>PROVATO AD ESEGUIRE </h3>" . "<p>$sql</p>");
        echo($e);
        exit();
    }




    //header("refresh:2;url= " . "../pages/AdminCreateConference.php");
    echo '<link rel="stylesheet" href="../css/style.css">
              <div class="container"> </div>
              <h1>Conferenza Inserita</h1> 
              </div> <div class="container" </div>';

}
?>