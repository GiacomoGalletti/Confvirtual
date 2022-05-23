<?php

$arrayhours= [

    DateTime::createFromFormat("H:i:s", '09:00:00')->format("H:i"),
    DateTime::createFromFormat("H:i:s", '10:00:00')->format("H:i"),
    DateTime::createFromFormat("H:i:s", '14:00:00')->format("H:i"),
    DateTime::createFromFormat("H:i:s", '19:00:00')->format("H:i"),


];
function hourAviable($start_time,$end_time,$arrayhours)
{
    $arrayBool = [
        '8' => 0,
        '9' => 0,
        '10' => 0,
        '11' => 0,
        '12' => 0,
        '13' => 0,
        '14' => 0,
        '15' => 0,
        '16' => 0,
        '17' => 0,
        '18' => 0,
        '19' => 0,
        '20' => 0,
        '21' => 0,
        '22' => 0
    ];
    $start_time = (int) date('H:i',strtotime($start_time));
    $end_time = (int) date('H:i', strtotime($end_time));
    for ($i=0; $i<count($arrayhours); $i=$i+2) {
        $array_end = (int)$arrayhours[$i+1];
        $array_start = (int)$arrayhours[$i];
        for($index=$array_start; $index<$array_end; $index++){
            $arrayBool[(string)$index] = 1;
        }
    }


    for ($i=$start_time; $i<$end_time; $i++) {
        if ($arrayBool[(string)$i] == 1) {
            return false;
        }
    }
    return true;
}

 echo hourAviable(
    DateTime::createFromFormat("H:i", '19:00')->format("H:i"),
    DateTime::createFromFormat("H:i", '23:00')->format("H:i"),
    $arrayhours)? 'true':'false';
