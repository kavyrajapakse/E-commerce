<?php

session_start();
require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.svg" />
</head>

<body>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12 mt-2 mb-2">
                <div class="row">

                    <div class="col-12 offset-lg-1 col-lg-2 ">
                        <P class="fs-1 text-center text-black fw-bold mt-1 pt-2 head">THRIFT ESTOP</P>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="input-group mt-4">
                            <input type="text" id="kw" class="form-control" aria-label="Text input with dropdown button" />

                            <select class="form-select" style="max-width: 250px;" id="c">
                                <option value="0">All Categories</option>
                                <?php
                                $cat_rs = Database::search("SELECT * FROM `category`");
                                $cat_num = $cat_rs->num_rows;

                                for ($x = 0; $x < $cat_num; $x++) {
                                    $cat_data = $cat_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $cat_data["cat_id"]; ?>"><?php echo $cat_data["cat_name"]; ?></option>
                                <?php
                                }

                                ?>


                            </select>

                            <button class="btn btn-dark" onclick="basicSearch(0);">Search</button>

                        </div>



                    </div>

                    <div class="col-12 mx-2 col-lg-1 mt-2 mt-lg-4 text-center">
                        <a href="advancedSearch.php" class="text-decoration-none link-secondary fw-bold">Advanced</a>
                    </div>

                </div>
            </div>

            <?php include "header.php"; ?>

            <hr />

            <div class="col-12" id="basicSearchResult">
                <div class="row">

                    <!-- Carousel -->

                    <div id="carouselExampleCaptions" class="offset-1 col-10 carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="resources/dress.jpg" class="d-block w-100 pic-img">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>SKIRTS & DRESSES</h5>
                                    <p>Thrift eStop connects you with people whose style match yours.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/trouser.jpg" class="d-block w-100 pic-img">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>SHORTS & TROUSERS</h5>
                                    <p>We will have your order delivered to any destination in the country.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/top1.jpg" class="d-block w-100 pic-img">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>TOPS & TSHIRTS</h5>
                                    <p>Awesome prices for awesome pieces.</p>
                                </div>
                            </div>

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <!-- Carousel -->

                    

                    <!-- slider -->

                    <div class="col-12 mt-3 mb-3">
                        <div class="row order">
                            <h3 class="mt-5 text-center">How To Order a Product</h3>
                            <div class="row g-5 mt-1 mb-3 my-2">
                                <div class="col-4">
                                    <div class="p-3 bg-transparent shadow-lg d-flex justify-content-around align-items-center rounded border border-grey">
                                        <div>
                                            <p class="fs-2 badge bg-danger-subtle text-black fw-bold ">01 </p><BR/>
                                            <P class="f2 fw-bolder">Choose a Product</P>
                                            <p>We have several varieties products you can choose from</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 bg-transperant shadow-lg d-flex justify-content-around align-items-center rounded border border-grey">
                                        <div>
                                        <p class="fs-2 badge bg-danger-subtle text-black fw-bold">02 </p><BR/>
                                            <P class="f2 fw-bolder">Place an order</P>
                                            <p>Once your order is set we move to the next step which is shipping</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 bg-transperant shadow-lg d-flex justify-content-around align-items-center rounded border border-grey">
                                        <div>
                                        <p class="fs-2 badge bg-danger-subtle text-black fw-bold ">03 </p><BR/>
                                            <P class="f2 fw-bolder">Get order delivered</P>
                                            <p>Our delivery process is easy, you receive the order direct to your door</p>
                                        </div>

                                    </div>
                                </div>
                                
                            </div>

                        </div>

                    </div>

                    <div class="col-12 mt-4 text-center">
                        <div class="row">
                            <a href="#" class="text-decoration-none text-dark fs-3 fw-bold">NEW ARRIVALS</a>
                        </div>
                    </div>

                    <!-- products -->
                    <div class="col-12 mt-2 mb-3">
                        <div class="row">

                            <div class="col-12">
                                <div class="row justify-content-center gap-2">

                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `status_status_id`='1' ORDER BY 
                                    `datetime_added` DESC LIMIT 4 OFFSET 0");
                                    $product_num = $product_rs->num_rows;

                                    for ($x = 0; $x < $product_num; $x++) {
                                        $product_data = $product_rs->fetch_assoc();

                                    ?>
                                        <div class="card col-12 col-lg-2 mt-2 mb-2" style="width: 15rem;">

                                            <?php

                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                            `product_id`='" . $product_data["id"] . "'");

                                            $img_data = $img_rs->fetch_assoc();

                                            ?>

                                            <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-1" style="height: 200px;">
                                            <div class="card-body ms-0 m-0">
                                                <h5 class="card-title fw-bold fs-5"><?php echo $product_data["title"]; ?></h5>
                                                <?php
                                                $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "'");
                                                $user_data = $user_rs->fetch_assoc();
                                                ?>
                                                <span class="mt-1">Sold By: <?php echo $user_data["fname"]; ?></span><br /><br />
                                                <span class="card-text fw-bolder fs-5 mt-3">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                                <a href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>" class="col-12 btn btn-dark">Quick View</a>
                                                
                                            </div>
                                        </div>
                                    <?php
                                    }

                                    ?>



                                </div>
                            </div>

                            <div class="col-12 mt-4 text-center offset-lg-5 col-lg-2">
                                <button class="btn btn-outline-danger" onclick="loadpro(0);">Load More Products</button>
                            </div>

                        </div>
                    </div>
                    <!-- products -->

                </div>
            </div>




            <hr />

            <?php include "footer.php"; ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>