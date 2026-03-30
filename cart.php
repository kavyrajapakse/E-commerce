<?php
session_start();
require "connection.php";

$user = $_SESSION["u"];

if (isset($user)) {

?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>My Cart</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources/logo.svg" />

    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <?php include "header.php"; ?>
            </div>

        </div>

        <div class="col-12 bg-body container px-3 my-5 clearfix">
            <div class="row bg-body-secondary">
                <div class="col-12">
                    <div class="row">
                        <div class="offset-lg-1 col-lg-2 col-12">

                        </div>
                        <div class="col-12 col-lg-6 text-center">
                            <P class="fs-3 text-dark fw-bold mt-3 pt-2">My CART | THRIFT ESTOP</P>
                        </div>

                    </div>

                </div>
            </div>
            <div class="offset-lg-5 col-12 col-lg-4 text-center">
                <div class="row">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php" class="text-dark">Home</a></li>
                            <li class="breadcrumb-item active text-dark" aria-current="page">My cart</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
        </div>

        <?php

        $netTotal = 0;

        $rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON 
`cart`.`product_id`=`product`.`id` INNER JOIN `size` ON 
`product`.`size_size_id`=`size`.`size_id` INNER JOIN `color` ON
`product`.`color_clr_id`=`color`.`clr_id` INNER JOIN `condition` ON
`product`.`condition_condition_id`=`condition`.`condition_id` WHERE `cart`.`users_email`='" . $user["email"] . "'");

        $num = $rs->num_rows;


        if ($num > 0) {
            //load cart
            //echo ("load");
        ?>

            <!-- products -->

            <div class="card-body container px-3 my-5 clearfix">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped-columns border-3 border-black m-0">
                        <thead>
                            <tr class="justify-content-center">
                                <th class="text-center py-3 px-4" style="min-width: 250px;">
                                    Product Name &amp; Details
                                </th>
                                <th class="text-center py-3 px-4" style="width: 150px;">
                                    Price
                                </th>
                                <th class="text-center py-3 px-4" style="width: 100px;">
                                    Quantity
                                </th>
                                <th class="text-center py-3 px-4" style="width: 150px;">
                                    Total
                                </th>
                                <th class="text-center align-middle py-3 px-0" style="width: 100px;">
                                    <a href="#" class="shop-tooltip float-none text-dark" title="" data-original-title="Clear cart">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($x = 0; $x < $num; $x++) {
                                $d = $rs->fetch_assoc();
                                $total = $d["price"];
                                $netTotal += $total;
                                
                            ?><tr>
                                <td class="p-4">
                                    <div class="media align-items-center">
                                        <?php
                                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                        `product_id`='" . $d["id"] . "'");
                                    $img_data = $img_rs->fetch_assoc();
                                        ?>
                                        <img src="<?php echo $img_data["img_path"];?>" class="d-block ui-w-40 ui-bordered mr-4" alt="" />
                                        <div class="media-body">
                                            <a href="#" class="d-block text-dark mt-3 text-decoration-none">Product Name : <?php echo $d["title"];?></a>
                                            <small>
                                                <span class="text-muted">Color: </span>
                                                <span class="ui-product-color ui-product-color-sm align-text-bottom border border-black" style="background-color: <?php echo $d["clr_name"];?>;">
                                                </span> &nbsp;
                                                <span class="text-muted">Size: </span> <?php echo $d["size_name"];?> &nbsp;
                                                <span class="text-muted">Condition:</span> <?php echo $d["condition_name"];?>
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right font-weight-semibold align-middle p-4">Rs.<?php echo $d["price"];?>.00</td>
                                <td class="align-middle p-4"><?php echo $d["qty"];?></td>
                                <td class="text-right font-weight-semibold align-middle p-4">Rs.<?php echo $d["price"];?>.00</td>
                                <td class="text-center align-middle px-0"><a href="#" onclick="removeFromCart(<?php echo $d['id'];?>);" class="shop-tooltip close float-none text-danger text-decoration-none" title="" data-original-title="Remove">Remove</a></td>
                            </tr><?php
                            } 
?>

                        </tbody>

                    </table>


                </div>

                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                    <div class="mt-4">
                        <label class="text-muted font-weight-normal">Promo Code</label>
                        <input type="text" placeholder="ABC" class="form-control" />
                    </div>
                    <div class="d-flex">
                        <div class="text-right mt-4 mr-5 me-5">
                            <label class="text-muted font-weight-normal m-0">Delivery</label>
                            <div class="text-large"><strong>Rs.400.00</strong></div>
                        </div>
                        <div class="text-right mt-4 mr-5" id="total">
                            <label class="text-muted font-weight-normal m-0">Total Price</label>
                            <div class="text-large"><strong>Rs.<?php echo ($netTotal + 400);?>.00</strong></div>
                        </div>
                    </div>

                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                    <button type="button" class="btn btn-lg btn-outline-dark md-btn-flat mt-2 mr-3">Back to shopping</button>
                    <button type="button" class="btn btn-lg btn-danger mt-2" onclick="checkOut();">Checkout</button>
                </div>



            </div>

            <!-- products -->




        <?php
        } else {

        ?>
            <!-- Empty View -->
            <div class="col-12 container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="col-12 text-center mb-2">
                            <label class="form-label fs-3 fw-bold mt-2">
                                You have no items in your Cart yet.
                            </label>
                        </div>
                        <div class="offset-lg-4 col-12 col-lg-4 mb-2 d-grid mb-2">
                            <a href="home.php" class="btn btn-outline-danger fs-3 fw-bold">
                                SHOP
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Empty View -->

        <?php
        }
        ?>
















        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </body>

    </html>
<?php

} else {
    header("location: index.php");
}
