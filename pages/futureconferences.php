<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>
<title>Conferenze Future</title>
<form method="post">
<?php
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
function getConferences()
{
    foreach (ConferenceQueryController::getConferenceFuture() as $r) {
        rowConferenceInfo($r);
    }
}

function rowConferenceInfo($r)
{
    $srcImg = $r['immagineLogo'];

    echo '
                                <tr>
                                <th>' . $r['acronimo'] . '</th> 
                                <td>' . $r['nome'] . '</td>
                                <td>' . $r['annoEdizione'] . '</td>
                            
                            ';
    $string = '';
    foreach (ConferenceQueryController::getDaysConference($r['acronimo'], $r['annoEdizione']) as $r) {
        $string .= date_format(date_create($r['giorno']), "d/m") . ' - ';
    }
    echo '<td>' . $string . '</td>';
    echo '
    <td>';

    if(!empty($srcImg)){
        echo '<img id="currentPhoto" title="userImg personalizzata" width="60" height="80" src="';
        echo $srcImg;
        echo '">';
    } else { echo '<img title="no img" width="60" height="80" src="/resources/images/noImgDefault.jpg">';}
    echo '</td>
    ';
}

switch(Session::read('type')){
    case 'amministratore':
    case 'speaker':
    case 'presenter': ?>
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
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                getConferences();
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        break;
    default: ?>
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
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                getConferences();
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    <?php
}
?>
<?php
include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
?>
</form>
</body>
</html>