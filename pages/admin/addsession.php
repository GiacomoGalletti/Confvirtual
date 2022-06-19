<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/permission/SessionAdminPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/SessioneQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));

global $id;
$id = 0;
$index = $_POST['sessionbtn'];
$acronimo = $_POST['array_acronimo'][$index];
$annoEdizione = $_POST['array_annoEdizione'][$index];
$rawdates = $_POST['dates'][$index];

if (isset($_POST['presentationbtn']))
{
    header("Location:/pages/admin/addpresentation.php");
}

?>
<body>
<!-- PRIMO FORM SOLO PER LA LISTA DELLE SESSIONI E PER SPOSTARSI IN CREAZIONE PRESENTAZIONE -->
<form method="post" action="/pages/admin/addpresentation.php">
    <?php
    include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));

    try {
        Session::start();
        if (Session::read('msg_sessione') != false) {
            echo Session::read('msg_sessione');
            Session::delete('msg_sessione');
            Session::commit();
        }
    } catch (ExpiredSessionException|Exception $e) {
        echo $e;
    }

    ?>
    <div class="container">
        <h4 class="conferenceInfo">Conferenza selezionata: </h4>
        <p class="conferenceInfo">
            <?php print (' acronimo ' . $acronimo . ', edizione ' . $annoEdizione);
            $arrayDate = array();
            $arrayDate = explode("%", $rawdates);
            ?>
        </p>
        <?php
        if (($sessions = SessioneQueryController::getSessions($acronimo,$annoEdizione)) != null)
        {
            echo '
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
                    <td><?php print ($codice = $s['codice'])  ?></td>
                    <td><?php print $oraInizio  ?></td>
                    <td><?php print $oraFine  ?></td>
                    <td><?php print $s['titolo']  ?></td>
                    <td><a href="https://<?php print $s['linkStanza']?>">LINK</a></td>
                    <td><?php print $s['numeroPresentazioni']  ?></td>
                    <td><?php print ($data = $s['giornoData'])  ?></td>
                    <?php
                    if (strtotime($data) >= strtotime('now')) {
                        ?>
                        <input type="hidden" id="orainizio_sessione" name="orainizio_sessione[]" value="<?php print $oraInizio ?>">
                        <input type="hidden" id="orafine_sessione" name="orafine_sessione[]" value="<?php print $oraFine ?>">
                        <input type="hidden" id="data" name="data[]" value="<?php print $data ?>">
                        <input type="hidden" id="codice_sessione" name="codice_sessione[]" value="<?php print $codice ?>">
                        <td><button type="submit" id="presentationbtn" name="presentationbtn" value = "<?php print ($id)?>">Presentazioni</button></td>
                        <?php
                        $id++;
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
            ';
        }
   echo '
    </div>
</form>';
        ?>
        <!-- SECONDO FORM SOLO PER LA CREAZIONE DELLA SESSIONE -->
        <form method="post" action="/logic/createsession.php" autocomplete="off">
            <!-- dati da mandare alla stessa pagina per ricostruirla una volta premuto il submit -->
            <input type="hidden" id="sessionbtn" name="sessionbtn" value="<?php print $index ?>">
            <?php
                $arrayLength = sizeof($_POST['array_acronimo']);
                for ($i = 0; $i<$arrayLength; $i++)
                {
                    ?>
                        <input type="hidden" id="dates" name="dates[]" value="<?php print($_POST['dates'][$i]) ?>">
                        <input type="hidden" id="array_acronimo" name="array_acronimo[]" value="<?php print($_POST['array_acronimo'][$i]) ?>">
                        <input type="hidden" id="array_annoEdizione" name="array_annoEdizione[]" value="<?php print($_POST['array_annoEdizione'][$i]) ?>">
                    <?php
                }
            ?>
            <input type="hidden" id="acronimo" name="acronimo" value="<?php print $acronimo ?>">
            <input type="hidden" id="annoEdizione" name="annoEdizione" value="<?php print $annoEdizione ?>">
            <br>
            <!-- form di creazione della sessione -->
            <div class="container">
                <h4>Crea una sessione: </h4>
                <label for="ttl"><b>Titolo sessione</b></label>
                <input id = "ttl" type="text" placeholder="Inserisci titolo" name="ttl" autocomplete="off">
                <label for="giorno"><b>Selezionare giorno della conferenza: </b></label>
                <select id='giorno' Name="giorno" Size="Number_of_options">
                    <?php
                    for ($i = 0; $i<sizeof($arrayDate)-1; $i++)
                    {
                        $today = new DateTime(date("d-m-Y"));
                        $expire = new DateTime($arrayDate[$i]);
                        if ($expire > $today) {
                            ?>
                            <option>
                                <?php
                                print $arrayDate[$i];
                                ?>
                            </option>
                            <?php
                        } else {
                            ?>
                            <option>
                                <?php
                                print $arrayDate[$i] . ' NON MODIFICABILE';
                                ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <?php
                include (sprintf("%s/templates/timePicker.html", $_SERVER["DOCUMENT_ROOT"]));
                ?>
                <label for="stanza"><b>Link della stanza</b></label>
                <input id="stanza" type="text" placeholder="Inserisci link della stanza" name="stanza">
                <button name = "creaconferenzabtn" id="creaconferenzabtn" type="submit">Conferma</button>
            </div>
        </form>
        <?php
        include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
        ?>
</body>
</html>