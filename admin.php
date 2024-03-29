<?php
session_start();
include "connector.php";
$products = array_reverse(selectAll("products"));
isset($_SESSION["items"]) ? $quantity = count($_SESSION["items"]) : $quantity = 0;

?>
<!DOCTYPE html>
<html lang="en">
<?php include("header.php"); ?>
<link rel="stylesheet" href="Public/style/style.css">
<link rel="stylesheet" href="Public/style/components/product_list.css">



<body>
    <!-- Add Product Modal -->
    <div class="modal fade" id="addModal">
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
                        <form method="post" action="api.php" class="was-validated" id="form-add" name="form-add" enctype="multipart/form-data">
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
                            <button type="submit" name="submit" class="btn btn-submit btn-primary ">Submit</button>
                        </form>
                    </div>
                    <!-- form end -->
                </div>
            </div>
        </div>
    </div>

    <!-- End of add product modal -->

    <!-- The edit modal -->
    <div class="modal fade" id="editModal">
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
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="mb-3 mt-3">
                                <label for="name">Edit name:</label>
                                <input type="text" class="form-control fw-bold" id="editName" placeholder="Enter name" name="name" value="" required>
                            </div>
                            <div class="mb-3">
                                <label for="color">Edit color:</label>
                                <input type="text" class="form-control fw-bold" id="editColor" placeholder="Enter color" name="color" value="">
                            </div>
                            <div class="mb-3">
                                <label for="price">Edit price:</label>
                                <input type="text" class="form-control fw-bold" id="editPrice" placeholder="Enter price" name="price" value="0">
                            </div>
                            <div class="input-group mb-3">
                                <label for="pwd">Edit image: </label><br>
                                <input class="form-control-sm" type="file" name="img" id="fileToUpload">
                            </div>
                            <button type="button" name="edit" id="edit-form" class="btn btn-warning ">Confirm</button>
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
        <section class="h-50  h-custom py-5 justify-content-center" id="main-sectin" style="background-color: #eee;">
            <div class="container h-100 py-5 ">
                <div class="table-responsive-sm mx-5">
                    <table class="table table-sm  align-middle table-borderedless  " id="prodTable">
                        <div class="alert-mess">

                        </div>
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
                                    <td id="prodCell2<?= $item->id ?>">
                                        <h4 class="name text-dark"><?= $item->name ?></h4>
                                        <h6 style="color: #9e9e9e;">Color: <?= $item->color ?></h6>
                                    </td>
                                    <td id="prodCell3<?= $item->id ?>"><?= $item->price ?>$</td>
                                    <!-- <td id="prodCell4<?= $item->id ?>"><?= $item->color ?></td> -->
                                    <td id="prodCell4<?= $item->id ?>"><img src="Public/images/<?= $item->id ?>.png" alt="#" style="height: 150px; width: 150px"></td>
                                    <td>
                                        <button type="button" class="btn btn-warning edit-btn" edit-btn-id="<?= $item->id ?>" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
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
                <button class="btn  text-uppercase butt " type="button" data-bs-toggle="modal" data-bs-target="#addModal">
                    Add New
                </button>
            </div>
        </section>
        <!-- end main section -->

        <script src="Public/js/components/stopResubmit.js"></script>
        <script src="Public/js/components/addProdToDb.js"></script>
        <script src="Public/js/components/editProdData.js"></script>
        <script src="Public/js/components/DelProdFromDb.js"></script>
</body>
<?php include("footer.php"); ?>

</html>