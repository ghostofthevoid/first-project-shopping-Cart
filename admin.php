<?php
session_start();
include "connector.php";
$products = selectAll("products");
isset($_SESSION["items"]) ? $quantity = count($_SESSION["items"]) : $quantity = 0;

?>
<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
<link rel="stylesheet" href="Public/style/style.css">
<link rel="stylesheet" href="tests/product_list.css">

<body>
    <!-- form start -->
    <div class="offcanvas offcanvas-sm offcanvas-end .was-validated" id="add-form">

        <div class="container-sm  ">
            <h2>Stacked form</h2>
            <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="was-validated" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <label for="name">Product's name:</label>
                    <input type="text" class="form-control  " placeholder="Enter name" name="name" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3">
                    <label for="color">Product's color:</label>
                    <input type="text" class="form-control" placeholder="Enter color" name="color" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3">
                    <label for="price">Product's price:</label>
                    <input type="text" class="form-control" placeholder="Enter price" name="price" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="input-group mb-3">
                    <label for="pwd">Product's image:</label>
                    <input class="form-control-sm" type="file" name="img" id="fileToUpload">
                </div>
                <button type="submit" name="submit" class="btn butt">Submit</button>
            </form>
        </div>
    </div>
    <!-- form end -->
    <!-- main section -->
    <section class="h-50  h-custom py-5 justify-content-center" style="background-color: #eee;">

        <div class="container h-100 py-5 ">
            <div class="table-responsive-sm justify-content-center mx-5">
                <table class="table table-sm align-middle table-borderless ">
                    <thead>
                        <tr class="table-info">
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <?php foreach ($products as $item) : ?>
                        <tbody class="item-body">
                            <tr>
                                <th scope="row"><?= $item->id ?></th>
                                <td><?= $item->name ?></td>
                                <td><?= $item->price ?>$</td>
                                <td><img src="Public/images/<?= $item->id ?>.png" alt="#" style="height: 150px; width: 150px"></td>
                                <td><button type="button" class="btn btn-danger remove-btn" delete-btn-id="<?= $item->id ?>">
                                        Remove</button></td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                </table>
                <div class="container-fluid mt-3 bg-light">
                    <h3>Add a product to db</h3>
                    <button class="btn butt" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-form">
                        Add product
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- end main section -->

    <script src="Public/js/components/stop_resubmit.js"></script>
    <script src="Public/js/components/admin.js"></script>
</body>

<?php
$name = $price = $color = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST['name']);
    $price = test_input($_POST['price']);
    $color = test_input($_POST['color']);
}

$insertArray = ["name" => $name, 'img' => "", 'price' => $price, 'color' => $color];
$imgName = "";
if (isset($_POST['submit'])) {
    $imgName =  insertDataToDb('products', $insertArray, $conn);
}

// echo '<pre>';
// var_dump($_FILES['img']);
// echo '</pre>';

if (!empty($_FILES["img"])) {
    $name = "{$imgName}.png";

    try {
        move_uploaded_file($_FILES['img']['tmp_name'], "Public/images/$name");

        var_dump("done ? ");
    } catch (\Throwable $th) {
        echo json_encode($th);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

</html>