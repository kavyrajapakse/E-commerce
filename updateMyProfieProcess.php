<?php 
session_start();
$email=$_SESSION["u"]["email"];
$img=$_POST["img"];
$f=$_POST["f"];
$l=$_POST["l"];
$m=$_POST["m"];
$a1=$_POST["a1"];
$a2=$_POST["a2"];
$p=$_POST["p"];
$d=$_POST["d"];
$c=$_POST["c"];

require "connection.php";
if($img==null){
    echo("true");
}else{
    $file=explode("fakepath",$img);
    //echo($n);
    //echo($file[1]);   
    $file_data="resources/". $file[1];
    //echo($file_data);
    $search=Database::search("SELECT * FROM `profile_img` WHERE `user_email`='".$email."'");
    $search_num=$search->num_rows;
    if($search_num==0){
        Database::iud("INSERT INTO `profile_img`(`path`,`user_email`) VALUES('".$file_data."','".$email."')");
    }else{
        Database::iud("UPDATE `profile_img` SET `path`='".$file_data."' WHERE `user_email`='".$email."'");

    }


}


Database::iud("UPDATE `users` SET `fname`='".$f."' WHERE `email`='".$email."'");
Database::iud("UPDATE `users` SET `lname`='".$l."' WHERE `email`='".$email."'");
Database::iud("UPDATE `users` SET `mobile`='".$m."' WHERE `email`='".$email."'");
Database::iud("UPDATE `users_has_address` SET `line1`='".$a1."' WHERE `users_email`='".$email."'");
Database::iud("UPDATE `users_has_address` SET `line2`='".$a2."' WHERE `users_email`='".$email."'");
Database::iud("UPDATE `users_has_address` SET `city_id`='".$c."' WHERE `users_email`='".$email."'");


echo("User Profile Updated");

?>