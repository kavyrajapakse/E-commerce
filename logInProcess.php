<?php

session_start();

require "connection.php";

$email = $_POST["e"];
$pw = $_POST["p"];
$rm = $_POST["r"];

if(empty($email)){
    echo("Please enter your Email Address.");
}else if(strlen($email) > 100){
    echo("Incorrect Email Address");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid Email Address");
}else if(empty($pw)){
    echo("Please enter your Password.");
}else if(strlen($pw) < 5 || strlen($pw) > 20){
    echo("Invalid Password.");
}else{

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' AND 
    `password`='".$pw."'");
    $n = $rs->num_rows;
    $u_data = $rs->fetch_assoc();

    if($n == 1 && $u_data["status"] == 1){

        echo("success");
        
        $_SESSION["u"] = $u_data;

        if($rm == "true"){
            setcookie("email",$email,time() + (60*60*24*365));
            setcookie("password",$pw,time() + (60*60*24*365));
        }else{
            setcookie("email","",-1);
            setcookie("password","",-1);
        }

    }else{
        echo("Invalid User");
    }

}

?>