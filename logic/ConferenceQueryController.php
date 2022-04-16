<?php
include_once('DbConference.php');

class ConferenceQueryController
{
    static function getConferenceName($acronimo, $anno_edizione)
    {
        return DbConference::getConference($acronimo, $anno_edizione)->getName();
    }

    static function getConferenceFuture()
    {
        return DbConference::conferenceActive();
    }

    static function getDaysConference($acronimo,$anno)
    {
        return DbConference::daysConference($acronimo,$anno);
    }

}