
<?php
include_once('DbStats.php');

class StatsQueryController
{

    public static function getContaConferenzeRegistrate()
    {
        return DbStats::contaConferenzeRegistrate();
    }


    public static function getContaConferenzeAttive()
    {
        return DbStats::contaConferenzeAttive();
    }


    public static function getContaUtentiTotali()
    {
        return DbStats::contaUtentiTotali();
    }





}


