<!DOCTYPE html>
<html>
<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . '/templates/head.html');
?>
<body>
<title>Info</title>
<form>
    <?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . '/templates/navbar.php');
    ?>

    <div class="container">
        <h2>Confvirtual</h2>
        <h3>progetto basi di dati creato da:</h3>
        <span class="container">Giacomo Galletti</span><span class="container">Francesco Farina</span><span class="container">Leonardo Menegatti</span>
        <h4>repository:</h4>
        <p>link: <a href="https://github.com/GiacomoGalletti/Confvirtual">gitHub</a></p>
        <h4>specifiche del progetto:</h4>
        <p>link: <a href="https://virtuale.unibo.it/pluginfile.php/1092029/mod_resource/content/1/traccia.pdf">Virtuale</a></p>
    </div>

</form>
<?php
include ($_SERVER["DOCUMENT_ROOT"] . '/templates/navbarScriptReference.html');
?>
</body>
</html>
