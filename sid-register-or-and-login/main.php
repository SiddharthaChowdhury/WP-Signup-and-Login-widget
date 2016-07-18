<?php
error_reporting(E_ALL);
/*
* Plugin Name: Sid Register and/or Login Widget 
* Description: This plugin offers you simple signup and signin feature. You will have fine grain control over the widget, use it the way you like. 
* Version: v1.pl1
* Author: Mr Sidd
* License: GPL2
*/

add_action( 'widgets_init', function(){
     register_widget( 'sid_suni_wiz_pl1' );
});

add_action('init', function(){
    wp_register_script('sid_suni_parentScripts_pl1', plugin_dir_url( __FILE__ ) . 'Assets/scripts/suniJs.js');
    wp_register_style('sid_suni_style_pl1', plugin_dir_url( __FILE__ ) . 'Assets/styles/suniCss.css');
    wp_register_style('sid_suni_styleBoot_pl1', plugin_dir_url( __FILE__ ) . 'Assets/styles/bootstrap.min.css');

    if (isset( $_POST["sid_suni_loginSU_pl1"] ) && isset( $_POST["sid_suni_passSU_pl1"] ) && wp_verify_nonce($_POST['sid_suni_RegisterNonce_pl1'], 'sid-suni-RegisterNonce-pl1')){
        $user = new sid_suni_users_pl1();
        $user->login = $_POST['sid_suni_loginSU_pl1'];
        $user->email = $_POST['sid_suni_emailSU_pl1'];
        $user->passd = $_POST['sid_suni_passSU_pl1'];
        // $user->isAjx = $_POST['sid_suni_isAjxSU_pl1'];
        $user->nonce = $_POST['sid_suni_RegisterNonce_pl1'];
        $user->honey = $_POST['sid_suni_fullnameSU_pl1'];
        // $user->actvt = $_POST['sid_suni_RegisterActivation_pl1'];
        $user->register_user_pl1();
    }
    else if (isset( $_POST["sid_suni_loginSI_pl1"] ) && wp_verify_nonce($_POST['sid_suni_LoginNonce_pl1'], 'sid-suni-LoginNonce-pl1')){
        $user = new sid_suni_users_pl1();
        $user->login = $_POST['sid_suni_loginSI_pl1'];
        $user->passd = $_POST['sid_suni_passSI_pl1'];
        // $user->isAjx = $_POST['sid_suni_isAjxSI_pl1'];
        // $user->nonce = $_POST['sid_suni_LoginNonce_pl1'];
        $resp = $user->login_user_pl1();
        if($resp != 200)
        {
          sid_suni_Errors_pl1()->add('loginerr', $resp );
        }
    }
});

global $sid_pl1_dir;
	$sid_pl1_dir = plugin_dir_url( __FILE__ );

add_action('wp_footer', function(){
	
		global $sid_myResources_pl1;
    	if ( $sid_myResources_pl1 ){
    		wp_enqueue_script('jquery');
		    wp_enqueue_script( 'sid_suni_parentScripts_pl1' );
		    /* Localize script for AJAX*/
		    wp_localize_script( 'sid_suni_parentScripts_pl1', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php')));

		    wp_enqueue_style('sid_suni_style_pl1');
		    wp_enqueue_style('sid_suni_styleBoot_pl1');
    	}
});

require "init.php";
require "async.php";
require "logic.php";
require "mike.php";
?>
