<!DOCTYPE html>
<html lang="it">
<?php
include_once (sprintf("%s/logic/permission/SessionAdminPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/Session.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/ConferenceQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
?>
<body>
<form name="myform" method="post">
    <?php
    include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));
    $uName = Session::read('userName');

    function getConferencesAdmin($uName)
    {
        if ($uName != null)
            global $id;
        $id = 0;
        foreach (ConferenceQueryController::getMyConference($uName) as $r)
        {
            rowConferenceInfo($r);
            $id++;
        }
    }

    function rowConferenceInfo($r)
    {
        global $id;
        ?>
        <tr>
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
            <td><?php print $stringDates  ?></td>
            <td>
                <button type="submit" id="btn" name="sessionbtn" onclick="inline(this); EditSession()" value = "<?php print ($id) ?>" state="<?php print $stato ?>"><?php if ($stato==='completata') {print("Vota conferenza ");} else {print("Modifica conferenza ");} ?><?php print $stato ?></button>
                <input type="hidden" id="array_acronimo" name="array_acronimo[]" value="<?php print $acronimo ?>">
                <input type="hidden" id="array_annoEdizione" name="array_annoEdizione[]" value="<?php print $annoEdizione ?>">
                <input type="hidden" id="dates" name="dates[]" value="<?php print $sendDates ?>">
            </td>
        </tr>
        <?php
    }
    switch (Session::read('type')) {
        case 'amministratore': ?>
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
            break;
        case 'speaker':
            ?>
            <p>// robe 1</p>
            <?php
            break;
        case 'presenter': ?>
            <p>// robe 2</p>
            <?php
            break;
        default:
            header("Location: /index.php");
            break;
    }
    ?>
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