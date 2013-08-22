/*! $ script to hide certain form fields 

	This is called on the admin menus only. --- Called on the blog form too...

*/

(function($) {
	$(document).ready(function() {
		$('.hide_question').hide();
		$('select[name="role"]').change(function() {
			if ($(this).val() === "Faculty") {
				$('.student , .staff , .other_role , .purpose').fadeOut(200);
				$('.student , .staff , .purpose select').val('');
				$('.other_role , .staff , .student input').val('');

				other_role
				setTimeout(function(){
						$('.faculty , .faculty-staff').fadeIn(200);}, 200);
			}
			else if ($(this).val() === "Student") {
				$('.faculty , .staff, .faculty-staff , .other_role , .class_site').fadeOut(200);
				// Reset some values if they were put in...
				$('.faculty , .staff , .faculty-staff , .other_role , .class_site input').val('');
				$('.faculty , .faculty-staff select').val('');

				$('#nbm_purpose')
					.find('option')
					.remove()
					.end()
					.append('<option value="">---</option>')
					.append('<option value="Class website">Class website</option>')
					.append('<option value="Club site">Club site</option>')
					.append('<option value="Portfolio">Portfolio</option>')
					.append('<option value="Personal/group blog">Personal/group blog</option>')
					.append('<option value="Other">Other</option>')
					.val('');


				setTimeout(function(){
					$('.student , .purpose').fadeIn(200);}, 200);
			}
			else if ($(this).val() === "Staff") {
				$('.faculty , .class_site, .other_role , .student').fadeOut(200);		
				// Reset some values if they were put in...
				$('.class_site , .faculty , .other_role , .student input').val('');
				$('.class_site , .student select').val('');
				$('#nbm_purpose')
					.find('option')
					.remove()
					.end()
					.append('<option value="">---</option>')
					.append('<option value="Departmental site">Departmental site</option>')
					.append('<option value="Project site">Project site</option>')
					.append('<option value="Personal/group blog">Personal/group blog</option>')
					.append('<option value="Other">Other</option>')
					.val('');
				setTimeout(function(){
					$('.staff , .faculty-staff , .purpose').fadeIn(200);}, 200);

			}
			else if ($(this).val() === "Other") {
				$('.faculty , .staff , .class_site, .faculty-staff , .student').fadeOut(200);		
				// Reset some values if they were put in...
				$('.class_site , .staff , .faculty , .faculty-staff , .student input').val('');
				$('.class_site , .staff , .faculty , .faculty-staff , .student select').val('');
				$('#nbm_purpose')
					.find('option')
					.remove()
					.end()
					.append('<option value="">---</option>')
					.append('<option value="Project site">Project site</option>')
					.append('<option value="Personal/group blog">Personal/group blog</option>')
					.append('<option value="Other">Other</option>')
					.val('');
				setTimeout(function(){
					$('.other_role , .purpose').fadeIn(200);}, 200);

			}
			else if ($(this).val() === "") {
				$('.faculty , .staff , .class_site, .faculty-staff , .other_role , .purpose , .student').fadeOut(200);		
				// Reset some values if they were put in...
				$('.class_site , .staff , .faculty , .faculty-staff , .other_role , .purpose , .student input').val('');
				$('.class_site , .staff , .faculty , .faculty-staff , .other_role , .purpose , .student select').val('');

			}
			$('.temp').fadeIn(200);
		});
		$('select[name="class_site"]').change(function() {
			if ($(this).val() === "Yes") {
				$('.purpose').fadeOut(200);
				$('.purpose select').val('');
				setTimeout(function(){
					$('.class_site').fadeIn(200);}, 200);
			}
			else if ($(this).val() === "No") {
				$('.class_site').fadeOut(200);
				$('.class_site input').val('');
				$('.class_site select').val('');				
				$('#nbm_purpose')
					.find('option')
					.remove()
					.end()
					.append('<option value="">---</option>')
					.append('<option value="Departmental site">Departmental site</option>')
					.append('<option value="Project site">Project site</option>')
					.append('<option value="Personal/group blog">Personal/group blog</option>')
					.append('<option value="Other">Other</option>')
					.val('');				
				setTimeout(function(){
					$('.purpose').fadeIn(200);}, 200);

				// Reset some values if they were put in...
			}
			else if ($(this).val() === "") {
				$('.class_site , .purpose').fadeOut(200);

				// Reset some values if they were put in...
				$('.class_site input').val('');
				$('.purpose select').val('');
			}
		});

		$('select[name="purpose"]').change(function() {
			if ($(this).val() === "Other") {
				$('.use_other , .use-other').fadeIn(200);		
			}
			else {
				$('.use_other').fadeOut(200);
				$('.use_other input').val('');

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