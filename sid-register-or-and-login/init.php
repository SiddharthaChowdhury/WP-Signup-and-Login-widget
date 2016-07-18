<?php

class sid_suni_wiz_pl1 extends WP_Widget {
 
    function __construct() {
		parent::__construct(
			'SidWidz', // Base ID
			'Sid Register and Login ', // Name
			array( 'description' => 'Embrace a highly advanced Register and Login Wizard by Mr.Sidd.', ) // Args
		);
	}

    function widget($args, $instance) {	
    	extract($args);
    	extract($instance);
      
      global $sid_pl1_dir;
      global $sid_myResources_pl1;
      $sid_myResources_pl1 = true;
    	
      $title = apply_filters('widget_title', $instance['title']);
    	// print_r($instance);
        echo $before_widget; 
        if(!is_user_logged_in())
        {
          if ($title) 
          	echo $before_title . $title . $after_title;
          ?>

          <div class="form-parent-pl1-jq">
              <input type="hidden" value="<?php echo $sid_pl1_dir; ?>" class="sid-suni-Path-pl1"/>
              <!-- Top nav-bar -->
              <div class="col-md-12">
                  <nav class="col-md-11">
                      <ul class="nav navbar-nav pull-right">
                          <?php if(!empty($ynsignup) && !empty($ynsignin)) { ?>
                              <li><a href="#" class="sid-suni-toggleSU-pl1-jq"><?php if(!empty($toglSUbtn)) echo $toglSUbtn; else echo 'Register'; ?></a></li>
                              <li><a href="#" class="sid-suni-toggleSI-pl1-jq"><?php if(!empty($toglSIbtn)) echo $toglSIbtn; else echo 'Login'; ?></a></li>
                          <?php } ?>
                      </ul>
                  </nav>
              </div>
              
              <!-- Body -->
              <?php if(!empty($ynsignup)) { ?>
                  <div class="col-md-12 sid-suni-wrapperSU-pl1" style="display:<?php if(empty($ynsignin)) echo 'block'; else echo 'none'; ?>">
                      <div class="col-md-12">
                          <form method="post">
                              <input type="hidden" name="sid_suni_RegisterNonce_pl1" class="jq-input-pl1" value="<?php echo wp_create_nonce('sid-suni-RegisterNonce-pl1'); ?>"/>
                              <div class="form-group checkPh_pl1">
                                  <label for="fullName_pl1">Full Name</label>
                                  <input type="text" class="form-control jq-text-pl1" id="fullName_pl1" name="sid_suni_fullnameSU_pl1">
                              </div>  
                              <div class="form-group">
                                  <label for="userName_pl1"><?php if(!empty($loginPH)) echo $loginPH; else echo 'Username'; ?></label>
                                  &nbsp;&nbsp;<span class="check-pl1"></span>
                                  <input type="text" class="form-control jq-text-pl1 sid-suni-loginSU-pl1" id="userName_pl1" name="sid_suni_loginSU_pl1">
                              </div>
                              <div class="form-group">
                                  <label for="email_pl1"><?php if(!empty($emailPH)) echo $emailPH; else echo 'Email'; ?></label>
                                  &nbsp;&nbsp;<span class="check-pl1"></span>
                                  <input type="email" class="form-control jq-text-pl1 sid-suni-emailSU-pl1" id="email_pl1" name="sid_suni_emailSU_pl1">
                              </div>
                              <div class="form-group">
                                  <label class="psss_meter_pl1" for="pass_pl1"><?php if(!empty($passPH)) echo $passPH; else echo 'Password'; ?></label>
                                  &nbsp;&nbsp;<img data-seen="0" class="se_unsee_pl1" src="<?php echo $sid_pl1_dir; ?>/Assets/images/unsee.png">
                                  <input type="password" class="form-control jq-text-pl1 passs_pl1 sid_suni_passSU_pl1" id="pass_pl1" placeholder="Enter Password" name="sid_suni_passSU_pl1">
                              </div>
                              <div class="small_font_pl1"><?php if(!empty($tnccaption)) echo $tnccaption; else echo 'By registering you agree to our'; ?>  <a href="<?php if(!empty($tncUri)) echo $tncUri; else echo '#'; ?>"><?php if(!empty($tnclabel)) echo $tnclabel; else echo 'terms and conditions'; ?></a></div>
                              <div><input type="submit" value="<?php if(!empty($regBtn)) echo $regBtn; else echo 'Create Account'; ?>" class="btn btn-info"/></div>
                          </form>
                      </div>        
                  </div>        
              <?php } ?>
              <?php if(!empty($ynsignin)) { ?>
                <div class="col-md-12 sid-suni-wrapperSI-pl1">
                    <div class="col-md-12">
                        <form method="post">
                            <input type="hidden" name="sid_suni_LoginNonce_pl1" class="jq-input-pl1" value="<?php echo wp_create_nonce('sid-suni-LoginNonce-pl1'); ?>"/>
                            <div class="form-group">
                                <label for="userLogin"><?php if(!empty($usrnmPH)) echo $usrnmPH; else echo 'Username / Email'; ?></label>
                                <input type="text" class="form-control jq-text-pl1" id="userLogin" name="sid_suni_loginSI_pl1">
                            </div>
                            <div class="form-group">
                                <label for="password"><?php if(!empty($hashPH)) echo $hashPH; else echo 'Password'; ?></label>
                                <input type="password" class="form-control jq-text-pl1" id="password" name="sid_suni_passSI_pl1">
                            </div>
                          <div class="small_font_pl1">By default you will be remembered in this machine.</div>
                          <div><input type="submit" value="<?php if(!empty($loginBtn)) echo $loginBtn; else echo 'Login'; ?>" class="btn btn-info"/></div>
                        </form>
                    </div>
                </div>
            <?php } ?>
          </div>
          <?php
        }
        else
        {
          if ($title) 
            echo $before_title . $title . $after_title;
          ?>
            <div>
              <div>
                <?php echo get_bloginfo('name'); ?> 
                  welcomes you 
                <?php global $current_user;
                  get_currentuserinfo();
                  echo $current_user->user_login;
                ?>
              </div>
            </div>
            <div>
              <a href="<?php echo wp_logout_url(home_url()); ?>">Logout ?</a>
            </div>
          <?php
        }
        echo $after_widget; 
    }
 
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['ynsignup'] = strip_tags($new_instance['ynsignup']);
		$instance['ynsignin'] = strip_tags($new_instance['ynsignin']);
		// $instance['ynAjxsignup'] = strip_tags($new_instance['ynAjxsignup']);
		// $instance['ynAjxsignin'] = strip_tags($new_instance['ynAjxsignin']);
		$instance['toglSIbtn'] = strip_tags($new_instance['toglSIbtn']);
		$instance['toglSUbtn'] = strip_tags($new_instance['toglSUbtn']);

		// ------------------------ Sign up ---------------------
		$instance['loginPH'] = strip_tags($new_instance['loginPH']);
		$instance['emailPH'] = strip_tags($new_instance['emailPH']);
		$instance['passPH'] = strip_tags($new_instance['passPH']);
		$instance['tncUri'] = strip_tags($new_instance['tncUri']);
		$instance['tnclabel'] = strip_tags($new_instance['tnclabel']);
		$instance['tnccaption'] = strip_tags($new_instance['tnccaption']);
		$instance['regBtn'] = strip_tags($new_instance['regBtn']);
		// $instance['radio_buttons'] = $new_instance['radio_buttons'];

		// ------------------------ Sign up ---------------------
		$instance['usrnmPH'] = strip_tags($new_instance['usrnmPH']);
		$instance['hashPH'] = strip_tags($new_instance['hashPH']);
		$instance['loginBtn'] = strip_tags($new_instance['loginBtn']);
		
        return $instance;
    }
 
    function form($instance) {	
    // echo '<pre>'.print_r($instance).'</pre>';
      $is_empty = true; 
    if(!empty($instance))
      $is_empty = false;
 		extract($instance);
        ?>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Section Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $title; else echo "Default"; ?>" />
        </p>
        <p>
	       <div>
	       		<input id="<?php echo $this->get_field_id('ynsignup'); ?>" name="<?php echo $this->get_field_name('ynsignup'); ?>" type="checkbox" value="1" <?php $ynsignup = ($is_empty == false) ? $ynsignup : '0'; checked( '1', $ynsignup ); ?> />
	          	<span>REGISTRATION (enable Registration?)</span>
	       </div> 
	       <div >
	       		<input id="<?php echo $this->get_field_id('ynsignin'); ?>" name="<?php echo $this->get_field_name('ynsignin'); ?>" type="checkbox" value="1" <?php $ynsignin = ($is_empty == false) ? $ynsignin : '0'; checked( '1', $ynsignin ); ?> />
	          	<span>LOGIN (enable Login?)</span>
	       </div>
        </p>
        <hr>
        
        <p>
          <label for="<?php echo $this->get_field_id('toglSUbtn'); ?>"><?php _e('Signup Button text: (Of toggle MENU)'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('toglSUbtn'); ?>" name="<?php echo $this->get_field_name('toglSUbtn'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $toglSUbtn; else echo "Default"; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('toglSIbtn'); ?>"><?php _e('Signin Button text: (Of toggle MENU)'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('toglSIbtn'); ?>" name="<?php echo $this->get_field_name('toglSIbtn'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $toglSIbtn; else echo "Default"; ?>" />
        </p>

        <hr>
        	<div style="font-size:18px; text-align:center; color:green;">SignUP Settings</div>
        <hr>
        <!--==========================================================  Sign Up settings ===========================================================-->
        <p>
          <label for="<?php echo $this->get_field_id('loginPH'); ?>"><?php _e('Username Placeholder:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('loginPH'); ?>" name="<?php echo $this->get_field_name('loginPH'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $loginPH; else echo "Default"; ?>"  />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('emailPH'); ?>"><?php _e('Email Placeholder:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('emailPH'); ?>" name="<?php echo $this->get_field_name('emailPH'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $emailPH; else echo "Default"; ?>"  />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('passPH'); ?>"><?php _e('Password Placeholder:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('passPH'); ?>" name="<?php echo $this->get_field_name('passPH'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $passPH; else echo "Default"; ?>"  />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('tncUri'); ?>"><?php _e('Terms and Conditions URL:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('tncUri'); ?>" name="<?php echo $this->get_field_name('tncUri'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $tncUri; else echo "Default"; ?>"  />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('tnclabel'); ?>"><?php _e('Terms and Conditions Link name:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('tnclabel'); ?>" name="<?php echo $this->get_field_name('tnclabel'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $tnclabel; else echo "Default"; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('tnccaption'); ?>"><?php _e('Terms and Conditions Label:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('tnccaption'); ?>" name="<?php echo $this->get_field_name('tnccaption'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $tnccaption; else echo "Default"; ?>"  />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('regBtn'); ?>"><?php _e('Register button text:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('regBtn'); ?>" name="<?php echo $this->get_field_name('regBtn'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $regBtn; else echo "Default"; ?>"  />
        </p>
        <p>
        <?php
          // $radio_buttons = ($is_empty == false) ? $radio_buttons : '0';
        ?>
	       <!-- <div>
	       		<input class="" id="<?php echo $this->get_field_id('activation_option_1'); ?>" name="<?php echo $this->get_field_name('radio_buttons'); ?>" type="radio" value="1" <?php if($radio_buttons === '1'){ echo 'checked="checked"'; } ?> />
	          	<span>Enable EMAIL activation</span>
	       </div> 
	       <div>
	      		<input class="" id="<?php echo $this->get_field_id('activation_option_2'); ?>" name="<?php echo $this->get_field_name('radio_buttons'); ?>" type="radio" value="2" <?php if($radio_buttons === '2'){ echo 'checked="checked"'; } ?> />
	          	<span>Enable ADMIN activation</span>
	       </div>
	       <div >
	       		<input class="" id="<?php echo $this->get_field_id('activation_option_3'); ?>" name="<?php echo $this->get_field_name('radio_buttons'); ?>" type="radio" value="0" <?php if($radio_buttons === '0'){ echo 'checked="checked"'; } ?> />
	          	<span>Keep it simple</span>
	       </div> -->
        </p>
        <hr>
        	<div style="font-size:18px; text-align:center; color:green;">SignIN Settings</div>
        <hr>
        <!--==========================================================  Sign in settings ===========================================================-->
        <p>
          <label for="<?php echo $this->get_field_id('usrnmPH'); ?>"><?php _e('Username Placeholder:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('usrnmPH'); ?>" name="<?php echo $this->get_field_name('usrnmPH'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $usrnmPH; else echo "Default"; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('hashPH'); ?>"><?php _e('Password Placeholder:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('hashPH'); ?>" name="<?php echo $this->get_field_name('hashPH'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $hashPH; else echo "Default"; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('loginBtn'); ?>"><?php _e('Login button text:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('loginBtn'); ?>" name="<?php echo $this->get_field_name('loginBtn'); ?>" type="text" placeholder="<?php if($is_empty == false) echo $loginBtn; else echo "Default"; ?>" />
        </p>
        <?php 
    }
}
?>