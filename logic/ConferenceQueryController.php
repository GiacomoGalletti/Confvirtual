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

    static function getConferencePast()
    {
        return DbConference::conferenceClosed();
    }

    static function getDaysConference($acronimo,$anno)
    {
        return DbConference::daysConference($acronimo,$anno);
    }

    static function getMyConference($userName)
    {
        return DbConference::getAdminConferences($userName);
    }

    static function createConference($nome, $acronimo, $immagine, $date): bool
    {
        return DbConference::createConference($nome, $acronimo, $immagine, $date);
    }
}