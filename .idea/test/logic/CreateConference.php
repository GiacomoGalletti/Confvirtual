<?php

function createConference(){

    $nome = $_POST["name"];
    $acronimo = $_POST["acronimo"];
    $immagine = $_POST["immagine"];
    $date = $_POST["date"];
    include_once ('DbConn.php');

    $arrayDate = explode(",",$date);
    $arrayYears = array();

    foreach ($arrayDate as $a) {
        $date = DateTime::createFromFormat("Y-m-d", $a);
        array_push($arrayYears,$date -> format("Y"));
    }

    if(count(array_unique($arrayYears)) !== 1) {
        header("refresh:3;url= " . "../pages/AdminCreateConference.php");
        echo '<link rel="stylesheet" href="../css/style.css">
              <div class="container"> </div>
              <h1>Le date devono essere dello stesso anno</h1> 
              </div> <div class="container" </div>';
        exit();
    }

    try{
        $sql = 'CALL createConference(\''.$arrayYears[0].'\',\''.$acronimo.'\',\''.$immagine.'\',\''. $nome .'\');';
        $res = DbConn::getInstance()::getPDO() -> query($sql);
        $res -> closeCursor();

    } catch (PDOException $e) {
        echo("<h3 style='color: crimson'>PROVATO AD ESEGUIRE </h3>" . "<p>$sql</p>");
        echo($e);
        exit();
    }

    try {
        foreach ($arrayDate as $a)
        {
            $date = DateTime::createFromFormat("Y-m-d", $a);
            $sql = 'CALL aggiungiData(\'' . $date->format("Y-m-d") . '\',\'' . $date->format("Y") . '\',\''. $acronimo . '\')';
            $res = DbConn::getInstance()::getPDO() -> query($sql);
            $res -> closeCursor();
        }
    } catch (PDOException $e) {
        echo("<h3 style='color: crimson'>PROVATO AD ESEGUIRE </h3>" . "<p>$sql</p>");
        echo($e);
        exit();
    }


    header("refresh:3;url= " . "../pages/AdminCreateConference.php");
    echo '<link rel="stylesheet" href="../css/style.css">
              <div class="container"> </div>
              <h1>Conferenza Inserita</h1> 
              </div> <div class="container" </div>';

}
?>