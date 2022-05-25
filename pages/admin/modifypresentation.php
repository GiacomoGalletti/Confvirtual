<?php

include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
print_r($_POST);

if (isset($_POST['download_btn'])) {

    $file = basename($_POST['filePdf']);

    if(!file_exists($file)){ // file does not exist
        die('file not found');
    } else {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        readfile($file);
    }
}
?>
<body>
<form method="post">
<?php

include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
$index =  $_POST['article_tutorial_btn'];

switch ($_POST['tipologia'][$index]) {
case 'articolo':
?>
            <div class="container">
            <h4 class="conferenceInfo">Articolo selezionato: </h4>
            <p class="conferenceInfo">
<?php
print ('giorno: ' . $_POST['data'] . ' numero di sequenza: ' . $_POST['numeroSequenza'][$index] . ', inizio: ' . $_POST['orainizio'][$index]
    . ', fine: ' . $_POST['orafine'][$index] . '</p>');
?>
<table style="margin: 20px">
    <tr>
        <td>
            <label for="titolo_tb"><b>Titolo</b></label><br>
            <input type="text" maxlength="50" name="titolo_tb" placeholder="<?php  print $_POST['titolo'][$index]; ?>" >
        </td>
    </tr>
    <tr>
        <td>
            <label class="form_articolo"><b>File PDF</b></label>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <button type="submit" class="btn" name="download_btn" style="margin-right: 100px"><i class="fa fa-download" style="font-size:48px;color:#202040"></i>
        </td>
        <td>
            <label for="fileToUpload">Seleziona il file PDF da caricare:</label><br>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </td>
    </tr>

    <tr>
        <td>
            <label for="n_pagine_tb"><b>Numero di pagine</b></label><br>
            <input type="text" name="n_pagine_tb" placeholder="<?php  print $_POST['numeroPagine'][$index]; ?>" >
        </td>
    </tr>
</table>

</form>
</body>
<?php
break;
case 'tutorial':
    echo '
            <div class="container">
            <h4 class="conferenceInfo">Tutorial selezionato: </h4>
            <p class="conferenceInfo">
        ';

    print ('giorno: ' . $_POST['data'] . ' numero di sequenza: ' . $_POST['numeroSequenza'][$index] . ', inizio: ' . $_POST['orainizio'][$index]
        . ', fine: ' . $_POST['orafine'][$index] . '</p>');

// richiamo della query dei dati modificabili:

    ?>
    <table style="margin: 20px">
        <tr>
            <td>
                <label for="titolo_tb"><b>Titolo</b></label><br>
                <input type="text" name="titolo_tb" maxlength="50" placeholder="<?php  print $_POST['titolo'][$index]; ?>" >
            </td>
        </tr>

        <tr>
            <td>
                <label for="input_abstract_tutorial"><b>Abstract</b></label><br>
                <textarea id="input_abstract_tutorial" class="form_tutorial" maxlength="500" name="input_abstract_tutorial" rows="3" cols="95" placeholder="<?php print_r($_POST['abstract'][$index]) ?>"></textarea>
            </td>
        </tr>
    </table>

    </form>
    </body>
    <?php
break;
default :
//header('Location: /pages/admin/addpresentation.php');
break;
}