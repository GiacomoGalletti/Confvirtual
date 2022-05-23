<?php
require (sprintf("%s/logic/SessioneQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
require (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));

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
            echo '
                <h4>Sessione creata: </h4>
                  ';
        } else
        {
            echo '
             <h4>Sessione non creata</h4>
                ';
        }
    } else {
        echo '
        <div class="container"><p>AVVISO: campi inseriti non validi.</p></div>
        ';
    }
}
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: /pages/admin/addsession.php');
