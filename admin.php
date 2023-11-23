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
<link rel="stylesheet" href="Public/style/components/product_list.css">



<body>
    <!-- Add Product Modal -->
    <div class="modal fade" id="modalAdd">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Form to add a product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- form start -->
                    <div class="container-sm  ">
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
                                <input class="form-control-sm" type="file" name="img" id="fileToUpload" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary ">Submit</button>
                        </form>
                    </div>
                    <!-- form end -->
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End of add product modal -->

    <!-- The edit modal -->
    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title fw-bolder">Edit your data</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- form start -->
                    <div class="container-sm  ">
                        <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
                            <div class="mb-3 mt-3">
                                <label for="name">Edit name:</label>
                                <input type="text" class="form-control fw-bold" id="editName" placeholder="Enter name" name="name" value="">
                            </div>
                            <div class="mb-3">
                                <label for="color">Edit color:</label>
                                <input type="text" class="form-control fw-bold" id="editColor" placeholder="Enter color" name="color" value="">
                            </div>
                            <div class="mb-3">
                                <label for="price">Edit price:</label>
                                <input type="text" class="form-control fw-bold" id="editPrice" placeholder="Enter price" name="price" value="">
                            </div>
                            <div class="input-group mb-3">
                                <label for="pwd">Edit image: </label><br>
                                <input class="form-control-sm" type="file" name="img" id="fileToUpload">
                            </div>
                            <button type="submit" name="edit" class="btn btn-warning ">Confirm</button>
                        </form>
                    </div>
                    <!-- form end -->
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- end edit modal-->
    <!-- main section -->
    <?php if (!empty($products)) : ?>
        <section class="h-50  h-custom py-5 justify-content-center" style="background-color: #eee;">
            <div class="container h-100 py-5 ">
                <div class="table-responsive-sm mx-5">
                    <table class="table table-sm  align-middle table-borderedless  ">
                        <p class="h2 fw-bold">Available products</p>
                        <thead>
                            <tr class="table-info ">
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
                                    <th scope="row" class="pl-5"><?= $item->id ?></th>
                                    <td><?= $item->name ?></td>
                                    <td><?= $item->price ?>$</td>
                                    <td><img src="Public/images/<?= $item->id ?>.png" alt="#" style="height: 150px; width: 150px"></td>
                                    <td>
                                        <button type="button" class="btn btn-warning edit-btn" edit-btn-id="<?= $item->id ?>" data-bs-toggle="modal" data-bs-target="#modalEdit">Edit</button>
                                        <button type="button" class="btn btn-danger remove-btn" delete-btn-id="<?= $item->id ?>"> Remove</button>

                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
                </div>
            </div>
            <div class="container add-btn">
                <div class=" position-absolute bottom-0 end-0"></div>
                <button class="btn  text-uppercase butt " type="button" data-bs-toggle="modal" data-bs-target="#modalAdd">
                    Add New
                </button>
            </div>
        </section>
        <!-- end main section -->

        <script src="Public/js/components/stop_resubmit.js"></script>
        <script src="Public/js/components/admin.js"></script>
</body>
<?php include("footer.php"); ?>

<?php
function test_input($data)
{
    $data = ucfirst($data);
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$name = $price = $color = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST['name']);
    $price = test_input($_POST['price']);
    $color = test_input($_POST['color']);
}

$insertArray = ["name" => $name, 'price' => $price, 'color' => $color];
$imgName = "";
if (isset($_POST['submit'])) {
    $imgName =  insertDataToDb('products', $insertArray, $conn);
}

if (!empty($_FILES["img"])) {
    $name = "{$imgName}.png";
    try {
        move_uploaded_file($_FILES['img']['tmp_name'], "Public/images/$name");
    } catch (\Throwable $th) {
        echo json_encode($th);
    }
}

?>

</html>