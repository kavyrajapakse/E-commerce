<?php

require "connection.php";

$fname = $_POST["fn"];
$lname = $_POST["ln"];
$email = $_POST["e"];
$pw = $_POST["pw"];
$mobile = $_POST["m"];
$gender = $_POST["g"];
$city = $_POST["c"];

if(empty($fname)){
    echo("Please enter your First Name.");
}else if(strlen($fname) > 45){
    echo("First Name must have less than 45 characters.");
}else if(empty($lname)){
    echo("Please enter your Last Name.");
}else if(strlen($lname) > 45){
    echo("Last Name must have less than 45 characters.");
}else if(empty($email)){
    echo("Please enter your Email."); 
}else if(strlen($email) > 100){
    echo("Email must have less than 100 characters.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid Email");
}else if(empty($pw)){
    echo("Please enter your Password");
}else if(strlen($pw)<5 || strlen($pw)>20){
    echo("Password length must be between 5 - 20 characters.");
}else if(empty($mobile)){
    echo("Please enter your Mobile Number.");
}else if(strlen($mobile) != 10){
    echo("Mobile number must contain 10 characters.");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo("Invalid Mobile Number");
}else{

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."'
    OR `mobile`='".$mobile."'");
    $n = $rs->num_rows;

    if($n > 0){
        echo("User with the same Mobile number or Email already exists.");
    }else{

       $d = new DateTime();
       $tz = new DateTimeZone("Asia/Colombo");
       $d->setTimezone($tz);
       $date = $d->format("Y-m-d H:i:s");

       Database::iud("INSERT INTO users (`fname`,`lname`,`email`,`password`,`mobile`,`joined_date`,`status`,`gender_id`,`city_id`)
       VALUES ('".$fname."','".$lname."','".$email."','".$pw."','".$mobile."',
       '".$date."','1','".$gender."','".$city."')");

       echo("success");

    }

}

?>