<?php
include_once('DbConn.php');

// TODO: aggiungere dati relativi ai giorni della conferenza

class Conference
{
    private $anno_edizione;
    private $acronimo;
    private $tot_sponsorizzazioni;
    private $immagine_logo;
    private $stato_svolgimento;
    private $nome;

    public function __construct($anno_edizione, $acronimo, $tot_sponsorizzazioni, $immagine_logo, $stato_svolgimento, $nome) {
        $this->anno_edizione = $anno_edizione;
        $this->acronimo = $acronimo;
        $this->tot_sponsorizzazioni = $tot_sponsorizzazioni;
        $this->immagine_logo = $immagine_logo;
        $this->stato_svolgimento = $stato_svolgimento;
        $this->nome = $nome;
    }

    /**
     * Get the value of anno_edizione
     */ 
    public function getAnno_edizione()
    {
        return $this->anno_edizione;
    }

    /**
     * Get the value of acronimo
     */ 
    public function getAcronimo()
    {
        return $this->acronimo;
    }

    /**
     * Get the value of tot_sponsorizzazioni
     */ 
    public function getTot_sponsorizzazioni()
    {
        return $this->tot_sponsorizzazioni;
    }

    /**
     * Get the value of immagine_logo
     */ 
    public function getImmagine_logo()
    {
        return $this->immagine_logo;
    }

    /**
     * Get the value of stato_svolgimento
     */ 
    public function getStato_svolgimento()
    {
        return $this->stato_svolgimento;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * alias of getNome
     */
    public function getName()
    {
        return getNome();
    }
}

?>