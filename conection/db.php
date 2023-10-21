<?php
include("conection/dbcon.php");

function tt($value)
{
    echo '<pre>';
    print_r($value);
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

function insertDataInToDb($table, $params)
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
    $stmt->execute($params);
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
