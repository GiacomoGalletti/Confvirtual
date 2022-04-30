<?php

class Presentation
{

    private $codice;
    private $codice_sessione;
    private $ora_inizio;
    private $ora_fine;
    private $numero_sequenza;

    public function __construct($codice, $codice_sessione, $ora_inizio, $ora_fine, $numero_sequenza)
    {
        $this->codice = $codice;
        $this->codice_sessione = $codice_sessione;
        $this->ora_inizio = $ora_inizio;
        $this->ora_fine = $ora_fine;
        $this->numero_sequenza = $numero_sequenza;
    }

    public function getCodice()
    {
        return $this->codice;
    }


    public function getCodiceSessione()
    {
        return $this->codice_sessione;
    }


    public function getOraInizio()
    {
        return $this->ora_inizio;
    }

    public function getOraFine()
    {
        return $this->ora_fine;
    }

    public function getNumeroSequenza()
    {
        return $this->numero_sequenza;
    }


}