<?php
session_start();
include "connector.php";
function callToDb($table, $id, $conn)
{
    try {
        $sql = "SELECT * FROM $table WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            http_response_code(404);
            return array('error' => 'No product found for the given id');
        }
    } catch (PDOException $e) {
        http_response_code(500);
        return array('error' => 'Database error: ' . $e->getMessage());
    }
}
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

// Request data for editing
if (isset($data['editProd'])) {
    $result = callToDb('products', $data['editProd'], $conn);
    echo json_encode($result);
    die();
}

$conn = null;
