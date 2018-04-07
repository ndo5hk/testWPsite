<?php
/**
 * Admin View: Settings tab "Events" - event edit form
 *
 * If $event_id is set, it will be used to edit or copy an existing event
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wpdb, $users_entries, $wp_version;
$data = false;

// Check for existing event edit or copy
if ( isset($event_id) && ($event_id != '') ) {
	if ( intval($event_id) != $event_id ) {
		echo "<div class=\"error\"><p>".__('Bad event ID','spiffy-calendar')."</p></div>";
	} else {
		// Get the event data
		$data = $wpdb->get_results("SELECT * FROM " . WP_SPIFFYCAL_TABLE . " WHERE event_id='" . 
						esc_sql($event_id) . "' LIMIT 1");
		if ( empty($data) ) {
			echo "<div class=\"error\"><p>".__("An event with that ID couldn't be found",'spiffy-calendar')."</p></div>";
		} else if ($action == 'copy') {
			// Set up variable to add a copy of the event
			unset ($data[0]->event_id);
			unset ($event_id);
			$data[0]->event_title = '(copy) ' . $data[0]->event_title;
			$action = 'add';
		}
		$data = $data[0];
	}
	// Recover users entries if they exist; in other words if editing an event went wrong
	if (!empty($users_entries)) {
		$data = $users_entries;
	}
} else {
	// Deal with possibility that form was submitted but not saved due to error - recover user's entries here
	$data = $users_entries;
	if ( isset($_POST['event_id']) ) {
		$event_id = $_POST['event_id'];
	} else {
		$event_id = '';
	}
}

?>

<?php if ($action == 'add') { ?>
<h3><?php _e('Add Event','spiffy-calendar'); ?></h3>
<?php } else { ?>
<h3><?php _e('Edit Event','spiffy-calendar'); ?></h3>
<?php } ?>

<input type="hidden" name="event_id" value="<?php echo $event_id; ?>">

<table cellpadding="5" cellspacing="5">
<tr>				
<td><legend><?php _e('Event Title','spiffy-calendar'); ?></legend></td>
<td><input type="text" name="event_title" size="40" maxlength="30"
	value="<?php if ( !empty($data) ) echo esc_html(stripslashes($data->event_title)); ?>" /> <?php _e('Maximum 30 characters.','spiffy-calendar'); ?></td>
</tr>
<tr>
<td style="vertical-align:top;"><legend><?php _e('Event Description','spiffy-calendar'); ?></legend></td>
<td>
<textarea name="event_desc" rows="5" cols="50"><?php if ( !empty($data) ) echo esc_textarea(stripslashes($data->event_desc)); ?>
</textarea></td>
</tr>
<tr>
<td><legend><?php _e('Event Category','spiffy-calendar'); ?></legend></td>
<td>	 <select name="event_category">

 <?php
// Grab all the categories and list them
$sql = "SELECT * FROM " . WP_SPIFFYCAL_CATEGORIES_TABLE;
$cats = $wpdb->get_results($sql);
foreach($cats as $cat) {
	 echo '<option value="'.$cat->category_id.'"';
	 if (!empty($data)) {
		if ($data->event_category == $cat->category_id) {
			echo 'selected="selected"';
		}
	 }
	 echo '>' . esc_html(stripslashes($cat->category_name)) . '</option>';
}
?>

	</select>
</td>
</tr>
<?php
if (current_user_can( 'manage_options' )) {
	?>
	<tr>
	<td><legend><?php _e( 'Author', 'spiffy-calendar' ); ?></legend></td>
	<td>
	<?php
		if (version_compare($wp_version, '4.5', '<')) {
			$show = 'display_name';
		} else {
			$show = 'display_name_with_login';
		}
		wp_dropdown_users( array(
			'name' => 'event_author',
			'selected' => (empty($data) || !isset($data->event_author)) ? get_current_user_id() : $data->event_author,
			'show' => $show,
		) );
	?>
	</td>
	</tr>
	<?php
}
?>
<tr>
<td><legend><?php _e('Event Link (Optional)','spiffy-calendar'); ?></legend></td>
<td><input type="text" name="event_link" size="40" value="<?php if ( !empty($data) ) echo esc_url(stripslashes($data->event_link)); ?>" /></td>
</tr>
<tr>
<td><legend><?php _e('Start Date','spiffy-calendar'); ?></legend></td>
<td>
	<input type="text" id="event_begin" name="event_begin" class="spiffy-date-field" size="12"
	value="<?php 
		if ( !empty($data) ) {
			echo esc_html($data->event_begin);
		} else {
			echo date("Y-m-d",current_time('timestamp'));
		} 
	?>" />
</td>
</tr>
<tr>
<td><legend><?php _e('End Date','spiffy-calendar'); ?></legend></td>
<td><input type="text" id="event_end" name="event_end" class="spiffy-date-field" size="12"
	value="<?php 
		if ( !empty($data) ) {
			echo esc_html($data->event_end);
		} else {
			echo date("Y-m-d",current_time('timestamp'));
		} 
	?>" />
</td>
</tr>
<tr>
<td><legend><?php _e('Start Time (hh:mm)','spiffy-calendar'); ?></legend></td>
<td>	<input type="text" id="event_time" name="event_time" size=12
	value="<?php 
	if ( !empty($data) ) {
		if ($data->event_time == "00:00:00") {
			echo '';
		} else {
			echo date("h:i a",strtotime($data->event_time));
		}
	} else {
		//echo date("a:i a",current_time('timestamp')); //defaulting to current time is not helpful
	}
	?>" /> <?php _e('Optional, set blank if not required. Ignored for "Hide Events".','spiffy-calendar'); ?>
</td>
</tr>
<tr>
<td><legend><?php _e('End Time (hh:mm)','spiffy-calendar'); ?></legend></td>
<td>	<input type="text" id="event_end_time" name="event_end_time" size=12
	value="<?php 
	if ( !empty($data) ) {
		if ($data->event_end_time == "00:00:00") {
			echo '';
		} else {
			echo date("h:i a",strtotime($data->event_end_time));
		}
	} 
	?>" /> <?php _e('Optional, set blank if not required. Ignored for "Hide Events".','spiffy-calendar'); ?>
</td>
</tr>
<tr>
<td style="vertical-align:top;"><legend><?php _e('Recurring Events','spiffy-calendar'); ?></legend></td>
<td>	<?php
	if (isset($data)) {
		if ($data->event_repeats != NULL) {
			$repeats = $data->event_repeats;
		} else {
			$repeats = 0;
		}
	} else {
		$repeats = 0;
	}

	$selected_s = '';
	$selected_w = '';
	$selected_m = '';
	$selected_y = '';
	$selected_u = '';
	$selected_d = '';
	$recur_multiplier = 1;
	if (isset($data)) {
		if ($data->event_recur == "S") {
			$selected_s = 'selected="selected"';
		} else if ($data->event_recur == "W") {
			$selected_w = 'selected="selected"';
		} else if ($data->event_recur == "M") {
			$selected_m = 'selected="selected"';
		} else if ($data->event_recur == "Y") {
			$selected_y = 'selected="selected"';
		} else if ($data->event_recur == "U") {
			$selected_u = 'selected="selected"';
		} else if ($data->event_recur == "D") {
			$selected_d = 'selected="selected"';
		}
		$recur_multiplier = $data->event_recur_multiplier;
	}

	_e('Repeats','spiffy-calendar'); 
	?> 
	&nbsp;<input type="text" name="event_repeats" size="1" value="<?php echo esc_html($repeats); ?>" />&nbsp;
	<?php
	echo __('times','spiffy-calendar') . '. ' . __('Entering 0 means forever. Where the recurrence interval is left at none, the event will not recur.','spiffy-calendar');			
	?><br />
	<?php _e('Interval', 'spiffy-calendar');?>:&nbsp;
	<select name="event_recur" class="input">
		<option <?php echo $selected_s; ?> value="S"><?php _e('None', 'spiffy-calendar') ?></option>
		<option <?php echo $selected_w; ?> value="W"><?php _e('Weeks', 'spiffy-calendar') ?></option>
		<option <?php echo $selected_m; ?> value="M"><?php _e('Months (date)', 'spiffy-calendar') ?></option>
		<option <?php echo $selected_u; ?> value="U"><?php _e('Months (day)', 'spiffy-calendar') ?></option>
		<option <?php echo $selected_y; ?> value="Y"><?php _e('Years', 'spiffy-calendar') ?></option>
		<option <?php echo $selected_d; ?> value="D"><?php _e('Custom Days', 'spiffy-calendar') ?></option>						
	</select>&nbsp;
	<?php _e('Number of custom days','spiffy-calendar'); ?>
	&nbsp;<input type="number" step="1" min="1" max="199" size="2" name="event_recur_multiplier" value="<?php echo esc_html($recur_multiplier); ?>" />
</td>
</tr>
<tr>
<td style="vertical-align:top;"><legend><?php _e('Hide Events','spiffy-calendar'); ?></legend></td>
<td> 
<?php
	if (isset($data)) {
		if ($data->event_hide_events != NULL) {
			$hide_events = $data->event_hide_events;
		} else {
			$hide_events = 'F';
		}
	} else {
		$hide_events = 'F';
	}

	$selected_he_t = '';
	$selected_he_f = '';
	if (isset($data)) {
		if ($data->event_hide_events == 'T') {
			$selected_he_t = 'selected="selected"';
		} else if ($data->event_hide_events == 'F') {
			$selected_he_f = 'selected="selected"';
		}
	}
	if (isset($data)) {
		if ($data->event_show_title != NULL) {
			$show_title = $data->event_show_title;
		} else {
			$show_title = 'F';
		}
	} else {
		$show_title = 'F';
	}

	$selected_st_t = '';
	$selected_st_f = '';
	if (isset($data)) {
		if ($data->event_show_title == 'T') {
			$selected_st_t = 'selected="selected"';
		} else if ($data->event_show_title == 'F') {
			$selected_st_f = 'selected="selected"';
		}
	}
?>
<select name="event_hide_events" class="input">
		<option <?php echo $selected_he_f; ?> value='F'><?php _e('False', 'spiffy-calendar') ?></option>
		<option <?php echo $selected_he_t; ?> value='T'><?php _e('True', 'spiffy-calendar') ?></option>
	</select><br />
	<?php _e('Entering True means other events of this category will be hidden for the specifed day(s).','spiffy-calendar'); ?>
</td>
</tr>
<tr>
<td style="vertical-align:top;"><legend><?php _e('','spiffy-calendar'); ?></legend></td>
<td><?php _e('Show Title','spiffy-calendar'); ?>&nbsp;
<select name="event_show_title" class="input">
		<option <?php echo $selected_st_f; ?> value='F'><?php _e('False', 'spiffy-calendar') ?></option>
		<option <?php echo $selected_st_t; ?> value='T'><?php _e('True', 'spiffy-calendar') ?></option>
	</select>&nbsp;
	<?php _e('Entering True means the title of this event will be displayed. This is only used if Hide Events is True.','spiffy-calendar'); ?>
</td>
</tr>
<td><legend><?php _e('Image','spiffy-calendar'); ?></legend></td>
<td>
	<button class="spiffy-image-button">Select image</button>
	<?php
		$image_url = "";
		$image_id = "";
		
		if ( !empty($data) ) {
			if ($data->event_image > 0) {
				$image_id = $data->event_image;
				$image = wp_get_attachment_image_src( $data->event_image, 'thumbnail');
				$image_url = $image[0];
			}
		}
		echo '<input type="hidden" class="spiffy-image-input" name="event_image" size="80" value="' . 
				$image_id . '" />';
		echo '<img class="spiffy-image-view" style="max-width: 200px; height: auto;" src="' . $image_url . '" />';
		
		$checked = '';
		if ( !empty($data) && isset($data->event_remove_image) && ($data->event_remove_image == 'true') ) $checked = 'checked ';
	?>
	&nbsp;<input <?php echo $checked; ?>type="checkbox" name="event_remove_image" value="true"><?php _e('Remove image selection','spiffy-calendar'); ?>
</td>
</tr>
</table>

<?php if ($action == 'add') { ?>
<input type="submit" name="submit_add_event" class="button button-primary" value="<?php _e('Save','spiffy-calendar'); ?>" />
<?php } else { ?>
<input type="submit" name="submit_edit_event" class="button button-primary" value="<?php _e('Update','spiffy-calendar'); ?>" />
<?php } ?>	