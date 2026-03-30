<?php

session_start();
$user = $_SESSION["u"];
include "connection.php";

if (isset($user)) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Order History</title>

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

        <div class="container mt-5">

            <div class="row mt-5">
                <?php
                $rs = Database::search("SELECT * FROM `order_history` WHERE `users_email`='" . $user["email"] . "'");
                $num = $rs->num_rows;

                if ($num > 0) {
                ?>
                    <div class="mb-3 mt-3">
                        <h3 class="text-center">PURCHASED HISTORY</h3>
                        <hr>
                    </div>

                    <?php
                    for($i = 0; $i < $num; $i++){
                        $d = $rs->fetch_assoc();
                        ?>
                        <!-- order history-->
                    <div class="p-3 border border-3 rounded-3 bg-secondary-subtle mb-4">
                        <div>
                            <h5>Order ID: <span class="text-danger">#<?php echo $d["order_id"];?></span></h5>
                            <p><?php echo $d["order_date"];?></p>
                        </div>

                        <div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="container mb-5 mt-3">


                                        <div class="container">




                                            <div class="row my-2 mx-1 justify-content-center">
                                                <table class="table table-hover p-5">
                                                    <thead style="background-color:#84B0CA ;" class="text-white">
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Product Title</th>
                                                            <th scope="col">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-group-divider">


                                                    <?php
                                                    $rs3 = Database::search("SELECT * FROM `order_item` INNER JOIN `product` ON
                                                    `order_item`.`product_id`=`product`.`id` WHERE `order_item`.`order_history_ohid`='" . $d["ohid"] . "'");
                                                

                                                    $num2 = $rs3->num_rows;

                                                    for($x = 0; $x < $num2; $x++){
                                                        $d2 = $rs3->fetch_assoc();
                                                        ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $d2["id"];?></th>
                                                            <td><?php echo $d2["title"];?></td>
                                                            <td>Rs.<?php echo $d2["price"];?>.00</td>

                                                        </tr>
                                                        
                                                        <?php
                                                    }
                                                    ?>
                                                        

                                                    </tbody>

                                                </table>
                                            </div>





                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <div class="d-flex mt-4 justify-content-center">
                            <h5>Net Amount: <span class="text-danger"> Rs.<?php echo $d["amount"];?>.00</span></h4>
                        </div>
                    </div>
                    <!--order history-->

                        <?php
                    }
                    ?>
                    
                <?php

                } else {
                ?>
                    <div class="col-12 text-center mt-5 mb-4 d-none">
                        <h2>Order Products</h2>
                        <a href="index.php" class="btn btn-primary">Start shopping</a>
                    </div>
                <?php

                }

                ?>



            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php

} else {
    header("location: index.php");
}

?>