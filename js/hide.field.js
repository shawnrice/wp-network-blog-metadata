/*! $ script to hide certain form fields */

(function($) {
	$(document).ready(function() {
		$('select[name="role"]').change(function() {
			if ($(this).val() === "Professor") {
				$('.student , .staff , .purpose').fadeOut(200);
				$('.student , .staff , .purpose select').val('');
				setTimeout(function(){
						$('.professor , .professor-staff').fadeIn(200);}, 200);
			}
			else if ($(this).val() === "Student") {
				$('.professor , .staff, .professor-staff , .course_website').fadeOut(200);
				// Reset some values if they were put in...
				$('.professor , .staff , .professor-staff , course_website input').val('');
				$('.professor , .professor-staff select').val('');

				setTimeout(function(){
					$('.student , .purpose').fadeIn(200);}, 200);
			}
			else if ($(this).val() === "Staff") {
				$('.professor , .student').fadeOut(200);		
				// Reset some values if they were put in...
				$('.course_website , .professor , .student input').val('');
				$('.course_website , .student select').val('');
				setTimeout(function(){
					$('.staff , .professor-staff , .purpose').fadeIn(200);}, 200);

			}
			$('.temp').fadeIn(200);
		});
		$('select[name="course_website"]').change(function() {
			if ($(this).val() === "Yes") {
				$('.purpose').fadeOut(200);
				$('.purpose select').val('');
				setTimeout(function(){
					$('.course_website').fadeIn(200);}, 200);
			}
			else if ($(this).val() === "No") {
				$('.course_website').fadeOut(200);
				$('.course_website input').val('');
				setTimeout(function(){
					$('.purpose').fadeIn(200);}, 200);

				// Reset some values if they were put in...
			}
			else if ($(this).val() === "") {
				$('.course_website , .purpose').fadeOut(200);

				// Reset some values if they were put in...
				$('.course_website input').val('');
				$('.purpose select').val('');
			}
		});

		$('select[name="purpose"]').change(function() {
			if ($(this).val() === "other") {
				$('.use_other , .use-other').fadeIn(200);		
			}
			else {
				$('.use_other').fadeOut(200);
			}
		});
		function resetValues(type , name) {

			if (type === 'input') {
				a = type + '[name="' + name + '"]';
				$(a).attr('checked',false);
			}
			if (type === 'text') {
				a = 'input[type=text].'+name+'';
				$(a).val('');
			}
		};
	}
)})(jQuery);