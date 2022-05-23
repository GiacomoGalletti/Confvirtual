<?php

function hourAviable($start_time,$end_time,$arrayhours): bool
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
    if (count($arrayhours) == 0) {
        print 'ESCO SUBITO';
        return true;
    }
    $start_time = (int) date('H',strtotime($start_time));
    $end_time = (int) date('H', strtotime($end_time));
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
