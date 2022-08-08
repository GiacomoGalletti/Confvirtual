<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>
<?php
//print_r($_POST);

if(isset($_POST['add_btn'])) {
    $srcImg = $_POST['immagineLogo'];
    $nome = $_POST['nome'];
    $anno_edizione = $_POST['annoEdizione'];
    $acronimo = $_POST['acronimo'];
    $loggedUser = $_POST['loggedUser'];
    UserQueryController::addConferenceCreator($_POST['username'][$_POST['add_btn']], $anno_edizione, $acronimo);
} else {
    $index = $_POST['add_creator_button'];
    $srcImg = $_POST['immagineLogo'][$index];
    $nome = $_POST['nome'][$index];
    $anno_edizione = $_POST['annoEdizione'][$index];
    $acronimo = $_POST['acronimo'][$index];
    $loggedUser = $_POST['loggedUser'];
}
?>
<title>Aggiunta creatori conferenza</title>
<form action="addconferencecreator.php" method="post">
    <?php
    include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));

    ?>
    <input type="hidden" name="nome" value="<?php print $nome ?>">
    <input type="hidden" name="acronimo" value="<?php print $acronimo ?>">
    <input type="hidden" name="annoEdizione" value="<?php print $anno_edizione ?>">
    <input type="hidden" name="immagineLogo" value="<?php print $srcImg ?>">
    <input type="hidden" name="loggedUser" value="<?php print $loggedUser ?>">
    <?php

    function getUsers($username, $annoConferenza, $acronimoConferenza)
    {
        global $id;
        $id = 0;

        foreach (UserQueryController::getNonCreatorAdminList($username, $annoConferenza, $acronimoConferenza) as $r) {
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
                                <td><button type="submit" id="btn" name="add_btn" value="' . $id . '">Aggiungi ai creatori</button></td>
                            ';
    }
    ?>

    <div class="container">
        <div style="margin-top: 40px">
            <div style="display: block">
                <h4 style="display: inline-block; margin-right: 10px">Nome: </h4>
                <p style="display: inline-block; margin-right: 80px"><?php print ($nome); ?></p>
                <?php if(!empty($srcImg)){
                    echo '<td><img style="display: inline-block" id="currentPhoto" title="userImg personalizzata" width="120" height="160" src="'.$srcImg.'" alt=""> </td>';
                } else { echo '<td><img style="display: inline-block" title="no img" width="120" height="160" src="/resources/images/noImgDefault.jpg" alt="default_img"></td>';} ?>

            </div>

            <div style="display: block">
                <h4 style=" display:inline-block; margin-right: 10px">Acronimo: </h4>
                <p style=" display:inline-block; margin-right: 80px"><?php print ( $acronimo ); ?></p>
            </div>
            <div style="display: block">
                <h4 style="display: inline-block; margin-right: 10px">Anno Edizione: </h4>
                <p style="display: inline-block; margin-right: 80px"><?php print ( $anno_edizione ); ?></p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center mb-4">Lista Admin</h4>
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
                            getUsers($loggedUser, $anno_edizione, $acronimo);
                            ?>
                            </tbody>
                        </table>
                    </div>
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

