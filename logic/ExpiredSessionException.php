<?php

class ExpiredSessionException extends Exception
{

    public function __construct()
    {
        header("refresh:2;url= " . "/pages/login.php");
        ?>
        <link rel="stylesheet" href="/css/style.css">
        <div class="container"> </div>
        <h1>Sessione scaduta</h1>
        <?php
    }
}