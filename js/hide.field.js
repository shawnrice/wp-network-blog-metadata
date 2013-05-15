/*! jQuery script to hide certain form fields */

jQuery(document).ready(function() {

jQuery('input[name="role"]').change(function() {
	
	if (jQuery(this).val() === "professor") {
		jQuery('.professor').show('drop');
		jQuery('.student , .staff').hide('drop');
		
	}
	else if (jQuery(this).val() === "student") {
		jQuery('.student').show('drop');
		jQuery('.professor , .staff').hide('drop');
		jQuery('.purpose').show('drop');
		jQuery('.course_website').hide('drop');
		jQuery('.course_website input').val('');
	}
	else if (jQuery(this).val() === "staff") {
		jQuery('.staff').show('drop');
		jQuery('.professor , .student').hide('drop');
		jQuery('.department').show('drop');
		jQuery('.purpose').show('drop');
		jQuery('.course_website input').val('');
	}
});

jQuery('input[name="course_website"]').change(function() {
	if (jQuery(this).val() === "true") {
		jQuery('.course_website').show('drop');
		jQuery('.purpose').hide('drop');
	}
	else if (jQuery(this).val() === "false") {
		jQuery('.course_website').hide('drop');
		jQuery('.purpose').show('drop');
	}
});
jQuery('select[name="use"]').change(function() {
	if (jQuery(this).val() === "other") {
		jQuery('#use-other').show('drop');
	}
	else {
		jQuery('#use-other').hide('drop');
	}
});

function resetValues(type , name) {
	
	if (type === 'input') {
		a = type + '[name="' + name + '"]';
		jQuery(a).attr('checked',false);
	}
	if (type === 'text') {
		a = 'input[type=text].'+name+'';
//		alert(a);
		jQuery(a).val('');
	}
};
/*
jQuery('input[name="role"]').change(function() {
   jQuery('.professor, .student, .staff').fadeOut(150);
   jQuery('.' + jQuery(this).val()).show('drop' , '' , 1250);
});


jQuery('input[name="course_website"]').change(function() {
	if (jQuery(this).val() === 'true') {
		jQuery('.course_website').fadeIn(150);
	}
	else if (jQuery(this).val() === 'false') {
		jQuery('.course_website').fadeOut(150);
	}
}); */

});