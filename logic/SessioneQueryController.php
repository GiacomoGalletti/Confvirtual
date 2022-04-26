<?php
include_once (sprintf("%s/logic/DbSessione.php", $_SERVER["DOCUMENT_ROOT"]));

class SessioneQueryController
{

    static function createSession($ora_inizio, $ora_fine, $titolo, $link_stanza, $giorno_data, $anno_edizione, $acronimo_conferenza) : bool
    {
        return DbSessione::createSessione(
            $ora_inizio,
            $ora_fine,
            $titolo,
            $link_stanza,
            $giorno_data,
            $anno_edizione,
            $acronimo_conferenza
        );
    }

    static function getSessions($acronimo,$annoEdizione)
    {
        return DbSessione::getSessionsFromConfrernce($acronimo,$annoEdizione);
    }
}