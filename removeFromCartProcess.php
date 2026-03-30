<?php

require "connection.php";

if(isset($_GET["id"])){

    $ca_id = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE
    `product_id`='".$ca_id."'");

    if($cart_rs->num_rows != 0){

        Database::iud("DELETE FROM `cart` WHERE `product_id`='".$ca_id."'");
        echo("deleted");

    }else{
        echo("Something Went wrong");
    }

}

?>