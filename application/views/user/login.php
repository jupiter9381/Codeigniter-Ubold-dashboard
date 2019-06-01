<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>UBold - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url();?>assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?= base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url();?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto page-title-box">
                                    <a href="<?= base_url();?>user/login">
                                        <h4 class="page-title" style="font-weight: 600;">Sign In</h4>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Enter your user name and password to access admin panel.</p>
                                </div>

                                <form action="<?= base_url();?>user/signin" method="post">

                                    <div class="form-group mb-3">
                                        <label for="username">User Name</label>
                                        <input class="form-control" type="text" id="username" required="" placeholder="Enter your name" name="username">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" id="password" placeholder="Enter your password" name="password">
                                    </div>


                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>

                                </form>
                                <?php if(isset($error)){?>
                                <div class="alert alert-danger bg-danger text-white border-0 mt-2" role="alert">
                                    <i class="mdi mdi-alert-outline mr-2"></i><?= $error;?>
                                </div>
                                <?php }?>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Don't have an account? <a href="<?= base_url();?>user/register" class="text-white ml-1"><b>Sign Up</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="<?= base_url();?>assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?= base_url();?>assets/js/app.min.js"></script>
        
    </body>
</html>