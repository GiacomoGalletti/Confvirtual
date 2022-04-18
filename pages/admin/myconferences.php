<!DOCTYPE html>
<html lang="it">
<?php
if(isset($_POST['attiva'])){
    header("Location: /pages/admin/addrate.php");
}
if(isset($_POST['chiusa'])){
    header("Location: /pages/admin/addsession.php");
}
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>
<form class="ftco-section" method="post">
<?php
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
try {
    $uName = Session::read('userName');
} catch (ExpiredSessionException $e) {
}
function getConferencesAdmin($uName)
{
    foreach (ConferenceQueryController::getMyConference($uName) as $r) {
        rowConferenceInfo($r);
    }
}

function rowConferenceInfo($r)
{
    echo '
                                <tr>
                                <th scope="row" class="scope" >' . $r['acronimo'] . '</th> 
                                <td>' . $r['nome'] . '</td>
                                <td>' . $r['annoEdizione'] . '</td>
                                <td>' . ($stato = $r['statoSvolgimento']) . '</td>
                         
                            ';
    $string = '';
    foreach (ConferenceQueryController::getDaysConference($r['acronimo'], $r['annoEdizione']) as $r) {
        $string .= date_format(date_create($r['giorno']), "d/m") . ' - ';
    }
    echo '<td>' . $string . '</td> 
          <td> 
            <button type="button" class="modifica" name="'. $stato .'">Modifica conferenza '. $stato .'</button> 
          </td>';
}
try {
    switch (Session::read('type')) {
        case 'amministratore': ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-center mb-4">Le mie conferenze</h4>
                            <div class="table-wrap">
                                <table class="table">
                                    <thead class="thead-primary">
                                    <tr>
                                        <th>Acronimo</th>
                                        <th>Nome</th>
                                        <th>Anno</th>
                                        <th>Stato</th>
                                        <th>Giorni</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    try {
                                        getConferencesAdmin($uName);
                                    } catch (ExpiredSessionException $e) {
                                        echo $e;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            break;
        case 'speaker':
            ?>
            <p>// robe 1</p>
            <?php
            break;
        case 'presenter': ?>
            <p>// robe 2</p>
            <?php
            break;
        default:
            header("Location: /index.php");
    }
} catch (ExpiredSessionException $e) {
    echo $e;
}
?>
<?php
include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
?>
</form>
</body>
</html>