/*! jQuery script to hide certain form fields */

jQuery(document).ready(function() {

jQuery('input[name="role"]').change(function() {
	
	if (jQuery(this).val() === "professor") {
		jQuery('.professor , .professor-staff').fadeIn(350);
		jQuery('.student , .staff , .purpose').fadeOut(350);
		jQuery('.student , .staff , .purpose select').val('---');
		
	}
	else if (jQuery(this).val() === "student") {
		jQuery('.student , .purpose').fadeIn(350);
		jQuery('.professor , .staff, .professor-staff , .course_website').fadeOut(350);

		// Reset some values if they were put in...
		jQuery('.professor , .staff , .professor-staff , course_website input').val('');
		jQuery('.professor , .professor-staff select').val('---');

	}
	else if (jQuery(this).val() === "staff") {
		jQuery('.staff , .professor-staff , .purpose').fadeIn(350);
		jQuery('.professor , .student').fadeOut(350);
		
		// Reset some values if they were put in...
		jQuery('.course_website , .professor , .student input').val('');
		jQuery('.course_website , .student select').val('');
		
	}
	jQuery('.temp').fadeIn(350);
});

jQuery('select[name="course_website"]').change(function() {
	if (jQuery(this).val() === "Yes") {
		jQuery('.course_website').fadeIn(350);
		jQuery('.purpose').fadeOut(350);
		jQuery('.purpose select').val('---');
	}
	else if (jQuery(this).val() === "No") {
		jQuery('.course_website').fadeOut(350);
		jQuery('.purpose').fadeIn(350);

		// Reset some values if they were put in...
		jQuery('.course_website input').val('');
	}
	else if (jQuery(this).val() === "") {
		jQuery('.course_website , .purpose').fadeOut(350);
		
		// Reset some values if they were put in...
		jQuery('.course_website input').val('');
		jQuery('.purpose select').val('');
	}
});

jQuery('select[name="purpose"]').change(function() {
	if (jQuery(this).val() === "other") {
		jQuery('.use_other , .use-other').fadeIn(350);		
	}
	else {
		jQuery('.use_other').fadeOut(350);
	}
});

function resetValues(type , name) {
	
	if (type === 'input') {
		a = type + '[name="' + name + '"]';
		jQuery(a).attr('checked',false);
	}
	if (type === 'text') {
		a = 'input[type=text].'+name+'';
		jQuery(a).val('');
	}
};

});