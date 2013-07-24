<?php
/*
Adapted from "Custom List Table Example" by Matt Van Andel (http://www.mattvanandel.com)
*/

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Network_Blog_Metadata_Table extends WP_List_Table {

    /** ************************************************************************
     * REQUIRED. Set up a constructor that references the parent constructor. We 
     * use the parent reference to set some default configs.
     ***************************************************************************/
    function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'blog',     //singular name of the listed records
            'plural'    => 'blogs',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }
    
    
    /** ************************************************************************
     * Recommended. This method is called when the parent class can't find a method
     * specifically build for a given column. Generally, it's recommended to include
     * one method for each column you want to render, keeping your package class
     * neat and organized. For example, if the class needs to process a column
     * named 'blog_id', it would first see if a method named $this->column_title() 
     * exists - if it does, that method will be used. If it doesn't, this one will
     * be used. Generally, you should try to use custom column methods as much as 
     * possible. 
     * 
     * Since we have defined a column_title() method later on, this method doesn't
     * need to concern itself with any column with a name of 'blog_id'. Instead, it
     * needs to handle everything else.
     * 
     * For more detailed insight into how columns are handled, take a look at 
     * WP_List_Table::single_row_columns()
     * 
     * @param array $item A singular item (one full row's worth of data)
     * @param array $column_name The name/slug of the column to be processed
     * @return string Text or HTML to be placed inside the column <td>
     **************************************************************************/
    function column_default($item, $column_name){
        switch($column_name){
            case 'role':
			case 'blog_id':
                return $item[$column_name];
	        case 'purpose':
				$uses = array( 'Personal Blog' , 'course_website' , 'Research Blog' , 'Other' , 'Portfolio' );
				if ( $item[$column_name] == 'course_website' ) return 'Course Website';
				else if (  $item[$column_name] == 'x' ) return 'x';
				else if ( ! empty( $item[$column_name] ) && (! in_array( $item[$column_name] , $uses ) ) ) return 'Other (' . $item[$column_name] . ')';
				else return $item[$column_name];
			case 'path' :
				return '<a href=http://' . $item['domain'] . '>' . $item[$column_name] . '</a>';
            default:
                return print_r($item,true); // Show the whole array for troubleshooting purposes
        }
    }
    
        
    /** ************************************************************************
     * Recommended. This is a custom column method and is responsible for what
     * is rendered in any column with a name/slug of 'blog_id'. Every time the class
     * needs to render a column, it first looks for a method named 
     * column_{$column_title} - if it exists, that method is run. If it doesn't
     * exist, column_default() is called instead.
     * 
     * This example also illustrates how to implement rollover actions. Actions
     * should be an associative array formatted as 'slug'=>'link html' - and you
     * will need to generate the URLs yourself. You could even ensure the links
     * 
     * 
     * @see WP_List_Table::::single_row_columns()
     * @param array $item A singular item (one full row's worth of data)
     * @return string Text to be placed inside the column <td> (movie title only)
     **************************************************************************/
    function column_title($item){
        
        //Return the title contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item['blog_id'],
            /*$2%s*/ $item['ID'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }
    
    /** ************************************************************************
     * REQUIRED! This method dictates the table's columns and titles. This should
     * return an array where the key is the column slug (and class) and the value 
     * is the column's title text. If you need a checkbox for bulk actions, refer
     * to the $columns array below.
     * 
     * The 'cb' column is treated differently than the rest. If including a checkbox
     * column in your table you must create a column_cb() method. If you don't need
     * bulk actions or checkboxes, simply leave the 'cb' entry out of your array.
     * 
     * @see WP_List_Table::::single_row_columns()
     * @return array An associative array containing column information: 'slugs'=>'Visible Titles'
     **************************************************************************/
    function get_columns(){
        $columns = array(
            'blog_id'   	  	=> 'Blog ID',
            'role'		    	=> 'Role',
            'purpose' 			=> 'Purpose',
			'path'				=> 'Site URL'
        );
        return $columns;
    }
    
    /** ************************************************************************
     * Optional. If you want one or more columns to be sortable (ASC/DESC toggle), 
     * you will need to register it here. This should return an array where the 
     * key is the column that needs to be sortable, and the value is db column to 
     * sort by. Often, the key and value will be the same, but this is not always
     * the case (as the value is a column name from the database, not the list table).
     * 
     * This method merely defines which columns should be sortable and makes them
     * clickable - it does not handle the actual sorting. You still need to detect
     * the ORDERBY and ORDER querystring variables within prepare_items() and sort
     * your data accordingly (usually by modifying your query).
     * 
     * @return array An associative array containing all the columns that should be sortable: 'slugs'=>array('data_values',bool)
     **************************************************************************/
    function get_sortable_columns() {
        $sortable_columns 	= array(
            'blog_id'     	=> array( 'blog_id' , false ),     //true means it's already sorted
            'role'    		=> array( 'role' , false ),
            'purpose'  		=> array( 'purpose' , false ),
			'path' 			=> array( 'path' , false )
        );
        return $sortable_columns;
    }  
    
    /** ************************************************************************
     * REQUIRED! This is where you prepare your data for display. This method will
     * usually be used to query the database, sort and filter the data, and generally
     * get it ready to be displayed. At a minimum, we should set $this->items and
     * $this->set_pagination_args(), although the following properties and methods
     * are frequently interacted with here...
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
        global $wpdb;

		// Variable to set number of records
        $per_page = 20;
        
        
        /**
         * REQUIRED. Now we need to define our column headers. This includes a complete
         * array of columns to be displayed (slugs & titles), a list of columns
         * to keep hidden, and a list of columns that are sortable. Each of these
         * can be defined in another method (as we've done here) before being
         * used to build the value for our _column_headers property.
         */
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        
        /**
         * REQUIRED. Finally, we build an array to be used by the class for column 
         * headers. The $this->_column_headers property takes an array which contains
         * 3 other arrays. One for all columns, one for hidden columns, and one
         * for sortable columns.
         */
        $this->_column_headers = array($columns, $hidden, $sortable);

		// Construct query to get data
		$tablename = $wpdb->base_prefix . "nbm_data";
        $blogs = $wpdb->base_prefix . "blogs";
		$sql = '
			SELECT ' . $tablename . '.blog_id , ' . $tablename . '.role , ' . $tablename . '.purpose , ' . $blogs . '.path , ' . $blogs . '.domain FROM ' . $tablename . '
						INNER JOIN ' . $blogs . '
						ON ' . $tablename . '.blog_id=' . $blogs . '.blog_id
		';
		

		
		$querydata = $wpdb->get_results($sql);
        
		$blog_data = (array)$wpdb->get_results("
			SELECT `blog_id` , `domain` , `path` FROM " . $blogs
		);
		

        $data = array();

		foreach ($querydata as $querydatum ) {
			foreach ($querydatum as $key => $val) {
				if ($val == '') {
					$querydatum->$key = 'x'; // Change out the null values for 'x'
				}
				if ( $key == 'domain' ) $querydatum->$key = $val . $querydatum->path;
			}
			$querydatum = (array)$querydatum;

			
		   array_push($data, (array)$querydatum);
		}
		
        /**
         * This checks for sorting input and sorts the data in our array accordingly.
         * 
         * In a real-world situation involving a database, you would probably want 
         * to handle sorting by passing the 'orderby' and 'order' values directly 
         * to a custom query. The returned data will be pre-sorted, and this array
         * sorting technique would be unnecessary.
         */
        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'blog_id'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
            $result = strnatcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        usort($data, 'usort_reorder');

//      Pagination, get current page
        $current_page = $this->get_pagenum();

//		Pagination, get total items        
        $total_items = count($data);
        
//		Grab the contents that should be shown on the active page only
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        
        
//		Data is sorted and pruned. We can now show it.        
        $this->items = $data;
        
//		Pagination, registers all the pagination aspects
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }
    
}