<?php

include "connection.php";
session_start();
$user = $_SESSION["u"];

if (isset($_POST["payment"])) {

    $payment = json_decode($_POST["payment"], true);

    $date = new DateTime();
    $date->setTimezone(new DateTimeZone("Asia/Colombo"));
    $time = $date->format("Y-m-d H-i-s");

    Database::iud("INSERT INTO `order_history`(`order_id`,`order_date`,`amount`,`users_email`)
    VALUES ('" . $payment["order_id"] . "','" . $time . "','" . $payment["amount"] . "',
    '" . $user["email"] . "')");

    $orderHistoryId = Database::$connection->insert_id;

    $rs = Database::search("SELECT * FROM `cart` WHERE `users_email` = '" . $user["email"] . "'");
    $num = $rs->num_rows;

    for ($i = 0; $i < $num; $i++) {
        $d = $rs->fetch_assoc();

        Database::iud("INSERT INTO `order_item`(`oi_qty`,`order_history_ohid`,`product_id`)
        VALUES ('" . $d["qty"] . "','" . $orderHistoryId . "','" . $d["product_id"] . "')");

        $rs3 = Database::search("SELECT * FROM `product` INNER JOIN `status` ON
        product.status_status_id=status.status_id WHERE `id`='" . $d["product_id"] . "' ");
        $num3 = $rs3->num_rows;
        $d3 = $rs3->fetch_assoc();


        if ($num3 == 1) {
            Database::iud("UPDATE `product` SET `status_status_id` = '2' WHERE 
            `id`='" . $d3["id"] . "'");

            Database::iud("DELETE FROM `cart` WHERE `product_id`='" . $d3["id"] . "'");
            

        } else {
            echo ("SOMETHING WENT WRONG");
        }
    }
    echo ("success");
}
