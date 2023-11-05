<?php
session_start();
include "connector.php";
$items = [];

if (!empty($_SESSION['items'])) {
    foreach ($_SESSION['items'] as $item) {
        $items[] = json_decode($item);
    }
}
$items  = flattenArray($items);
$quantity = count($_SESSION["items"]);

// tt($_SESSION);


// session_unset();
// session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>

<body>
    <button class="btn">
        PURCHASE
    </button>
    <div class="total-sum">
        <span>
            <div id="total">0</div>
        </span>
    </div>

    <?php if (!empty($items)) : ?>
        <?php foreach ($items as $item) : ?>
            <div class="cart" cart-id="<?= $item->id ?>">
                <div>
                    <ul class="list">
                        <li class="name"><?= $item->name ?></li>
                        <li><img src="<?= $item->img ?>" alt="<?= $item->name ?>"></li>
                        <li class="price"><?= $item->price ?>$</li>
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
    <script src="js/components/cauntQuantity.js"></script>
    <script src="js/components/deleteBtn.js"></script>
</body>


</html>