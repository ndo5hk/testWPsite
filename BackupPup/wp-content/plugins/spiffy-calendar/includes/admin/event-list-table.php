<?php
/*
 ** Spiffy admin table for managing events
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*************************** LOAD THE BASE CLASS *******************************
 */
if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/************************** CREATE A PACKAGE CLASS *****************************
 */
class Spiffy_Events_List_Table extends WP_List_Table {
    
     /** ************************************************************************
     * Set up a constructor that references the parent constructor. We 
     * use the parent reference to set some default configs.
     ***************************************************************************/
    function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => __('event','spiffy-calendar'),     //singular name of the listed records
            'plural'    => __('events','spiffy-calendar'),    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }


    /** ************************************************************************
     * Column output handler
     * 
     * @param array $item A singular item (one full row's worth of data)
     * @param array $column_name The name/slug of the column to be processed
     * @return string Text or HTML to be placed inside the column <td>
     **************************************************************************/
    function column_default($item, $column_name){
		global $wpdb;
		
        switch($column_name){
			case 'event_time':
			case 'event_end_time':
				if ($item[$column_name] == '00:00:00') { 
					return __('N/A','spiffy-calendar'); 
				} else { 
					return date("h:i a",strtotime($item[$column_name]));
				}
				break;
				
			case 'event_recur':
				// Interpret the DB values into something human readable
				if ($item[$column_name] == 'S') { return '-'; } 
				else if ($item[$column_name] == 'W') { return __('Weekly','spiffy-calendar'); }
				else if ($item[$column_name] == 'M') { return __('Monthly (date)','spiffy-calendar'); }
				else if ($item[$column_name] == 'U') { return __('Monthly (day)','spiffy-calendar'); }
				else if ($item[$column_name] == 'Y') { return __('Yearly','spiffy-calendar'); }
				else if ($item[$column_name] == 'D') { return __('Every','spiffy-calendar') . ' ' . $event->event_recur_multiplier . ' ' . __('days','spiffy-calendar'); }
				break;
				
			case 'event_repeats':
				// Interpret the DB values into something human readable
				if ($item['event_recur'] == 'S') { return '-'; }
				else if ($item[$column_name] == 0) { return __('Forever','spiffy-calendar'); }
				else if ($item[$column_name] > 0) { return $item[$column_name].' '.__('Times','spiffy-calendar'); }
				break;
				
			case 'event_hide_events':
				// interpret the hide_events value
				if ($item[$column_name] == 'F') { return __('False', 'spiffy-calendar'); }
				else if ($item[$column_name] == 'T') { return __('True', 'spiffy-calendar'); }
				break;
				
			case 'event_show_title':
				if ($item['event_hide_events'] == 'F') { return '-'; }
				else {      // hide_event event
					if ($item[$column_name] == 'F') { return __('False', 'spiffy-calendar'); }
					else if ($item[$column_name] == 'T') { return __('True', 'spiffy-calendar'); }
				}
				break;
			
			case 'event_image':
				if ($item[$column_name] > 0) {
					$image = wp_get_attachment_image_src( $item[$column_name], 'thumbnail');
					return '<img src="' . $image[0] . '" width="76px" />';
				}
				break;
				
			case 'event_author':
				$e = get_userdata($item[$column_name]); 
				return $e->display_name;

			case 'event_category':
				$sql = "SELECT * FROM " . WP_SPIFFYCAL_CATEGORIES_TABLE . " WHERE category_id=".esc_sql($item[$column_name]);
				$this_cat = $wpdb->get_row($sql);
				return '<span style="color:'. esc_html($this_cat->category_colour).';">' . esc_html(stripslashes($this_cat->category_name)) . '</span>';
			
            default:
                return esc_html(stripslashes($item[$column_name]));
        }
    }


    /** ************************************************************************
     * Title column output handler
     * 
     * @see WP_List_Table::::single_row_columns()
     * @param array $item A singular item (one full row's worth of data)
     * @return string Text to be placed inside the column <td> (movie title only)
     **************************************************************************/
    function column_event_title($item){
        
        //Build row actions
        $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&event=%s">Edit</a>',$_REQUEST['page'],'edit',$item['event_id']),
            'copy'      => sprintf('<a href="?page=%s&action=%s&event=%s">Copy</a>',$_REQUEST['page'],'copy',$item['event_id']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&event=%s" onclick="return confirm(\'%s: %s?\')">Delete</a>',
								$_REQUEST['page'],
								'delete',
								$item['event_id'],
								__('Are you sure you want to delete the event titled','spiffy-calendar'),
								esc_html(stripslashes($item['event_title']))
								),
        );
        
        //Return the title contents
        return sprintf('%1$s%2$s',
            esc_html(stripslashes($item['event_title'])),
            $this->row_actions($actions)
        );
    }


    /** ************************************************************************
     * Handle the checkbox column
	 *
     * @param array $item A singular item (one full row's worth of data)
     * @return string Text to be placed inside the column <td> (movie title only)
     **************************************************************************/
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />', $this->_args['singular'], $item['event_id']);
    }


    /** ************************************************************************
     * Define our columns to display
     * 
     * @see WP_List_Table::::single_row_columns()
     * @return array An associative array containing column information: 'slugs'=>'Visible Titles'
     **************************************************************************/
    function get_columns(){
        $columns = array(
            'cb'			=> '<input type="checkbox" />', //Render a checkbox instead of text
            'event_title'	=> __('Title','spiffy-calendar'),
            'event_begin'	=> __('Start Date','spiffy-calendar'),
            'event_end'		=> __('End Date','spiffy-calendar'),
            'event_time'	=> __('Start Time','spiffy-calendar'),
            'event_end_time'	=> __('End Time','spiffy-calendar'),
            'event_recur'	=> __('Recurs','spiffy-calendar'),
            'event_repeats'	=> __('Repeats','spiffy-calendar'),
            'event_hide_events'	=> __('Hide Events','spiffy-calendar'),
            'event_show_title'	=> __('Show Title','spiffy-calendar'),
            'event_image'	=> __('Image','spiffy-calendar'),
            'event_author'	=> __('Author','spiffy-calendar'),
            'event_category'	=> __('Category','spiffy-calendar'),
        );
        return $columns;
    }


    /** ************************************************************************
     * Sortable columns array
     * 
     * @return array An associative array containing all the columns that should be sortable: 'slugs'=>array('data_values',bool)
     **************************************************************************/
    function get_sortable_columns() {
        $sortable_columns = array(
            'event_begin'    => array('event_begin',true),
			'event_category' => array('event_category',false)
        );
        return $sortable_columns;
    }


    /** ************************************************************************
     * Bulk actions array
     * 
     * @return array An associative array containing all the bulk actions: 'slugs'=>'Visible Titles'
     **************************************************************************/
    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }


    /** ************************************************************************
     * Bulk action handler
	 *
	 * Note: edit and copy actions are handled before this 
     * 
     * @see $this->prepare_items()
     **************************************************************************/
    function process_bulk_action() {
		global $wpdb;

        //Detect when a bulk action is being triggered...
        if( 'delete'===$this->current_action() ) {
            if ( ! isset( $_REQUEST['event'] ) ) {
				return;
			}

			foreach ( (array) $_REQUEST['event'] as $event_id ) {
				$sql = $wpdb->prepare("DELETE FROM " . WP_SPIFFYCAL_TABLE . " WHERE event_id=%d", $event_id);
				$wpdb->get_results($sql);
			
				$sql = $wpdb->prepare("SELECT event_id FROM " . WP_SPIFFYCAL_TABLE . " WHERE event_id=", $event_id);
				$result = $wpdb->get_results($sql);
			
				if ( empty($result) || empty($result[0]->event_id) ) {
					?>
					<div class="updated"><p><?php echo __('Event deleted successfully','spiffy-calendar') . ': ' . $event_id; ?></p></div>
					<?php
				} else {
					?>
					<div class="error"><p><strong><?php _e('Error','spiffy-calendar'); ?>:</strong> <?php _e('Despite issuing a request to delete, the event still remains in the database. Please investigate.','spiffy-calendar'); ?></p></div>
					<?php
				}
			}
        }
    }


    /** ************************************************************************
     * Prepare array of items to display in the table
     * 
     * @global WPDB $wpdb
     * @uses $this->_column_headers
     * @uses $this->items
     * @uses $this->get_columns()
     * @uses $this->get_sortable_columns()
     * @uses $this->get_pagenum()
     * @uses $this->set_pagination_args()
     **************************************************************************/
    function prepare_items() {
        global $current_user, $wpdb, $spiffy_calendar;

        /**
         * Determine how many records per page to show
         */
        $per_page = $this->get_items_per_page('spiffy_events_per_page', 10);
        
        /**
         * Define our column headers
         */
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = array($columns, $hidden, $sortable);
        
        
        /**
         * Handle bulk actions
         */
        $this->process_bulk_action();
        
        
        /**
         * Get list data
         */
		$options = $spiffy_calendar->get_options();
		$orderby = (!empty($_REQUEST['orderby'])) ? esc_sql($_REQUEST['orderby']) : 'event_begin'; //If no sort, default to start date
		$order = (!empty($_REQUEST['order'])) ? esc_sql($_REQUEST['order']) : 'desc'; //If no order, default to desc
		// note that $orderby and $order are column names and must not be "prepared"
		if (($options['limit_author'] == 'true') && !current_user_can('manage_options')) {
			$sql = $wpdb->prepare("SELECT * FROM " . WP_SPIFFYCAL_TABLE . " WHERE event_author=%d ORDER BY $orderby $order", $current_user->ID);
		} else {
			$sql = "SELECT * FROM " . WP_SPIFFYCAL_TABLE . " ORDER BY $orderby $order";
		}
		$data = $wpdb->get_results($sql, ARRAY_A);    
		
        /**
         * Handle pagination
         */
        $current_page = $this->get_pagenum();
        $total_items = count($data);
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        
        /**
         * Add our *sorted* data to the items property, where it can be used by the rest of the class.
         */
        $this->items = $data;
        
        
        /**
         * We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }


}
?>