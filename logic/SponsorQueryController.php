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
}