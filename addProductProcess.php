<?php
session_start();

require "connection.php";

$email = $_SESSION["u"]["email"];

$title = $_POST["t"];
$desc = $_POST["desc"];
$category = $_POST["ca"];
$size = $_POST["s"];
$condition = $_POST["cond"];
$clr = $_POST["col"];
$cost = $_POST["cost"];
$qty = $_POST["qty"];


if(empty($title)){
    echo("Please enter a Title.");
}else if(strlen($title) > 100){
    echo("Title must have less than 100 characters.");
}else if(empty($desc)){
    echo("Please enter the description.");
}else if(empty($category)){
    echo("Please select a category.");
}else if(empty($size)){
    echo("Please select a size.");
}else if(empty($condition)){
    echo("Please select a condition.");
}else if(empty($clr)){
    echo("Please select a color.");
}else if(empty($cost)){
    echo("Please select a cost.");
}else if(empty($qty)){
    echo("Please select a quantity.");
}else{

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;

Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,`category_cat_id`,`condition_condition_id`,`color_clr_id`,
`status_status_id`,`size_size_id`,`users_email`) VALUES 
('".$cost."','".$qty."','".$desc."','".$title."','".$date."','".$category."','".$condition."','".$clr."','".$status."','".$size."','".$email."')");

$product_id = Database::$connection->insert_id;

$length = sizeof($_FILES);

if($length <= 3 && $length > 0){

    $allowed_img_extensions = array("image/jpg","image/png","image/jpeg","image/svg+xml");

    for($x = 0;$x < $length;$x++){
        if(isset($_FILES["img".$x])){

            $img_file = $_FILES["img".$x];
            $file_extension = $img_file["type"];

            if(in_array($file_extension,$allowed_img_extensions)){

                $new_img_extension;

                if($file_extension == "image/jpg"){
                    $new_img_extension = ".jpg";
                }else if($file_extension == "image/jpeg"){
                    $new_img_extension = ".jpeg";
                }else if($file_extension == "image/png"){
                    $new_img_extension = ".png";
                }else if($file_extension == "image/svg+xml"){
                    $new_img_extension = ".svg";
                }

                $file_name = "resources//product//".$title."_".$x."_".uniqid().$new_img_extension;
                move_uploaded_file($img_file["tmp_name"],$file_name);

                Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`)
                VALUES ('".$file_name."','".$product_id."')");

                

                
            }else{
                echo("Not an allowed image type.");
            }

        }
    }

    echo("PRODUCT ADDED SUCESSFULLY");

}else{
    echo("Invalid Image Count");
}

}
