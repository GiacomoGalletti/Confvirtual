<!DOCTYPE html>
<html lang="en">
<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . '/logic/Session.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/templates/head.html');
?>
<body>
<title>Conferenze Future</title>
<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . '/templates/navbar.php');
switch(Session::read('type')){
    case 'amministratore': ?>
        <form class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-center mb-4">Programmazione Conferenze</h4>
                        <div class="table-wrap">
                            <table class="table">
                                <thead class="thead-primary">
                                <tr>
                                    <th>Acronimo</th>
                                    <th>Nome</th>
                                    <th>Anno</th>
                                    <th>Giorni</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($row = ConferenceQueryController::conferenceFuture() as $r) {
                                    echo '
                                <tr>
                                <th scope="row" class="scope" >' . $r['acronimo'] . '</th> 
                                <td>' . $r['nome'] . '</td>
                                <td>' . $r['annoEdizione'] . '</td>
                            ';
                                    $string = '';
                                    foreach ($row = ConferenceQueryController::daysConference($r['acronimo'],$r['annoEdizione']) as $r) {
                                        $string .= date_format(date_create($r['giorno']),"d/m") . ' - ';
                                    }
                                    echo '<td>' . $string . '</td>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
        break;
    case 'speaker':?>
        // robe
        <?php
        break;
    case 'presenter': ?>
        // robe
        <?php
        break;
    default: ?>
        <form class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-center mb-4">Programmazione Conferenze</h4>
                        <div class="table-wrap">
                            <table class="table">
                                <thead class="thead-primary">
                                <tr>
                                    <th>Acronimo</th>
                                    <th>Nome</th>
                                    <th>Anno</th>
                                    <th>Giorni</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($row = ConferenceQueryController::conferenceFuture() as $r) {
                                    echo '
                                <tr>
                                <th scope="row" class="scope" >' . $r['acronimo'] . '</th> 
                                <td>' . $r['nome'] . '</td>
                                <td>' . $r['annoEdizione'] . '</td>
                            ';
                                    $string = '';
                                    foreach ($row = ConferenceQueryController::daysConference($r['acronimo'],$r['annoEdizione']) as $r) {
                                        $string .= date_format(date_create($r['giorno']),"d/m") . ' - ';
                                    }
                                    echo '<td>' . $string . '</td>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php
}
?>
<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . '/templates/navbarScriptReference.html');
?>
</body>
</html>