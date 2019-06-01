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
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?= base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url();?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto page-title-box">
                                    <a href="<?= base_url();?>user/register" style="font-weight: 600;">
                                        <h2 class="page-title" style="font-weight: 600;">Sign Up</h2>
                                    </a>
                                </div>

                                <form action="<?= base_url();?>user/signup" method="post">

                                    <div class="form-group">
                                        <label for="fullname">User Name</label>
                                        <input class="form-control" type="text" id="fullname" placeholder="Enter your name" required name='username'>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required id="password" placeholder="Enter your password" name='password'>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Confirm Password</label>
                                        <input class="form-control" type="password" required id="confirm_password" placeholder="Enter your confirm password" name='confirm_password'>
                                    </div>
                                    <?php echo validation_errors(); ?>
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-success btn-block" type="submit"> Sign Up </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Already have account?  <a href="<?= base_url();?>user/login" class="text-white ml-1"><b>Sign In</b></a></p>
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