<?php
include_once('DbPresentation.php');

class PresentationQueryController
{

    public static function getPresentations($codice_sessione)
    {
        return DbPresentation::getPresentationsOfSession($codice_sessione);
    }

    public static function createPresentation($codice_sessione, $orainizio, $orafine)
    {
        return DbPresentation::createPresentation($codice_sessione, $orainizio, $orafine);
    }


}