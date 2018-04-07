<?php
/**
 * Admin View: Settings tab "Options"
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (!current_user_can('manage_options'))
	wp_die(__('You do not have sufficient permissions to access this page.','spiffy-calendar'));	

// Pull the values out of the database that we need for the form
$allowed_group = $options['can_manage_events'];
$calendar_style = $options['calendar_style'];

if ($options['display_author'] == 'true') {
	$yes_disp_author = 'selected="selected"';
	$no_disp_author = '';
} else {
	$yes_disp_author = '';
	$no_disp_author = 'selected="selected"';
}

if ($options['limit_author'] == 'true') {
	$yes_limit_author = 'selected="selected"';
	$no_limit_author = '';
} else {
	$yes_limit_author = '';
	$no_limit_author = 'selected="selected"';
}

if ($options['display_detailed'] == 'true') {
	$yes_disp_detailed = 'selected="selected"';
	$no_disp_detailed = '';
} else {
	$yes_disp_detailed = '';
	$no_disp_detailed = 'selected="selected"';
}

if ($options['display_jump'] == 'true') {
	$yes_disp_jump = 'selected="selected"';
	$no_disp_jump = '';
} else {
	$yes_disp_jump = '';
	$no_disp_jump = 'selected="selected"';
}

/*if ($options['display_upcoming'] == 'true') {
	$yes_disp_upcoming = 'selected="selected"';
	$no_disp_upcoming = '';
} else {
	$yes_disp_upcoming = '';
	$no_disp_upcoming = 'selected="selected"';
}*/

$upcoming_days = $options['display_upcoming_days'];

if ($options['enable_categories'] == 'true') {
	$yes_enable_categories = 'selected="selected"';
	$no_enable_categories = '';
} else {
	$yes_enable_categories = '';
	$no_enable_categories = 'selected="selected"';
}

if ($options['enable_new_window'] == 'true') {
	$yes_enable_new_window = 'selected="selected"';
	$no_enable_new_window = '';
} else {
	$yes_enable_new_window = '';
	$no_enable_new_window = 'selected="selected"';
}

if ($options['enable_expanded_mini_popup'] == 'true') {
	$yes_enable_expanded_mini_popup = 'selected="selected"';
	$no_enable_expanded_mini_popup = '';
} else {
	$yes_enable_expanded_mini_popup = '';
	$no_enable_expanded_mini_popup = 'selected="selected"';
}

$subscriber_selected = '';
$contributor_selected = '';
$author_selected = '';
$editor_selected = '';
$admin_selected = '';
if ($allowed_group == 'read') { $subscriber_selected='selected="selected"';}
else if ($allowed_group == 'edit_posts') { $contributor_selected='selected="selected"';}
else if ($allowed_group == 'publish_posts') { $author_selected='selected="selected"';}
else if ($allowed_group == 'moderate_comments') { $editor_selected='selected="selected"';}
else if ($allowed_group == 'manage_options') { $admin_selected='selected="selected"';}

// Now we render the form
		?>
<h3><?php _e('Options','spiffy-calendar'); ?></h3>

<table class="form-table">
<tr>
	<th scope="row">
		<?php _e('Event Manager Role','spiffy-calendar'); ?>
	</th>
	<td>
		<select name="permissions">
			<option value="subscriber"<?php echo $subscriber_selected ?>><?php _e('Subscriber','spiffy-calendar')?></option>
			<option value="contributor" <?php echo $contributor_selected ?>><?php _e('Contributor','spiffy-calendar')?></option>
			<option value="author" <?php echo $author_selected ?>><?php _e('Author','spiffy-calendar')?></option>
			<option value="editor" <?php echo $editor_selected ?>><?php _e('Editor','spiffy-calendar')?></option>
			<option value="admin" <?php echo $admin_selected ?>><?php _e('Administrator','spiffy-calendar')?></option>
		</select>
		<p class="description"><?php _e('Choose the lowest user group that can manage events','spiffy-calendar'); ?></p>
	</td>
</tr>
<tr>
	<th scope="row">
		<?php _e('Display author name on events?','spiffy-calendar'); ?>
	</th>
	<td>
		<select name="display_author">
			<option value="on" <?php echo $yes_disp_author ?>><?php _e('Yes','spiffy-calendar') ?></option>
			<option value="off" <?php echo $no_disp_author ?>><?php _e('No','spiffy-calendar') ?></option>
		</select>
	</td>
</tr>
<tr>
	<th scope="row">
		<?php _e('Limit non-admins to editing their own events only?','spiffy-calendar'); ?>
	</th>
	<td>
		<select name="limit_author">
			<option value="on" <?php echo $yes_limit_author ?>><?php _e('Yes','spiffy-calendar') ?></option>
			<option value="off" <?php echo $no_limit_author ?>><?php _e('No','spiffy-calendar') ?></option>
		</select>
	</td>
</tr><tr>
	<th scope="row">
		<?php _e('Enable detailed event display?','spiffy-calendar'); ?>
	</th>
	<td>
		<select name="display_detailed">
			<option value="on" <?php echo $yes_disp_detailed ?>><?php _e('Yes','spiffy-calendar') ?></option>
			<option value="off" <?php echo $no_disp_detailed ?>><?php _e('No','spiffy-calendar') ?></option>
		</select>
		<p class="description"><?php _e('When this option is enabled the time and image will be listed with the event title. Note that time and image are always displayed in the popup window.', 'spiffy-calendar'); ?></p>
	</td>
</tr>
<tr>
	<th scope="row">
		<?php _e('Display a jumpbox for changing month and year quickly?','spiffy-calendar'); ?>
	</th>
	<td>
		<select name="display_jump">
			<option value="on" <?php echo $yes_disp_jump ?>><?php _e('Yes','spiffy-calendar') ?></option>
			<option value="off" <?php echo $no_disp_jump ?>><?php _e('No','spiffy-calendar') ?></option>
	  </select>
	</td>
</tr>
<tr>
	<th scope="row">
		<?php _e('Display upcoming events for','spiffy-calendar'); ?>
	</th>
	<td>
		<input type="text" name="display_upcoming_days" value="<?php echo esc_html($upcoming_days); ?>" size="1" maxlength="3" /> <?php _e('days into the future','spiffy-calendar'); ?>
	</td>
</tr>
<tr>
	<th scope="row">
		<?php _e('Enable event categories?','spiffy-calendar'); ?>
	</th>
	<td>
		<select name="enable_categories">
			<option value="on" <?php echo $yes_enable_categories ?>><?php _e('Yes','spiffy-calendar') ?></option>
			<option value="off" <?php echo $no_enable_categories ?>><?php _e('No','spiffy-calendar') ?></option>
		</select>
	</td>
</tr>
<tr>
	<th scope="row">
		<?php _e('Open event links in new window?','spiffy-calendar'); ?>
	</th>
	<td>
		<select name="enable_new_window">
			<option value="on" <?php echo $yes_enable_new_window ?>><?php _e('Yes','spiffy-calendar') ?></option>
			<option value="off" <?php echo $no_enable_new_window ?>><?php _e('No','spiffy-calendar') ?></option>
		</select>
	</td>
</tr>
<tr>
	<th scope="row">
		<?php _e('Enable expanded mini calendar popup?','spiffy-calendar'); ?>
	</th>
	<td>
		<select name="enable_expanded_mini_popup">
			<option value="on" <?php echo $yes_enable_expanded_mini_popup ?>><?php _e('Yes','spiffy-calendar') ?></option>
			<option value="off" <?php echo $no_enable_expanded_mini_popup ?>><?php _e('No','spiffy-calendar') ?></option>
		</select>
		<p class="description"><?php _e('When this option is disabled the time and title will be listed in the mini calendar popup. When this option is enabled, the description is also displayed.', 'spiffy-calendar'); ?></p>
	</td>
</tr>
<tr>
	<th scope="row">
		<?php _e('Custom CSS styles','spiffy-calendar'); ?>
	</th>
	<td>
		<textarea name="style" rows="10" cols="60" tabindex="2"><?php echo stripslashes(esc_textarea($calendar_style)); ?></textarea><br />
		<input type="checkbox" name="reset_styles" /> <?php _e('Tick this box if you wish to reset the Calendar style to default','spiffy-calendar'); ?>
		<p class="description"><?php _e('Default styles are always loaded. If you would like to add additional custom CSS you may do so here.', 'spiffy-calendar'); ?></p>
	</td>
</tr>
</table>

<p class="submit"><input class="button button-primary" name="submit" value="<?php echo __('Save Changes','spiffy-calendar'); ?>" type="submit" /></p>