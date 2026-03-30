<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_SESSION["p"])) {
        $product = $_SESSION["p"];
?>

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

                    include "header.php";
                    ?>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 text-center">
                                <h2 class="h2 text-white fw-bold">Update Product</h2>
                            </div>


                            <div class="col-12 offset-lg-1 col-lg-6 mt-5 mb-5 border border-secondary">
                                <div class="row">

                                    <div class="col-12 mt-1">
                                        <label class="form-label fw-bold" style="font-size: 16px;">
                                            Product Title
                                        </label>
                                        <input type="text" class="form-control" id="title" value="<?php echo $product["title"]; ?>" />
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 16px;">Product Description</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea cols="30" rows="10" class="form-control" id="desc"><?php echo $product["description"]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <label class="form-label fw-bold" style="font-size: 16px;">Product Category</label>
                                        <select class="form-select text-center" id="category" disabled>
                                            <?php

                                            $category_rs = Database::search("SELECT * FROM `category` WHERE 
                                                    `cat_id`='" . $product["category_cat_id"] . "'");
                                            $category_data = $category_rs->fetch_assoc();
                                            ?>
                                            <option><?php echo $category_data["cat_name"]; ?></option>
                                        </select>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <label class="form-label fw-bold" style="font-size: 16px;">Product Size</label>
                                        <select class="form-select text-center" id="size" disabled>
                                            <?php

                                            $size_rs = Database::search("SELECT * FROM `size` WHERE 
                                                    `size_id`='" . $product["size_size_id"] . "'");
                                            $size_data = $size_rs->fetch_assoc();
                                            ?>
                                            <option><?php echo $size_data["size_name"]; ?></option>
                                        </select>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <label class="form-label fw-bold" style="font-size: 16px;">Product Condition</label>
                                        <select class="form-select text-center" id="condition" disabled>
                                            <?php

                                            $condition_rs = Database::search("SELECT * FROM `condition` WHERE 
                                                    `condition_id`='" . $product["condition_condition_id"] . "'");
                                            $condition_data = $condition_rs->fetch_assoc();
                                            ?>
                                            <option><?php echo $condition_data["condition_name"]; ?></option>
                                        </select>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <label class="form-label fw-bold" style="font-size: 16px;">Product Color</label>
                                        <select class="form-select text-center" id="color" disabled>
                                            <?php

                                            $clr_rs = Database::search("SELECT * FROM `color` WHERE 
                                                    `clr_id`='" . $product["color_clr_id"] . "'");
                                            $clr_data = $clr_rs->fetch_assoc();
                                            ?>
                                            <option><?php echo $clr_data["clr_name"]; ?></option>
                                        </select>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <label class="form-label fw-bold" style="font-size: 16px;">Original Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" id="cost" value="<?php echo $product["price"]; ?>" />
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <label class="form-label fw-bold" style="font-size: 16px;">Product Quantity</label>
                                        <input type="number" class="form-control" value="<?php echo $product["qty"]; ?>" min="0" id="qty" disabled />
                                    </div>

                                

                                    

                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <label class="form-label text-center fw-bold" style="font-size: 16px;">Approved Payment Methods</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="offset-2 offset-lg-2 col-2 pm pm1"></div>
                                                <div class="col-2 pm pm2"></div>
                                                <div class="col-2 pm pm3"></div>
                                                <div class="col-2 pm pm4"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-4 ms-2 mt-5 mb-5 border border-secondary">
                                <div class="row">
                                    <div class="col-12 text-center mt-3">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                                    </div>
                                    <div class="offset-lg-1 col-lg-6 col-12 mt-4 text-center align-content-center">
                                        <?php
                                        $img = array();
                                        $img[0] = "resources/addproduct.svg";
                                        $img[1] = "resources/addproduct.svg";
                                        $img[2] = "resources/addproduct.svg";
                                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product["id"] . "'");
                                        $img_num = $img_rs->num_rows;
                                        for ($x = 0; $x < $img_num; $x++) {
                                            $img_data = $img_rs->fetch_assoc();
                                            $img[$x] = $img_data["img_path"];
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-12 border border-dark rounded">
                                                <img src="<?php echo $img[0];?>" class="img-fluid" style="width: 200px;" id="i0" />
                                            </div>
                                            <div class="col-12 mt-1 border border-dark rounded">
                                                <img src="<?php echo $img[1];?>" class="img-fluid" style="width: 200px;" id="i1" />
                                            </div>
                                            <div class="col-12 mt-1 border border-dark rounded">
                                                <img src="<?php echo $img[2];?>" class="img-fluid" style="width: 200px;" id="i2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-4">
                                        <input type="file" class="d-none" id="imageuploader" multiple />
                                        <label for="imageuploader" class="col-12 btn btn-secondary" onclick="changeProductImage();">Upload Images</label>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                <button class="btn btn-danger" onclick="updateProduct();">Update Product</button>
                            </div>


                        </div>
                    </div>





                    <?php

                    ?>

                    <?php include "footer.php" ?>

                </div>
            </div>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
        </body>

        </html>
    <?php

    } else {
    ?>
        <script>
            alert("Please select a product");
            window.location = "myProducts.php";
        </script>
    <?php
    }
} else {
    ?>
    <script>
        alert("You have to log in first");
        window.location = "index.php";
    </script>
<?php

}

?>