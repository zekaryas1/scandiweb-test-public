<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once "../../includes/autoload.php";
include_once "../../utils/command.php";
include_once "../../utils/config.php";


// Instantiate product object can be any product
$product = new Book();

// Product read query
$result = $product->read();

// Get row count
$num = $result->rowCount();

// Check if any products
if ($num > 0 and isset($commands)) {
    // Cat array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        $my_row = (object)$row;

        $cat_item = ($commands[$my_row->type]($my_row));

        // Push to "data"
        $cat_arr['data'][] = $cat_item->toArray();
    }

    // Turn to JSON & output
    echo json_encode($cat_arr);

} else {
    // No Products
    echo json_encode(
        array('message' => 'No Products Found')
    );
}