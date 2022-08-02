<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/headWithRate.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/SessioneQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/debug.php", $_SERVER["DOCUMENT_ROOT"]));
global $id;
$id = 0;
$index = $_POST['sessionbtn'];
$acronimo = $_POST['array_acronimo'][$index];
$annoEdizione = $_POST['array_annoEdizione'][$index];
$rawdates = $_POST['dates'][$index];
$arrayDate = array();
$arrayDate = explode("%", $rawdates);
?>
<body>
<form method="post">
    <?php
    include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
    try {
        //Session::start();
        if (Session::read('msg_presentazione') != false) {
            echo Session::read('msg_presentazione');
            Session::delete('msg_presentazione');
            Session::commit();
        }
    } catch (ExpiredSessionException|Exception $e) {
        echo $e;
    }
    ?>
</form>
<div class="container">
    <form action="/logic/rateAdded.php" method = "post">
        <h1>VOTAZIONE CONFERENZA</h1>

        <h3> Conferenza selezionata:</h3>

        <?php
        echo "acronimo conferenza: ".$acronimo.'<br />';
        echo "edizione: ".$annoEdizione.'<br />';
        print "date: ";
        foreach($arrayDate as $dat){
            print $dat." ";
        }
        ?>
        <br>
        <br>
        <h3>Selezione Presentazione</h3>
        <select class="custom-select" id="inputGroupSelect04" name="dati_presentazione">
            <?php receivePresentations($acronimo,$annoEdizione); ?>
    </form>
</div>
</body>
<?php
function receivePresentations($acronimo,$annoEdizione)
{
    $codici_sessioni = SessioneQueryController::getSessions($acronimo,$annoEdizione);
    if ($codici_sessioni != null){
        //print('<h3>Codici sessioni:</h3>');
        //print_r($codici_sessioni);
        print('<option selected>Scegli la presentazione</option>');
        foreach ($codici_sessioni as $cs) {
            //print('<h3>CS:</h3>');
            //print_r($cs);
            $codici_presentazioni = PresentationQueryController::getAllPresentationInfo($cs['codice']);
            //print('<h3>Codici presentazioni:</h3>');
            //print_r($codici_presentazioni);
            foreach ($codici_presentazioni as $cp) {
                //print('<h3>CP:</h3>');
                //print_r($cp);
                $info_presentazione = PresentationQueryController::getPresentationInfo($cp['codice'])[0];
                print('<h3>info_presentazione:</h3>');
                print_r($info_presentazione);
                if (PresentationQueryController::checkCoveredPresentation($info_presentazione['codicePresentazione'], $info_presentazione['codiceSessione'],$info_presentazione['tipoPresentazione'])) {
                    print('<option value="'. $info_presentazione['codicePresentazione'].','.$info_presentazione['codiceSessione'] .'">'. '<b>TIPO: </b>' .$info_presentazione['tipoPresentazione'] . ' <b>  TITOLO: </b>' . $info_presentazione['titolo'] .'</option>');
                }
            }
        }
        for ($i=0;$i < sizeof($_POST['array_acronimo']); $i++) {
            print('<input type="hidden" name="array_acronimo[]" value="'.$_POST['array_acronimo'][$i].'">');
            print('<input type="hidden" name="array_annoEdizione[]" value="'.$_POST['array_annoEdizione'][$i].'">');
            print('<input type="hidden" name="dates[]" value="'.$_POST['dates'][$i].'">');
        }
        print('
        </select>
        <h3> inserire valutazione:</h3>
        <input type="hidden" name="sessionbtn" value="'.$_POST['sessionbtn'].'">
        <fieldset class="rate">
            <input type="radio" id="rating10" name="voto" value="10" /><label for="rating10" title="5 stars"></label>
            <input type="radio" id="rating9" name="voto" value="9" /><label class="half" for="rating9" title="4 1/2 stars"></label>
            <input type="radio" id="rating8" name="voto" value="8" /><label for="rating8" title="4 stars"></label>
            <input type="radio" id="rating7" name="voto" value="7" /><label class="half" for="rating7" title="3 1/2 stars"></label>
            <input type="radio" id="rating6" name="voto" value="6" /><label for="rating6" title="3 stars"></label>
            <input type="radio" id="rating5" name="voto" value="5" /><label class="half" for="rating5" title="2 1/2 stars"></label>
            <input type="radio" id="rating4" name="voto" value="4" /><label for="rating4" title="2 stars"></label>
            <input type="radio" id="rating3" name="voto" value="3" /><label class="half" for="rating3" title="1 1/2 stars"></label>
            <input type="radio" id="rating2" name="voto" value="2" /><label for="rating2" title="1 star"></label>
            <input type="radio" id="rating1" name="voto" value="1" /><label class="half" for="rating1" title="1/2 star"></label>
        </fieldset>
        <br>
        <label for="input_abstract_tutorial"> <h4>inserire note della valutazione: </h4> </label>
        <br>
        <textarea id="input_rate" class="form_rate" maxlength="50" name="note" rows="3" cols="50" placeholder="max 50 caratteri"></textarea>
        <br>
        <button name="submitRate" type="submit">salva valutazione</button>
            ');
    } else {
        print('<p>Nessuna sessione in questa conferenza.</p>');
    }
}
