/*
**	Spiffy Calendar utility scripts on admin pages
**
**  Version 1.4
*/

// WP colorpicker
jQuery(document).ready(function($){
    $('.spiffy-color-field').wpColorPicker();
});

// Begin/End date check
jQuery(document).ready(function($) {
    jQuery("#event_begin, #event_end").calendricalDateRange();
});

// Media uploader for images
var file_frame;

jQuery('.spiffy-image-button').live('click', function( event ){

    event.preventDefault();

    // If the media frame already exists, reopen it.
    if ( file_frame ) {
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
	  jQuery('.spiffy-image-input').val(attachment.id);
	  jQuery('.spiffy-image-view').attr('src',attachment.url);
    });

    // Finally, open the modal
    file_frame.open();
  });