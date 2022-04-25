<?php
include_once('DbConn.php');

class Sessione
{
    private $codice;
    private $ora_inizio;
    private $ora_fine;
    private $titolo;
    private $link_stanza;
    private $numero_presentazioni;
    private $giorno_data;
    private $anno_edizione;
    private $acronimo_conferenza;

    public function __construct(
        $codice,
        $ora_inizio,
        $ora_fine,
        $titolo,
        $link_stanza,
        $numero_presentazioni,
        $giorno_data,
        $anno_edizione,
        $acronimo_conferenza
    )
    {
        $this->codice = $codice;
        $this->ora_inizio = $ora_inizio;
        $this->ora_fine = $ora_fine;
        $this->titolo = $titolo;
        $this->link_stanza = $link_stanza;
        $this->numero_presentazioni = $numero_presentazioni;
        $this->giorno_data = $giorno_data;
        $this->anno_edizione = $anno_edizione;
        $this->acronimo_conferenza = $acronimo_conferenza;
    }

    /**
     * @return mixed
     */
    public function getCodice()
    {
        return $this->codice;
    }

    /**
     * @return mixed
     */
    public function getOraInizio()
    {
        return $this->ora_inizio;
    }

    /**
     * @return mixed
     */
    public function getOraFine()
    {
        return $this->ora_fine;
    }

    /**
     * @return mixed
     */
    public function getTitolo()
    {
        return $this->titolo;
    }

    /**
     * @return mixed
     */
    public function getLinkStanza()
    {
        return $this->link_stanza;
    }

    /**
     * @return mixed
     */
    public function getNumeroPresentazioni()
    {
        return $this->numero_presentazioni;
    }

    /**
     * @return mixed
     */
    public function getGiornoData()
    {
        return $this->giorno_data;
    }

    /**
     * @return mixed
     */
    public function getAnnoEdizione()
    {
        return $this->anno_edizione;
    }

    /**
     * @return mixed
     */
    public function getAcronimoConferenza()
    {
        return $this->acronimo_conferenza;
    }

}