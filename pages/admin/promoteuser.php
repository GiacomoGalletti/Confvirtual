<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/permission/SessionAdminPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>
<title>Promozione utente</title>
<form action="/logic/promote_user_presenter_speaker.php" method="post">
    <?php

    try {
        Session::start();
        if (Session::read('msg') != false) {
            echo Session::read('msg');
            Session::delete('msg');
            Session::commit();
        }
    } catch (ExpiredSessionException|Exception $e) {
        echo $e;
    }

    function getUsers()
    {
        global $id;
        $id = 0;

        foreach (UserQueryController::getUsersList() as $r) {
            rowUsersInfo($r, $id);
            $id++;
        }
    }

    function rowUsersInfo($r, $id)
    {
        echo '
                                <tr>
                                <th scope="row" class="scope" ><input type="hidden" name="username[]" value="' . $r['userName'] . '">' . $r['userName'] . '</th> 
                                <td>' . $r['nome'] . '</td>
                                <td>' . $r['cognome'] . '</td>
                                <td>' . $r['luogoNascita'] . '</td>
                                <td>' . $r['dataNascita'] . '</td>
                                <td><button type="submit" id="btn" name="promotion_btn1" value="' . $id . '">Promuovi a speaker</button></td>
                                <td><button type="submit" id="btn" name="promotion_btn2" value="' . $id . '">Promuovi a presenter</button></td>
                            ';
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center mb-4">Lista Utenti</h4>
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr>
                            <th>Utente</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Luogo di nascita</th>
                            <th>Data di nascita</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        getUsers();
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
    ?>
</form>
</body>
</html>
