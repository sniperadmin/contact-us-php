/* global $, document */


$(document).ready(function($) {
	
	'use strict';
	// General Variables
	var userError = true,
		customError = true,
		phoneError = true;
	// for testing only
	function errorChecker () {
		if (userError === true || customError === true || phoneError === true) {
			console.log('Form not Completed!');
		} else {
			console.log('Form Valid');
		}
	}
	//-------------------------------------------------
	
	// Adding font-awesome icons in each input field
	$('<i class="fas fa-user icon"></i>').insertBefore('#user-field');
	$('<i class="fas fa-envelope-open-text"></i>').insertBefore('#mail-field');
	$('<i class="fas fa-phone"></i>').insertBefore('#phone-field');
	
	// playing with placeholders in input fields //
	// -> cashing placeholder value and hiding it within focus
	var cashedAttr = '';
	$('[placeholder]').focus(function () {
		cashedAttr = $(this).attr('placeholder');// cashing....
		$(this).attr('placeholder', '');//hiding...
	}).blur(function (){//moving out...
		$(this).attr('placeholder', cashedAttr);//getting back cashed value
	});
	
	// ******** Adding asterisk to the required fields ******** //
	$('<span class="asterisk">*</span>').insertAfter(':input[required]');
	//styling asterisk
	$('.asterisk').parent('div').css('position', 'relative');
	// styles for each asterisk
	$('.asterisk').each(function () {
		$('.asterisk').css({
			'position': 'absolute',
			'top': 5,
			'left': $(this).parent('div').find(':input').innerWidth() - 10,
			'color': '#F00'
		});
	});
	
	// ********** styling fields with colors and checking animations ********** //
	// #user-field
	// adding guide errors
	$('#user-field').blur(function () {
		if ($(this).val().length < 4) {
			$(this).css('border', '1px solid #f00').parent().find('.asterisk').fadeIn(100).parent().find('.name-error').fadeIn(100).css('display', 'block');
			userError = true;
		} else {
			$(this).css('border', '1px solid #080').parent().find('.asterisk').fadeOut(100).parent().find('.name-error').fadeOut(200);
			userError = false;
		}
		errorChecker();
	});
	
	//empty mail error
	function emptyError() {
		$('.empty').blur(function () {
			if ($(this).val().length < 1) {
			$(this).css('border', '1px solid #f00').parent().find('.asterisk').fadeIn(100).parent().find('.error').html('This cannot be empty!').fadeIn(100).css('display', 'block');
				customError = true;
			} else {
				$(this).css('border', '1px solid #080').parent().find('.asterisk').fadeOut(100).parent().find('.error').fadeOut(200);
				customError = false;
			}
			errorChecker();
		});
	}
	emptyError();
	
	
	
	// #phone-field
	$('#phone-field').blur(function () {
		if ($(this).val().length < 1) {
			$(this).css('border', '1px solid #f00').parent().find('.asterisk').fadeIn(100).parent().find('.phone-error').fadeIn(100).css('display', 'block');
			phoneError = true;
		} else {
			$(this).css('border', '1px solid #080').parent().find('.asterisk').fadeOut(100).parent().find('.phone-error').fadeOut(200);
			phoneError = false;
		}
		errorChecker();
	});


	//submit Validation
	$('.contact-me').submit(function (e) {
		if (userError === true || customError === true || phoneError === true) {
			e.preventDefault();
			$('#user-field, #mail-field, #phone-field').blur();
		}
	});
	
});