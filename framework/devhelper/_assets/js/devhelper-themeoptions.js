jQuery(document).ready(function($){


/* ===============================================================
	SHOW FIRST ARTICLE
=============================================================== */
$('.wpstarter-developer .content .fields article').first().show();



/* ===============================================================
	UPDATED TRUE
=============================================================== */
setTimeout(function(){
    $('.wpstarter-developer .updated-true').slideUp();
}, 6000); // <-- time in milliseconds



/* ===============================================================
	CHANGE SECTION
=============================================================== */
$('.wpstarter-developer .sidebar ul li a').click(function(){

	// Active Link
	$('.wpstarter-developer .sidebar ul li').removeClass('active');
	$(this).parent().addClass('active');

	// Show Section
	$('.wpstarter-developer .content .fields article').hide();
	$('.wpstarter-developer .content .fields article.themeoptions-'+$(this).attr('data-section')).show();

});



/* ===============================================================
	COLOR PICKER
=============================================================== */
$(function() {
	$('.color-field').wpColorPicker();
});



/* ===============================================================
	REPEATER FIELD
=============================================================== */
$('.add-repeater-field').click(function(){
	var field_id    = $(this).attr('data-id');
	var field_clone = $('input#'+field_id).clone();

	$('.view_'+field_id).append( $('.copy_'+field_id).html() );

	$('.remove-repeater-field').click(function(){
		$(this).parent().remove();
	});
});

	/* ----- Remove Repeater Field ----- */
	$('.remove-repeater-field').click(function(){
		$(this).parent().remove();
	});



/* ===============================================================
	IMAGE UPLOAD
=============================================================== */
var file_frame;
$('.wpstarter-developer .add-image').click(function(){

	event.preventDefault();

	// Get Field ID
	var field_id = $(this).attr('data-id');

	// If the media frame already exists, reopen it.
	if( file_frame ){
		file_frame.open();
		return;
	}

	// Create the media frame.
	file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
		},
		multiple: false  // Set to true to allow multiple files to be selected
	});

	// When an image is selected, run a callback.
	file_frame.on( 'select', function() {
		// We set multiple to false so only get one image from the uploader
		attachment = file_frame.state().get('selection').first().toJSON();
		// Do something with attachment.id and/or attachment.url here
		$('.'+field_id+'_imageurl').val( attachment.url ); // Show URL
		$('#'+field_id).val( attachment.id ); // Save ID
		// Show Image
		if( attachment.url != '' ){
			$('.wpstarter-developer .imgprev_'+field_id+' img').attr('src', attachment.url);
			$('.wpstarter-developer .imgprev_'+field_id).show();
		}else{
			$('.wpstarter-developer .imgprev_'+field_id).hide();
		}
	});

	// Finally, open the modal
	file_frame.open();
});

	/* ----- Clean Image ----- */
	$('.wpstarter-developer .clean-image').click(function(){
		var clean_img_id = $(this).attr('data-id');
		$('.wpstarter-developer #'+clean_img_id).val(''); // Remove Image From Value
		$('.wpstarter-developer .'+clean_img_id+'_imageurl').val(''); //  Remove Image URL
		$('.wpstarter-developer .imgprev_'+clean_img_id).hide(); // Display none on preview image
		$('.wpstarter-developer .imgprev_'+clean_img_id+' img').attr('src', ''); // Remove src Image
	});



}); // End jQuery