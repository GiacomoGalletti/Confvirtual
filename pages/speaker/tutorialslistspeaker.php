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

//    $index = $_POST['btn'];
//    $nome = $_POST['nome'][$index];
//    $cognome = $_POST['cognome'][$index];
    $username = Session::read('userName');

    function getTutorials($username)
    {
        global $id;
        $id = 0;
        if (($tutorials = PresentationQueryController::ritornaTutorialAssegnabile($username)) != null ) {
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
                                <td><button type="submit" id="btn" name="associationbtn" value="' . $id . '">MODIFICA RISORSE</button></td>
                            ';

//        for ( $i=0; $i<sizeof($_POST['username']); $i++) {
//            //echo '<h4>valore di $i: '. $i .'</h4>';
//            echo '
//                <input type="hidden" name="username[]" value="' . $_POST['username'][$i] . '">
//                <input type="hidden" name="nome[]" value="' . $_POST['nome'][$i] . '">
//                <input type="hidden" name="cognome[]" value="' . $_POST['cognome'][$i] . '">';
//        }
    }
    ?>

    <div class="container">
<!--        <h4>Speaker selezionato: </h4>-->
<!--        <p>-->
<!--            --><?php //print (' Nome: <b>' . $nome . '</b>, Cognome: <b>' . $cognome .'</b>, UserName: <b>' . $username .'</b>');
//            ?>
<!--        </p>-->
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
<!--                        <input type="hidden" name="tipo_presentazione" value="tutorial">-->
<!--                        <input type="hidden" name="btn" value="--><?php //print $_POST['btn'] ?><!--">-->
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

