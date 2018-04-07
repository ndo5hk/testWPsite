<?php
/*
 ** Spiffy Calendar Shortcode Buttons
 **
 ** Copyright Sunny Themes
 **
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (!class_exists("SPIFFYCALShortcode")) {
class SPIFFYCALShortcode {

	function __construct () {

		/* Add the shortcode handler to the admin page */
		add_action('media_buttons', array($this, 'add_encoder'));

		/* Add the scripts */
		add_action('admin_head', array ($this, 'add_scripts'));
	}

	function add_encoder(){
		/* Place the form in the footer */
		add_action('admin_footer', array ($this, 'add_form') );

		/* Add the button to the media buttons */
		echo '&nbsp;<a href="#TB_inline?width=640&height=847&inlineId=spiffycal_sc_form" class="thickbox" id="add_spiffycal_button" title="Spiffy Calendar Shortcode"><img src="' . plugin_dir_url(__FILE__) . '../images/spiffy26.png" alt="Spiffy Calendar Shortcode" /></a>';
	}

	/*
	** Define the popup form
	*/
	function add_form() {
		global $spiffy_calendar, $wpdb;
?>

<style type="text/css">

#spiffycal_sc_wrap h2.popup-header { background: url(<?php echo plugin_dir_url(__FILE__); ?>../images/spiffy26.png) top left no-repeat;	padding: 8px 0 5px 36px; height: 32px;}
#spiffycal_sc_wrap .hide { display: none; }
#spiffycal_sc_wrap .button-primary { color: #fff !important; }

.spiffycal_sc_section { margin-top: 20px; }
.spiffycal_sc_section label { display: inline-block; width: 200px; }
.spiffycal_sc_section span.spiffycal_sc_caption { font-size: .85em; color: #666; font-style: italic; width: 270px;
		display: inline-block; vertical-align: top; padding-left: 10px; }
		
#spiffycal_sc_categories, #spiffycal_sc_limit { vertical-align: top; }

</style>

<div id="spiffycal_sc_form" style="display:none;">
  <div id="spiffycal_sc_wrap">
	<div class="spiffycal-sc-header">
		<h2 class="popup-header"><?php _e( 'Spiffy Calendar Shortcode Embed', 'spiffy-calendar' ); ?></h2>
	</div>

	<form id="spiffycal_sc_form_element">

		<div class="spiffycal_sc_section spiffycal-sc">
			<label for="spiffycal_short_code"><?php _e( 'Select shortcode:', 'spiffy-calendar' ); ?></label>

			<select id="spiffycal_short_code">
				<option value="spiffy-calendar" SELECTED><?php _e( 'Full Calendar', 'spiffy-calendar' ); ?></option>
				<option value="spiffy-minical"><?php _e( 'Mini Calendar', 'spiffy-calendar' ); ?></option>
				<option value="spiffy-todays-list"><?php _e( 'Today\'s Events', 'spiffy-calendar' ); ?></option>
				<option value="spiffy-upcoming-list"><?php _e( 'Upcoming Events', 'spiffy-calendar' ); ?></option>
			</select>
		</div>
			
		<div class="spiffycal_sc_section spiffycal_cat">	
			<label for="spiffycal_sc_categories">
				<?php _e('Select categories (optional):', 'spiffy-calendar'); ?>
				<p class="howto"><?php _e('CTRL+click to select multiple categories.', 'spiffy-calendar'); ?></p>
			</label>
			<select multiple id="spiffycal_sc_categories">
			<?php
			$sql = "SELECT * FROM " . WP_SPIFFYCAL_CATEGORIES_TABLE;
			$cats = $wpdb->get_results($sql);
			foreach($cats as $cat) {
				 echo '<option value="'.$cat->category_id.'">' . esc_html(stripslashes($cat->category_name)) . '</option>';
			}
			?>
			</select>
		</div>

		<div class="spiffycal_sc_section spiffycal_list hide">
			<h4><?php _e('List Options', 'spiffy-calendar'); ?></h4>
			<label for="spiffycal_sc_limit">
				<?php _e('List limit (optional):', 'spiffy-calendar'); ?>
				<p class="howto"><?php _e('Leave blank to list all events found.', 'spiffy-calendar'); ?></p>
			</label>
			<input type="number" min="0" name="spiffycal_sc_limit" value="" id="spiffycal_sc_limit" />
			<div>
				<label for="spiffy_sc_list_style"><?php _e('Style', 'spiffy-calendar'); ?></label>
				<select id="spiffy_sc_list_style" />
					<option value="Popup" SELECTED>Popup</option>
					<option value="Expanded">Expanded</option>
				</select>
			</div>
		</div>
		
		<div class="spiffycal_sc_section">	
			<div>	
				<a href="#" class="button-primary" id="spiffycal_sc_insert"><?php _e('Insert', 'spiffy-calendar'); ?></a>
				<input type="reset" value="Reset">
			</div>
		</div>
	</form>
  </div>
</div>

<?php
	}

	/*
	** Add scripts
	*/
	function add_scripts() {
?>

<script type="text/javascript">
  jQuery(function(){
	jQuery("#spiffycal_sc_insert").click(function() {
		output = '[';
		output += jQuery('#spiffycal_short_code').val();
		
		var selectedValues = jQuery('#spiffycal_sc_categories').val();
		if (selectedValues != null) {
			output += ' cat_list="' + selectedValues.join(",") + '"';
		}
		
		if (!jQuery(".spiffycal_list").hasClass ('hide')) {
			if ( jQuery('#spiffycal_sc_limit').val() && (jQuery('#spiffycal_sc_limit').val() > 0) ) output += ' limit=' + jQuery('#spiffycal_sc_limit').val();
			if (jQuery('#spiffy_sc_list_style').val()) output += ' style="' + jQuery('#spiffy_sc_list_style').val() + '"';
		}
		
		output += ']';
		send_to_editor(output);
	});
	
	jQuery("#spiffycal_short_code").change(function(evt) {
            var val = jQuery(this).val();
            switch ( val ) {
                case 'spiffy-calendar':
				case 'spiffy-minical':
					jQuery(".spiffycal_list").addClass ('hide');
                    break;
                case 'spiffy-todays-list':
                case 'spiffy-upcoming-list':
					jQuery(".spiffycal_list").removeClass ('hide');
                    break;
            }
	});
	

  });
</script>

<?php
	}

} // end of class
}

if (class_exists("SPIFFYCALShortcode")) {
	$spiffy_calendar_sc = new SPIFFYCALShortcode();
}

?>