<?php

include "connection.php";
session_start();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>All Products</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.svg" />
</head>

<body>

    <div class="container-fluid">
        <div class="row mb-3">

            <?php include "header.php"; ?>
        </div>

    </div>

    <div class="container-fluid px-4" id="pro_view">
        <?php
        $query = "SELECT * FROM `product`";

        ?>
        <div class="row mb-4 gx-3">

            <div class="row">
                <div class="col-12">
                    <div class="row justify-content-center gap-4">

                        <?php


                        if ("0" != ($_GET["page"])) {
                            $pageno = $_GET["page"];
                        } else {
                            $pageno = 1;
                        }


                        $product_rs = Database::search($query);
                        $product_num = $product_rs->num_rows;

                        $results_per_page = 20;
                        $number_of_pages = ceil($product_num / $results_per_page);

                        $page_results = ($pageno - 1) * $results_per_page;
                        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " 
                                        OFFSET " . $page_results . " ");

                        $selected_num = $selected_rs->num_rows;

                        for ($x = 0; $x < $selected_num; $x++) {
                            $selected_data = $selected_rs->fetch_assoc();

                            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE#
                                            `product_id`='" . $selected_data["id"] . "'");

                            $product_img_data = $product_img_rs->fetch_assoc();

                        ?>
                            <!-- card -->
                            <div class="card col-12 col-lg-2 mt-2 mb-2" style="width: 15rem;">


                                <img src="<?php echo $product_img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 200px;">
                                <div class="card-body ms-0 m-0 text-center">
                                    <h5 class="card-title fw-bold fs-6"><?php echo $selected_data["title"]; ?></h5>
                                    <?php
                                    $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $selected_data["users_email"] . "'");
                                    $user_data = $user_rs->fetch_assoc();
                                    ?>
                                    <span class="mt-1">Sold By: <?php echo $user_data["fname"]; ?></span><br /><br />
                                    <span class="card-text fw-bolder fs-5 mt-3">Rs.<?php echo $selected_data["price"]; ?>.00</span>
                                    <a href="<?php echo "singleProductView.php?id=" . ($selected_data["id"]); ?>" class="col-12 btn btn-dark">Quick View</a>
                                    <button class="col-3 btn btn-body mt-2 border border-dark">
                                        <i class="bi bi-cart-fill text-dark fs-5"></i>
                                    </button>
                                    <button class="col-3 btn btn-body mt-2 border border-dark">
                                        <i class="bi bi-heart-fill text-dark fs-5"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- card -->

                        <?php
                        }

                        ?>

                    </div>
                </div>

                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-lg justify-content-center">
                            <li class="page-item">
                                <a class="page-link" <?php if ($pageno <= 1) {
                                                            echo ("#");
                                                        } else {
                                                        ?> onclick="productPage(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                }

                                                                                                    ?> aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <?php

                            for ($y = 1; $y <= $number_of_pages; $y++) {
                                if ($y == $pageno) {
                            ?>
                                    <li class="page-item active">
                                        <a class="page-link" onclick="productPage(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link" onclick="productPage(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                                    </li>
                                    </li>
                            <?php
                                }
                            }

                            ?>





                            <li class="page-item">
                                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                            echo ("#");
                                                        } else {
                                                        ?> onclick="productPage(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                }

                                                                                                    ?> aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>



            </div>


        </div>
       
    </div>

    <div class="container-fluid">
        <div class="row">

            <?php include "footer.php"; ?>
        </div>

    </div>

   

</body>

</html>