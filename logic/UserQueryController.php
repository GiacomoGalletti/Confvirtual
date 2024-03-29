<?php
include_once('DbUser.php');

class UserQueryController
{
    static function getUsersList()
    {
        return DbUser::getUsersList();
    }

    static function getNonCreatorAdminList($username, $annoConferenza, $acronimoConferenza)
    {
        return DbUser::nonCreatorAdminList($username, $annoConferenza, $acronimoConferenza);
    }

    static function addConferenceCreator($username, $annoConferenza, $acronimoConferenza)
    {
        return DbUser::addConferenceCreator($username, $annoConferenza, $acronimoConferenza);
    }

    static function getPresenterList()
    {
        return DbUser::PresenterList();
    }

    static function getSpeakerList()
    {
        return DbUser::SpeakerList();
    }

    static function promoteUserToSpeaker($username): bool
    {
        return DbUser::promotionToSpeaker($username);
    }

    static function promoteUserToPresenter($username): bool
    {
        return DbUser::promotionToPresenter($username);
    }

    static function registerUser($username, $name, $surname, $password, $luogoNascita, $dataNascita): bool
    {
        return DbUser::registerUser($username, $name, $surname, $password, $luogoNascita, $dataNascita);
    }

    static function login($username, $password): bool
    {
        return DbUser::login($username, $password);
    }

    static function userExists($userName): bool
    {
        return DbUser::userExists($userName);
    }

    static function getUserImgProfile($userName,$type)
    {
        return DbUser::getUserImgProfile($userName,$type);
    }

    public static function getUserType($userName)
    {
        return DbUser::getUserType($userName);
    }

    public static function getInfoUser($userName)
    {
        return DbUser::getInfoUser($userName);
    }

    public static function updateUser($nomeUtente, $curriculum, $nomeDipartimento, $nomeUniversita, $filePath): bool
    {
        return DbUser::updateUser($nomeUtente, $curriculum, $nomeDipartimento, $nomeUniversita, $filePath);
    }
}