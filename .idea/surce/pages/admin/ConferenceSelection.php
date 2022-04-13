<?php
    include_once '../logic/ConferenceQueryController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ConferenceSelection</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<?php
include('../templates/titleimg.html');
include('../templates/ConferenceSelectionNavBar.html');
?>

<form class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center mb-4">Seleziona Conferenza</h4>
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr>
                            <th>Acronimo</th>
                            <th>Nome</th>
                            <th>Anno</th>
                            <th>Giorni</th>
                            <!-- <th>Valutazione</th> -->
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($row = ConferenceQueryController::conferenceFuture() as $r) {
                            echo '
                                <tr>
                                <th scope="row" class="scope" >' . $r['acronimo'] . '</th> 
                                <td>' . $r['nome'] . '</td>
                                <td>' . $r['annoEdizione'] . '</td>
                            ';
                            $string = '';
                            foreach ($row = ConferenceQueryController::daysConference($r['acronimo'],$r['annoEdizione']) as $r) {
                                $string .= date_format(date_create($r['giorno']),"d/m") . ' - ';
                            }
                            echo '<td>' . $string . '</td>';
                            echo '<td> <a href="../AddSession.php" class="btn btn-primary">Seleziona</a> </td>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="../../js/jquery.min.js"></script>
<script src="../../js/popper.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/main.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>