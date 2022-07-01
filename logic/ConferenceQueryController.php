<?php
include_once('DbConference.php');

class ConferenceQueryController
{

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

    static function subscribeToConference($annoEdizione,$acronimoConferenza): bool
    {
        return DbConference::subscribeToConference($annoEdizione,$acronimoConferenza);
    }

    static function checkSubcription($annoEdizione,$acronimoConferenza): ?bool
    {
        return DbConference::checkSubcription($annoEdizione,$acronimoConferenza);
    }

    static function getConferenceSubscribed()
    {
        return DbConference::getConferenceSubscribed();
    }
}