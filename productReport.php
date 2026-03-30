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

        <title>Product Report</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources/logo.svg" />
    </head>

    <body>

        <div class="container mt-3">
            <div>
                <h1 class="text-center">Product Report</h1><hr>
            </div>

            <div class="row d-flex justify-content-end mt-4">
                

                <button class="btn btn-danger col-2 mt-3" onclick="window.print()">Print Report</button>


            </div>

            <div class="row my-2 mx-1 mt-4 justify-content-center">
                <table class="table">
                    <thead style="background-color:#84B0CA ;" class="text-white">
                        <tr>
                            <th scope="col">Product Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th></th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $pro_rs = Database::search("SELECT * FROM `product`");
                        $pro_num = $pro_rs->num_rows;
                        for ($x = 0; $x < $pro_num; $x++) {
                            $pro_data = $pro_rs->fetch_assoc();
        

                        ?>
                            <tr>
                                <th scope="row"><?php echo $pro_data["id"]; ?></th>
                                <td><?php echo $pro_data["title"]; ?></td>
                                <td><?php echo $pro_data["description"]; ?></td>
                                <td>Rs.<?php echo $pro_data["price"]; ?>.00</td>
                            </tr>

                        <?php

                        }

                        ?>


                    </tbody>

                </table>
            </div>

        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {
    echo ("YOU ARE NOT A VALID USER");
}
?>