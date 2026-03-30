<?php

include "connection.php";
session_start();

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Invoice</title>

  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css" />

  <link rel="icon" href="resources/logo.svg" />

</head>

<body>
  <?php
  if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"];
    $oid = $_GET["pid"];

    $netTotal = 0;

    $rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='".$oid."'");
    $d = $rs->fetch_assoc();

    $rs2 = Database::search("SELECT * FROM `order_history` WHERE `order_id`='".$d["order_id"]."'");
    $d2 = $rs2->fetch_assoc();

    $order_rs = Database::search("SELECT * FROM `order_item` INNER JOIN `product` ON
    `product`.`id`=`order_item`.`product_id` INNER JOIN `order_history` ON
    `order_item`.`order_history_ohid`=`order_history`.`ohid` WHERE `order_history_ohid`='".$d2["ohid"]."';");
    //$order_data = $order_rs->fetch_assoc();
    $order_num = $order_rs->num_rows;
    

    //$pro_rs = Database::search("SELECT * FROM `product` WHERE `id` = '".$order_data["product_id"]."'");
    //$pro_num = $pro_rs->num_rows;

  ?> <div class="card">
      <div class="card-body">
        <div class="container mb-5 mt-3">
          <div class="row d-flex align-items-baseline">
            <div class="col-xl-9">
              <p style="color: #7e8d9f;font-size: 20px;">Order >> <strong>ID: #<?php echo $oid ?></strong></p>
            </div>
            <div class="col-xl-3 float-end">
              <a data-mdb-ripple-init class="btn btn-secondary text-capitalize border-0" onclick="window.print()" data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</a>
              <a data-mdb-ripple-init class="btn btn-dark text-capitalize" data-mdb-ripple-color="dark"><i class="far fa-file-pdf text-danger"></i> Export</a>
            </div>
            <hr>
          </div>

          <div class="container">
            <div class="col-md-12">
              <div class="text-center">
                <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                <p class="pt-0 head fs-2">THRIFT ESTOP</p>
              </div>

            </div>


            <div class="row">
              <div class="col-xl-8">
                <ul class="list-unstyled">
                  <li class="text-muted">To: <span style="color:#5d9fc5 ;"><?php echo $user["fname"];?></span></li>
                  <li class="text-muted"><?php echo $user["email"];?></span></li>
                  <li class="text-muted">Sri Lanka</li>
                  <li class="text-muted"><i class="fas fa-phone"></i> <?php echo $user["mobile"];?></span></li>
                </ul>
              </div>
              <div class="col-xl-4">
                <p class="text-muted">Invoice</p>
                <ul class="list-unstyled">
                  <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">ID: </span> <?php echo $d["id"];?></span></li>
                  <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Creation Date: </span><?php echo $d["date"];?></li>
                  <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-danger text-black fw-bold">
                      Paid</span></li>
                </ul>
              </div>
            </div>

            <div class="row my-2 mx-1 justify-content-center">
              <table class="table">
                <thead style="background-color:#84B0CA ;" class="text-white">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  <?php
                  for ($x = 0; $x < $order_num; $x++) {
                    $order_data = $order_rs->fetch_assoc();
                    $total = $order_data["price"];
                    $netTotal += $total;
          
                    ?>
                    <tr>
                    <th scope="row"><?php echo $order_data["id"];?></th>
                    <td><?php echo $order_data["description"];?></td>
                    <td>Rs.<?php echo $order_data["price"];?>.00</td>
                  </tr>
                    
                    <?php

                  }
                  
                  ?>
                  
                  
                </tbody>

              </table>
            </div>
            <div class="row">
              <div class="col-xl-8">
                <p class="ms-3">Add additional notes and payment information</p>

              </div>
              <div class="col-xl-3">
                <ul class="list-unstyled">
                  <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>Rs.<?php echo $netTotal;?>.00</li>
                  <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Delivery: </span>Rs.400.00</li>
                </ul>
                <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span style="font-size: 25px;">Rs.<?php echo ($netTotal + 400)?>.00</span></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xl-10 text-center text-danger">
                <p>Thank you for your purchase</p>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div><?php


        } 
          ?>



  <script src="bootstrap.bundle.js"></script>
  <script src="script.js"></script>
</body>

</html>