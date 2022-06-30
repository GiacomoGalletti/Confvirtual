<?php
include_once('DbUser.php');

class UserQueryController
{
    static function getUsersList()
    {
        return DbUser::UsersList();
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

    public static function userExists($userName, $psw): bool
    {
        return DbUser::userExists($userName, $psw);
    }
}