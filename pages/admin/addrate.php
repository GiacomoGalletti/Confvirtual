<!DOCTYPE html>
<html lang="it">


<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/headWithRate.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));

?>


<body>
<form method="post">
    <?php
    include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
    ?>
</form>

<form action="rateAdded.php" method = "post">
    <h1>VOTAZIONE CONFERENZA</h1>

    <h3> conferenza selezionata:</h3>

    <?php

    global $id;
    $id = 0;
    $index = $_POST['sessionbtn'];
    $acronimo = $_POST['array_acronimo'][$index];
    $annoEdizione = $_POST['array_annoEdizione'][$index];
    $rawdates = $_POST['dates'][$index];

    $arrayDate = array();
    $arrayDate = explode("%", $rawdates);

    pre_r($_POST);  // mio debug, da togliere

    if (isset($_POST['sessionbtn'])) {

        echo "acronimo conferenza: ".$acronimo.'<br />';
        echo "edizione: ".$annoEdizione.'<br />';
        //echo "data:".$arrayDate.'<br />';
        print "date: ";
        foreach($arrayDate as $dat){
            print $dat." ";
        }



    }

    ?>

    <h3> inserire valutazione:</h3>

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
</form>

<?php


pre_r($_POST);  // mio debug, da togliere

if(isset($_POST['submitRate'])){




    $radioVal = $_POST['voto'];
    $textVal = $_POST['note'];


    DbConference::createRating($_POST["codicePresentazione"],$_POST["codiceSessione"],$_POST["voto"],$_POST["note"]);
}
?>

</body>


<?php                                   //funzione debug post
function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>