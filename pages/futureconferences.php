<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"])); ?>
<body>
<?php
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"])); ?>
<form method="post" action="/logic/subscribeconference.php"> <?php

    function getConferencesLogged()
    {
        global $id;
        $id = 0;
        foreach (ConferenceQueryController::getConferenceFuture() as $c) {
            $srcImg = $c['immagineLogo'];

            echo '
                                <input type="hidden" name="acronimo[]" value="'.$c['acronimo'].'">
                                <input type="hidden" name="annoEdizione[]" value="'.$c['annoEdizione'].'">
                                <tr>
                                <th>' . $c['acronimo'] . '</th> 
                                <td>' . $c['nome'] . '</td>
                                <td>' . $c['annoEdizione'] . '</td>';
            $string = '';
            foreach (ConferenceQueryController::getDaysConference($c['acronimo'], $c['annoEdizione']) as $r) {
                $string .= date_format(date_create($r['giorno']), "d/m") . ' - ';
            }
            echo '<td>' . $string . '</td>';
            if(!empty($srcImg)){
                echo '<td><img id="currentPhoto" title="userImg personalizzata" width="60" height="80" src="'.$srcImg.'" alt=""> </td>';
            } else { echo '<td><img title="no img" width="60" height="80" src="/resources/images/noImgDefault.jpg" alt="default_img"></td>';}

            if (ConferenceQueryController::checkSubcription($c['annoEdizione'],$c['acronimo'])) {
                echo '<td><button type="submit" id="btn" name="conferencebtn" value ="'.$id.'" disabled >già iscritto</button></td>';
            } else {
                echo '<td><button type="submit" id="btn" name="conferencebtn" value ="'.$id.'">Iscriviti</button></td>';
            }
            $id++;
        }
    }

    function getConferences()
    {
        global $id;
        $id = 0;
        foreach (ConferenceQueryController::getConferenceFuture() as $c) {
            $srcImg = $c['immagineLogo'];

            echo '
                                <input type="hidden" name="acronimo[]" value="'.$c['acronimo'].'">
                                <input type="hidden" name="annoEdizione[]" value="'.$c['annoEdizione'].'">
                                <tr>
                                <th>' . $c['acronimo'] . '</th> 
                                <td>' . $c['nome'] . '</td>
                                <td>' . $c['annoEdizione'] . '</td>';
            $string = '';
            foreach (ConferenceQueryController::getDaysConference($c['acronimo'], $c['annoEdizione']) as $r) {
                $string .= date_format(date_create($r['giorno']), "d/m") . ' - ';
            }
            echo '<td>' . $string . '</td>';
            if(!empty($srcImg)){
                echo '<td><img id="currentPhoto" title="userImg personalizzata" width="60" height="80" src="'.$srcImg.'"> </td>';
            } else { echo '<td><img title="no img" width="60" height="80" src="/resources/images/noImgDefault.jpg" alt="default_img"></td>';}

            $id++;
        }
    }
    try {
        switch (Session::read('type')) {
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
                                        <th>Logo</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    getConferencesLogged();
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
    } catch (ExpiredSessionException|Exception $e) {
        echo $e;
    }
    ?>
</form>
</body>
</html>
<?php
