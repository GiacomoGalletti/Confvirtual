<!DOCTYPE html>
<html lang="it">
<?php
unset($_POST['tipologia']);
unset($_POST['titolo']);
unset($_POST['article_tutorial_btn']);
unset($_POST['filePDF']);
unset($_POST['confirm_btn']);
unset($_POST['numeroPagine']);
unset($_POST['abstract']);
unset($_POST['orafine_presentazione']);
unset($_POST['orainizio_presentazione']);

print_r($_POST);
include_once (sprintf("%s/logic/permission/SessionAdminPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Upload.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/FileTypeEnum.php", $_SERVER["DOCUMENT_ROOT"]));

//unset($_POST['tipologia'],$_POST['numeroSequenza'],$_POST['titolo'],$_POST['numeroPagine'],$_POST['filePDF'],$_POST['abstract']);
//unset($_POST);

$index = $_POST['presentationbtn'];
$orainizio_sessione = $_POST['orainizio_sessione'][$index];
$orafine_sessione = $_POST['orafine_sessione'][$index];
$data=$_POST['data'][$index];
$codice_sessione = $_POST['codice_sessione'][$index];
$arrayHours = array();
$article_tutorial_btn = 0;

?>
<body>
<form method="post" action="/pages/admin/modifypresentation.php">
    <?php
    include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
    try {
        Session::start();
        if (Session::read('msg_presentazione') != false) {
            echo Session::read('msg_presentazione');
            Session::delete('msg_presentazione');
            Session::commit();
        }
    } catch (ExpiredSessionException|Exception $e) {
        echo $e;
    }
    ?>
    <div class="container">
        <h4 class="conferenceInfo">Sessione selezionata: </h4>
        <p class="conferenceInfo">
            <?php
            print ('giorno: ' . $data . ' inizio sessione: ' . $orainizio_sessione . ', fine sessione: ' . $orafine_sessione);
            ?>
        </p>
        <?php
        if (($presentations = PresentationQueryController::getAllPresentationInfo($codice_sessione)) != null)
        {
            ?>
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
                                    <th>numero sequenza</th>
                                    <th>ora inizio</th>
                                    <th>ora fine</th>
                                    <th>tipologia</th>
                                    <th>titolo</th>
                                    <th></th>
                                </tr>
                                <?php
                                foreach ($presentations as $p) {

                                    $codice_presentazione = $p['codice'];
                                    $oraInizio = DateTime::createFromFormat("H:i:s", $p['oraInizio'])->format("H:i");
                                    $oraFine = DateTime::createFromFormat("H:i:s", $p['oraFine'])->format("H:i");
                                    $arrayHours[] = $oraInizio;
                                    $arrayHours[] = $oraFine;
                                    $info = PresentationQueryController::getPresentationInfo($p['codice']);
                                    $tipologia = $info[0]['tipoPresentazione'];
                                    $titolo = $info[0]['titolo'];
                                    if ($tipologia == 'articolo') {
                                        $numeroPagine = $info[0]['numeroPagine'];
                                        $filePdf = $info[0]['filePdf'];
                                        ?>
                                        <input type="hidden" name="numeroPagine[]" value="<?php print $numeroPagine ?>">
                                        <input type="hidden" name="filePDF[]" value="<?php print $filePdf ?>">
                                        <input type="hidden" name="abstract[]" value="">
                                        <?php
                                    } else {
                                        $abstract = $info[0]['abstract'];
                                        ?>
                                        <input type="hidden" name="numeroPagine[]" value="">
                                        <input type="hidden" name="filePDF[]" value="">
                                        <input type="hidden" name="abstract[]" value="<?php print $abstract ?>">
                                        <?php
                                    }
                                    ?>
                                    <input type="hidden" name="codice_presentazione[]" value="<?php print $codice_presentazione ?>">
                                    <input type="hidden" name="orafine_presentazione[]" value="<?php print $oraFine ?>">
                                    <input type="hidden" name="orainizio_presentazione[]" value="<?php print $oraInizio ?>">
                                    <input type="hidden" name="orafine_sessione[]" value="<?php print $orafine_sessione ?>">
                                    <input type="hidden" name="orainizio_sessione[]" value="<?php print $orainizio_sessione ?>">
                                    <input type="hidden" name="data" value="<?php print $data ?>">
                                    <input type="hidden" name="codice_sessione" value="<?php print $codice_sessione ?>">
                                    <input type="hidden" name="tipologia[]" value="<?php print $tipologia ?>">
                                    <input type="hidden" name="titolo[]" value="<?php print $titolo ?>">
                                    <input type="hidden" name="numeroSequenza[]" value="<?php print $p['numeroSequenza'] ?>">
                                    <input type="hidden" id="presentationbtn" name="presentationbtn" value="<?php print $_POST['presentationbtn'] ?>">


                                    <tr>
                                        <td><?php print $p['codice']  ?></td>
                                        <td><?php print $p['numeroSequenza']  ?></td>
                                        <td><?php print $oraInizio  ?></td>
                                        <td><?php print $oraFine  ?></td>
                                        <td><?php print $tipologia ?></td>
                                        <td><?php print $titolo ?></td>
                                        <td><button type="submit" id="article_tutorial_btn" name="article_tutorial_btn" value="<?php echo $article_tutorial_btn++; ?>"><?php print ('modifica '.$tipologia)?></button></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</form>

<form method="post" action="/logic/createpresentation.php" autocomplete="off" enctype="multipart/form-data">
    <div class="container">
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
        <label class="form_articolo"><b>File PDF</b></label>
        <label for="fileToUpload" class="form_articolo">Seleziona il file PDF da caricare:</label>
        <input class="form_articolo" type="file" name="fileToUpload" id="fileToUpload"><br>

        <label class="form_articolo" for="pagenum"><b>Numero di pagine:</b></label>
        <input class="form_articolo" type="text" id="pagenum" name="pagenum" pattern="[0-9]+" placeholder="inserisci il numero di pagine">

        <label for="input_titolo_tutorial" class="form_tutorial"><b>Titolo Tutorial</b></label>
        <input class="form_tutorial" type="text" id="input_titolo_tutorial" name="titolo_tutorial" placeholder="inserisci titolo tutorial">
        <label for="input_abstract_tutorial" class="form_tutorial"><b>Abstract</b></label>
        <textarea id="input_abstract_tutorial" class="form_tutorial" maxlength="500" name="input_abstract_tutorial" rows="3" cols="95" placeholder="max 500 caratteri"></textarea>
        <br>
        <button name="confirm_btn" type="submit">Conferma</button>

        <input type="hidden" id="presentationbtn" name="presentationbtn" value="<?php print $_POST['presentationbtn'] ?>">
        <?php
        $arrayLength = sizeof($_POST['orainizio_sessione']);
        for ($i = 0; $i<$arrayLength; $i++)
        {
            ?>
            <input type="hidden" name="orafine_sessione[]" value="<?php print $_POST['orafine_sessione'][$i] ?>">
            <input type="hidden" name="orainizio_sessione[]" value="<?php print $_POST['orainizio_sessione'][$i] ?>">
            <input type="hidden" name="data[]" value="<?php print $_POST['data'][$i] ?>">
            <input type="hidden" name="codice_sessione[]" value="<?php print $_POST['codice_sessione'][$i] ?>">
            <?php
        }
        //con nessun articolo o tutorial presente arrayHours ha size 0 e non viene creato, resta "undefined"
        for ($i = 0; $i<sizeof($arrayHours); $i++) {
            ?> <input type="hidden" name="arrayHours[]" value="<?php print $arrayHours[$i] ?>"> <?php
        }
        ?>
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

