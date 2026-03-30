<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add New Product</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.svg" />

</head>

<body>

    <div class="container-fluid bg-body">
        <div class="row gy-3">

            <?php

            session_start();
            require "connection.php";

            include "header.php";

            if (isset($_SESSION["u"])) {

            ?>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12 text-center bg-transperant">
                            <h2 class="h2 text-dark fw-bold">Add New Product</h2>
                        </div>

                        <div class="col-12 d-none" id="msgDiv">
                            <div class="alert alert-danger" role="alert" id="msg">

                            </div>
                        </div>
                        <div class="col-12 offset-lg-1 col-lg-6 mt-5 mb-5 border border-secondary">
                            <div class="row">

                                <div class="col-12 mt-1">
                                    <label class="form-label fw-bold" style="font-size: 16px;">
                                        Product Title
                                    </label>
                                    <input type="text" class="form-control" id="title" />
                                </div>

                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 16px;">Product Description</label>
                                        </div>
                                        <div class="col-12">
                                            <textarea cols="30" rows="10" class="form-control" id="desc"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 mt-3">
                                    <label class="form-label fw-bold" style="font-size: 16px;">Product Category</label>
                                    <select class="form-select text-center" id="category">
                                        <option value="0">Select Category</option>
                                        <?php
                                        $category_rs = Database::search("SELECT * FROM `category`");
                                        $category_num = $category_rs->num_rows;

                                        for ($x = 0; $x < $category_num; $x++) {
                                            $category_data = $category_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6 mt-3">
                                    <label class="form-label fw-bold" style="font-size: 16px;">Product Size</label>
                                    <select class="form-select text-center" id="size">
                                        <option value="0">Select Size</option>
                                        <?php
                                        $size_rs = Database::search("SELECT * FROM `size`");
                                        $size_num = $size_rs->num_rows;

                                        for ($x = 0; $x < $size_num; $x++) {
                                            $size_data = $size_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $size_data["size_id"]; ?>"><?php echo $size_data["size_name"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6 mt-3">
                                    <label class="form-label fw-bold" style="font-size: 16px;">Product Condition</label>
                                    <select class="form-select text-center" id="con">
                                        <option value="0">Select Condition</option>
                                        <?php
                                        $condition_rs = Database::search("SELECT * FROM `condition`");
                                        $condition_num = $condition_rs->num_rows;

                                        for ($x = 0; $x < $condition_num; $x++) {
                                            $condition_data = $condition_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $condition_data["condition_id"]; ?>"><?php echo $condition_data["condition_name"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6 mt-3">
                                    <label class="form-label fw-bold" style="font-size: 16px;">Product Color</label>
                                    <select class="form-select text-center" id="color">
                                        <option value="0">Select Color</option>
                                        <?php
                                        $color_rs = Database::search("SELECT * FROM `color`");
                                        $color_num = $color_rs->num_rows;

                                        for ($x = 0; $x < $color_num; $x++) {
                                            $color_data = $color_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $color_data["clr_id"]; ?>"><?php echo $color_data["clr_name"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6 mt-3">
                                    <label class="form-label fw-bold" style="font-size: 16px;">Original Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="number" class="form-control" id="cost" value="0" min="1"/>
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>

                                <div class="col-6 mt-3">
                                    <label class="form-label fw-bold" style="font-size: 16px;">Product Quantity</label>
                                    <input type="number" class="form-control" value="0" min="0" id="qty" />
                                </div>

                                



                            </div>
                        </div>

                        <div class="col-12 col-lg-4 ms-2 mt-5 mb-5 border border-secondary">
                            <div class="row">
                                <div class="col-12 text-center mt-3">
                                    <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                                </div>
                                <div class="offset-lg-1 col-lg-6 col-12 mt-4 text-center align-content-center">
                                    <div class="row">
                                        <div class="col-12 border border-dark rounded">
                                            <img src="resources/addproduct.svg" class="img-fluid" style="width: 200px;" id="i0" />
                                        </div>
                                        <div class="col-12 mt-1 border border-dark rounded">
                                            <img src="resources/addproduct.svg" class="img-fluid" style="width: 200px;" id="i1" />
                                        </div>
                                        <div class="col-12 mt-1 border border-dark rounded">
                                            <img src="resources/addproduct.svg" class="img-fluid" style="width: 200px;" id="i2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                    <input type="file" class="d-none" id="imageuploader" multiple />
                                    <label for="imageuploader" class="col-12 btn btn-outline-secondary" onclick="changeProductImage();">Upload Images</label>
                                </div>
                            </div>
                        </div>

                        

                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-1 mb-3">
                            <button class="btn btn-danger" onclick="addProduct();">Add Product</button>
                        </div>


                    </div>
                </div>





            <?php

            } else {
                header("Location:home.php");
            }

            ?>

            <?php include "footer.php" ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>