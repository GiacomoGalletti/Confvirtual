<?php

class ExpiredSessionException extends Exception
{
    public function errorMessage() {
        $errorMsg = '
        <link rel="stylesheet" href="/css/style.css">
        <div class="container"> </div>
        <h1>Sessione scaduta</h1>
        <p>reindirizzamento alla home page</p>';
        return $errorMsg;
    }

    public function __construct()
    {
        parent::__construct();
        header("refresh:10;url= " . "/pages/login.php");
        print ($this->errorMessage());
    }
}