<!DOCTYPE html>
<html lang="en">

<body>
<form action="AddSession.php" method="post" >
    <div class="container">
        <!-- Per poter aggiungere una sessione bisogna prima aver selezionato una conferenza -->
        <label for="ttl"><b>Titolo sessione</b></label>
        <input id = "titolo" type="text" placeholder="Inserisci titolo" name="ttl" required>
        <!-- I giorni da poter selezionare devono essere quelli della conferenza -->
        <label for="giorno"><b>Selezionare giorno della conferenza: </b></label>
        <select Name="lb_selezione_giorno" Size="Number_of_options">
            <option> Giorno 1 </option>
            <option> Giorno 2 </option>
            <option> Giorno 3 </option>
            <option> Giorno N </option>
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
    </div>

</form>
<script src="../../js/jquery.min.js"></script>
<script src="../../js/popper.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/main.js"></script>
</body>
<footer>
</footer>
</html>