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

<body>

  <div class="container">
    <section class="display_product">
      <table class="styled-table">
        <thead>
          <th>Name</th>
          <th>Image</th>
          <th>Price</th>
          <th>Action</th>
        </thead>
        <?php foreach ($products as $item) : ?>
          <tbody>
            <tr>
              <td><?= $item->name ?></td>
              <td><img src="<?= $item->img ?>"></td>
              <td><?= $item->price ?>$</td>
              <td><button class="add-product-to-card" data-shit-id="<?= $item->id ?>"><i class='bx bxs-cart'></i></button></td>
            </tr>
          </tbody>
        <?php endforeach; ?>
      </table>
    </section>
  </div>
  <script src="js/index.js"></script>

</body>

</html>