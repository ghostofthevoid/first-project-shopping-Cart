<?php
session_start();
include "connector.php";
$products = selectAll("products");
isset($_SESSION["items"]) ? $quantity = count($_SESSION["items"]) : $quantity = 0;



// tt($_SESSION)
?>

<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>

</body>
<section class="p-5">
  <div class="container py-5">
    <div class="row text-center">
      <?php foreach ($products as $item) : ?>
        <div class="col-md-8 col-lg-6 col-xl-4">
          <div class="card" style="border-radius: 15px;">
            <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
              <img src="Public/images/<?= $item->id ?>.png" style="border-top-left-radius: 15px; border-top-right-radius: 15px; height: 300px;" class="img-fluid" alt="<?= $item->name ?>" />
              <a href="#!">
                <div class="mask"></div>
              </a>
            </div>
            <div class="card-body pb-0">
              <div class="d-flex justify-content-between">
                <div>
                  <p><?= $item->name ?></p>
                </div>
                <div>
                  <p class="small text-muted">Rated 4.0/5</p>
                </div>
              </div>
            </div>
            <hr class="my-0" />
            <div class="card-body pb-0">
              <div class="d-flex justify-content-between">
                <p><?= $item->price ?>$</p>
                <p class="text-dark">#### 8787</p>
              </div>
              <p class="small text-muted">VISA Platinum</p>
            </div>
            <hr class="my-0" />
            <div class="card-body">
              <div class="d-flex justify-content-center align-items-center pb-2 mb-1">
                <button type="button" class="btn add-btn add-product-to-card btn-lg" data-shit-id="<?= $item->id ?>">Buy now</button>
              </div>
            </div>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
  </div>
</section>
<script src="Public/js/index.js"></script>
</body>

</html>