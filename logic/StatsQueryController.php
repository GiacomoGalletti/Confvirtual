
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

    public static function getRankingSpeaker()
    {
        return DbStats::getRankingSpeaker();
    }

    public static function getRankingPresenter()
    {
        return DbStats::getRankingPresenter();
    }

}


