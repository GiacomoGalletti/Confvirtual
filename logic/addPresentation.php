<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/SessioneQueryController.php", $_SERVER["DOCUMENT_ROOT"]));

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
<form class="ftco-section" method="post">
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
            <h4 class="conferenceInfo">Sessione selezionata: </h4>
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
                                    <th>codice sessione</th>
                                    <th>ora inizio</th>
                                    <th>ora fine</th>
                                    <th>titolo</th>
                                    <th>link stanza</th>
                                    <th>numero presentazioni</th>
                                    <th>giorno</th>
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
                    <td><?php print $s['titolo']  ?></td>
                    <td><a href="http://<?php print $s['linkStanza']?>">LINK</a></td>
                    <td><?php print $s['numeroPresentazioni']  ?></td>
                    <td><?php print $s['giornoData']  ?></td>
                </tr>
                <?php
            }
            echo '
                                </thead>
                                <tbody>
                                <?php
                                getConferencesAdmin($uName);
                                ?>
                                </tbody>
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
        <!-- Per poter aggiungere una sessione bisogna prima aver selezionato una conferenza -->
        <label for="ttl"><b>Titolo sessione</b></label>
        <input id = "ttl" type="text" placeholder="Inserisci titolo" name="ttl" required>
        <!-- I giorni da poter selezionare devono essere quelli della conferenza -->
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
        <br>
        <label for="oraini"><b>Orario di inizio sessione</b></label>
        <input type="time" id="oraini" name="oraini" min="07:00" max="23:00" step="3600000" required>
        <small>Inserire un orario tra le 7:00 e le 23:00</small>
        <br>
        <label for="orafin"><b>Orario di fine sessione</b></label>
        <input type="time" id="orafin" name="orafin" min="07:00" max="23:00" step="3600000" required>
        <small>Inserire un orario tra le 7:00 e le 23:00</small>
        <br>
        <label for="stanza"><b>Link della stanza</b></label>
        <input id="stanza" type="text" placeholder="Inserisci link della stanza" name="stanza" required>
        <button name = "submit" type="submit">Conferma</button>
    </div>
</form>
<?php
include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
?>
</body>
</html>