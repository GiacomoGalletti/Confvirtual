<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"]));

?>
<body>
<form action="tutorialslist.php" method="post">
    <?php
    include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
    function getUsers()
    {
        global $id;
        $id = 0;

        foreach (UserQueryController::getSpeakerList() as $r) {
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
                                <td>';  if(isset($r['foto'])){ echo '<img title="userImg personalizzata" width="60" height="80" src="'. $r['foto'] .'">'; } else { echo '<img title="userImg default" width="60" height="80" src="/resources/images/defaultUserImg.jpg">';} echo '</td>
                                <td><input type="hidden" name="username[]" value="' . $r['userName'] . '">' . $r['userName'] . '</td> 
                                <td>' . setData($r['nome']) . '</td>
                                <td>' . setData($r['cognome']) . '</td>
                                <td>' . setData($r['nomeUniversita']) . '</td>
                                <td>' . setData($r['nomeDipartimento']) . '</td>
                                <td><button type="submit" id="btn" name="btn" value="' . $id . '">Assegna Tutorial</button></td>
                            ';
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center mb-4">Lista Speaker</h4>
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr>
                            <th></th>
                            <th>Utente</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Università</th>
                            <th>Dipartimento</th>
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
