<?php
print_r($_POST); //-------DEBUG--------
header('HTTP/1.1 307 Temporary Redirect');
header('Location: /pages/admin/myconferences.php');
if(isset($_POST['submitRate'])){
    try {
        $radioVal = $_POST['voto'];
        $textVal = $_POST['note'];
        if (DbConference::createRating($_POST["codicePresentazione"],$_POST["codiceSessione"],$_POST["voto"],$_POST["note"])){
            Session::write('msg_presentazione',
                '<div class="container" style="background-color: limegreen;opacity: 50"> <h4>
                    Voto inserito con successo.
                    </h4> </div>');
        } else {
            Session::write('msg_presentazione',
                '<div class="container" style="background-color: red;opacity: 50"> <h4>
                    Inserimento voto fallita.
                    </h4> </div>');
        }
    } catch (ExpiredSessionException|Exception $e) {
        echo $e;
    }
}