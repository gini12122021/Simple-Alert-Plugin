/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Simple_Alert
 * @subpackage Simple_Alert/public
 */

(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	  // Access the passed PHP array (now a JavaScript object)

	    // Ensure sa_status and sa_message are defined
		if ( typeof simpleAlert.sa_status !== 'undefined' && simpleAlert.sa_status === 'on' && typeof simpleAlert.sa_message !== 'undefined' ) {
        

	
			var position = simpleAlert.sa_position || 'top-right';
			var padding = simpleAlert.sa_padding || '15px';
			var backgroundColor = simpleAlert.sa_background_color || '#f44336';
			var textColor = simpleAlert.sa_text_color || '#fff';
	
			console.log(simpleAlert.sa_position);
		  // Create a new div with the message
		  var newDiv = $('<div>', {
			html: simpleAlert.sa_message,
			id: 'sa-alert',
			css: {
				position: 'fixed',
				top: position.includes('top') ? '5%' : (position.includes('center') ? '50%' : 'auto'),
				bottom: position.includes('bottom') ? '5%'  : (position.includes('center') ? '0' : 'auto'),
				left: position.includes('left') ? '20px' : (position.includes('center') ? '0' : 'auto'),
				right: position.includes('right') ? '20px'  : (position.includes('center') ? '0' : 'auto'),
				padding: padding,
				backgroundColor: backgroundColor,
				color: textColor,
				borderRadius: '5px',
				boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)' ,
			   zIndex: 9999,
			   height: 'max-content',
				width: 'fit-content',
				margin: '0 auto',
			}
		});

		
		// Append the new div to the body
		$('body').append(newDiv);

		// Optionally remove the alert after a few seconds
			setTimeout(function() {
				$('#sa-alert').fadeOut('slow', function() {
					$(this).remove();
				});
			}, 3000); // 5 seconds
		}
})( jQuery );
