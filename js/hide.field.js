/*! jQuery script to hide certain form fields */

jQuery(document).ready(function() {

jQuery('input[name="role"]').change(function() {
	
	if (jQuery(this).val() === "professor") {
		jQuery('.professor , .professor-staff').fadeIn(500);
		jQuery('.student , .staff , .purpose').fadeOut(500);
		jQuery('.student , .staff , .purpose select').val('---');
		
	}
	else if (jQuery(this).val() === "student") {
		jQuery('.student , .purpose').fadeIn(500);
		jQuery('.professor , .staff, .professor-staff , .course_website').fadeOut(500);

		// Reset some values if they were put in...
		jQuery('.professor , .staff , .professor-staff , course_website input').val('');
		jQuery('.professor , .professor-staff select').val('---');

	}
	else if (jQuery(this).val() === "staff") {
		jQuery('.staff , .professor-staff , .purpose').fadeIn(500);
		jQuery('.professor , .student').fadeOut(500);
		
		// Reset some values if they were put in...
		jQuery('.course_website , .professor , .student input').val('');
		jQuery('.course_website , .student select').val('');
		
	}
	jQuery('.temp').fadeIn(500);
});

jQuery('select[name="course_website"]').change(function() {
	if (jQuery(this).val() === "Yes") {
		jQuery('.course_website').fadeIn(500);
		jQuery('.purpose').fadeOut(500);
		jQuery('.purpose select').val('---');
	}
	else if (jQuery(this).val() === "No") {
		jQuery('.course_website').fadeOut(500);
		jQuery('.purpose').fadeIn(500);

		// Reset some values if they were put in...
		jQuery('.course_website input').val('');
	}
	else if (jQuery(this).val() === "") {
		jQuery('.course_website , .purpose').fadeOut(500);
		
		// Reset some values if they were put in...
		jQuery('.course_website input').val('');
		jQuery('.purpose select').val('');
	}
});
jQuery('select[name="use"]').change(function() {
	if (jQuery(this).val() === "other") {
		jQuery('#use-other').fadeIn(500);
	}
	else {
		jQuery('#use-other').fadeOut(500);
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