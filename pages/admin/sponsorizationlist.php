<?php
include_once (sprintf("%s/logic/permission/SessionAdminPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/SponsorQueryController.php", $_SERVER["DOCUMENT_ROOT"]));

if (isset($_POST['delete_btn'])) {
    SponsorQueryController::deleteSponsorization($_POST['nomeSponsor'][$_POST['delete_btn']],$_POST['acronimoConferenza'][$_POST['delete_btn']],$_POST['annoEdizioneConferenza'][$_POST['delete_btn']]);
}

function sendData($nomeSponsor,$acronimoConferenza,$annoEdizioneConferenza) {
    echo '
    <input type=hidden name="nomeSponsor[]" value="'. $nomeSponsor .'">
    <input type=hidden name="acronimoConferenza[]" value="'. $acronimoConferenza .'">
    <input type=hidden name="annoEdizioneConferenza[]" value="'. $annoEdizioneConferenza .'">
    ';
}

function getSponsorizations()
{
    $sponsorizations = SponsorQueryController::getAllSponsorizations();
    if ($sponsorizations != null) {
        foreach ($sponsorizations as $r) {

            rowSponsorizationInfo($r);
        }
    }
}

$id = 0;

function rowSponsorizationInfo($r)
{
    sendData($r['nomeSponsor'],$r['acronimoConferenza'],$r['annoEdizioneConferenza']);
    global $id;
    $srcImg = SponsorQueryController::getSponsorImg($r['nomeSponsor'])['immagine'];
    echo '
                                <tr>
                                <th>' . $r['nomeSponsor'] . '</th> 
                                <td>' . $r['acronimoConferenza'] . '</td>
                                <td>' . $r['annoEdizioneConferenza'] . '</td>
                                <td>' . $r['importo'] . '</td>
                                <td>';
    if($srcImg != null){
        echo '<img id="currentPhoto" title="userImg personalizzata" width="60" height="80" src="' . $srcImg . '">';
    } else { echo '<img title="no img" width="60" height="80" src="/resources/images/noImgDefault.jpg">';}
    echo '</td>';

    echo '<td><button type="submit" id="delete_btn" name="delete_btn" style="background-color: red;opacity: 50" value="'. $id .'">Elimina sponsorizzazione</button></td>';
    $id++;
}?>
<form method="post">
    <body>
    <?php include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"])); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center mb-4">Sponsorizzazioni</h4>
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr>
                            <th>Nome sponsor</th>
                            <th>Acronimo conferenza</th>
                            <th>Anno edizione</th>
                            <th>Importo</th>
                            <th>Logo sponsor</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        getSponsorizations();
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
    </body>
</form>