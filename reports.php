<?php

include "connection.php";
session_start();

if (isset($_SESSION["a"])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reports</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources/logo.svg" />
    </head>

    <body class="admb">

        <div class="container-fluid">
            <h1 class="text-center mt-4 mb-4">Reports</h1>
            <div class="d-grid gap-2 mt-3 col-4 mx-auto border repo">
                <button class="btn btn-dark mt-5 me-3 ms-3" type="button" onclick="userReport();">Users Report</button>
                <button class="btn btn-dark mt-5 ms-3 me-3" type="button" onclick="productReport();">Products Report</button>
                <button class="btn btn-dark mt-5 me-3 ms-3" type="button" onclick="oIReport();">Ordered Items Report</button>
                <button class="btn btn-dark mt-5 mb-5 me-3 ms-3" type="button" onclick="oHReport();">Order History Report</button>
            </div>

        </div>


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php
}
?>