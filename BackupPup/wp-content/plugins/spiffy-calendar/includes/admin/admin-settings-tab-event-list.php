<?php
/**
 * Admin View: Settings tab "Events" - event list
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
// Define the admin list table for event management
require_once (plugin_dir_path(__FILE__) . 'event-list-table.php');
 
global $wpdb;	

?>
<br />
<a href="<?php echo admin_url('admin.php?page=spiffy-calendar&tab=events&action=add'); ?>" class="button button-primary"><?php _e('Add New Event','spiffy-calendar'); ?></a>

<?php
// Display the admin list table for event management
$spiffyEvents = new Spiffy_Events_List_Table();
$spiffyEvents->prepare_items();
?>
<form id="spiffy-events-filter" method="get">
	<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
	<?php $spiffyEvents->display() ?>
</form>