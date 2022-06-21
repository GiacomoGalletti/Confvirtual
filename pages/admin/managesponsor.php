<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/Upload.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/FileTypeEnum.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/permission/SessionAdminPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/SponsorQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));

global $id;
$id = 0;
//$index = $_POST['sessionbtn'];
//$acronimo = $_POST['array_acronimo'][$index];
//$annoEdizione = $_POST['array_annoEdizione'][$index];
//$rawdates = $_POST['dates'][$index];

?>
<body>
<!-- PRIMO FORM SOLO PER LA LISTA DEGLI SPONSOR -->
<form method="post" >
    <?php include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
    try {
        Session::start();
        if (Session::read('msg_sessione') != false) {
            echo Session::read('msg_sessione');
            Session::delete('msg_sessione');
            Session::commit();
        }
    } catch (ExpiredSessionException|Exception $e) {
        echo $e;
    } ?>
    <div class="container">
        <?php if (($sponsors = SponsorQueryController::getAllSponsor()) != null)
        {
            echo '
                <h4>Sponsor attivi: </h4>
                <p class="conferenceInfo">
                <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-wrap">
                            <table class="table">
                                <thead class="thead-primary">
                                <tr>
                                    <th>nome</th>
                                    <th>logo</th>
                                    <th>tot sponsorizzazzioni</th>
                                    <th></th>
                                </tr>
                                ';
            foreach ($sponsors as $s) {
                $tot_sponsorizzazioni = SponsorQueryController::calculateTotalSponsorization($s['nome']);
                ?>
                <tr>
                    <td><?php print $s['nome']  ?></td>
                    <td><?php print $s['immagineLogo']  ?></td>
                    <td><?php if ($tot_sponsorizzazioni == null){print (0 . ' euro');} else { print ($tot_sponsorizzazioni . ' euro'); } ?></td>
                    <td><button type="submit" name="sponsor_btn" value = "<?php print ($id)?>"> sponsorizzazioni</button></td>
                </tr>
                <?php $id++; }
            echo '
                                </thead>
                            </table>
                        </div>
                </div>
            </div>
            ';
        }
        echo '
    </div>
</form>';
        ?>
        <!-- SECONDO FORM SOLO PER LA CREAZIONE DELLO SPONSOR -->
        <form method="post" action="/logic/createsponsor.php" autocomplete="off" enctype="multipart/form-data">
            <br>
            <!-- form di creazione della sessione -->
            <div class="container">
                <h4>Crea uno sponsor: </h4>
                <label for="ttl"><b>Nome sponsor<sup>*</sup></b></label><input id = "ttl" type="text" placeholder="Inserisci nome" name="nome_sponsor" autocomplete="off">
                <label for="fileToUpload"><b>Logo Sponsor<sup>*</sup></b></label><br>
                <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
                <p><sup>*</sup>: campi obbligatori</p>
            </div>
            <div class="container">
                <button name = "crea_sponsor_btn" id="crea_sponsor_btn" type="submit">Conferma</button>
            </div>
        </form>
        <?php
        include_once (sprintf("%s/templates/navbarScriptReference.html", $_SERVER["DOCUMENT_ROOT"]));
        ?>
</body>
</html>