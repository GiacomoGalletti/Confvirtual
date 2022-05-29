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

    public static function getPresentationInfo($codice_presentazione)
    {
        return DbPresentation::getPresentationInfo($codice_presentazione);
    }

    public static function getArticlesList($userName){
        return DbPresentation::articlesList($userName);
    }

    public static function getTutorialsList($userName){
        return DbPresentation::tutorialsList($userName);
    }

    public static function orderPresentation(): bool
    {
        return DbPresentation::ordinamentoSequenzePresentazioni();
    }

    public static function deletePresentation($codice_presentazione, $codice_sessione): bool
    {
        return DbPresentation::eliminaPresentazione($codice_presentazione, $codice_sessione);
    }
}