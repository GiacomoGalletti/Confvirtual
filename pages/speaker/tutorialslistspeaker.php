<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/permission/SessionSpeakerPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));

?>
<body>
<form action="/pages/speaker/tutorialresources.php" method="post">
    <?php

    try {
        Session::start();
        if (Session::read('msg_sessione') != false) {
            echo Session::read('msg_sessione');
            Session::delete('msg_sessione');
            Session::commit();
        }
    } catch (ExpiredSessionException|Exception $e) {
        echo $e;
    }

    $username = Session::read('userName');

    function getTutorials($username)
    {
        global $id;
        $id = 0;
        if (($tutorials = PresentationQueryController::getTutorialsList($username)) != null ) {
            foreach ($tutorials as $r) {
                rowTutorialsInfo($r, $id);
                $id++;
            }
        }
    }

    function rowTutorialsInfo($r, $id)
    {
        echo '
                                <tr>
                                <td><input type="hidden" name="codicepresentazione[]" value="' . $r['codicePresentazione'] . '">' . $r['codicePresentazione'] . '</td>
                                <td><input type="hidden" name="codicesessione[]" value="' . $r['codiceSessione'] . '">' . $r['codiceSessione'] . '</td>
                                <td><input type="hidden" name="titolo[]" value="' . $r['titolo'] . '">' . $r['titolo'] . '</td>
                                <td><button type="submit" id="btn" name="modificabtn" value="' . $id . '">MODIFICA RISORSE</button></td>
                            ';
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center mb-4">Lista Tutorial</h4>
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr>
                            <th>codice Presentazione</th>
                            <th>codice Sessione</th>
                            <th>titolo</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        getTutorials($username);
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>

