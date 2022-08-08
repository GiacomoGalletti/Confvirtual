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

    public static function getArticlesListUncovered(){
        return DbPresentation::uncoveredArticlesList();
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

    public static function updatePresentation($tipologia,$codice_presentazione, $codice_sessione,$titolo,$filePDF,$numero_pagine,$abstract): bool
    {
        return DbPresentation::modificaPresentazione($tipologia,$codice_presentazione, $codice_sessione,$titolo,$filePDF,$numero_pagine,$abstract);
    }

    public static function getMediaValutazioniPresentazione($codice_sessione, $codice_presentazione){
        return DbPresentation::mediaValutazioniPresentazione($codice_sessione, $codice_presentazione);
    }

    public static function checkCoveredPresentation($codicePresentazione, $codiceSessione, $tipo): ?bool
    {
        return DbPresentation::checkCoveredPresentation($codicePresentazione, $codiceSessione, $tipo);
    }

    public static function addAuthor($codicePresentazione,$codiceSessione,$nome, $cognome) :bool
    {
        return DbPresentation::addAuthor($codicePresentazione,$codiceSessione,$nome, $cognome);
    }

    public static function addKeyWord($codicePresentazione,$codiceSessione,$word): bool
    {
        return DbPresentation::addKeyWord($codicePresentazione,$codiceSessione,$word);
    }

    public static function getKeyWord($codicePresentazione,$codiceSessione)
    {
        return DbPresentation::getKeyWord($codicePresentazione,$codiceSessione);
    }

    public static function getAuthors($codicePresentazione,$codiceSessione)
    {
        return DbPresentation::getAuthors($codicePresentazione,$codiceSessione);
    }

    public static function deleteKeyWords($codicePresentazione,$codiceSessione)
    {
        return DbPresentation::deleteKeyWords($codicePresentazione,$codiceSessione);
    }

    public static function deleteAuthors($codicePresentazione,$codiceSessione)
    {
        return DbPresentation::deleteAuthors($codicePresentazione,$codiceSessione);
    }

    public static function getInfoValutazioni($codice_sessione, $codice_presentazione){
        return DbPresentation::getInfoValutazioni($codice_sessione, $codice_presentazione);
    }
}