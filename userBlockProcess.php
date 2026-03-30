<?php

include "connection.php";

$e = $_GET["email"];

$rs = Database::search("SELECT * FROM `users` WHERE `email`='".$e."'");
$num = $rs->num_rows;
$d = $rs->fetch_assoc();

if($num == 1){
    if($d["status"] == 1){
        Database::iud("UPDATE `users` SET `status`='0' WHERE `email`='".$d["email"]."'");
        echo("blocked");
    }else{
        Database::iud("UPDATE `users` SET `status`='1' WHERE `email`='".$d["email"]."'");
        echo("unblocked");
    }
}



?>