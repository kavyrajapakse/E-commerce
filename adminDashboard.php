<?php

include "connection.php";
session_start();

if (isset($_SESSION["a"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources/logo.svg" />
    </head>

    <body onload="loadRecentProducts();">

        <div class="d-flex" id="wrapper">

            <!-- sidebar -->

            <div class="bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading text-center py-4 primary-text text-uppercase border-bottom">
                    <p class="fs-1 text-black fw-bold head">THRIFT ESTOP</p>

                    <div class="list-group list-group-flush my-3">
                        <a href="" class="list-group-item list-group-item-action bg-transparent second-text active">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a href="manageUsers.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                            <i class="bi bi-people-fill me-2"></i>Manage Users
                        </a>
                        <a href="manageProduct.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                            <i class="bi bi-gift-fill me-2"></i>Manage Products
                        </a>
                        <a href="reports.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                            <i class="bi bi-paperclip me-2"></i>Reports
                        </a>
                       
                        <a href="" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                            <i class="bi bi-chat-fill me-2"></i>Analytics
                        </a>
                        <a href="" onclick="adminOut();"  class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
                            <i class="bi bi-box-arrow-left me-2"></i>Logout
                        </a>

                    </div>

                </div>

            </div>

            <!-- sidebar -->

            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-justify-left primary-text fs-4 me-3" id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">Dashboard</h2>
                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item-dropdown">
                                <a href="" class="nav-link dropdown-toggle text-dark fw-bold" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-fill me-2"></i>Pamali
                                </a>

                            </li>

                        </ul>
                    </div>
                </nav>

                <div class="container-fluid px-4">
                    <?php
                    $pro_rs = Database::search("SELECT * FROM `product`");
                    $pro_num = $pro_rs->num_rows;

                    $order_rs = Database::search("SELECT * FROM `order_item`");
                    $order_num = $order_rs->num_rows;
                    
                    
                    ?>

                    <div class="row g-3 my-2">
                        <div class="col-md-4">
                            <div class="p-3 bg-secondary-subtle shadow-lg d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2"><?php echo $pro_num?></h3>
                                    <p class="fs-5">Products</p>
                                </div>
                                <i class="bi bi-gift-fill fs-1 primary-text border border-black rounded-full secondary-bg p-3"></i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-secondary-subtle shadow-lg d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2"><?php echo $order_num?></h3>
                                    <p class="fs-5">Sales</p>
                                </div>
                                <i class="bi bi-cash-stack fs-1 primary-text border border-black rounded-full secondary-bg p-3"></i>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="p-3 bg-secondary-subtle shadow-lg d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2">%25</h3>
                                    <p class="fs-5">Increase</p>
                                </div>
                                <i class="bi bi-graph-up-arrow fs-1 primary-text border border-black rounded-full secondary-bg p-3"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        <h3 class="fs-4 mb-3">Recent Orders</h3>
                        <div class="col">
                        <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Email</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody id="rp">
                            
                            
                            
                            
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <script>
            var el = document.getElementById("wrapper");
            var toggleButton = document.getElementById("menu-toggle");

            toggleButton.onclick = function() {
                el.classList.toggle("toggled");
            }
        </script>
    </body>

    </html>

<?php
} else {
    echo ("not a valid Admin");
}

?>