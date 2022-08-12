<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>
<form method="post" action="presentationslist.php">
    <?php
    function getConferences()
    {
        global $id;
        $id = 0;
        foreach (ConferenceQueryController::getConferencePast() as $r) {
            rowConferenceInfo($r, $id);
            $id++;
        }
    }

    function rowConferenceInfo($r, $id)
    {
        $srcImg = $r['immagineLogo'];
        echo '
                                <input type="hidden" name="nome[]" value="'.$r['nome'].'">
                                <input type="hidden" name="acronimo[]" value="'.$r['acronimo'].'">
                                <input type="hidden" name="annoEdizione[]" value="'.$r['annoEdizione'].'">
                                <input type="hidden" name="immagineLogo[]" value="'.$r['immagineLogo'].'">
                                <tr>
                                <th scope="row" class="scope" >' . $r['acronimo'] . '</th> 
                                <td>' . $r['nome'] . '</td>
                                <td>' . $r['annoEdizione'] . '</td>
                            ';

        $string = '';
        foreach (ConferenceQueryController::getDaysConference($r['acronimo'], $r['annoEdizione']) as $r) {
            $string .= date_format(date_create($r['giorno']), "d/m") . ' - ';
        }
        echo '<td>' . $string . '</td>';

        if(!empty($srcImg)){
            echo '<td><img id="currentPhoto" title="userImg personalizzata" width="60" height="80" src="'.$srcImg.'" alt="img personale"> </td>';
        } else { echo '<td><img title="no img" width="60" height="80" src="/resources/images/noImgDefault.jpg" alt="default_img"></td>';}

        echo '<td><button type="submit" id="btn" name="presentations_list_btn" value ="'.$id.'">Visualizza Presentazioni</button></td></tr>';
    } ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center mb-4">Conferenze Passate</h4>
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
                        getConferences();
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
