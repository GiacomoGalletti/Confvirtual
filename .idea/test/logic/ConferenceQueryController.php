<?php
include_once ('DbConference.php');

class ConferenceQueryController
{
    static function getConferenceName($acronimo, $anno_edizione)
    {
        return DbConference::getConference($acronimo, $anno_edizione)->getName();
    }

}