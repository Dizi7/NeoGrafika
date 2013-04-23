(function($) {
	'use strict';

	$(function() {

		console.log('hello from the jquery');
		// Verificar si el browser soporta input type date
		if (!Modernizr.inputtypes.date) {
			// NO soporta input type date, crear uno con jQuery UI
			var date_inputs = $('input[type="date"]');
			$.each(date_inputs, function(){
				$(this).datepicker();
			});
		}





	});

}(jQuery));
