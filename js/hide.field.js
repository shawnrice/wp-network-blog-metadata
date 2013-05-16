/*! jQuery script to hide certain form fields */

jQuery(document).ready(function() {

jQuery('input[name="role"]').change(function() {
	
	if (jQuery(this).val() === "professor") {
		jQuery('.professor , .professor-staff').show('drop');
		jQuery('.student , .staff , .purpose').hide('drop');
		jQuery('.student , .staff , .purpose select').val('---');
		
	}
	else if (jQuery(this).val() === "student") {
		jQuery('.student , .purpose').show('drop');
		jQuery('.professor , .staff, .professor-staff , .course_website').hide('drop');

		// Reset some values if they were put in...
		jQuery('.professor , .staff , .professor-staff , course_website input').val('');
		jQuery('.professor , .professor-staff select').val('---');

	}
	else if (jQuery(this).val() === "staff") {
		jQuery('.staff , .professor-staff , .purpose').show('drop');
		jQuery('.professor , .student').hide('drop');
		
		// Reset some values if they were put in...
		jQuery('.course_website , .professor , .student input').val('');
		jQuery('.course_website , .student select').val('');
		
	}
});

jQuery('select[name="course_website"]').change(function() {
	if (jQuery(this).val() === "Yes") {
		jQuery('.course_website').show('drop');
		jQuery('.purpose').hide('drop');
		jQuery('.purpose select').val('---');
	}
	else if (jQuery(this).val() === "No") {
		jQuery('.course_website').hide('drop');
		jQuery('.purpose').show('drop');

		// Reset some values if they were put in...
		jQuery('.course_website input').val('');
	}
	else if (jQuery(this).val() === "") {
		jQuery('.course_website , .purpose').hide('drop');
		
		// Reset some values if they were put in...
		jQuery('.course_website input').val('');
		jQuery('.purpose select').val('');
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