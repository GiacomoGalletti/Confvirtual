<?php

class ExpiredSessionException extends Exception
{
    public function errorMessage()
    {
        echo "<script> alert('Sessione scaduta: reindirizzamento alla home page');window.location.href='/pages/login.php';</script>";
    }

    public function __construct()
    {
        parent::__construct();
        $this->errorMessage();
    }
}