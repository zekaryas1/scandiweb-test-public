<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once "../../includes/autoload.php";
include_once "../../utils/command.php";
include_once "../../utils/config.php";


$data = json_decode(file_get_contents("php://input"));

if (isset($commands)) {
    $product = $commands[$data->type]($data);

    // Create product
    if ($product->create()) {
        echo json_encode(
            array('message' => '$product Created')
        );
    } else {
        http_response_code(404);
        echo json_encode(
            array('message' => '$product Not Created')
        );
    }
}

