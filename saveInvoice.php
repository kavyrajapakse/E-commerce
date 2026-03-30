<?php

session_start();
require "connection.php";


if(isset($_SESSION["u"])){
    $user = $_SESSION["u"];
    $order_id = $_POST["o"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $qty = 1;
    $status = 0;

    Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`qty`,`status`,`users_email`) VALUES 
    ('".$order_id."','".$date."','".$qty."','".$status."','".$user["email"]."')");

    echo ("1");

}