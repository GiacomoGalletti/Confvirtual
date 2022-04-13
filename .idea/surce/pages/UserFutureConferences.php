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
                                <tr>
                                    <th scope="row" class="scope" >inf1</th>
                                    <td>Informatica-1</td>
                                    <td>2022</td>
                                    <td>05/04 - 07/04</td>
                                </tr>

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
                                <tr>
                                    <th scope="row" class="scope" >inf1</th>
                                    <td>Informatica-1</td>
                                    <td>2022</td>
                                    <td>05/04 - 07/04</td>
                                </tr>

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