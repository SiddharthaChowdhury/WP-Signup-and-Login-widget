<?php
add_action( 'wp_ajax_my_action', 'sid_suni_ajaxHandler_pl1' );
add_action( 'wp_ajax_nopriv_my_action', 'sid_suni_ajaxHandler_pl1' );
function sid_suni_ajaxHandler_pl1()
{
    $type = $_POST['token'];
    if (isset($type)) {
      $user = new sid_suni_users_pl1();
        switch ($type) {
            case 'check_username_pl1':
                    $data = $_POST['data_sent'];
                    $user->login = $data['username'];
                    $resp = $user->checkUsername_pl1();
                    echo $resp;
                    die();
                break;
            case 'check_email_pl1':
                    $data = $_POST['data_sent'];
                    $user->email = $data['email'];
                    $resp = $user->checkEmail_pl1();
                    echo $resp;
                    die();
                break;
            // case 'register_user':
            //         $data = $_POST['data_sent'];
            //         $user->login = $data['sid_suni_loginSU_pl1'];
            //         $user->email = $data['sid_suni_emailSU_pl1'];
            //         $user->passd = $data['sid_suni_passSU_pl1'];
            //         $user->isAjx = $data['sid_suni_isAjxSU_pl1'];
            //         $user->nonce = $data['sid_suni_RegisterNonce_pl1'];
            //         $user->honey = $data['sid_suni_fullnameSU_pl1'];
            //         $user->actvt = $data['sid_suni_RegisterActivation_pl1'];

            //         $resp = $user->register_user_pl1();
            //         echo $resp;
            //         die();
            //     break;
            // case 'login_user':
            //         $data = $_POST['data_sent'];
            //         $user->login = $data['sid_suni_loginSI_pl1'];
            //         $user->passd = $data['sid_suni_passSI_pl1'];
            //         $user->isAjx = $data['sid_suni_isAjxSI_pl1'];
            //         $user->nonce = $data['sid_suni_LoginNonce_pl1'];

            //         $resp = $user->login_user_pl1();
            //         echo $resp;
            //         die();
            //     break;
            default:
                echo 'fishy! Something went wrong! Sorry for the inconvenience..' ;
                break;
        }
    }
}
?>