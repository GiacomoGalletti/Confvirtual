<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
require (sprintf("%s/logic/Upload.php", $_SERVER["DOCUMENT_ROOT"]));
require (sprintf("%s/logic/FileTypeEnum.php", $_SERVER["DOCUMENT_ROOT"]));

$index = $_POST['presentationbtn'];
$orainizio = $_POST['orainizio'][$index];
$orafine = $_POST['orafine'][$index];
$data=$_POST['data'][$index];
$codice_sessione = $_POST['codice_sessione'][$index];

if (isset($_POST['submit']))
{
    if ($_POST['radius'] == 'articolo')
    {
        try {
            $upload = new Upload($_FILES['fileToUpload'], FileTypeEnum::PDF);
        } catch (Exception $e) {
            echo '<h4>Upload fallito</h4>' . '<p>'. $e .'</p>';
        }
        if (PresentationQueryController::createArticle($_POST['codice_sessione'][$index],$_POST['oraini'],$_POST['orafin'],$_POST['titolo_articolo'],$upload->getFilePath(),$_POST['pagenum'])) {
            echo 'articolo creato con successo';
        } else {
            echo 'articolo non creato.';
        }
    } else if ($_POST['radius'] == 'tutorial') {
        if (PresentationQueryController::createTutorial($_POST['codice_sessione'][$index],$_POST['oraini'],$_POST['orafin'],$_POST['titolo_tutorial'],$_POST['input_abstract_tutorial'])) {
            echo 'tutorial creato con successo';
        } else {
            echo 'tutorial non creato.';
        }
    } else {
        echo '<p2>seleziona una tipologia di presentazione.</p2>';
    }
}
?>
<body>
<?php
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
?>
<form method="post">
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
    if (($presentations = PresentationQueryController::getAllPresentationInfo($codice_sessione)) != null)
    {
        echo '
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
                                    <th></th>
                                </tr>
                                ';
        foreach ($presentations as $p) {
            $oraInizio = DateTime::createFromFormat("H:i:s", $p['oraInizio'])->format("H:i");
            $oraFine = DateTime::createFromFormat("H:i:s", $p['oraFine'])->format("H:i");
            $tipologia = PresentationQueryController::getTypePresentation($p['codice'])[0]['tipoPresentazione'];
            ?>
            <tr>
                <td><?php print $p['codice']  ?></td>
                <td><?php print $oraInizio  ?></td>
                <td><?php print $oraFine  ?></td>
                <td><?php print $tipologia ?></td>
                <td><button type="submit" id="article_tutorial_btn" name="article_tutorial_btn" value = ""><?php print ('modifica '.$tipologia)?></button></td>
            </tr>
            <?php
        }
        echo '
                                </thead>
                            </table>
                        </div>
                    </div>
            </div>';
    } else
    {
        echo '<div class="conteiner">
                    <p1>nessuna presentazione creata per la sessione corrente.</p1>
                  </div>
                  </form>';
    }
    ?>
    <form method="post" enctype= "multipart/form-data">
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

        <input type="hidden" id="presentationbtn" name="presentationbtn" value="<?php print $_POST['presentationbtn'] ?>">
        <?php
            $arrayLength = sizeof($_POST['orainizio']);
            for ($i = 0; $i<$arrayLength; $i++)
            {
                ?>
                <input type="hidden" name="orafine[]" value="<?php print $_POST['orafine'][$i] ?>">
                <input type="hidden" name="orainizio[]" value="<?php print $_POST['orainizio'][$i] ?>">
                <input type="hidden" name="data[]" value="<?php print $_POST['data'][$i] ?>">
                <input type="hidden" name="codice_sessione[]" value="<?php print $_POST['codice_sessione'][$i] ?>">
                <?php
            }
        ?>
    </form>
</div>
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
        let tutorial = document.getElementsByClassName("form_tutorial");
        let articolo = document.getElementsByClassName("form_articolo");

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