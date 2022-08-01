<?php
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
print_r($_POST); //-------DEBUG--------

if(isset($_POST['submitRate'])){
    try {
        if($_POST['dati_presentazione']!='Scegli la presentazione'){
            $dati_presentazione = explode(',',$_POST['dati_presentazione']);
            if (ConferenceQueryController::createRating($dati_presentazione[0],$dati_presentazione[1],$_POST["voto"],$_POST["note"])){
                Session::write('msg_presentazione',
                    '<div class="container" style="background-color: limegreen;opacity: 50"> <h4>
                    Voto inserito con successo.
                    </h4> </div>');
                header('HTTP/1.1 307 Temporary Redirect');
                header('Location: /pages/admin/myconferences.php');
            } else {
                Session::write('msg_presentazione',
                    '<div class="container" style="background-color: red;opacity: 50"> <h4>
                    Presentazione già valutata.
                    </h4> </div>
                ');

                header('HTTP/1.1 307 Temporary Redirect');
                header('Location: /pages/admin/addrate.php');
            }
        } else {
            Session::write('msg_presentazione',
                '<div class="container" style="background-color: red;opacity: 50"> <h4>
                    Seleziona una presentazione.
                    </h4> </div>
                ');

            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: /pages/admin/addrate.php');
        }
    } catch (ExpiredSessionException|Exception $e) {
        echo $e;
    }
}