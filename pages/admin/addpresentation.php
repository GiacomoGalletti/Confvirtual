<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/upload.php", $_SERVER["DOCUMENT_ROOT"]));

$index = $_POST['presentationbtn'];
$orainizio = $_POST['orainizio'][$index];
$orafine = $_POST['orafine'][$index];
$data=$_POST['data'][$index];
$codice_sessione = $_POST['codice_sessione'][$index];

if (isset($_POST['submit']))
{
    if ($_POST['radius'] == 'articolo')
    {
        uploadPDF();
        //IN in_codiceSessione int,IN in_oraInizio time,IN in_oraFine time
        if (PresentationQueryController::createPresentation($codice_sessione,$orainizio,$orafine))
        {
            if (PresentationQueryController::createArticle($codice_sessione,$orainizio,$orafine))
            {

            } else
            {
                echo 'articolo non creato.';
            }
        } else
        {
            echo 'presentazione non creata.';
        }
    } else if ($_POST['radius'] == 'tutorial'){

    } else {
        echo '<p2>seleziona una tipologia di presentazione.</p2>';
    }
   // header("Location: /pages/admin/addpresentation.php");
}
?>
<body>
<form method="post" enctype= "multipart/form-data">
    <?php
    include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
    ?>
    <div class="container">
        <?php
        ?>
            <h4 class="conferenceInfo">Sessione selezionata: </h4>
            <p class="conferenceInfo">
                <?php
                print ('giorno: ' . $data . ' inizio sessione: ' . $orainizio . ', fine sessione: ' . $orafine);
                ?>
            </p>
        <?php
        if (($sessions = PresentationQueryController::getPresentations($codice_sessione)) != null)
        {
            echo '
                    <div class="container">
                    <h4>Presentazioni create: </h4>
                    <p class="conferenceInfo">
                    <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-wrap">
                            <table class="table">
                                <thead class="thead-primary">
                                <tr>
                                    <th>codice presentazione</th>
                                    <th>ora inizio</th>
                                    <th>ora fine</th>
                                    <th>tipologia</th>
                                </tr>
                                ';
            foreach ($sessions as $s) {
                $oraInizio = DateTime::createFromFormat("H:m:s", $s['oraInizio'])->format("H:m");
                $oraFine = DateTime::createFromFormat("H:m:s", $s['oraFine'])->format("H:m")
                ?>
                <tr>
                    <!-- TODO: sistemare dopo completamento della creazione dei Articoli e Tutorials -->
                    <td><?php print $s['codice']  ?></td>
                    <td><?php print $oraInizio  ?></td>
                    <td><?php print $oraFine  ?></td>
                    <td><?php print $s['tipologia']  ?></td>
                </tr>
                <?php
            }
            echo '
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>';
        } else
        {
            echo '<div class="conteiner">
                    <p1>nessuna presentazione creata per la sessione corrente.</p1>
                  </div>';
        }
        ?>

        <h4>Crea presentazione:</h4>
        <!-- Gli orari di inizio e fine devono essere compatibili con quelli già presi da altre PRESENTAZIONI -->
        <?php
            include (sprintf("%s/templates/timePicker.html", $_SERVER["DOCUMENT_ROOT"]));
        ?>
        <p><b>Tipologia</b></p>
        <label for="radius_articolo"> Articolo </label>
        <input type="radio" id="radius_articolo" name="radius" value="articolo">
        <label for="radius_tutorial"> Tutorial </label>
        <input type="radio" id="radius_tutorial" name="radius" value="tutorial">

        <br>

        <label for="input_titolo_articolo" class="form_articolo"><b>Titolo Articolo</b></label>
        <input class="form_articolo" type="text" id="input_titolo_articolo" name="titolo_articolo" placeholder="inserisci titolo articolo">
        <p class="form_articolo"><b>File PDF</b></p>

        <p class="form_articolo">Seleziona il file PDF da caricare:</p>
        <input class="form_articolo" type="file" name="fileToUpload" id="fileToUpload">

        <label class="form_articolo" for="pagenum"><b>Numero di pagine:</b></label>
        <input class="form_articolo" type="text" id="pagenum" name="pagenum" pattern="[0-9]+" placeholder="inserisci il numero di pagine">

        <label for="input_titolo_tutorial" class="form_tutorial"><b>Titolo Tutorial</b></label>
        <input class="form_tutorial" type="text" id="input_titolo_tutorial" name="titolo_tutorial" placeholder="inserisci titolo tutorial">
        <label for="input_abstract_tutorial" class="form_tutorial"><b>Abstract</b></label>
        <textarea id="input_abstract_tutorial" class="form_tutorial" maxlength="500" name="input_abstract_tutorial" rows="3" cols="95" placeholder="max 500 caratteri"></textarea>
        <br>
        <button name = "submit" type="submit">Conferma</button>

    </div>
</form>
<?php
include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
?>

<script>

    function hideElement(elements) {
        [].forEach.call(elements,function(obj) {
                obj.style.display = "none"
                obj.style.visibility = "hidden"
        }
        )
    }

    function showElement(elements) {
        [].forEach.call(elements,function(obj) {
                obj.style.display = "block";
                obj.style.visibility = "visible";
        }
        )
    }

    function changeForm() {
        var tutorial = document.getElementsByClassName("form_tutorial");
        var articolo = document.getElementsByClassName("form_articolo");

        hideElement(articolo);
        hideElement(tutorial);

        if (document.getElementById("radius_articolo").checked)
        {
            showElement(articolo);
        }
        else if (document.getElementById('radius_tutorial').checked)
        {
            showElement(tutorial);
        }

    }
    document.getElementById("radius_articolo").onchange = changeForm;
    document.getElementById('radius_tutorial').onchange = changeForm;
    changeForm();
</script>
</body>
</html>