<?php

include "connection.php";

$i = $_GET["id"];

$rs = Database::search("SELECT * FROM `product` INNER JOIN `status` ON 
product.status_status_id=status.status_id WHERE `id`='".$i."'");
$num = $rs->num_rows;
$d = $rs->fetch_assoc();

if($num == 1){
    if($d["status_status_id"] == 1){
        Database::iud("UPDATE `product` SET `status_status_id`='2' WHERE `id`='".$d["id"]."'");
        echo("SoldOut");
    }else{
        Database::iud("UPDATE `product` SET `status_status_id`='1' WHERE `id`='".$d["id"]."'");
        echo("Available");
    }
}



?>