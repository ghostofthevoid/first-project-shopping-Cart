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

isset($_SESSION["items"]) ? $quantity = count($_SESSION["items"]) : $quantity = 0;



// tt($_SESSION);


// session_unset();
// session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
<link rel="stylesheet" href="Public\style\components\cart.css">

<body>
    <section class="h-100  h-custom py-5" style="background-color: #eee;">
        <div class="container h-100 py-5 ">
            <div class="row d-flex  justify-content-center h-100 ">
                <div class="col-xl-8">
                    <div class="card shopping-cart justify-content-center py-5" style="border-radius: 15px;">
                        <?php if (!empty($items)) : ?>
                            <div class="card-body text-black ">
                                <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Your products</h3>
                                <?php foreach ($items as $item) : ?>
                                    <div class="cart d-flex align-items-center mb-5 ">
                                        <div class="flex-shrink justify-content-start ">
                                            <img src="Public/images/<?= $item->id ?>.png" class="mx-auto d-block" style="width: 150px; height: 150px" alt="<?= $item->name ?>">
                                        </div>

                                        <div class="flex-grow-1 ms-3  ">
                                            <div class="btn-del container-fluid ">
                                                <button type="button" class=" delete-button btn btn-outline-danger" delete-btn-id="<?= $item->id ?>"><i class="fa-solid fa-trash-can"></i></button>
                                            </div>
                                            <div class="container">
                                                <h5 class="name text-primary"><?= $item->name ?></h5>
                                                <h6 style="color: #9e9e9e;">Color: <?= $item->color ?></h6>
                                            </div>
                                            <div class="d-flex align-items-center ms-auto fw-bolder pb-2">
                                                <p class="price fw-bold mb-0 me-5 pe-3"><?= $item->price ?>$</p>
                                                <div class="wrapped container-sm  justify-content-between " style="max-width: 150px">
                                                    <button type="button" class="minus btn btn-white fs-3 fw-bolder">-</button>
                                                    <input type="text" class="num form-control fs-3 fw-bold " value="01"></input>
                                                    <button type="button" class="plus btn btn-white fs-3   fw-bolder">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                                <hr class="mb-4" style="height: 2px; background-color: #1266f1; opacity: 1;">
                                <div class="d-flex justify-content-between p-2 mb-2" style="background-color: #e1f5fe;">
                                    <h5 class="fw-bold mb-0">Total:</h5>
                                    <h5 class="fw-bold mb-0" id="total">0</h5>
                                </div>

                                <hr class="mb-4" style="height: 2px; background-color: #1266f1; opacity: 1;">
                                <div class="d-grid mt-5">
                                    <button type="button" class="btn buy-btn btn-block btn-lg fw-bold">Buy now</button>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="container  py-5 ">
                                <div class="alert alert-primary py-5">
                                    <strong>Info!</strong> Your cart is empty pleas GO back <a href="index.php" class="alert-link">HOME:)</a>.
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="Public/js/components/cauntQuantity.js"></script>
    <script src="Public/js/components/deleteBtn.js"></script>
</body>
<?php include("footer.php"); ?>

</html>