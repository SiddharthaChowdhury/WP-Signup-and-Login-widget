<?php
function sid_suni_Errors_pl1(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function sid_suni_show_sync_errormsgs_pl1() {
	if($codes = sid_suni_Errors_pl1()->get_error_codes()) {
		echo '<div>';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = sid_suni_Errors_pl1()->get_error_message($code);
		        echo '<span style="color:#FF6699;"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
	}	
}
?>