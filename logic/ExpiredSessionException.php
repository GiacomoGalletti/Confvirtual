<?php

class ExpiredSessionException extends Exception
{
    public function errorMessage(): string
    {
        return '
        <link rel="stylesheet" href="/style/css/style.css">
        <div class="container"> </div>
        <h1>Sessione scaduta</h1>
        <p>reindirizzamento alla home page</p>';
    }

    public function __construct()
    {
        parent::__construct();
        header("refresh:5;url= " . "/pages/login.php");
        print ($this->errorMessage());
    }
}