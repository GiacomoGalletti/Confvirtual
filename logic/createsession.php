<?php
include_once (sprintf("%s/logic/SessioneQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));

function validateDate($date, $format = 'd-m-Y'): bool
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}
if (isset($_POST['creaconferenzabtn']))
{
    print_r($_POST);
    if ($_POST['ttl'] != '' && $_POST['stanza'] != '' && isset($_POST['giorno']) && validateDate($_POST['giorno'])) {
        if (
            SessioneQueryController::createSession($_POST['oraini'],$_POST['orafin'],$_POST['ttl'],$_POST['stanza'],$_POST['giorno'],$_POST['annoEdizione'],$_POST['acronimo'])
        )
        {
            Session::write('msg_sessione', '
                    <div class="container" style="background-color: red;opacity: 50"> <h4>
                        Sessione creata con successo.
                    </h4> </div>');
        } else
        {
            Session::write('msg_sessione', '
                    <div class="container" style="background-color: red;opacity: 50"> <h4>
                        Creazione sessione fallita.
                    </h4> </div>');
        }
    } else {
        Session::write('msg_sessione', '
                    <div class="container" style="background-color: red;opacity: 50"> <h4>
                        Campi inseriti non validi.
                    </h4> </div>');
    }
}
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: /pages/admin/addsession.php');
