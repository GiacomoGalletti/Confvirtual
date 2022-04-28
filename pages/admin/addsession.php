<!DOCTYPE html>
<html lang="it">
<?php

include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/SessioneQueryController.php", $_SERVER["DOCUMENT_ROOT"]));

if (isset($_POST['to_presentation']))
{
    header("Location:/pages/admin/addpresentation.php");
}


if (isset($_POST['submit']))
{
    if (SessioneQueryController::createSession($_POST['oraini'],$_POST['orafin'],$_POST['ttl'],$_POST['stanza'],$_POST['giorno'],$_POST['annoEdizione'],$_POST['acronimo']))
    {
        header("refresh:2;Location: /pages/admin/myconferences.php");
    }
    else
    {
        header("refresh:2;Location: /pages/admin/addsession.php");
    }
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
        $acronimo = $_POST['acronimo'][$index];
        $annoEdizione = $_POST['annoEdizione'][$index];
        $rawdates=$_POST['dates'][$index];
        ?>
         <div class="container">
            <h4 class="conferenceInfo">Conferenza selezionata: </h4>
            <p class="conferenceInfo">
                <?php print (' acronimo ' . ($acronimo) . ', edizione ' . ($annoEdizione));
                $arrayDate = array();
                $arrayDate = explode("%", $rawdates)
                ?>
            </p>
         </div>
        <?php
        if (($sessions = SessioneQueryController::getSessions($acronimo,$annoEdizione)) != null)
        {
            echo '
                    <div class="container">
                    <h4>Sessioni create: </h4>
                    <p class="conferenceInfo">
                    <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-wrap">
                            <table class="table">
                                <thead class="thead-primary">
                                <tr>
                                    <th>codice <br> sessione</th>
                                    <th>ora inizio</th>
                                    <th>ora fine</th>
                                    <th>titolo</th>
                                    <th>link stanza</th>
                                    <th>numero <br> presentazioni</th>
                                    <th>giorno</th>
                                    <th></th>
                                </tr>
                                ';
                                foreach ($sessions as $s) {
                                    $oraInizio = DateTime::createFromFormat("H:i:s", $s['oraInizio'])->format("H:i");
                                    $oraFine = DateTime::createFromFormat("H:i:s", $s['oraFine'])->format("H:i");
                                    ?>
                                    <tr>
                                        <td><?php print $s['codice']  ?></td>
                                        <td><?php print $oraInizio  ?></td>
                                        <td><?php print $oraFine  ?></td>
                                        <td><?php print $s['titolo']  ?></td>
                                        <td><a href="http://<?php print $s['linkStanza']?>">LINK</a></td>
                                        <td><?php print $s['numeroPresentazioni']  ?></td>
                                        <td><?php print ($data = $s['giornoData'])  ?></td>
                                            <?php
                                                if (strtotime($data) >= strtotime('now')) {
                                                    echo '<td><button type="submit" id="to_presentation" name="to_presentation">Presentazioni</button></td>';
                                                } else
                                                {
                                                    echo '<td>non modificabile</td>';
                                                }
                                            ?>
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
        <label for="ttl"><b>Titolo sessione</b></label>
        <input id = "ttl" type="text" placeholder="Inserisci titolo" name="ttl">
        <label for="giorno"><b>Selezionare giorno della conferenza: </b></label>
        <select id='giorno' Name="giorno" Size="Number_of_options">
            <?php
            for ($i = 0; $i<sizeof($arrayDate); $i++)
            {
                ?>
                <option>
                    <?php
                    print $arrayDate[$i];
                    ?>
                </option>
                <?php
            }
            ?>
        </select>
        <?php
        include (sprintf("%s/templates/timePicker.html", $_SERVER["DOCUMENT_ROOT"]));
        ?>
        <label for="stanza"><b>Link della stanza</b></label>
        <input id="stanza" type="text" placeholder="Inserisci link della stanza" name="stanza">
        <button name = "submit" type="submit">Conferma</button>
    </div>
</form>
<script>
</script>
<?php
include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
?>
</body>
</html>