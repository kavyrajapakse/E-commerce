<?php

include "connection.php";
session_start();
$user = $_SESSION["u"];

$productlist = array();
$qtylist = array();

if (isset($_POST["cart"]) && $_POST["cart"] == "true") {
    //echo("From Cart");

    $rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user["email"] . "'");
    $num = $rs->num_rows;

    for ($i = 0; $i < $num; $i++) {
        $d = $rs->fetch_assoc();

        $productlist[] = $d["product_id"];
        $qtylist[] = $d["qty"];
    }
} else {
    //echo ("From buy now");
    $productlist[] = $_POST["productId"];
    
}

$merchantId = "1222311";
$merchantSecret = "ODE5MDQ1MTQ1MTQ1ODQzMDc5NDMxNjM2NDI5ODYzMzE4MzQ3NTIy";
$items = "";
$netTotal = 0;
$currency = "LKR";
$orderId = uniqid();

for ($i = 0; $i < sizeof($productlist); $i++) {

    $rs2 = Database::search("SELECT * FROM `product` WHERE 
        `id`='" . $productlist[$i] . "'");

    $d2 = $rs2->fetch_assoc();
    $items .= $d2["title"];

    if ($i != sizeof($productlist) - 1) {
        $items .= ", ";
    }

    $netTotal += intval($d2["price"]);
}

$netTotal += 400;

$hash = strtoupper(
    md5(
        $merchantId .
            $orderId .
            number_format($netTotal, 2, '.', '') .
            $currency .
            strtoupper(md5($merchantSecret))
    )
);

$payment = array();
$payment["sandBox"] = true;
$payment["merchant_id"] = $merchantId;
$payment["first_name"] = $user["fname"];
$payment["last_name"] = $user["lname"];
$payment["email"] = $user["email"];
$payment["phone"] = $user["mobile"];
$payment["address"] = "Battaramulla, Sri Lanka";
$payment["city"] = "Colombo";
$payment["country"] = "Sri Lanka";
$payment["order_id"] = $orderId;
$payment["items"] = $items;
$payment["currency"] = $currency;
$payment["amount"] = number_format($netTotal, 2, '.', '');
$payment["hash"] = $hash;
$payment["return_url"] = "";
$payment["cancel_url"] = "";
$payment["notify_url"] = "";

echo json_encode($payment);
