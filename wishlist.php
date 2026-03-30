<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Wishlist</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources/logo.svg" />

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <?php include "header.php"; ?>

                <div class="col-12 bg-body mb-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="offset-lg-1 col-lg-2 col-12">

                                </div>
                                <div class="col-12 col-lg-6 text-center">
                                    <P class="fs-1 text-dark fw-bold mt-3 pt-2">Wishlist | THRIFT ESTOP</P>
                                </div>

                            </div>
                        </div>
                        <div class="offset-lg-5 col-12 col-lg-4 text-center">
                            <div class="row">
                                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="home.php" class="text-dark">Home</a></li>
                                        <li class="breadcrumb-item active text-dark" aria-current="page">wishlist</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
                <hr />

                <?php
                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE
                `users_email`='" . $_SESSION["u"]["email"] . "'");
                $watchlist_num = $watchlist_rs->num_rows;

                if ($watchlist_num == 0) {
                ?>
                    <!-- empty view -->
                    <div class="col-12 mt-5">
                        <div class="row">
                            <div class="col-12 emptyView"></div>
                            <div class="col-12 text-center">
                                <label class="form-label fs-2 fw-bold">No products added to the wishlist</label>
                            </div>
                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-2 mb-5">
                                <a href="home.php" class="btn btn-danger fs-4 fw-bold">Shop for products</a>
                            </div>
                        </div>
                    </div>
                    <!-- empty view -->
                <?php
                } else {
                    for($x = 0;$x < $watchlist_num;$x++){
                        $watchlist_data = $watchlist_rs->fetch_assoc();
                    
                ?>
                    <!-- have products -->
                    <div class="col-12 col-lg-9 ms-5">
                        <div class="row">

                            <div class="card mb-3 mx-0 mx-lg-2 col-12">
                                <div class="row g-0">
                                    <div class="col-md-4">

                                        <?php

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $watchlist_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();
                                        $clr_rs = Database::search("SELECT * FROM `color` WHERE `clr_id`='" . $product_data["color_clr_id"] . "'");
                                        $clr_data = $clr_rs->fetch_assoc();
                                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                            `product_id`='" . $product_data["id"] . "'");
                                        $img_data = $img_rs->fetch_assoc();
                                        $con_rs = Database::search("SELECT * FROM `condition` WHERE `condition_id`='" . $product_data["condition_condition_id"] . "'");
                                        $con_data = $con_rs->fetch_assoc();
                                        $size_rs = Database::search("SELECT * FROM `size` WHERE `size_id`='" . $product_data["size_size_id"] . "'");
                                        $size_data = $size_rs->fetch_assoc(); 
                                        $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "'");
                                        $user_data = $user_rs->fetch_assoc();

                                        ?>

                                        <img src="<?php echo $img_data["img_path"];?>" class="img-fluid rounded-start" style="height: 200px;" />
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card-body">

                                            <h5 class="card-title fs-2 fw-bold text-dark"><?php echo $product_data["title"];?></h5>

                                            
                                            

                                            <span class="fs-5 fw-bold text-black-50">Condition : <?php echo $con_data["condition_name"];?></span>
                                            <br />
                                            <span class="fs-5 fw-bold text-danger">Size : <?php echo $size_data["size_name"];?></span>
                                            <br />
                                            <span class="fs-5 fw-bold text-black-50">Price :</span>&nbsp;&nbsp;
                                            <span class="fs-5 fw-bold text-black">Rs. <?php echo $product_data["price"];?> .00</span>
                                            <br />
                                            
                                            <span class="fs-5 fw-bold text-black-50">Seller :</span>
                                            
                                            <span class="fs-5 fw-bold text-black"><?php echo $user_data["fname"];?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-5">
                                        <div class="card-body d-lg-grid">
                                            <a href="#" onclick="addToCart(<?php echo $product_data['id']; ?>);" class="btn btn-secondary mb-2">Add to Cart</a>
                                            <a href="#" onclick="removeFromWatchlist(<?php echo $watchlist_data['id'];?>);" class="btn btn-outline-danger">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- have products -->

                <?php
                }
                }
                ?>










                <?php include "footer.php"; ?>
            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php
}else{
    header("location: index.php");
}

?>