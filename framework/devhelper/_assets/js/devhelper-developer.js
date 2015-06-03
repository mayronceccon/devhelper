jQuery(document).ready(function($){



/* ===============================================================
	UPDATED TRUE
=============================================================== */
setTimeout(function(){
    $('.devhelper-developer .updated-true').slideUp();
}, 6000); // <-- time in milliseconds



/* ===============================================================
	CHANGE SECTION
=============================================================== */
$('.devhelper-developer .sidebar ul li a').click(function(){

	// Active Link
	$('.devhelper-developer .sidebar ul li').removeClass('active');
	$(this).parent().addClass('active');

	// Show Section
	$('.devhelper-developer .content .fields article').hide();
	$('.devhelper-developer .content .fields article.developer-'+$(this).attr('data-section')).show();

});



/* ===============================================================
	JQUERY UI SORTABLE
=============================================================== */
$('.sortable').sortable();
$('.sortable').disableSelection();



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
	REPEATER FIELD MORE
=============================================================== */
$('.add-repeater-field-more').click(function(){
	var field_id    = $(this).attr('data-id');
	var field_clone = $('input#'+field_id).clone();

	/* -- Uniq ID -- */
	var date = new Date();
	var components = [
	    date.getYear(),
	    date.getMonth(),
	    date.getDate(),
	    date.getHours(),
	    date.getMinutes(),
	    date.getSeconds(),
	    date.getMilliseconds()
	]; var id = components.join("");

	/* -- Filter Input -- */
	var html_output = $('.copy_more_'+field_id).html();
	$( html_output ).each(function(){

		$( 'input',this ).each(function(){
			input_name     = 'wpstarterDeveloper';
			input_name    += '[' + field_id + ']';
			input_name    += '[' + id + ']';
			input_name    += '[' + $(this).attr('data-key') + ']';
			html_output    = html_output.replace('name=""', 'name="'+input_name+'"');
		});
	});
	//html_output = html_output.replace('name=""', 'name="'+input_name+'"');
	

	/* -- Insert On View Div -- */
	$('.view_more_'+field_id).append( html_output );

	/* -- Remove -- */
	$('.remove-repeater-field-more').click(function(){
		$(this).parent().remove();
	});
});

	/* ----- Remove Repeater Field ----- */
	$('.remove-repeater-field-more').click(function(){
		$(this).parent().remove();
	});



/* ===============================================================
	IMAGE UPLOAD
=============================================================== */
var file_frame;
$('.devhelper-developer .add-image').click(function(){

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
			$('.devhelper-developer .imgprev_'+field_id+' img').attr('src', attachment.url);
			$('.devhelper-developer .imgprev_'+field_id).show();
		}else{
			$('.devhelper-developer .imgprev_'+field_id).hide();
		}
	});

	// Finally, open the modal
	file_frame.open();
});

	/* ----- Clean Image ----- */
	$('.devhelper-developer .clean-image').click(function(){
		var clean_img_id = $(this).attr('data-id');
		$('.devhelper-developer #'+clean_img_id).val(''); // Remove Image From Value
		$('.devhelper-developer .'+clean_img_id+'_imageurl').val(''); //  Remove Image URL
		$('.devhelper-developer .imgprev_'+clean_img_id).hide(); // Display none on preview image
		$('.devhelper-developer .imgprev_'+clean_img_id+' img').attr('src', ''); // Remove src Image
	});



}); // End jQuery