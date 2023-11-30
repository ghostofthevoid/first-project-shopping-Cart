<?php
include("dbcon.php");

function tt($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

function selectAll($table, $params = [])
{
    global $conn;
    $sql = "SELECT * FROM $table ";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {

                $sql = $sql . "WHERE $key=$value";
            } else {
                $sql = $sql . "AND $key=$value";
            }
            $i++;
        }
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function selectOneFromDb($table, $params = [])
{
    global $conn;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . "WHERE $key=$value";
            } else {
                $sql = $sql . "AND $key=$value";
            }
            $i++;
        }
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetch();
}

function insertDataToDb($table, $params, $conn)
{
    $i = 0;
    $column = '';
    $mask = '';

    foreach ($params as $key => $value) {
        if ($i === 0) {
            $column = $column . "$key";
            $mask = $mask . "'" . "$value" . "'";
        } else {
            $column = $column . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }
    $sql = "INSERT INTO $table ($column)VALUES($mask)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $conn->lastInsertId();
}

function flattenArray($array)
{
    $result = [];
    foreach ($array as $element) {
        if (is_array($element)) {
            $result = array_merge($result, flattenArray($element));
        } else {
            $result[] = $element;
        }
    }
    return $result;
}

//=============================================
function removeFromCart($itemToRemove)
{

    $cart = $_SESSION['items'];
    foreach ($cart as $index => $object) {

        if ($itemToRemove == json_decode($object)[0]->id) {
            unset($cart[$index]);
            break;
        }
    }
    return $cart;
}

function deleteFromDb($table, $id, $conn)
{
    if (is_numeric($id)) {
        $sql = "DELETE FROM $table WHERE id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        //return $conn->lastInsertId();
    }
}

function eraseImage($folderPath, $imageName)
{
    $filePath = $folderPath . $imageName;

    if (file_exists($filePath)) {

        if (unlink($filePath)) {
            return "File '$imageName' has been removed successfully.";
        } else {
            return "Error removing the file '$imageName'.";
        }
    } else {
        return "File '$imageName' does not exist.";
    }
}

// UPDATE `products` SET `price` = '600' WHERE `products`.`id` = 93
function updateProductData($table, $id, $params)
{
    global $conn;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $str = $str . $key . " = '" . $value . "'";
        } else {
            $str = $str . ", " . $key . " = '" . $value . "'";
        }
        $i++;
    }
    $sql = "UPDATE $table SET $str WHERE `id` = $id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $conn->lastInsertId();
}

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

function test_input($data)
{
    $data = ucfirst($data);
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
