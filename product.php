<?php
session_start();
require "connection.php";

$product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_cat_id,product.condition_condition_id,product.color_clr_id,
    product.status_status_id,product.size_size_id,product.users_email FROM `product` WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
        $product_data = $product_rs->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>Product View | Gimmck</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <!-- <link rel="stylesheet" href="header.css" /> -->
    <link rel="icon" href="resources/logos/logo.gif "/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link type="text/css" rel="stylesheet" href="paymentMethod.css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
</head>
<body style="background-color:white ;">
    <div class="container-fluid">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="allProducts.php" style="text-decoration:none ;">All</a></li>
                <li class="breadcrumb-item"><a href="#" style="text-decoration:none ;"><?php echo $category_data["name"]?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $product_data["title"]?></li>
                </ol>
            </nav>
        </div>

        <div class="row mt-1">
            <div class="col-lg-1">
                <div class="row">
                    
                        <img src="resources/addproduct.svg" class="image2 border" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" onload="mainImg(<?php echo $x; ?>)"/>
                        

                    ?>
                </div>
            </div>
            <div class="col-lg-4 border mainImg di1" style="height:58vh ;" id="mainImg">
            
            <img src="resources/addproduct.svg" id="mainimg1" class="thumbnail"/>
            
            </div>
            <div class="col-lg-7">
                <div class="row">
                    

                    
                       <label class="fs-2 fw-bold"><?php echo $product_data["title"]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="" style="color: grey; text-decoration:none"><?php echo $user3_data["fname"]?> <?php echo $user3_data["lname"]?></a>
                        </label>
                </div>
                <hr/>
                <div class="row mt-3">
                    <label class="fs-5">Condition&nbsp; &nbsp;&nbsp;: <?php echo $condition_data["name"] ?></label>
                </div>
                <hr/>
                <div class="row mt-3"> 
                    <div class="col-lg-6">
                    <label class="fs-5">Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        : Rs.<span style="font-size:45px;" id="price"><?php echo $product_data["price"] ?></span>.00</label>
                    </div>
                    <div class="col-lg-4">
                        <?php 
                        if(isset($_SESSION["u"])){
                            $checkfromPro=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
                            $checkfromPro_data=$checkfromPro->fetch_assoc();
                            $checkfromSearch=Database::search("SELECT * FROM `search_product` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
                            $checkfromSearch_data=$checkfromSearch->fetch_assoc();
                            if($checkfromPro_data["qty"]==0 && $checkfromSearch_data["qty"]==0){
                              ?>
                              <button class="btn btn-primary col-12" style="border-radius:10px ;" disabled>Buy this Now</button>
                                <button class="col-12 btn btn-dark mt-2"  style="border-radius:10px ;" disabled>
                                    <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                </button>
                              <?php  
                            

                            }else{
                                ?>
                                <button class="btn btn-primary d-grid col-12" style="border-radius:10px ;"onclick="openPay2(<?php echo $checkfromPro_data['id'];?>);" >Buy this Now</a>
                             <button class="col-12 btn btn-dark mt-2" onclick="addToCartFromProductView(<?php echo $product_data['id']; ?>);" style="border-radius:10px ;">
                                 <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                             </button>
                                
                                <?php
                            }
                            ?>

                             
                            <?php
                        }else{
                            ?>
                             <button class="btn btn-primary d-grid col-12" style="border-radius:10px ;" disabled>Buy this Now</button>
                             <button class="col-12 btn btn-dark mt-2" href="midlogin2.php" style="border-radius:10px ;" disabled>
                                <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                             </button>
                            <?php
                        }
                        ?>          
                       

                       
                       <button class="col-12 btn btn-light border-dark mt-2 mb-2" style="border-radius:10px ;" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);" >
                        <?php
                        if(isset($_SESSION["u"])){
                            $email=$_SESSION["u"]["email"];
                            $heart=Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
                            $heart_num=$heart->num_rows;
                            if($heart_num==1){
                               ?>
                               <i class="bi bi-heart-fill text-danger fs-5 " id="heart<?php echo $product_data['id']; ?>"></i>
                               <?php
                            }else{
                               ?>
                               <i class="bi bi-heart-fill text-dark fs-5 " id="heart<?php echo $product_data['id']; ?>"></i>
                               
                               <?php
                            }
                           
                          

                        }else{
                            ?> 
                            <i class="bi bi-heart-fill text-dark fs-5 " id="heart<?php echo $product_data['id']; ?>"></i>
                            <?php
                        }
                       ?>
                        
                        </button>
                    </div>
                    
                    
                </div>
                <hr/>
                <div class="row">
                    <div class="col-3">
                    <label class="fs-5">Quantity &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>
                    <?php 
                    if(isset($_SESSION["u"])){
                    $value=Database::search("SELECT * FROM `search_product` WHERE `user_email`='".$email."' AND `product_id`='".$pid."'");
                    $value_data=$value->fetch_assoc();
                    $product=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
                    $product_data=$product->fetch_assoc();
                    $qty=$product_data["qty"];
                        if($qty==0){
                            $value_data["qty"]=0;
                        }
                    }else{
                        $product=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
                        $product_data=$product->fetch_assoc();
                        $qty=$product_data["qty"];
                        if($qty==0){
                            $value_data["qty"]=0;
                        }else{
                            $value_data["qty"]=1;
                        }
                    }
                    ?>
                    </div>
                    <div class="col-9">
                        <div class="row" style="margin-top:-10px ; margin-left:-100px">
                                <div class="col-2">
                                   
                                    <button class="btn fs-2" style="border:none;color:red" id="minus" onclick="productminus(<?php echo $product_data['id'];?>);">-</button>
                                </div>
                                <div class="col-2 ">
                                    
                                
                                <input type="text" class="form-control text-center" style="margin-top: 2vh;  margin-left:-30px" value="<?php echo $value_data["qty"];?>" placeholder="<?php echo $value_data["qty"];?>" id="productqty"/>

                                </div>
                                <div class="col-2">
                                    <button class="btn fs-2" style="border:none; color:green" id="plus" onclick="productplus(<?php echo $product_data['id'];?>);">+</button>
                                    
                                    
                                </div>
                                <div class="col-3 mt-3">
                                    <?php 
                                    if($qty==0){
                                        ?>
                                         <label id="label1" style="color:red;" class="fw-bold">0 items Available</label>
                                        <?php
                                    }
                                    ?>
                               
                                </div>
                               
                        </div>
                               
                    </div>
                    
                               
                            </div>
            
                <hr/>
                
                                <?php
                 if(isset($_SESSION["u"])){
                    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$email."'");
                    $address_data =$address_rs->fetch_assoc();
             
                     $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$address_data["city_id"]."'");
                     $city_data = $city_rs->fetch_assoc();
                     $district=Database::search("SELECT * FROM `district` WHERE `id`='".$city_data["district_id"]."'");
                     $district_data=$district->fetch_assoc();
             
                    $delivery=0;
                    
             
                    
                     $search1=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
                     $search1_data=$search1->fetch_assoc();
                     if($district_data["id"]=='1'){
                         $delivery = $delivery+$search1_data["delivery_fee_colombo"];
                     }else{
                         $delivery = $delivery+$search1_data["delivery_fee_other"];
                      }
                     $search_product=Database::search("SELECT * FROM `search_product` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
                     $search_product_data=$search_product->fetch_assoc();
                     $total=$search1_data["price"]*$search_product_data["qty"];
                     $g=$total+$delivery;
                                     

                 }        
      
                        
                ?>  
                <div class="row mt-5">
                    <div class="col-lg-3">
                    <label class="fs-5">Payment Methods </label>
                    </div>
                    <div class="col-lg-2 col-3">
                        <img src="resources/payment_method/mastercard_img.png" style="height: 10vh;"/>
                    </div>
                    <div class="col-lg-2 col-3">
                        <img src="resources/payment_method/american_express_img.png" style="height: 10vh;"/>
                    </div>
                    <div class="col-lg-2 col-3">
                        <img src="resources/payment_method/visa_img.png" style="height: 10vh;"/>
                    </div>
                    <div class="col-lg-2 col-3">
                        <img src="resources/payment_method/paypal_img.png" style="height: 10vh;"/>
                    </div>
                    
                </div>
                
            </div>
        </div>
        <div class="row mt-4 mb-2">
            <div class="col-12">
            <ul class="nav nav-tabs">
                <li class="nav-item" >
                    <a class="nav-link active" aria-current="page" href="#" onclick="change2();">Description</a>
                    
                </li>
                <li class="nav-item border" style="width:1350px ;" >
                    <a class="nav-link " href="#" style="width:20% ;" onclick="change3();">Shipping Details</a>
                </li>
               
                
            </ul>
            </div>
        </div>
        <div class="row mb-5" id="description" >
            <div class="col-12">
            <?php
             $product=Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
             $product_data=$product->fetch_assoc();
             echo $product_data["description"]
            
            ?>
            </div>
            
        </div>
        <div class="row mb-5 d-none" id="shipping" >
            <div class="col-12">
                <label class="form-label">Delivery fee within Colombo : Rs. <?php echo $product_data["delivery_fee_colombo"]?> .00</label><br/>
                <label class="form-label">Delivery fee out of Colombo : Rs. <?php echo $product_data["delivery_fee_other"]?>.00 </label>
            </div>
            
        </div>


    </div>
   
           

        
        <?php
   
    
    
    include "footer.php" ;
    
    ?>

<div class="modal" tabindex="-1" id="paymentModal" style="height:90vh;overflow-y:hidden">
                <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header " style="background-color:navy;color:aliceblue;">
                            <h2>GIMMICK | PAY</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> 
                        <div class="modal-body">
                        <div class="modal-body product-box1">
                <div class="box-product-body">
                    <div class="box-product-body-inner">
                        <div class="product-details">
                            <div class="payment-heading-div-outer">
                                <div class="payment-method-logo">
                                    <div class="payment-method-logo-inner"></div>
                                </div>
                                <div class="payment-method-desc">
                                    <br/>
                                    
                                    
                                    <span class="sell_price">LKR <span style="font-size:45px;" id="price"><?php echo $g ?></span>.00</span>
                                </div>
                            </div>
                            <div class="payment-options-div-outer">
                                <span class="select-pay-sp">Select a payment Method</span>
                                <br/>
                                <br/>
                                <span class="payment-type-one">Credit/Debit Card</span>
                                <div class="payment-methods">
                                    <input class="one" name="one" type="submit" onclick="purchaseProduct(<?php echo $pid ?>);" />
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="two"  name="two" type="submit" onclick="purchaseProduct(<?php echo $pid ?>);" />
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="three" name="three" type="submit" onclick="purchaseProduct(<?php echo $pid ?>);"/>
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="four" name="four" type="submit" value="discover" onclick="purchaseProduct(<?php echo $pid ?>);" />
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="five" name="five" type="submit" value="dinnersclub" onclick="purchaseProduct(<?php echo $pid ?>);"/>
                                    &nbsp;&nbsp;&nbsp;
                                </div>
                                <br/>
                                <br/>
                                <span class="payment-type-one">Mobile Wallet</span>
                                <div class="payment-methods">
                                    <input class="six" name="six" type="submit" value="paypal"  onclick="purchaseProduct(<?php echo $pid ?>);"/>
                                    &nbsp;&nbsp;&nbsp;
                                     <input class="seven" name="seven" type="submit" value="bbb"  onclick="purchaseProduct(<?php echo $pid ?>);"/>
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="eight" name="eight" type="submit" value="worldpay"  onclick="purchaseProduct(<?php echo $pid ?>);"/>
                                    &nbsp;&nbsp;&nbsp;
                                    <input class="nine" name="nine" type="submit" value="hsbc"  onclick="purchaseProduct(<?php echo $pid ?>);"/>
                                    &nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
        </div>
                    </div>
                  
                    
                </div>
            </div>
           
                        </div>
                      
                    </div>
                </div>
            </div>



<script src="script.js"></script>
</body>
</html>