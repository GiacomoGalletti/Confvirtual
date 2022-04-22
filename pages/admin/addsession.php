<!DOCTYPE html>
<html lang="en">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>
<form class="ftco-section" method="post">
<?php
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
?>
    <div class="container">
        <div>
            <h4 class="conferenceInfo">Conferenza selezionata: </h4>
            <p class="conferenceInfo">
                <?php print (' acronimo ' . $_POST['acronimo'] . ', edizione ' . $_POST['annoEdizione']);
                $arrayDate = array();
                $arrayDate = explode("%", $_POST['dates'])
                ?>
            </p>
        </div>
        <!-- Per poter aggiungere una sessione bisogna prima aver selezionato una conferenza -->
        <label for="ttl"><b>Titolo sessione</b></label>
        <input id = "titolo" type="text" placeholder="Inserisci titolo" name="ttl" required>
        <!-- I giorni da poter selezionare devono essere quelli della conferenza -->
        <label for="giorno"><b>Selezionare giorno della conferenza: </b></label>
        <select Name="lb_selezione_giorno" Size="Number_of_options">
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
        <input type="time" id="appt1" name="appt1" min="07:00" max="23:00" required>
        <small>Inserire un orario tra le 7:00 e le 23:00</small>
        <br>
        <label for="orafin"><b>Orario di fine sessione</b></label>
        <input type="time" id="appt2" name="appt2" min="07:00" max="23:00" required>
        <small>Inserire un orario tra le 7:00 e le 23:00</small>
        <br>
        <label for="stanza"><b>Link della stanza</b></label>
        <input id="linkstanza" type="text" placeholder="Inserisci link della stanza" name="stanza" required>
        <button name = "submit" type="submit">Conferma</button>
    </div>
</form>
<?php
include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
?>
</body>
</html>