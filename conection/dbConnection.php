<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "shopdb";
$conn = "";


try {
    $conn = new PDO("mysql:host=$db_server;dbname=shopdb", $db_user, $db_pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
