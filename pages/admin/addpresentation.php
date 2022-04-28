<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/SessioneQueryController.php", $_SERVER["DOCUMENT_ROOT"]));

if (isset($_POST['submit']))
{
//    if ())
//    {
//        header("refresh:2;Location: /pages/admin/addsession.php");
//    }
//    else
//    {
//        header("refresh:2;Location: /pages/admin/addsession.php");
//    }
}
?>
<body>
<form method="post">
    <?php
    include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
    ?>
    <div class="container">
        <?php
        $index = $_POST['btn']-1;
        //$acronimo = $_POST['acronimo'][$index];
        //$annoEdizione = $_POST['annoEdizione'][$index];
        //$rawdates=$_POST['dates'][$index];
        ?>
            <h4 class="conferenceInfo">Sessione selezionata: </h4>
            <p class="conferenceInfo">
                <?php print (' inizio sessione: ' . 'INSERIRE ORARIO' . ', fine sessione: ' . 'INSERIRE ORARIO');
//                $arrayDate = array();
//                $arrayDate = explode("%", $rawdates)
                ?>
            </p>
        <?php
        if (($sessions = SessioneQueryController::getSessions($acronimo,$annoEdizione)) != null)
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
        }
        ?>
        <input type="hidden" id="dates" name="dates" value="<?php print $rawdates ?>">
        <input type="hidden" id="acronimo" name="acronimo" value="<?php print $acronimo ?>">
        <input type="hidden" id="annoEdizione" name="annoEdizione" value="<?php print $annoEdizione ?>">
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
        <label for = "input_filepdf" class="form_articolo"><b>File PDF</b></label>
        <form class="form_articolo" id="input_filepdf" action="/logic/upload.php" method="post" enctype="multipart/form-data">
            <p class="form_articolo" id="input_filepdf">Seleziona il file PDF da caricare:<p/>
            <input class="form_articolo" type="file" name="fileToUpload" id="fileToUpload">
        </form>
        <label class="form_articolo" for="pagenum"><b>Numero di pagine:</b></label>
        <input class="form_articolo" type="text" id="pagenum" name="pagenum" pattern="[0-9]+" placeholder="inserisci il numero di pagine">

        <label for="input_titolo_tutorial" class="form_tutorial"><b>Titolo Tutorial</b></label>
        <input class="form_tutorial" type="text" id="input_titolo_tutorial" name="titolo_tutorial" placeholder="inserisci titolo tutorial">
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