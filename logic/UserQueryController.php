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

    static function promoteUserToSpeaker($username)
    {
        return DbUser::promotionToSpeaker($username);
    }

    static function promoteUserToPresenter($username)
    {
        return DbUser::promotionToPresenter($username);
    }
}