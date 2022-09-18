<?php

require_once("../../config.php");
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
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
$table = <<<LALAQT
    (
        SELECT 
            users.id, 
            users.email, 
            users.role, 
            users.locked, 
            user_details.ud_name, 
            user_details.ud_unit, 
            units.unit_name
        FROM users
            JOIN user_details ON users.id = user_details.id
            JOIN units ON user_details.ud_unit = units.unit_id
        ORDER BY users.id ASC
    ) temp
LALAQT;

// Where Clause
$whereAll = "";


// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'id', 'dt' => 1 ),
    array( 'db' => 'email', 'dt' => 2 ),
    array( 'db' => 'ud_name',
            'dt' => 3,
            'formatter' => function ($d, $row) {
                return properName($d);
            } 
        ),
    array( 'db' => 'role', 
            'dt' => 4,
            'formatter' => function ($d, $row ) {
                return $d == 3 ? 'Regular User' : ($d == 2 ? 'Special Access' : 'Administrator');
            }
         ),
    array( 'db' => 'role', 'dt' => 5 ),
    array( 'db' => 'unit_name', 'dt' => 6 ),
    array( 'db' => 'ud_unit', 'dt' => 7 ),
    array( 'db' => 'locked', 'dt' => 8 ),
    array( 'db' => 'id', 'dt' => 9,
            'formatter' => function ($d, $row) {
                return '<span data-toggle="tooltip" data-placement="left" title="Modify" class="mr-2">
                            <a href="?modify='.$d.'" class="modifyUser" target="_blank" data-toggle="modal" data-target="#modify-user"><i class="fa fa-cog"></i></a>
                        </span>
                        <span data-toggle="tooltip" data-placement="right" title="View Documents">
                            <a href="?viewDocs='.$d.'" class="text-success" target="_blank"><i class="fa fa-file"></i></a>
                        </span>';
            }
        )
);
 
// SQL server connection information
$sql_details = array(
    'user' => DB_USER,
    'pass' => DB_PASS,
    'db'   => DB_NAME,
    'host' => DB_HOST
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $whereAll )
);