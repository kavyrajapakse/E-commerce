<?php

require "connection.php";

$email = $_POST["e"];
$npw = $_POST["np"];
$rnpw = $_POST["rnp"];
$vcode = $_POST["vc"];

if(empty($email)){
    echo("Please Enter your Email Address");
}else if(empty($npw)){
    echo("Please enter your New Password");
}else if(strlen($npw)<5 || strlen($npw)>20){
    echo("Invalid New Password");
}else if(empty($rnpw)){
    echo("Please Retype the New Password");
}else if($npw != $rnpw){
    echo("Passwords does not match");
}else if(empty($vcode)){
    echo("Please enter your Verification Code");
}else{

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' AND 
    `verification_code`='".$vcode."'");
    $n = $rs->num_rows;

    if($n == 1){

        Database::iud("UPDATE `users` SET `password`='".$npw."' WHERE `email`='".$email."' AND 
        `verification_code`='".$vcode."'");

        echo("success");

    }else{

        echo("Invalid user details.");

    }

}

?>