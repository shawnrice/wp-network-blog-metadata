/*! jQuery script to hide certain form fields */

jQuery(document).ready(function() {

jQuery('input[name="role"]').change(function() {
	
	if (jQuery(this).val() === "professor") {
		jQuery('.student , .staff , .purpose').fadeOut(200);
		jQuery('.student , .staff , .purpose select').val('---');
		
		setTimeout(function(){
				jQuery('.professor , .professor-staff').fadeIn(200);}, 200);		
	}
	else if (jQuery(this).val() === "student") {
		jQuery('.professor , .staff, .professor-staff , .course_website').fadeOut(200);
		// Reset some values if they were put in...
		jQuery('.professor , .staff , .professor-staff , course_website input').val('');
		jQuery('.professor , .professor-staff select').val('---');

		setTimeout(function(){
			jQuery('.student , .purpose').fadeIn(200);}, 200);
	}
	else if (jQuery(this).val() === "staff") {
		jQuery('.professor , .student').fadeOut(200);		
		// Reset some values if they were put in...
		jQuery('.course_website , .professor , .student input').val('');
		jQuery('.course_website , .student select').val('');
		setTimeout(function(){
			jQuery('.staff , .professor-staff , .purpose').fadeIn(200);}, 200);
		
	}
	jQuery('.temp').fadeIn(200);
});

jQuery('select[name="course_website"]').change(function() {
	if (jQuery(this).val() === "Yes") {
		jQuery('.purpose').fadeOut(200);
		jQuery('.purpose select').val('---');
		setTimeout(function(){
			jQuery('.course_website').fadeIn(200);}, 200);
	}
	else if (jQuery(this).val() === "No") {
		jQuery('.course_website').fadeOut(200);
		jQuery('.course_website input').val('');
		setTimeout(function(){
			jQuery('.purpose').fadeIn(200);}, 200);

		// Reset some values if they were put in...
	}
	else if (jQuery(this).val() === "") {
		jQuery('.course_website , .purpose').fadeOut(200);
		
		// Reset some values if they were put in...
		jQuery('.course_website input').val('');
		jQuery('.purpose select').val('');
	}
});

jQuery('select[name="purpose"]').change(function() {
	if (jQuery(this).val() === "other") {
		jQuery('.use_other , .use-other').fadeIn(200);		
	}
	else {
		jQuery('.use_other').fadeOut(200);
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