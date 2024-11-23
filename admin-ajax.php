<?php
define( 'YOURLS_ADMIN', false );
define( 'YOURLS_AJAX', true );
require_once( dirname( __DIR__ ) .'/includes/load-yourls.php' );
yourls_maybe_require_auth();

// This file will output a JSON string
yourls_content_type_header( 'application/json' );
yourls_no_cache_headers();
yourls_no_frame_header();

if( !isset( $_REQUEST['action'] ) )
	die();

// Pick action
$action = $_REQUEST['action'];
switch( $action ) {

	case 'add':
		yourls_verify_nonce( 'add_url', $_REQUEST['nonce'], false, 'omg error' );
		$return = yourls_add_new_link( $_REQUEST['url'], $_REQUEST['keyword'], '', $_REQUEST['rowid'] );
		echo json_encode($return);
		break;

	case 'edit_display':
		yourls_verify_nonce( 'edit-link_'.$_REQUEST['id'], $_REQUEST['nonce'], false, 'omg error' );
		$row = yourls_table_edit_row ( $_REQUEST['keyword'], $_REQUEST['id'] );
		echo json_encode( array('html' => $row) );
		break;



}

die();
