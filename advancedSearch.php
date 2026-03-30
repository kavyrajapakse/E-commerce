<?php
session_start();
require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advanced Search</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.svg" />

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>

            <div class="col-12 bg-body mb-2">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="offset-lg-1 col-lg-2 col-12">
                                <P class="fs-1 text-center text-black fw-bold mt-3 pt-2 head">THRIFT ESTOP</P>
                            </div>
                            <div class="col-12 col-lg-6 text-center">
                                <P class="fs-1 text-dark fw-bold mt-3 pt-2">Advanced Search</P>
                            </div>

                        </div>
                    </div>
                    <div class="offset-lg-5 col-12 col-lg-4 text-center">
                        <div class="row">
                            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php" class="text-dark">Home</a></li>
                                    <li class="breadcrumb-item active text-dark" aria-current="page">You searched for</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12">
                <hr class="border border-3 border-dark">
            </div>

            <div class="col-12 col-lg-3 border-end border-dark">
                <div class="row">
                    <div class="col-12 mt-2 mb-1">
                        <input type="text" class="form-control" placeholder="Type keyword to search..." id="t" />
                    </div>
                    <div class="col-12 mt-1 mb-1 d-grid">
                        <button class="btn btn-dark text-center" onclick="advancedSearch(0);">Search</button>
                    </div>

                    <div class="col-12 mt-5 mb-1">
                        <select class="form-select" id="c1">
                            <option value="0">PRODUCT CATEGORIES</option>
                            <?php
                                $cat_rs = Database::search("SELECT * FROM `category`");
                                $cat_num = $cat_rs->num_rows;

                                for ($i = 0; $i < $cat_num; $i++) {
                                    $cat_data = $cat_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $cat_data["cat_id"]; ?>"><?php echo $cat_data["cat_name"]; ?></option>
                                <?php
                                }

                                ?>

                        </select>
                    </div>

                    <div class="col-12 mt-3 mb-1">
                        <select class="form-select" id="c2">
                            <option value="0">FILTER BY CONDITION</option>
                            <?php
                            $condition_rs = Database::search("SELECT * FROM `condition`");
                            $condition_num = $condition_rs->num_rows;

                            for ($x = 0; $x < $condition_num; $x++) {
                                $condition_data = $condition_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $condition_data["condition_id"]; ?>"><?php echo $condition_data["condition_name"]; ?></option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>

                    <div class="col-12 mt-3 mb-1">
                        <select class="form-select" id="c3">
                            <option value="0">FILTER BY COLOR</option>
                            <?php
                            $color_rs = Database::search("SELECT * FROM `color`");
                            $color_num = $color_rs->num_rows;

                            for ($c = 0; $c < $color_num; $c++) {
                                $color_data = $color_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $color_data["clr_id"] ?>"><?php echo $color_data["clr_name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-12 mt-3 mb-1">
                        <select class="form-select" id="s1">
                            <option value="0">FILTER BY SIZE</option>
                            <?php
                            $size_rs = Database::search("SELECT * FROM `size`");
                            $size_num = $size_rs->num_rows;

                            for ($x = 0; $x < $size_num; $x++) {
                                $size_data = $size_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $size_data["size_id"] ?>"><?php echo $size_data["size_name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-12 mt-5 mb-2">
                        <input type="text" class="form-control" placeholder="Price From" id="pf" style="border-color: red;" />
                    </div>

                    <div class="col-12 mt-3 mb-3">
                        <input type="text" class="form-control" placeholder="Price To" id="pt" style="border-color: red;" />
                    </div>

                    <div class="col-12 mt-4 mb-5">
                        <select class="form-select border border-top-0 border-start-0 border-end-0 border-4 border-info" id="s2">
                            <option value="0">FILTER BY</option>
                            <option value="1">PRICE LOW TO HIGH</option>
                            <option value="2">PRICE HIGH TO LOW</option>
                            <option value="3">QUANTITY LOW TO HIGH</option>
                            <option value="4">QUANTITY HIGH TO LOW</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-9 mt-5 bg-body rounded mb-3">
                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" id="view_area">
                            <div class="offset-5 col-2 mt-5">
                                <span class="fw-bold text-secondary"></span>
                            </div>
                            <div class="offset-3 col-6 mt-3 mb-5">
                                <span class="h1 text-secondary fw-bold">Search</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>