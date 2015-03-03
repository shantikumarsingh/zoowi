$(document).ready(function(){
	$('#login_btn, #create_btn, #forgot_btn').click(function(){
		$('#signin_form .form-group, #signup_form .required, #forgot_form .form-group').addClass('has-error');
		$('#field_error').removeClass('hide');
		$('#field_error').addClass('show');
	})
});