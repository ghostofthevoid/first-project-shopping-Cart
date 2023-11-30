<?php
session_start();
include "connector.php";

//================================================================================

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);


if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = array();
}

if (isset($data['deleteId'])) {
    $_SESSION['items'] = removeFromCart($data['deleteId']);
    $result = callToDb('products', $data['deleteId'], $conn);
    $arrayOfData = array('quantityOfItems' => count($_SESSION['items']), 'item' => $result);
    echo json_encode($arrayOfData);
    die();
}

if (isset($data['num'])) {

    $result = callToDb('products', $data['num'], $conn);

    if (!in_array(json_encode($result), $_SESSION['items'])) {
        array_push($_SESSION['items'], json_encode($result));
    }
    echo json_encode(count($_SESSION['items']));
    die();
}
// removing products from dataBase and images from folder images
if (isset($data['removeProd'])) {
    $name = "{$data['removeProd']}.png";
    deleteFromDb('products', $data['removeProd'], $conn);
    $result = eraseImage("Public/images/", $name);
    echo json_encode($result);
    die();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'])) {
        $name = $price = $color = "";
        $name = test_input($_POST['name']);
        $price = test_input($_POST['price']);
        $color = test_input($_POST['color']);

        $insertArray = ["name" => $name, 'price' => $price, 'color' => $color];

        $lastInsertId =  insertDataToDb('products', $insertArray, $conn);


        if (!empty($_FILES["img"])) {
            $name = "{$lastInsertId}.png";
            try {
                move_uploaded_file($_FILES['img']['tmp_name'], "Public/images/$name");
            } catch (\Throwable $th) {
                echo json_encode($th);
            }
        }
        $result = callToDb('products', $lastInsertId, $conn);
        echo json_encode($result);
        // $response = ['status' => 'success', 'message' => 'Form data received successfully'];
        // echo json_encode($response);
    }
}
$conn = null;
