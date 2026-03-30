<?php

session_start();
require "connection.php";


if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $user = $_SESSION["u"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.category_cat_id,product.condition_condition_id,product.color_clr_id,
    product.status_status_id,product.size_size_id,product.users_email FROM `product` WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();

        $images = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
        $images_num = $images->num_rows;

        $category = Database::search("SELECT * FROM `category` INNER JOIN `product` ON `product`.`category_cat_id`=`category`.`cat_id` WHERE `product`.`id`='" . $pid . "'  ");
        $category_data = $category->fetch_assoc();

?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo $product_data["title"]; ?></title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="resources/logo.svg" />

        </head>

        <body>

            <div class="container-fluid">

                <div class="row mb-4">

                    <?php include "header.php"; ?>

                    <div class="row mt-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="allProducts.php" style="text-decoration:none ;">All</a></li>
                                <li class="breadcrumb-item"><a href="#" style="text-decoration:none ;"><?php echo $category_data["cat_name"] ?></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $product_data["title"] ?></li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row mt-1">
                        <div class="col-lg-1 ms-2">
                            <div class="row">
                                <?php
                                for ($x = 0; $x < $images_num; $x++) {
                                    $images_data = $images->fetch_assoc();
                                    $img[$x] = $images_data["img_path"];
                                ?>
                                    <img src="<?php echo $images_data["img_path"] ?>" class="image2 border" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" onload="mainImg(<?php echo $x; ?>)" />
                                <?php
                                }

                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4 border mainImg di1" style="height:75vh ;" id="mainImg">
                            <?php
                            $images1 = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                            $images1_data = $images1->fetch_assoc();
                            $img1 = $images1_data["img_path"];
                            ?>
                            <img src="" id="mainimg1" class="thumbnail" />
                            <?php
                            ?>
                        </div>
                        <div class="col-12 col-lg-6 order-3 ms-4">
                            <div class="row">
                            
                                <div class="col-12">
                                    <div class="row  border-secondary">
                                        <div class="col-12 my-2">
                                            <span class="fs-2 fw-bold text-dark"><?php echo $product_data["title"]; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row border-bottom border-dark">
                                    <div class="col-12 my-2">
                                        <?php
                                        $condition_rs = Database::search("SELECT * FROM `condition` WHERE `condition_id`='" . $product_data["condition_condition_id"] . "'");
                                        $condition_data = $condition_rs->fetch_assoc();
                                        ?>
                                        <span class="fs-5">condition : <?php echo $condition_data["condition_name"]; ?></span>


                                    </div>
                                </div>

                                <div class="row border-bottom border-dark mt-2 ">
                                    <div class="col-6 my-2">
                                        <span class="fs-4 text-dark fw-bold">Price : Rs.<?php echo $product_data["price"]; ?>.00</span>
                                    </div>

                                    <div class="col-5 my-2 d-grid">
                                        <button class="btn btn-dark" onclick="buyNow(<?php echo $product_data['id']; ?>);">Buy this now</button>&nbsp;
                                        <button class="btn btn-secondary border border-dark" <?php if($product_data["status_status_id"] == 1){?> onclick="addToCart(<?php echo $product_data['id']; }?>);">
                                            <i class="bi bi-cart-fill text-white fs-5"></i>
                                        </button>&nbsp;
                                        <button class="btn btn-body border border-dark mb-2" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">
                                            <i class="bi bi-heart-fill text-danger fs-5"></i>
                                        </button>
                                    </div>

                                </div>

                                <div class="row border-bottom border-dark mt-2 mb-3">
                                    <div class="col-12 my-2">
                                        <div class="row">
                                            <div class="col-6 my-2">
                                                <?php
                                                $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "'");
                                                $user_data = $user_rs->fetch_assoc();
                                                ?>
                                                <span class="text-secondary fw-bold">Seller : <?php echo $user_data["fname"]; ?></span>
                                            </div>
                                            <div class="col-6 my-2">
                                                <?php
                                            $status_rs = Database::search("SELECT * FROM `status` WHERE `status_id`='" . $product_data["status_status_id"] . "'");
                                            $status_data = $status_rs->fetch_assoc();
                                            ?>
                                                <span class="fs-5 text-danger fw-bold"><?php echo $status_data["status_name"];?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <label class="form-label text-center fw-bold" style="font-size: 16px;">Payment Methods</label>
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
                        </div>






                    </div>




                </div>

                <hr />

                <div class="row mt-4 mb-2">
                    <div class="col-12">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#" onclick="change2();">Description</a>

                            </li>
                            <li class="nav-item border" style="width:1150px ;">
                                <a class="nav-link " href="#" style="width:20% ;" onclick="change2();">Shipping Details</a>
                            </li>


                        </ul>
                    </div>
                </div>

                <div class="row mb-5" id="description">
                    <div class="col-12 mt-2">
                        <?php
                        $size_rs = Database::search("SELECT * FROM `size` WHERE `size_id`='" . $product_data["size_size_id"] . "'");
                        $size_data = $size_rs->fetch_assoc();
                        ?>
                        <span class="mt-1 ms-2 mb-3"><?php echo $product_data["description"]; ?></span><br /><br />
                        <span class="mt-1 ms-2 mb-3">Size : <?php echo $size_data["size_name"]; ?></span><br /><br />
                        <span class="ms-3 mt-4 text-secondary">Size Chart</span><br />
                        <img style="height: 270px;" class="ms-3 mb-3" src="resources/sz.jpg" />
                    </div>

                </div>

                <div class="row mb-5 d-none" id="shipping">
                    <div class="col-12 mt-2">
                        <span class="mt-1 ms-2 mb-3">Delivery fee colombo : Rs.400.00</span><br />

                        <span class="fs-4 ms-2 mt-4 text-danger">VENDOR INFORMATION</span><br /><br />
                        <span class="mt-1 ms-2 mb-3">Vendor's Name : <?php echo $user_data["fname"]; ?> <?php echo $user_data["lname"]; ?></span><br /><br />
                        <span class="mt-1 ms-2 mb-3">Vendor's Mobile No : <?php echo $user_data["mobile"]; ?> (For Negotitations)</span><br /><br />
                    </div>

                </div>

                <hr />

                <div class="col-12 bg-white">
                    <div class="row d-block me-0 mt-4 mb-3">
                        <div class="col-12 text-center">
                            <span class="fs-3 ms-2 fw-bold text-danger">Related Products</span>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="col-12">
                    <div class="row justify-content-center gap-2">

                        <?php

                        $related_rs = Database::search("SELECT * FROM `product` WHERE 
`category_cat_id`='" . $product_data["category_cat_id"] . "' LIMIT 4");
                        $related_num = $related_rs->num_rows;

                        for ($x = 0; $x < $related_num; $x++) {
                            $related_data = $related_rs->fetch_assoc();

                        ?>
                            <div class="card col-12 col-lg-2 mt-2 mb-2" style="width: 15rem;">

                                <?php

                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                            `product_id`='" . $related_data["id"] . "'");

                                $img_data = $img_rs->fetch_assoc();

                                ?>

                                <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-1" style="height: 200px;">
                                <div class="card-body ms-0 m-0">
                                    <h5 class="card-title fw-bold fs-5"><?php echo $related_data["title"]; ?></h5>
                                    <?php
                                    $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "'");
                                    $user_data = $user_rs->fetch_assoc();
                                    ?>
                                    <span class="mt-1">Sold By: <?php echo $user_data["fname"]; ?></span><br /><br />
                                    <span class="card-text fw-bolder fs-5 mt-3">Rs.<?php echo $related_data["price"]; ?>.00</span>
                                    <a href="<?php echo "singleProductView.php?id=" . ($related_data["id"]); ?>" class="col-12 btn btn-dark">Quick View</a>
                                    <button class="col-3 btn btn-body mt-2 border border-dark" onclick="addToCart(<?php echo $related_data['id']; ?>);">
                                        <i class="bi bi-cart-fill text-dark fs-5"></i>
                                    </button>
                                    <button onclick="addToWatchlist(<?php echo $related_data['id']; ?>);" class="col-3 btn btn-body mt-2 border border-dark">
                                        <i class="bi bi-heart-fill text-dark fs-5"></i>
                                    </button>
                                </div>
                            </div>
                        <?php
                        }

                        ?>



                    </div>
                </div>

                <div class="row">
                    <?php include "footer.php"; ?>
                </div>



                <script src="bootstrap.bundle.js"></script>
                <script src="script.js"></script>
                <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        </body>

        </html>
    <?php

    } else {
    ?> <script>
            alert("Something went wrong");
        </script> <?php
                }
            }else{
                header("location: index.php");
            }


                    ?>