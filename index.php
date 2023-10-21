<?php
session_start();
include("conection/dbcon.php");
include("header.php");
include("conection/db.php");
$products = selectAll("products");
tt($_SESSION)
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Viwe Products</title>
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="style/header.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

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
              <td><?= $item->price ?><i class='bx bxs-dollar-circle bx-rotate-180'></i></td>
              <td><button class="add-product-to-card" data-shit-id="<?= $item->id ?>"><i class='bx bxs-cart'></i></button></td>
            </tr>
          </tbody>
        <?php endforeach; ?>
      </table>
    </section>
  </div>
  <script src="index.js"></script>

</body>

</html>