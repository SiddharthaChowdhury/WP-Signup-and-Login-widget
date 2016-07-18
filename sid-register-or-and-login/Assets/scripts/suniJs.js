(function($) {
	
	// check if bootstrap is loaded IF NO Bring in bootstrap.
	// if( typeof $().modal == 'function' ) 

	// 	else{
	// 	var path = $('.sid-suni-Path-pl1').val();
	// 	document.write('<link rel="stylesheet" id="pl1_boot" type="text/css" href="'+path+'bootstrp_pl1.min.css">');
	// }
	// --------------- Toggle buttons ------------------
	$('.sid-suni-toggleSU-pl1-jq').click(function(e){
		e.preventDefault();
		$(this).closest('.form-parent-pl1-jq').find('.sid-suni-wrapperSI-pl1').find('.jq-text-pl1').val("") ;
		$(this).closest('.form-parent-pl1-jq').find('.sid-suni-wrapperSI-pl1').hide();
		$(this).closest('.form-parent-pl1-jq').find('.sid-suni-wrapperSU-pl1').show();
		$(this).css({'background-color': '#878787','color':'white'})
		$(this).closest('.form-parent-pl1-jq').find('.sid-suni-toggleSI-pl1-jq').css({'background-color': '#fff','color':'black'})
	})
	$('.sid-suni-toggleSI-pl1-jq').click(function(e){
		e.preventDefault();
		$(this).closest('.form-parent-pl1-jq').find('.sid-suni-wrapperSU-pl1').find('.jq-text-pl1').val("") ;
		$(this).closest('.form-parent-pl1-jq').find('.sid-suni-wrapperSU-pl1').hide();
		$(this).closest('.form-parent-pl1-jq').find('.sid-suni-wrapperSI-pl1').show();
		$(this).css({'background-color': '#878787','color':'white'})
		$(this).closest('.form-parent-pl1-jq').find('.sid-suni-toggleSU-pl1-jq').css({'background-color': '#fff','color':'black'})
	})

	// ---------------------- Password visibility/ Invisibility  -----------------------
	$('.se_unsee_pl1').click(function(e)
	{
		if($(this).data('seen') == '0')
		{
			$(this).closest('.form-parent-pl1-jq').find('.passs_pl1').prop('type', 'text');
			$(this).attr('src', $(this).closest('.form-parent-pl1-jq').find('.sid-suni-Path-pl1').val()+'Assets/images/see.png')
			$(this).data('seen', '1');
		}
		else
		{
			$(this).closest('.form-parent-pl1-jq').find('.passs_pl1').prop('type', 'password');
			$(this).attr('src', $(this).closest('.form-parent-pl1-jq').find('.sid-suni-Path-pl1').val()+'Assets/images/unsee.png')
			$(this).data('seen', '0');
		}	
	})

	// ---------------------- Password strength  -----------------------
	$('.passs_pl1').on('keyup',function(){

		console.log($(this).closest('.form-group').find('.psss_meter_pl1'))
		if ($(this).val().length == 0 ){
			$(this).closest('.form-parent-pl1-jq').find('.psss_meter_pl1').css('color','black');
			$(this).closest('.form-parent-pl1-jq').find('.psss_meter_pl1').text('No Password')
		}
		if ($(this).val().length <= 5 ){
			$(this).closest('.form-parent-pl1-jq').find('.psss_meter_pl1').css('color','#ff5333');
			$(this).closest('.form-parent-pl1-jq').find('.psss_meter_pl1').text('Weak')
		}
		else if($(this).val().length > 5 && $(this).val().length <= 9 ){
			$(this).closest('.form-parent-pl1-jq').find('.psss_meter_pl1').css('color','#ffa857');
			$(this).closest('.form-parent-pl1-jq').find('.psss_meter_pl1').text('Moderate')
		}
		else{
			$(this).closest('.form-parent-pl1-jq').find('.psss_meter_pl1').css('color','#00d11c');
			$(this).closest('.form-parent-pl1-jq').find('.psss_meter_pl1').text('Good')
		}
	})

	var error = {
		'username': 'on',
		'email': 'on'
	};
	// --------------- Username check --------------------
	$('.sid-suni-loginSU-pl1').on('blur',function(){
		var url = $('.sid-suni-Path-pl1').val();
		var self = $(this);
		var loading = url+'Assets/images/LoadingX.gif';
		var yes = url+'Assets/images/yes.png';
		var no = url+'Assets/images/no.png';

		self.closest('div.form-group').find('.check-pl1').html('<img src="'+loading+'"/>');
		var data_to_send = {}
		if(self.val().length > 3)
		{
			data_to_send['username'] = $(this).val();
			var data = {
		    	action: 'my_action',
		    	token: 'check_username_pl1',
		   		data_sent: data_to_send
		    };
		    // console.log(data)
		  	$.post(MyAjax.ajaxurl, data, function(response) {
		  		
			  	if(response == '200'){
			  		self.closest('div.form-group').find('.check-pl1').empty();
			  		self.closest('div.form-group').find('.check-pl1').html('<img src="'+yes+'"/>');
			  		$('.sid-suni-mike-pl1').empty();
			  		error['username'] = 'off';
			  	}
			  	else
			  	{
			  		self.closest('div.form-group').find('.check-pl1').empty();
			  		self.closest('div.form-group').find('.check-pl1').html('<img src="'+no+'"/>');
			  		// $('.sid-suni-mike-pl1').html('<div style="color:red;">'+response+'</div>');
			  		error['username'] = 'on';
			  	}
		  	});
		}
		else
		{
			self.closest('div.form-group').find('.check-pl1').empty();
		}
	})
	// ----------------------- Email Check ----------------------------
	$('.sid-suni-emailSU-pl1').on('blur',function(){
		var url = $('.sid-suni-Path-pl1').val();
		var self = $(this);
		var loading = url+'Assets/images/LoadingX.gif';
		var yes = url+'Assets/images/yes.png';
		var no = url+'Assets/images/no.png';

	self.closest('div.form-group').find('.check-pl1').html('<img src="'+loading+'"/>');
		var data_to_send = {}
		if(self.val().length > 3)
		{
			data_to_send['email'] = $(this).val();
			var data = {
		    	action: 'my_action',
		    	token: 'check_email_pl1',
		   		data_sent: data_to_send
		    };
		  	$.post(MyAjax.ajaxurl, data, function(response) {
			  	if(response == '200'){
			  		self.closest('div.form-group').find('.check-pl1').empty();
			  		self.closest('div.form-group').find('.check-pl1').html('<img src="'+yes+'"/>');
			  		$('.sid-suni-mike-pl1').empty();
			  		error['email'] = 'off';
			  	}
			  	else
			  	{
			  		self.closest('div.form-group').find('.check-pl1').empty();
			  		self.closest('div.form-group').find('.check-pl1').html('<img src="'+no+'"/>');
			  		// $('.sid-suni-mike-pl1').html('<div style="color:red;">'+response+'</div>');
			  		error['email'] = 'on';
			  	}
		  	});
		}
		else
		{
			self.closest('div.form-group').find('.check-pl1').empty();
		}
	})


	

	// //--------------------- Signup submit -----------------------------
	// $('.sid-suni-submitSU-pl1').click(function(e){
	// 	e.preventDefault();
	// 	var err = 0;
	// 	$.each(error, function(key, val){
	// 		if(val == 'on')
	// 			err = 1;
	// 	})
	// 	if(err == 0)
	// 	{
	// 		if($( "input[name='sid_suni_isAjxSU_pl1']" ).val() == 'off')
	// 		{
	// 			$(this).closest('form').submit();
	// 		}
	// 		else
	// 		{
	// 			var self = $(this);
	// 			var form = self.closest('form');
	// 			var data_to_send = {}

	// 			form.find('.jq-input-pl1').each(function(){
	// 				data_to_send[$(this).attr('name')] = $(this).val();
	// 			})
				
	// 			$('.sid-suni-overlay').show();
	// 			var data = {
	// 		    	action: 'my_action',
	// 		    	token: 'register_user',
	// 		   		data_sent: data_to_send
	// 		    };
	// 		  	$.post(MyAjax.ajaxurl, data, function(response) {
	// 		  		console.log(response);
	// 		  		$('.sid-suni-overlay').show();
	// 			  	if(response == '200'){
	// 			  		$('.sid-suni-container-pl1').empty();
	// 			  		$('.sid-suni-container-pl1').html('<div>Welcome DUDE</div>');

	// 			  	}
	// 			  	else
	// 			  	{
	// 			  		$('.sid-suni-mike-pl1').html('<div>ERRORDSSSS</div>');
	// 			  	}
	// 		  	},'json').responseJSON;
	// 		}
	// 	}
	// 	else
	// 	{
	// 		console.table(error);
	// 	}
	// })

	// $('.sid-suni-submitSI-pl1').click(function(r){
	// 	r.preventDefault();
	// 	var flag = 0;
	// 	var self = $(this);
	// 	var data_to_send = {};
	// 	var form = self.closest('form');
	// 	form.find('.jq-input-pl1').each(function(){
	// 		if($(this).val() != "")
	// 			data_to_send[$(this).attr('name')] = $(this).val();
	// 		else
	// 			flag ++;
	// 	})
	// 	console.log(data_to_send);
	// 	if(flag < 1)
	// 	{
	// 		$('.sid-suni-overlay').show();
	// 		if($( "input[name='sid_suni_isAjxSI_pl1']" ).val() == 'off')
	// 			$(this).closest('form').submit();
	// 		else
	// 		{
	// 			var data = {
	// 		    	action: 'my_action',
	// 		    	token: 'login_user',
	// 		   		data_sent: data_to_send
	// 		    };
	// 		    $('.sid-suni-overlay').show();
	// 		  	$.post(MyAjax.ajaxurl, data, function(response) {
	// 		  		console.log(response);
	// 			  	if(response == '200'){
	// 			  		$('.sid-suni-container-pl1').empty();
	// 			  		$('.sid-suni-container-pl1').html('<div>Welcome DUDE</div>');
	// 			  	}
	// 			  	else
	// 			  	{
	// 			  		$('.sid-suni-mike-pl1').html('<div>'+response+'</div>');
	// 			  		$('.sid-suni-overlay').hide();
	// 			  	}
	// 		  	});
	// 		}
	// 	}
	// })

})(jQuery);