<?php
include_once('DbPresentation.php');

class PresentationQueryController
{

    public static function getPresentations($codice_sessione)
    {
        return DbPresentation::getPresentetionsOfSession($codice_sessione);
    }
}