jQuery( document ).ready( function( $ ) {
	var ajaxurl = CustomCheckoutJsObj.ajaxurl;
	if ( ! $( 'body' ).hasClass( 'logged-in' ) ) {
		$( document ).on( 'focusout', '.checkout #billing_email', function() {
			var email = $( this ).val();
			if ( ! validEmail( email ) ) {
				var html = '<span class="billing_email_error" style="color:red;padding:10px;">Please Enter Valid Email.</span>';
				$( html ).insertAfter( '.checkout #billing_email_field span' );
				setTimeout( function() {
					$( '.billing_email_error' ).remove();
				}, 3000 );
			}
			$.ajax({
				url: ajaxurl,
				type: 'POST',
				data: { 'email': email, 'action': 'cs_check_email_exists_ajax' },
				dataType: 'json',
				beforeSend: function() {
					$( '.custom_loader' ).show();
				},
				success: function( response ) {
					if ( 'email-exists' === response.data.code ) {
						var html = '<span class="billing_email_error" style="padding:10px;">' + response.data.message + '</span>';
						if ( $( '#billing_email_field' ).find( '.billing_email_error' ).length !== 0 ) {
							$( '.billing_email_error' ).html( response.data.message );
						} else {
							$( html ).insertAfter( '.checkout #billing_email_field span' );
						}
						$( '.checkout #customer_details .form-row:not(:first)' ).hide();
						$( '.checkout .button' ).prop("disabled", true);
						
					} else {
						$( '.billing_email_error' ).remove();
						$( '.checkout #customer_details .form-row:not(:first)' ).show();
						$( '.checkout :button' ).prop("disabled", false);
					}
				},
				complete: function() {
					$( '.custom_loader' ).hide();
				}
			} );

		} );
	}

    // Function to check email is valid or not.
    function validEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
    }
} );