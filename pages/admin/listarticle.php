<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/PresentationQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
?>

<body>
<form action="" method="post">
    <?php
    include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));

    function getArticles()
    {
        global $id;
        $id = 0;
        $selected_user = $_POST['username'][$_POST['btn']];
        if (($articles = PresentationQueryController::getArticlesList($selected_user)) != null ) {
            foreach ($articles as $r) {
                rowArticlesInfo($r, $id);
                $id++;
            }
        }
    }

    function rowArticlesInfo($r, $id)
    {
        echo '
                                <tr>
                                <td><input type="hidden" name="codicepresentazione[]" value="' . $r['codicePresentazione'] . '">' . $r['codicePresentazione'] . '</td> 
                                <td><input type="hidden" name="codicesessione[]" value="' . $r['codiceSessione'] . '">' . $r['codiceSessione'] . '</td>
                                <td><input type="hidden" name="titolo[]" value="' . $r['titolo'] . '">' . $r['titolo'] . '</td>
                                <td><button type="submit" id="btn" name="promotion_btn1" value="' . $id . '">DA DEFINIRE</button></td>
                            ';
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center mb-4">Lista Articoli</h4>
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
                        getArticles();
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

