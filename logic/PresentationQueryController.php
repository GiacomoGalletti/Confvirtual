<?php
include_once('DbPresentation.php');

class PresentationQueryController
{

    public static function getPresentations($codice_sessione)
    {
        return DbPresentation::getPresentationsOfSession($codice_sessione);
    }

    public static function createArticle($codice_sessione, $orainizio, $orafine,$titolo,$filePDF,$numero_pagine): bool
    {
        return DbPresentation::createArticle($codice_sessione, $orainizio, $orafine,$titolo,$filePDF,$numero_pagine);
    }

    public static function createTutorial($codice_sessione, $orainizio, $orafine,$titolo,$abstract): bool
    {
        return DbPresentation::createTutorial($codice_sessione, $orainizio, $orafine,$titolo,$abstract);
    }

}