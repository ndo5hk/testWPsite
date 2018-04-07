<?php
/**
 * Admin View: Settings tab "Events"
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (!current_user_can($options['can_manage_events']))
	wp_die(__('You do not have sufficient permissions to access this page.','spiffy-calendar'));	

global $wpdb;

if ( isset($_POST['errors']) ) {
	// An add or update failed, redraw the event edit screen
	$action = (isset($_REQUEST['action']))? $_REQUEST['action'] : 'edit';
	include ('admin-settings-tab-event-edit.php');	
} else if ( isset($_REQUEST['action']) && ($_REQUEST['action'] == 'add') ) {
	// Add new event requested by post or get
	$action = 'add';
	include ('admin-settings-tab-event-edit.php');
} else if ( isset($_GET['action']) && (($_GET['action'] == 'edit') || ($_GET['action'] == 'copy')) ) {
	$event_id = $_GET['event'];
	$action = $_GET['action'];
	// Edit or copy existing event
	include ('admin-settings-tab-event-edit.php');
} else {
	// Display the event list
	include ('admin-settings-tab-event-list.php');
}