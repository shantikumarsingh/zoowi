$(document).ready(function(){
	$('#login_btn, #create_btn, #forgot_btn').click(function(){
		$('#signin_form .form-group, #signup_form .required, #forgot_form .form-group').addClass('has-error');
		$('#field_error').removeClass('hide');
		$('#field_error').addClass('show');
	});

	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	});

	$('#list-view').click(function(){
		$('#columns-id').removeClass('columns').addClass('columns-remove');
		$('#grid-li').removeClass('active');
		$('#list-li').addClass('active');
	});
	$('#grid-view').click(function(){
		$('#columns-id').removeClass('columns-remove').addClass('columns');
		$('#list-li').removeClass('active');
		$('#grid-li').addClass('active');
	});

});