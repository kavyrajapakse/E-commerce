<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.svg" />
</head>

<body class="admb mt-5">


    <div class="container-fluid justify-content-center" style="margin-top: 50px;">
        <div class="row align-content-center">

            <div class="col-12">
                <div class="row">



                </div>
            </div>

            <div class="col-12 p-5">
                <div class="row">
                    <div class="col-6 d-none d-lg-block bg"></div>

                    <div class="col-12 col-lg-6 d-block">
                        <div class="row g-3 align-content-center">

                            <div class="col-12">
                                <p class="fs-1 text-black fw-bold mt-1 head pt-5 ms-3">THRIFT ESTOP</p>
                            </div>

                            <div class="col-12 mb-2">
                                <h2>Admin Login</h2>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="ex : kavy01" id="e" />
                            </div>

                        
                            <div class="col-12 d-none" id="msgDiv">
                                <div class="alert alert-danger" id="msg"></div>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-secondary">Home</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-outline-danger" onclick="adminVerification();">Verification Code</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->

            <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter Your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>