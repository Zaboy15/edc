<?php
// memanggil file config.php
require ('../../configserverside.php');

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'tabelspkwithdraw';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case object
// parameter names
$columns = array(
	array( 'db' => 'id', 'dt' => 0 ),
	array( 'db' => 'ticket_spk', 'dt' => 1 ),
	array( 'db' => 'wo_activity', 'dt' => 2 ),
	array( 'db' => 'spk_number',  'dt' => 3 ),
	array( 'db' => 'namaitfs',  'dt' => 4 ),
	array( 'db' => 'namamerchant',  'dt' => 5 ),
	array( 'db' => 'serial',  'dt' => 6 ),
	array( 'db' => 'remarks_spk',  'dt' => 7 ),
	array( 'db' => 'spk_status',  'dt' => 8 ),
	array( 'db' => 'tgl_bast',  'dt' => 9 ),
	array( 'db' => 'incoming_warehouse',  'dt' => 10 ),




	// array(
	//        'db'        => 'start_date',
	//        'dt'        => 4,
	//        'formatter' => function( $d, $row ) {
	//         return date( 'jS M y', strtotime($d));
	//        }
    // ),
);

// SQL server connection information
$sql_details = array(
	'user' => $dbuser,
	'pass' => $dbpass,
	'db'   => $dbname,
	'host' => $dbhost
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( '../../ssp/ssp.class.php' );
// /Applications/XAMPP/xamppfiles/htdocs/edcmip/template/assets/plugins/scripts
// /Applications/XAMPP/xamppfiles/htdocs/edcmip/vendor/classes

echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null )
);

