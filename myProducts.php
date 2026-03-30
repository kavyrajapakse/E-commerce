<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];

    $pageno;


?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>My Products</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources/logo.svg" />

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <!-- header -->
                <div class="col-12 bg-transperant">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                

                                <div class="col-12 col-lg-4">
                                    <div class="row text-center text-lg-start">
                                        
                                        <div class="col-12 mt-5">
                                            <span class="text-dark fw-bold"><?php echo $email; ?></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 col-lg-10 mt-2 my-lg-4">
                                    <h1 class="offset-4 offset-lg-2 text-dark fw-bold">My Products</h1>
                                </div>
                                <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid">
                                    <button class="btn btn-secondary fw-bold" onclick="window.location='addProduct.php'"><i class="bi bi-plus-circle"></i>&nbsp;Add Product</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- header -->

                <div class="col-12 bg-secondary-subtle">
                    <div class="row">
                        <div class="col-12 offset-lg-3 col-lg-6 bg-body border border-dark mt-3 mb-3 rounded">
                            <div class="col-12 mt-2 text-center">
                                <label class="form-label fw-bold fs-3">Sort Products</label>
                            </div>
                            <div class="col-lg-10 mt-3 col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-lg-4 mb-3">
                                                <select class="form-select" id="condition">
                                                    <option value="0">By Condition</option>
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
                                            <div class="col-12 col-lg-3 mb-3">
                                                <select class="form-select" id="size">
                                                    <option value="0">By Size</option>
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
                                            <div class="col-12 offset-lg-1 col-lg-4">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold">Active Time</label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="r1" id="n">
                                                        <label class="form-check-label" for="n">
                                                            Newest to oldest
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="r1" id="o">
                                                        <label class="form-check-label" for="o">
                                                            Oldest to newest
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="mt-3 col-12">
                                <div class="col-12 offset-lg-3 col-lg-6 mt-4 mb-1">
                                    <input type="text" class="form-control" placeholder="Type keyword to search..." id="s" />
                                </div>
                                <div class="col-12 offset-lg-5 col-lg-4 mt-2 mb-3">
                                    <button class="btn btn-secondary" onclick="sort(0);">Sort</button>
                                    <button class="btn btn-danger" onclick="clearSort();">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 offset-lg-2 col-lg-8 mt-3 mb-3 bg-body">
                    <div class="row" id="sort">

                        <div class="offset-1 col-10 text-center">
                            <div class="row justify-content-center">

                                <?php
 
                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }

                                $product_rs = Database::search("SELECT * FROM `product` WHERE `users_email`='" . $email . "'");
                                $product_num = $product_rs->num_rows;

                                $results_per_page = 4;
                                $number_of_pages = ceil($product_num / $results_per_page);

                                $page_results = ($pageno - 1) * $results_per_page;
                                $selected_rs = Database::search("SELECT * FROM `product` WHERE `users_email`='" . $email . "'
                                LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                $selected_num = $selected_rs->num_rows;

                                for ($x = 0; $x < $selected_num; $x++) {
                                    $selected_data = $selected_rs->fetch_assoc();

                                ?>

                                    <div class="card mb-3 mt-3 col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-4 mt-4">

                                                <?php

                                                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE
                                            `product_id`='" . $selected_data["id"] . "'");

                                                $product_img_data = $product_img_rs->fetch_assoc();

                                                ?>

                                                <img src="<?php echo $product_img_data["img_path"]; ?>" class="img-fluid rounded-start" />
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                                    <span class="card-text fw-bold text-dark">Rs. <?php echo $selected_data["price"]; ?>.00</span><br /><br/>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="<?php echo $selected_data["id"]; ?>" onchange="changeStatus(<?php echo $selected_data['id']; ?>);" <?php if ($selected_data["status_status_id"] == 2) { ?> checked <?php } ?> />
                                                        <label class="form-check-label fw-bold text-secondary" for="<?php echo $selected_data["id"]; ?>">
                                                            <?php if ($selected_data["status_status_id"] == 2) { ?>
                                                                Activate Product
                                                            <?php } else {
                                                            ?>
                                                                Deactivate Product
                                                            <?php
                                                            } ?>
                                                        </label>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row g-1 mt-1">
                                                                <div class="col-12 col-lg-6 d-grid">
                                                                    <button class="btn btn-dark" onclick="sendId(<?php echo $selected_data['id']; ?>);">Update</button>
                                                                </div>
                                                                <div class="col-12 col-lg-6 d-grid">
                                                                    <button class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                
                                        </div>
                                    </div>

                                <?php
                                }

                                ?>

                                <!-- card -->

                                <!-- card -->

                            </div>
                        </div>

                        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-lg justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" href="
                                            <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                                echo "?page=" . ($pageno - 1);
                                            }

                                            ?>
                                            " aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <?php

                                    for ($y = 1; $y <= $number_of_pages; $y++) {
                                        if ($y == $pageno) {
                                    ?>
                                            <li class="page-item active">
                                                <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="page-item">
                                                <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                            </li>
                                            </li>
                                    <?php
                                        }
                                    }

                                    ?>





                                    <li class="page-item">
                                        <a class="page-link" href="
                                            <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                                echo "?page=" . ($pageno + 1);
                                            }

                                            ?>
                                            " aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- product -->




            </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>

<?php

}

?>