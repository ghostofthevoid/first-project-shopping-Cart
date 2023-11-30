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

    $editArray = ["name" => $name, 'price' => $price, 'color' => $color];

    updateProductData('products', $id, $editArray);

    $result = callToDb('products', $id, $conn);

    echo json_encode($result);
}

$conn = null;
