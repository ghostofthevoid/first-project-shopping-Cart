<?php
session_start();
include("conection/dbcon.php");
include("conection/db.php");
include("header.php");


$items = [];

if (!empty($_SESSION['items'])) {
    foreach ($_SESSION['items'] as $item) {
        $items[] = json_decode($item);
    }
}
$items  = flattenArray($items);

// tt($_SESSION);


// session_unset();
// session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product cart</title>
    <link rel="stylesheet" href="style/cart.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>

<body>
    <div class="total-sum">
        <span id="total">67</span>
    </div>

    <?php if (!empty($items)) : ?>
        <?php foreach ($items as $item) : ?>
            <div class="cart" cart-id="<?= $item->id ?>">
                <div>
                    <ul class="list">
                        <li><?= $item->name ?></li>
                        <li><img src="<?= $item->img ?>" alt="<?= $item->name ?>"></li>
                        <li><?= $item->price ?>$</li>
                    </ul>
                    <div>
                        <button class="delete-button" delete-btn-id="<?= $item->id ?>">Delete</button>
                    </div>
                </div>
                <div>
                    <div class="wrapped">
                        <button class="minus">-</button>
                        <input type="text" class="num" value="01"></input>
                        <button class="plus">+</button>
                    </div>
                </div>
            </div>

        <?php endforeach ?>
    <?php else : ?>
        <div class="message">
            <pre>
            <h2>Your cart is empty</h2>
            <h2>Pleas go back</h2>
            </pre>

        </div>
    <?php endif ?>
    <script src="cart/cauntQuantity.js"></script>
    <script src="cart/deleteBtn.js"></script>
</body>


</html>