<?php

function printArray($array){
    $out = '';
    for ($i=0; $i<sizeof($array); $i++) {
        $out .= $array[$i] . ' ';
    }
    return $out;
}
?>
