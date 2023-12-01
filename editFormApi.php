<?php
session_start();
include "connector.php";

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$id = 0;
// Request data for editing
if (isset($data['editProd'])) {
    $id = $data['editProd'];
    $result = callToDb('products', $data['editProd'], $conn);
    echo json_encode($result);
    die();
}

if (isset($data['id'])) {
    $name = $price = $color = "";
    $id = $data['id'];
    $name = test_input($data['editedName']);
    $price = test_input($data['editedPrice']);
    $color = test_input($data['editedColor']);

    // the output which contains only the digits, the regular expression [^0-9.] matches any character that is not a digit or a dot.
    $onlyDigitsPrice = preg_replace("/[^0-9.]/", "", $price);

    $editArray = ["name" => $name, 'price' => $onlyDigitsPrice, 'color' => $color];

    updateProductData('products', $id, $editArray);

    $result = callToDb('products', $id, $conn);

    echo json_encode($result);
}

$conn = null;
