<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.svg" />
</head>

<body class="muser" onload="loadProducts(0);">

    <div class="col-10">
        <h2 class="text-center mt-5 mb-4 text-dark">PRODUCT MANAGEMENT</h1>
            <hr>

            <div class="row d-flex justify-content-end mt-4">
                <div class="d-none" id="msgDiv" onclick="reload();">
                    <div class="alert alert-danger" id="msg"></div>
                </div>

                <div class="col-3 mt-3">
                    <input type="email" class="form-control" placeholder="Product ID" id="e" />
                </div>

                <button class="btn btn-outline-dark col-1 mt-3" onclick="searchProduct();">Search</button>
            </div>

            <div class="mt-3">

                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Condition</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="bt">




                    </tbody>
                </table>
            </div>

            

    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>