<?php
include_once (sprintf("%s/logic/UserQueryController.php", $_SERVER["DOCUMENT_ROOT"]));

if(isset($_POST['promotion_btn1'])) {
    if(UserQueryController::promoteUserToSpeaker($_POST['username'][$_POST['promotion_btn1']])){
        try {
            Session::write('msg', '<div class="container" style="background-color: limegreen;opacity: 50"> <h4>Promozione Speaker avvenuta.</h4> </div>');
        } catch (ExpiredSessionException|Exception $e) {
            echo $e;
        }
    }else {
        try {
            Session::write('msg', '<div class="container" style="background-color: red;opacity: 50"> <h4>Promozione Speaker fallita.</h4> </div>');
        } catch (ExpiredSessionException|Exception $e) {
            echo $e;
        }
    }
}

if (isset($_POST['promotion_btn2'])) {
    if(UserQueryController::promoteUserToPresenter($_POST['username'][$_POST['promotion_btn2']])){
        try {
            Session::write('msg', '<div class="container" style="background-color: limegreen;opacity: 50"> <h4>Promozione Presenter avvenuta.</h4> </div>');
        } catch (ExpiredSessionException|Exception $e) {
            echo $e;
        }
    }else {
        try {
            Session::write('msg', '<div class="container" style="background-color: red;opacity: 50"> <h4>Promozione Presenter fallita.</h4> </div>');
        } catch (ExpiredSessionException|Exception $e) {
            echo $e;
        }
    }
}

header('HTTP/1.1 307 Temporary Redirect');
header('Location: /pages/admin/promoteuser.php');

