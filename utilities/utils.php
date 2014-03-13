<?php

function flatten_array( &$item ) {
	// Quick helper callback function to deal with arrays from the reports
	// Basically, it matches up the numeric array keys to the blog ids

	$item = $item[0];

}


function nbm_array_to_csv_download( $array, $header='', $filename = "blog_metadata.csv", $delimiter="," ) {

	// Add a datestamp to the front of the filename.
	$filename = date( 'ymdHi' ) . '-' . $filename;

	// open raw memory as file so no temp files needed
	$f = fopen( 'php://memory', 'w' );

	//input the header
	fputcsv( $f, $header, $delimiter );

	// loop over the input array
	foreach ( $array as $line ) {
		// generate csv lines from the inner arrays
		fputcsv( $f, $line, $delimiter );
	}
	// rewrind the "file" with the csv lines
	fseek( $f, 0 );
	// tell the browser it's going to be a csv file
	header( 'Content-Type: application/csv' );
	// tell the browser we want to save it instead of displaying it
	header( 'Content-Disposition: attachement; filename="'.$filename.'"' );
	// make php send the generated csv lines to the browser
	fpassthru( $f );
	die();
}


function nbm_populate_null() {
	// Function populates null values in the wp_wpnbm_data table for each blog that doesn't exist in there.
	// I can hook this into an install function later.

	global $wpdb;
	$tablename = $wpdb->base_prefix . "nbm_data";

	$sql = 'SELECT * from ' . $tablename;
	$data = $wpdb->get_results( $sql, ARRAY_A );

	$sql = 'SELECT `blog_id` from wp_blogs';
	$ids = $wpdb->get_results( $sql, ARRAY_N );
	array_walk( $ids, 'flatten_array' );
	$ids = array_flip( $ids );

	foreach ( $data as $datum ) {
		if ( in_array( $datum['blog_id'] , array_keys( $ids ) ) ) {
			unset( $ids[$datum['blog_id']] );
		}
	}
	$ids = array_flip( $ids );
	$count = 0;
	foreach ( $ids as $id ) {
		$sql = 'INSERT INTO ' . $tablename . ' VALUES( ' . $id . ' , NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL )';
		$result = $wpdb->get_results( $sql );
		$count++;
	}

	// Message to appear declaring completion of null population
	echo '<div class="updated fade">' . $count . ' blogs with null values added into the database.</div>';

}
