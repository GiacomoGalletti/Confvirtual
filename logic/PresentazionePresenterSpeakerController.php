<?php
include_once('DbPresentazionePresenterSpeaker.php');

class PresentazionePresenterSpeakerController
{
    public static function associateSpeaker($username,$titolo_tutorial,$codice_presentazione,$codice_sessione)
    {
        return DbPresentazionePresenterSpeaker::associateSpeaker($username,$titolo_tutorial,$codice_presentazione,$codice_sessione);
    }

    public static function addAuthorAndAssociatePresenter($username,$titolo_tutorial,$codice_presentazione,$codice_sessione)
    {
        return DbPresentazionePresenterSpeaker::addAuthorAndAssociatePresenter($username,$titolo_tutorial,$codice_presentazione,$codice_sessione);
    }
}