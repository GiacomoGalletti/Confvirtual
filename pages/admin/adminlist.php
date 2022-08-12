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
<form action="adminlist.php" method="post">
    <?php
    function getUsers()
    {
        global $id;
        $id = 0;

        foreach (UserQueryController::getAdministratorList() as $r) {
            rowUsersInfo($r, $id);
            $id++;
        }
    }

    function setData($data): string
    {
        return $data ?? "non inserito";
    }
    function rowUsersInfo($r, $id)
    {
        echo '
                                <tr>
                                <td><input type="hidden" name="username[]" value="' . $r['userName'] . '">' . $r['userName'] . '</td> 
                                <td><input type="hidden" name="nome[]" value="' . $r['nome'] . '">' . setData($r['nome']) . '</td>
                                <td><input type="hidden" name="cognome[]" value="' . $r['cognome'] . '">' . setData($r['cognome']) . '</td>
                                <td><button type="submit" id="btn" name="btn" value="' . $id . '">Assegna Conferenza</button></td>
                            ';
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center mb-4">Lista Amministratori</h4>
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr>
                            <th>Utente</th>
                            <th>Nome</th>
                            <th>Cognome</th>
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
