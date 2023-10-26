<?php
session_start();
include "connector.php";

// if (($_REQUEST['test'] ?? 0) == 1) {
//     echo json_encode($_REQUEST);
// } else {
//     echo json_encode($_POST);
// }
// $result = explode("/", $_SERVER['REQUEST_URI']);
// $result = end($result);

// switch ($result) {
//     case "page1":
//         echo "rout1";
//         break;

//     default:
//         echo "rout2";
//         break;
// }

//POST REQUEST GET DATA
// $json = file_get_contents('php://input');
// echo $json;

// $data = json_decode(file_get_contents('php://input'), true);
// $id = $data['id'];

// $sql = "SELECT * FROM products WHERE id = :id";

// $stmt = $conn->prepare($sql);
// $stmt->bindParam(':id', $id, PDO::PARAM_INT);

// $stmt->execute();
// $stmt->fetchAll();

// $conn = null;
//================================================================================

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);


if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = array();
}

if (isset($data['deleteId'])) {
    $_SESSION['items'] = removeFromCart($data['deleteId']);
    echo json_encode(count($_SESSION['items']));
    die();
}

if (isset($data['num'])) {

    $id = $data['num'];


    try {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            if (!in_array(json_encode($result), $_SESSION['items'])) {
                array_push($_SESSION['items'], json_encode($result));
            }
        } else {
            http_response_code(404);
            echo json_encode(array('error' => 'No product found for the given id'));
            die();
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array('error' => 'Database error: ' . $e->getMessage()));
        die();
    }
    echo json_encode(count($_SESSION['items']));
    die();
}
