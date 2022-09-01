<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/permission/SessionAdminPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>
<form name="myform" action="addconferencecreator.php" method="post">
    <?php
    Session::start();
    try {
        $uName = Session::read('userName');
    } catch (ExpiredSessionException|Exception $e) {
        $uName = null;
    }

    try {
        if (Session::read('msg_presentazione') != false) {
            echo Session::read('msg_presentazione');
            Session::delete('msg_presentazione');
            Session::commit();
        }
    } catch (ExpiredSessionException|Exception $e) {
        echo $e;
    }
    function getConferencesAdmin($uName)
    {
        if ($uName != null) {

            $id = 0;
            foreach (ConferenceQueryController::getMyConference($uName) as $r)
            {
                rowConferenceInfo($r);
                $id++;
            }
        }
    }

    function rowConferenceInfo($r)
    {
        global $id;
        ?>
        <tr>
            <input type="hidden" name="nome[]" value="<?php print $r['nome'] ?>">
            <input type="hidden" name="acronimo[]" value="<?php print $r['acronimo'] ?>">
            <input type="hidden" name="annoEdizione[]" value="<?php print $r['annoEdizione'] ?>">
            <input type="hidden" name="immagineLogo[]" value="<?php print $r['immagineLogo'] ?>">
            <input type="hidden" name="loggedUser" value="<?php print (Session::read('userName')) ?>">
            <th scope="row" class="scope" ><?php  print ($acronimo = $r['acronimo'])  ?></th>
            <td><?php print $r['nome'] ?></td>
            <td><?php print ($annoEdizione = $r['annoEdizione']) ?></td>
            <td><?php  print ($stato = $r['statoSvolgimento']) ?></td><?php
            $stringDates = '';
            $sendDates = '';
            foreach (ConferenceQueryController::getDaysConference($r['acronimo'], $r['annoEdizione']) as $r) {
                $sendDates .= date_format(date_create($r['giorno']), "d-m-Y") . '%';
                $stringDates .= date_format(date_create($r['giorno']), "d/m") . ' - ';
            } ?>
            <td><?php print $stringDates ?></td>
            <td>
                <button type="submit" id="btn" name="sessionbtn" onclick="inline(this); EditSession()" value = "<?php print ($id) ?>" state="<?php print $stato ?>"><?php if ($stato==='completata') {print("Vota Conferenza");} else {print("Modifica Sessioni");} ?></button>
                <input type="hidden" id="array_acronimo" name="array_acronimo[]" value="<?php print $acronimo ?>">
                <input type="hidden" id="array_annoEdizione" name="array_annoEdizione[]" value="<?php print $annoEdizione ?>">
                <input type="hidden" id="dates" name="dates[]" value="<?php print $sendDates ?>">
            </td>
            <td>
                <?php
                if ($stato==='attiva') {
                    ?>
                    <button type="submit" id="btn2" name="add_creator_button" value="<?php print $id ?>">Aggiungi creatore</button>
                    <?php
                }
                ?>
            </td>
        </tr>
        <?php
    }  ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center mb-4">Le mie conferenze</h4>
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr>
                            <th>Acronimo</th>
                            <th>Nome</th>
                            <th>Anno</th>
                            <th>Stato</th>
                            <th>Giorni</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        getConferencesAdmin($uName);
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

<script type="text/javascript">
    let state;
    let index;
    const inline = btn => {
        state = btn.getAttribute("state");
        index = btn.getAttribute("value");
    }
    function EditSession()
    {
        if(state === 'attiva')
        {
            document.myform.action ="/pages/admin/addsession.php";
            return true;
        } else if (state === 'completata')
        {
            document.myform.action ="/pages/admin/addrate.php";
            return true;
        }
        return false;
    }
</script>
</body>
</html>