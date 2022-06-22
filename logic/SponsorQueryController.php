<?php
include_once (sprintf("%s/logic/DbSponsor.php", $_SERVER["DOCUMENT_ROOT"]));

class SponsorQueryController
{
    static function getAllSponsor()
    {
        return DBSponsor::getAllSponsor();
    }

    public static function calculateTotalSponsorization($nome): ?int
    {
        return DBSponsor::calculateTotalSponsorization($nome);
    }

    public static function createSponsor($nome_sponsor, $logo_sponsor): bool
    {
        return DBSponsor::createSponsor($nome_sponsor, $logo_sponsor);
    }

    public static function createSponsorization($importo, $int, $int1, $nome_sponsor): bool
    {
        return DBSponsor::createSponsorization($importo, $int, $int1, $nome_sponsor);
    }

    public static function deleteSponsor($name):bool
    {
        return DBSponsor::deleteSponsor($name);
    }

    public static function getSponsorImg($nomeSponsor)
    {
        return DBSponsor::getSponsorImg($nomeSponsor);
    }

    public static function getAllSponsorizations()
    {
        return DBSponsor::getAllSponsorizations();

    }

    public static function deleteSponsorization($nomeSponsor,$acronimoConferenza,$annoEdizioneConferenza)
    {
        return DBSponsor::deleteSponsorization($nomeSponsor,$acronimoConferenza,$annoEdizioneConferenza);
    }
}