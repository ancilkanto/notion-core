jQuery(document).ready(function($){



	$( '.cs-framework.cs-option-framework form select.notion-select' ).selectmenu();


	// cs-slider
	$( '.cs-field-slider' ).each(function() { 
	    var dis     = $( this ),
	        input   = $( 'input', dis ),
	        slider  = $( '.cs-slider > div', dis ),
	        data    = input.data( 'slider' ),
	        val     = input.val() || 0,
	        step    = data.step || 1,
	        min     = data.min || 0,
	        max     = data.max || 200;

	    slider.slider({
	        range: "min",
	        value: parseInt( val ),
	        step: step,
	        min: parseInt( min ),
	        max: parseInt( max ),
	        slide: function( e, o ) {
	            input.val( o.value + data.unit ).trigger( 'change' );
	        }
	    });

	    input.keyup( function() {
	        slider.slider( "value" , parseInt( input.val() ) );
	    });

	});


	$( '.cs-field-slider input' ).change(function(){
		console.log($(this).val());
		var target_image = $('.notion_image_1').closest('.cs-fieldset').find('img');
		target_image.css('height', $(this).val());

	});


});