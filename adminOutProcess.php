<?php

session_start();

if(isset($_SESSION["a"])){

    $_SESSION["u"] = null;
    session_destroy();

    echo("success");

}

?>