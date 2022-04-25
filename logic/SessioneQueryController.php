<?php

class SessioneQueryController
{
    static function createSession(
        $ora_inizio,
        $ora_fine,
        $titolo,
        $link_stanza,
        $giorno_data,
        $anno_edizione,
        $acronimo_conferenza) : bool
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
}