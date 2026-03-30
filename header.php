


<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

</head>

<body>

    <div class="col-12 bg-color">
        <div class="row mt-1 mb-1">

            <div class="col-12 offset-lg-1 text-center col-lg-3 align-self-start mt-3">

            <?php

            if(isset($_SESSION["u"])){
                $session_data = $_SESSION["u"];

                ?>
                <a href="home.php" class="text-lg-start text-decoration-none text-dark">Hello <?php echo $session_data["fname"];?></a> &centerdot;
                <span class="text-lg-start" onclick="signOut();">SignOut</span> &centerdot;
                <?php
            }else{
                ?>

                    <a href="index.php" class="text-decoration-none text-dark fw-bold">
                        Sign In
                    </a> &centerdot;

                <?php
            }
            
            ?>
                
                <a href="blog.php" class="text-lg-start text-decoration-none text-dark">BLOG</a> &centerdot;
                <span class="text-lg-start">Contact</span> 
                
            </div>

            <div class="col-12 offset-lg-1 col-lg-1 text-center align-self-start mt-3 mb-1">
                <h6></h6>
            </div>

            <div class="col-12 offset-lg-2 col-lg-4 align-self-end" style="text-align: center;">
                <div class="row">

                    <div class="col-12 offset-lg-1 col-lg-6 dropdown">
                        <button class="btn btn-secondary-emphasis dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Thrift eStop
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="myProducts.php">My Products</a></li>
                            <li><a class="dropdown-item" href="addProduct.php">Add New Product</a></li>
                            <li><a class="dropdown-item" href="orderHistory.php">Purchased History</a></li>
                        </ul>
                    </div>

                    <div class="col-1 col-lg-1 ms-5 ms-lg-0 mt-1 mb-1 profile-icon" onclick="window.location='updateUser.php';"></div>

                    <div class="col-1 col-lg-2 ms-5 ms-lg-0 mt-1 mb-1 wish-icon" onclick="window.location='wishlist.php';">
                    
                </div>

                    <div class="col-1 col-lg-1 ms-5 ms-lg-0 mt-1 mb-1 cart-icon" onclick="window.location='cart.php';">
                
                </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>