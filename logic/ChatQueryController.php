<?php
include_once('DbChat.php');

class ChatQueryController
{

    public static function getMessages($codice_sessione)
    {
        return DbChat::getMessagesOfSession($codice_sessione);
    }

    public static function sendMessage($codice_sessione,$testo,$timestamp)
    {
        return DbChat::sendMessage($codice_sessione,$testo,$timestamp);
    }
}