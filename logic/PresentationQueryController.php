<?php
include_once('DbPresentation.php');

class PresentationQueryController
{

    public static function getAllPresentationInfo($codice_sessione)
    {
        return DbPresentation::getAllPresentationInfo($codice_sessione);
    }

    public static function createArticle($codice_sessione, $orainizio, $orafine,$titolo,$filePDF,$numero_pagine): bool
    {
        return DbPresentation::createArticle($codice_sessione, $orainizio, $orafine,$titolo,$filePDF,$numero_pagine);
    }

    public static function createTutorial($codice_sessione, $orainizio, $orafine,$titolo,$abstract): bool
    {
        return DbPresentation::createTutorial($codice_sessione, $orainizio, $orafine,$titolo,$abstract);
    }

    public static function getTypePresentation($codice_presentazione)
    {
        return DbPresentation::getTypePresentation($codice_presentazione);
    }

}