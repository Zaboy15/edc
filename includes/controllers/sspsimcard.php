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
$table = 'tabelsimcard';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case object
// parameter names
$columns = array(
	array( 'db' => 'id', 'dt' => 0 ),
	array( 'db' => 'provider', 'dt' => 1 ),
	array( 'db' => 'data_sim', 'dt' => 2 ),
	array( 'db' => 'date_incoming',  'dt' => 3 ),
	array( 'db' => 'date_outgoing',  'dt' => 4 ),
	array( 'db' => 'nameitfs',  'dt' => 5 ),
	array( 'db' => 'remarks',  'dt' => 6 ),
	array( 'db' => 'status',  'dt' => 7 ),




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
	SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null,null )
);

