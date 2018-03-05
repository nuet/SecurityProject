/* start page singup */
var Days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];// index => month [0-11]
$(document).ready(function () {
	'use strict';
	if ($('section').hasClass('form_input')) { //page signup
		var option = '', i = 0;
		for (i = 1; i <= Days[0]; i++) { //add option days
			option += '<option value="' + i + '">' + i + '</option>';
		}
		$('#day').append(option);
		$('#day').val(selectedDay);

		option = '';
		for (i = 1; i <= 12; i++) {
			option += '<option value="' + i + '">' + i + '</option>';
		}
		$('#month').append(option);
		$('#month').val(selectedMon);

		var d = new Date();
		option = '';
		for (i = 1930; i <= d.getFullYear(); i++){// years start 1930
			option += '<option value="'+ i + '">' + i + '</option>';
		}
		$('#year').append(option);
		$('#year').val(selectedYear);
	}
	
	$("#form_pass").submit(function(e){
		var $pass1 = Invalid_password(document.getElementById("inputPassWord"));
		var $pass2 = Invalid_password2(document.getElementById("inputPassWord2"));
		console.log($pass1 +"  "+$pass2);
		if( $pass1 && $pass2 )
		{
			
		}
		else{
			e.preventDefault(); 
		}
	});
});

function isLeapYear(year) {
	year = parseInt(year);
	if (year % 4 != 0) {
	  return false;
	} else if (year % 400 == 0) {
	  return true;
	} else if (year % 100 == 0) {
	  return false;
	} else {
	  return true;
	}
}

function change_year(select)
{
	if( isLeapYear( $(select).val() ) )
	{
		Days[1] = 29;
		if( $("#month").val() == 2)
		{
			var day = $('#day');
			var val = $(day).val();
			$(day).empty();
			var option = '';
			for (var i=1;i <= Days[1];i++){ //add option days
				option += '<option value="'+ i + '">' + i + '</option>';
			}
			$(day).append(option);
			if( val > Days[ month ] )
			{
				val = 1;
			}
			$(day).val(val);
		}
	}
	else {
		Days[1] = 28;
	}
}

function change_month(select) {
	var day = $('#day');
	var val = $(day).val();
	$(day).empty();
	var option = '';
	var month = parseInt( $(select).val() ) - 1;
    for (var i=1;i <= Days[ month ];i++){ //add option days
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $(day).append(option);
	if( val > Days[ month ] )
	{
		val = 1;
	}
	$(day).val(val);
}

function InvalidMsg(textbox) {
	var $input, $Span,$small;
	$input = $(textbox);
	$Span  = $input.parent().prev().children('span');
	$small = $input.parent().parent().parent().next().children().children().children("small");
	if (textbox.validity.valueMissing) {
		textbox.setCustomValidity(' ');
		if ($input.hasClass('is-valid')) {
			$input.removeClass('is-valid');
		}
		if ($input.hasClass('is-invalid')) {
			$input.removeClass('is-invalid');
		}
		if ($Span.hasClass('_valid')) {
			$Span.removeClass('_valid').addClass('_invalid');
		}
		if ($small.hasClass('_HelpInvalid')) {
			$small.removeClass('_HelpInvalid').addClass('_HelpValid');
		}
	}
	else if(textbox.validity.patternMismatch || textbox.validity.typeMismatch){//pattren is true
		textbox.setCustomValidity(' ');
		$input.removeClass('is-valid').addClass('is-invalid');
		$Span.removeClass('_valid').addClass('_invalid');
		$small.removeClass('_HelpValid').addClass('_HelpInvalid');
	}    
	else {
		textbox.setCustomValidity('');
		$input.removeClass('is-invalid').addClass('is-valid');
		$Span.removeClass('_invalid').addClass('_valid');
		$small.removeClass('_HelpInvalid').addClass('_HelpValid');
	}
	return true;
}
function Invalid_name(textbox) {
	var $input, $Span, $small;
	$input = $(textbox);
	$Span = $input.parent().parent().parent().prev().children('span');
	//$small = $input.parent().parent().parent().parent().next().children().children("small");
	if (textbox.validity.valueMissing) {
		textbox.setCustomValidity(' ');
		if ($input.hasClass('is-valid')) {
			$input.removeClass('is-valid');
		}
		if ($input.hasClass('is-invalid')) {
			$input.removeClass('is-invalid');
		}
		if ($Span.hasClass('_valid')) {
			$Span.removeClass('_valid').addClass('_invalid');
		}
		//if ($small.hasClass('_HelpInvalid')) {
		//	$small.removeClass('_HelpInvalid').addClass('_HelpValid');
		//}
	}
	else if(textbox.validity.patternMismatch || textbox.validity.typeMismatch){//pattren is true
		textbox.setCustomValidity(' ');
		$input.removeClass('is-valid').addClass('is-invalid');
		$Span.removeClass('_valid').addClass('_invalid');
		//$small.removeClass('_HelpValid').addClass('_HelpInvalid');
	}    
	else {
		textbox.setCustomValidity('');
		$input.removeClass('is-invalid').addClass('is-valid');
		$Span.removeClass('_invalid').addClass('_valid');
		//$small.removeClass('_HelpInvalid').addClass('_HelpValid');
	}
	return true;
}

function addInput(button)
{
	var input = $(button).parent().prev();
	$(button).attr("onclick","delInput(this)")
		     .removeClass('btn-info')
		     .addClass('btn-danger')
	         .text("-");
	var Add = $("<input type=\"text\" name=\"" + $(input).attr("name") + "\" class=\"col form-control form-control-lg\" id=\"" + $(input).attr("id") + "2\" pattern=\"^\\s*([\\u0621-\\u064A]{2,10})\\s*$\" value=\"\" placeholder=\"بقية الاسم المركب\" onchange=\"Invalid_name(this)\" oninvalid=\"Invalid_name(this)\" required />");
	$(input).after(Add);
}
function delInput(button)
{
	var input = $(button).parent().prev();
	$(button).attr("onclick","addInput(this)")
		     .removeClass('btn-danger')
		     .addClass('btn-info')
	         .text("+");
	$(input).remove();
}

/* end page singup */

/* start page password */


function Invalid_password(textbox)//
{
	var $input = $(textbox);
	var $Span  = $input.parent().prev().children('span');
	var str	   =  $input.val();
	var pattrn = new RegExp("[^a-zA-Z0-9_\.,`';@?:#\$%&!\+-]","g");
	var patt1  = new RegExp("[a-z]","g");
	var patt2  = new RegExp("[A-Z]","g");
	var patt3  = new RegExp("[0-9]","g");
	var patt4  = new RegExp("[_\.,`';@?:#\$%&!\+-]","g");
	
	if(str.length < 6 || str.length > 16 || textbox.validity.valueMissing )
	{
		if($input.hasClass('is-valid'))
			$input.removeClass('is-valid');
		$input.addClass('is-invalid');
		if ($Span.hasClass('_valid'))
			$Span.removeClass('_valid');
		$Span.addClass('_invalid');
		textbox.setCustomValidity('');
		$input.focus();
		return false;
	}
	else if( pattrn.test(str) )
	{
		if($input.hasClass('is-valid'))
			$input.removeClass('is-valid');
		$input.addClass('is-invalid');
		if ($Span.hasClass('_valid'))
			$Span.removeClass('_valid');
		$Span.addClass('_invalid');
		$input.focus();
		return false;
	}
	else if( !patt1.test(str) || !patt2.test(str) || !patt3.test(str) || !patt4.test(str) )
	{
		if($input.hasClass('is-valid'))
			$input.removeClass('is-valid');
		$input.addClass('is-invalid');
		if ($Span.hasClass('_valid'))
			$Span.removeClass('_valid');
		$Span.addClass('_invalid');
		$input.focus();
		return false;
	}
	else
	{
		for(var i=0;i<str.length-1;i++)
		{
			pattrn = new RegExp("["+ str.charAt(i) +"]","ig");
			if(pattrn.test(str.substr(i+1)))
			{
				if($input.hasClass('is-valid'))
					$input.removeClass('is-valid');
				$input.addClass('is-invalid');
				if ($Span.hasClass('_valid'))
					$Span.removeClass('_valid');
				$Span.addClass('_invalid');
				$input.focus();
				return false;
			}
		}
		if($input.hasClass('is-invalid'))
			$input.removeClass('is-invalid');
		$input.addClass('is-valid');
		if ($Span.hasClass('_invalid'))
			$Span.removeClass('_invalid');
		$Span.addClass('_valid');
	
	}
	return true;
}

function Invalid_password2(textbox)
{
	var $input 	 = $(textbox);
	var val	   	 = $input.val();
	var password = $("#inputPassWord").val();
	
	var $Span  	 = $input.parent().prev().children('span');
	if ( textbox.validity.valueMissing )
	{
		if ($Span.hasClass('_valid'))
			$Span.removeClass('_valid');
		$Span.addClass('_invalid');
		textbox.setCustomValidity('');
		$input.focus();
		return false;
	}
	else if( val != password )
	{
		if($input.hasClass('is-valid'))
			$input.removeClass('is-valid');
		$input.addClass('is-invalid');
		if ($Span.hasClass('_valid'))
			$Span.removeClass('_valid');
		$Span.addClass('_invalid');
		$input.focus();
		return false;
	}
	else{
		if($input.hasClass('is-invalid'))
			$input.removeClass('is-invalid');
		$input.addClass('is-valid');
		if ($Span.hasClass('_invalid'))
			$Span.removeClass('_invalid');
		$Span.addClass('_valid');
		return true;
	}
}


/* end page password */
