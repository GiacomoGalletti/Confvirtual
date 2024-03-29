<?php
include_once (sprintf("%s/logic/permission/SessionAdminPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
$index =  $_POST['article_tutorial_btn'];
$numeroSequenza = $_POST['numeroSequenza'][$index];
$orainizio_presentazione = $_POST['orainizio_presentazione'][$index];
$orafine_presentazione = $_POST['orafine_presentazione'][$index];
$codice_presentazione = $_POST['codice_presentazione'][$index];
$codice_sessione = $_POST['codice_sessione'][$_POST['presentationbtn']];
$data = $_POST['data'][$_POST['presentationbtn']];
$titolo = $_POST['titolo'][$index];
$filePDF = $_POST['filePDF'][$index];
$numeroPagine = $_POST['numeroPagine'][$index];
$abstract = $_POST['abstract'][$index];
?>
<body>
<form method="post" action="/logic/delete_update_presentation.php" autocomplete="off" enctype="multipart/form-data">
<?php
switch ($_POST['tipologia'][$index]) {
    case 'articolo':
        ?>
        <div class="container">
            <h4 class="conferenceInfo">Articolo selezionato: </h4>
            <p class="conferenceInfo">
                <?php
                print ('giorno: ' . $data . ' numero di sequenza: ' . $numeroSequenza . ', inizio: ' . $orainizio_presentazione
                    . ', fine: ' . $orafine_presentazione . '<br>codice presentazione: ' . $codice_presentazione . ' codice sessione: ' . $codice_sessione.'</p>');
                sendData();
                ?>

            <table style="margin: 20px">
                <tr>
                    <td>
                        <label for="titolo_new"><b>Titolo</b><br>
                            <input type="text" maxlength="50" name="titolo_new"  placeholder="<?php  print $titolo; ?>" >
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="form_articolo"><b>File PDF</b></label>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        <a type="submit" target="_blank" href="<?php print $filePDF ?>" class="btn btn-outline-primary" name="download_btn" style="margin-right: 100px"><i class="fa fa-download" style="font-size:48px;color:#202040"></i>
                    </td>
                    <td>
                        <label for="fileToUpload">Seleziona il file PDF da caricare:</label><br>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="n_pagine_tb"><b>Numero di pagine</b><br>
                            <input type="text" name="n_pagine_tb" placeholder="<?php  print $numeroPagine; ?>" >
                        </label>
                    </td>
                </tr>
            </table>

            <table style="margin: 20px">
                <tr>
                    <td><button type="submit" id="confirm_mod_btn" name="confirm_mod_btn" value="">Conferma modifica</button></td>
                    <td><button type="submit" id="delete_btn" name="delete_btn" style="background-color: red;opacity: 50" value="">Elimina articolo</button></td>
                </tr>
            </table>
        </div>
        </form>
        </body>


    <?php
    break;
    case 'tutorial':?>
        <div class="container">
            <h4 class="conferenceInfo">Tutorial selezionato: </h4>
            <p class="conferenceInfo">
                <?php
                print ('giorno: ' . $data . ' numero di sequenza: ' . $numeroSequenza . ', inizio: ' . $orainizio_presentazione
                    . ', fine: ' . $orafine_presentazione . '<br>codice presentazione: ' . $codice_presentazione . ' codice sessione: ' . $codice_sessione.'</p>');
                sendData();
                ?>
            <table style="margin: 20px">
                <tr>
                    <td>
                        <label for="titolo_tb"><b>Titolo</b><br>
                            <input type="text" name="titolo_new" maxlength="50" placeholder="<?php  print $titolo; ?>" >
                        </label>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="input_abstract_tutorial"><b>Abstract</b></label><br>
                        <textarea id="input_abstract_tutorial" class="form_tutorial" maxlength="500" name="input_abstract_tutorial" rows="3" cols="95" placeholder="<?php print $abstract ?>"></textarea>
                    </td>
                </tr>
            </table>
        </div>
            <div class="container">
                <table style="margin: 20px">
                    <tr>
                        <td><button type="submit" id="confirm_mod_btn" name="confirm_mod_btn">Conferma modifica</button></td>
                        <td><button type="submit" id="delete_btn" name="delete_btn" style="background-color: red;opacity: 50" value="">Elimina tutorial</button></td>
                    </tr>
                </table>
            </div>
        </form>
    <?php
    break;

    default :
        header('Location: /pages/admin/addpresentation.php');
        break;
}

function sendData(): void
{
    for ($i = 0; $i<sizeof($_POST['codice_sessione']); $i++) {
        print('<input type="hidden" name="codice_sessione[]" value="'.$_POST['codice_sessione'][$i].'">');
        print('<input type="hidden" name="data[]" value="'.$_POST['data'][$i].'">');
    }

    for ($i = 0; $i<sizeof($_POST['orainizio_sessione']); $i++) {
        print('<input type="hidden" name="orainizio_sessione[]" value="'.$_POST['orainizio_sessione'][$i].'">');
        print('<input type="hidden" name="orafine_sessione[]" value="'.$_POST['orafine_sessione'][$i].'">');
    }

    for ($i = 0; $i< sizeof($_POST['tipologia']); $i++) {
        ?>
        <input type="hidden" name="tipologia[]" value="<?php print $_POST['tipologia'][$i] ?>">
        <input type="hidden" name="numeroSequenza[]" value="<?php print $_POST['numeroSequenza'][$i] ?>">
        <input type="hidden" name="orafine_presentazione[]" value="<?php print $_POST['orafine_presentazione'][$i] ?>">
        <input type="hidden" name="orainizio_presentazione[]" value="<?php print $_POST['orainizio_presentazione'][$i] ?>">
        <input type="hidden" name="titolo[]" value="<?php print $_POST['titolo'][$i] ?>">
        <input type="hidden" name="codice_presentazione[]" value="<?php print $_POST['codice_presentazione'][$i] ?>">
        <input type="hidden" name="numeroPagine[]" value="<?php print $_POST['numeroPagine'][$i] ?>">
        <input type="hidden" name="filePDF[]" value="<?php print $_POST['filePDF'][$i] ?>">
        <input type="hidden" name="abstract[]" value="<?php print $_POST['abstract'][$i] ?>">
    <?php } ?>
    <input type="hidden" name="article_tutorial_btn" value="<?php print $_POST['article_tutorial_btn'] ?>">
    <input type="hidden" id="presentationbtn" name="presentationbtn" value="<?php print $_POST['presentationbtn'] ?>">
    <?php
}