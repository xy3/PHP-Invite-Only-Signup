jQuery(document).ready(function($) {
	
	$('#register_form').submit(function(event)
	{
		event.preventDefault();
		
		var form_data = $('#register_form').serializeArray();
		form_data.push({name: 'action', value: 'register'});
		
		$.ajax({
				url: 'src/php/functions.inc.php',
				type: 'POST',
				dataType: 'json',
				data: form_data,
				success: function(data) {
					if (data.status) {
						$('#result').text('Thanks for registering.');
						$('#register_form')[0].reset();
					} else {
						$('#result').text(data.message);
					}
				},
				error: function(xhr){
					console.log(xhr.responseText);
				}
			})
	});


});