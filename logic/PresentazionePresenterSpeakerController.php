<?php
include_once('DbPresentazionePresenterSpeaker.php');

class PresentazionePresenterSpeakerController
{
    public static function associateSpeaker($username,$codice_presentazione,$codice_sessione): bool
    {
        return DbPresentazionePresenterSpeaker::associateSpeaker($username,$codice_presentazione,$codice_sessione);
    }

    public static function addAuthorAndAssociatePresenter($username,$codice_presentazione,$codice_sessione): bool
    {
        return DbPresentazionePresenterSpeaker::addAuthorAndAssociatePresenter($username,$codice_presentazione,$codice_sessione);
    }
}