<?php

class sid_suni_users_pl1{
	public $login;
	public $email;
	public $passd;
	public $isAjx;
	public $nonce;
	public $honey;
	public $actvt;
	function __construct(){
		$login = NULL;
		$email = NULL;
		$passd = NULL;
		$isAjx = NULL;
		$nonce = NULL;
		$honey = NULL;
		$actvt = 0;
	}

	public function checkUsername_pl1($nm = NULL)
	{
		if ($nm == NULL) {
			$nm = $this->login;
		}
		require_once(ABSPATH . WPINC . '/registration.php');
		if (!validate_username($nm)) {
			return 'Invalid Username.';
		}

		$user = get_user_by( 'login', $nm );
		if($user)
			return "Username Exists.";
		return 200;
	}

	public function checkEmail_pl1($em = NULL)
	{
		if ($em == NULL) {
			$em = $this->email;
		}
		require_once(ABSPATH . WPINC . '/registration.php');
		if (!is_email($em)) {
			return 'Invalid Email Address.';
		}
		$user = get_user_by( 'email', $em );
		if($user)
			return 'Email is in use.';
		return 200;
	}

	public function register_user_pl1()
	{
		$err_ajx = [];
		if (strlen($this->honey) > 0) 
			sid_suni_Errors_pl1()->add('internal', __('External errors.'));

		if(!wp_verify_nonce($this->nonce, 'sid-suni-RegisterNonce-pl1'))
			sid_suni_Errors_pl1()->add('internal', __('Something is wrong.'));
		
		if($this->checkUsername_pl1($this->login) != 200)
			sid_suni_Errors_pl1()->add('username', __('Username error.'));
		
		if($this->checkEmail_pl1($this->email) != 200)
			sid_suni_Errors_pl1()->add('email', __('Email error.'));
		
		if(strlen($this->passd) < 5)
			sid_suni_Errors_pl1()->add('password', __('Password too weak.'));
		
		if (empty($err_ajx)) {
			$new_user_id = wp_insert_user(array(
					'user_login'		=> $this->login,
					'user_pass'	 		=> $this->passd,
					'user_email'		=> $this->email,
					'user_registered'	=> date('Y-m-d H:i:s'),
				)
			);
			if($new_user_id) {
				// send an email to the admin alerting them of the registration
				wp_new_user_notification($new_user_id);
 
				wp_setcookie($this->login, $this->passd, true);
				wp_set_current_user($new_user_id, $this->login);	
				do_action('wp_login', $this->login);
 				return 200;
			}

		}
		else
			return $err_ajx;

	}

	function login_user_pl1(){

		$usr = $this->login;
		$id = '';
		if (!filter_var($usr, FILTER_VALIDATE_EMAIL) === false) {
			$user = get_user_by( 'email', $usr );
			if(!$user)
				return "Email is not registered";
			else
			{
				$usr = $user->user_login;
				$id = $user->id;
			}
			
		}
		else
		{
			$user = get_user_by( 'login', $usr );
			if(!$user)
				return "Username is not registered";
			$id = $user->id;
		}
		
		if(!empty($usr)) {
 
			wp_setcookie($usr, $this->passd, true);
			wp_set_current_user($id, $usr);	
			do_action('wp_login', $usr);
			return 200;
 		}
 		return $usr;
	}
}

?>