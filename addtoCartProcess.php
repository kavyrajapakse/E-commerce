<?php

include "connection.php";
session_start();

$user = $_SESSION["u"];

$prodct = $_POST["p"];
//echo($prodct);

$rs = Database::search("SELECT * FROM `product` WHERE `id`='".$prodct."'");
$num = $rs->num_rows;


if($num > 0){
    $d = $rs->fetch_assoc();
    $qty = $d["qty"];

    $rs2 = Database::search("SELECT * FROM `cart` WHERE `users_email`='".$user["email"]."'
    AND `product_id`='".$d["id"]."'");
    $num2 = $rs2->num_rows;

    if($num2 == 1){
        $d2 = $rs2->fetch_assoc();
        $c_id = $d2["cart_id"];

        Database::iud("DELETE FROM `cart` WHERE `cart_id`='".$c_id."'");
            echo("REMOVED");
        //echo("Update");
    }else{

        Database::iud("INSERT INTO `cart`(`qty`,`users_email`,`product_id`) VALUES
        ('".$qty."','".$user["email"]."','".$d["id"]."')");
        echo("Product is Added to the cart");

        //echo("insert");
    }

    //echo("Available");
}else{
    echo("Soldout");
}


?>