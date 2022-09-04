<?php
include_once (sprintf("%s/logic/permission/SessionPresenterSpeakerPermission.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/head.html", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"]));
include_once (sprintf("%s/templates/navbar.php", $_SERVER["DOCUMENT_ROOT"]));

try {
    Session::start();
    if (Session::read('msg_modifica') != false) {
        echo Session::read('msg_modifica');
        Session::delete('msg_modifica');
        Session::commit();
    }

    $loggedUser = (Session::read('userName'));
    $userInfo = UserQueryController::getInfoUser($loggedUser)[0];

    if ($userInfo['foto'] == null OR $userInfo['foto'] == '') {
        $foto = '/resources/images/noImgDefault.jpg';
    } else {
        $foto = $userInfo['foto'];
    }

    ?>
    <body>
    <form method="post" action="/logic/update_user.php" autocomplete="off" enctype="multipart/form-data">
        <div class="container">
            <div style="margin: 20px">
                <div style="margin-top: 20px">
                    <h4 style="display: inline-block; margin-right: 10px">Nome Utente:</h4>
                    <p style="display: inline-block; margin-right: 80px"><?php print $loggedUser ?></p>
                </div>
                <div style="margin-top: 20px">
                    <h4 style="display: inline-block; margin-right: 10px">Nome:</h4>
                    <p style="display: inline-block; margin-right: 80px"><?php print $userInfo['nome'] ?></p>
                </div>
                <div style="margin-top: 20px">
                    <h4 style="display: inline-block; margin-right: 10px">Cognome:</h4>
                    <p style="display: inline-block; margin-right: 80px"><?php print $userInfo['cognome'] ?></p>
                </div>
                <div style="margin-top: 20px">
                    <h4 style="display: inline-block; margin-right: 10px">Luogo di Nascita:</h4>
                    <p style="display: inline-block; margin-right: 80px"><?php print $userInfo['luogoNascita'] ?></p>
                </div>
                <div style="margin-top: 20px">
                    <h4 style="display: inline-block; margin-right: 10px">Data di Nascita:</h4>
                    <p style="display: inline-block; margin-right: 80px"><?php print $userInfo['dataNascita'] ?></p>
                </div>
            </div>
            <table style="margin: 20px">
                <tr>
                    <td>
                        <div>
                            <h4 style="display: inline-block; margin-right: 10px">Curriculum:</h4>
                        </div>
                    </td>
                    <td>
                        <div>
                            <?php
                            if ($userInfo['curriculum'] !== '') {
                                print ('<input type="text" maxlength="50" name="curriculum"  placeholder="' . $userInfo['curriculum'] . '">');
                            } else {
                                print ('<input type="text" maxlength="50" name="curriculum"  placeholder="curriculum non inserito.">');
                            }
                            ?>
                            <input type="hidden" name="curriculum_original" value="<?php print($userInfo['curriculum']) ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <h4 style="display: inline-block; margin-right: 10px">Foto:</h4>
                        </div>
                    </td>
                    <td>
                        <div>
                            <img style="display: inline-block" title="userImg" width="160" height="160" src="<?php print $foto; ?>">
                        </div>
                    </td>
                    <td>
                        <div>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="hidden" name="fileToUpload_original" value="<?php print($userInfo['foto']) ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <h4 style="display: inline-block; margin-right: 10px">Università:</h4>
                        </div>
                    </td>
                    <td>
                        <div>
                            <?php
                            if ($userInfo['nomeUniversita'] !== '') {
                                print ('<input type="text" maxlength="50" name="nomeUniversita"  placeholder="' . $userInfo['nomeUniversita'] . '">');
                            } else {
                                print ('<input type="text" maxlength="50" name="nomeUniversita"  placeholder="università non inserita.">');
                            }
                            ?>
                            <input type="hidden" name="nomeUniversita_original" value="<?php print($userInfo['nomeUniversita']) ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <h4 style="display: inline-block; margin-right: 10px">Dipartimento:</h4>
                        </div>
                    </td>
                    <td>
                        <div>
                            <?php
                            if ($userInfo['nomeDipartimento'] !== '') {
                                print ('<input type="text" maxlength="50" name="nomeDipartimento"  placeholder="' . $userInfo['nomeDipartimento'] . '">');
                            } else {
                                print ('<input type="text" maxlength="50" name="nomeDipartimento"  placeholder="dipartimento non inserito.">');
                            }
                            ?>
                            <input type="hidden" name="nomeDipartimento_original" value="<?php print($userInfo['nomeDipartimento']) ?>">

                        </div>
                    </td>
                </tr>
            </table>
            <table style="margin: 20px;">
                <tr>
                    <td><button type="submit" name="confirm_btn">Conferma modifiche</button></td>
                </tr>
            </table>
        </div>
    </form>
    </body>
    <?php
} catch (ExpiredSessionException|Exception $e) {
    header('Location: /index.php');
}