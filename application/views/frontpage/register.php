<html lang="en"><head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Shocco - Shocco's Register</title>
    <link rel="shortcut icon" href="<?=base_url();?>assets/img/favicon.ico" type="image/x-icon">
    <link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>assets/css/login-css.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <input type="hidden" id="base_url" value="<?=base_url()?>">
    <script src="<?=base_url();?>assets/vendor/jquery/jquery.js"></script>
    <script src="<?=base_url();?>assets/js/popper.min.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/js/socialLogin.js"></script>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="364585571683-dvn2i1408p68kb6o058hnh9lfafqco7i.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
<body>
    <main role="main">
        <div class="container">
            <div class=" overlay2 rgba-black-strong">
                <div class="container">
                    <div class="login-wrapper">
                        <a href="<?=base_url();?>"> 
                            <img class="login-logo" src="<?=base_url();?>assets/img/logo.png" alt="Shocco's Logo">
                        </a>
                        <h3 class="text-white mb-3">Sign Up Shocco's Home</h3>

                        <!-- FB login -->
                        <div class="fb-login-button" data-size="large" data-width="100%" data-button-type="login_with" data-auto-logout-link="false" scope="public_profile,email" onlogin="checkLoginState();"></div>

                        <!-- Google Login -->
                        <div class="g-signin2" data-onsuccess="onSignIn"></div>

                        <p class="or">- or -</p>

                        <?php if(isset($_SESSION['error_msg'])){ ?>
                            <div class="log-alert log-danger">
                                <strong><i class="fa fa-times"></i> Oops! </strong> <?=$_SESSION['error_msg'];?>
                                <span class="closebtn" onclick="$(this).parent().remove()">&times;</span>
                            </div>
                        <?php } ?>
                        <!-- Main Login -->
                        <form action="<?=base_url();?>auth/register_user" role="form" id="adminlog" method="post">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="email" placeholder="Email Address" required="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" class="form-control" id="password" aria-describedby="password" placeholder="Password" required="">
                            </div>
                            <button type="submit" id="sublog" name="sublog" class="btn btn-primary btn-block btn-rounded mb-3">Sign Up</button>
                            
                            <div class="form-group">
                                <p class="agText text-white">By signing in or signing up, I agree to Shocco's Home's <br> <a href="<?=base_url();?>home/terms_and_conditions" target="_blank"> Terms and Conditions</a> and <a href="<?=base_url();?>home/policy" target="_blank">Privacy Policy</a></p>
                            </div>

                        </form>
                    </div>
                    <h6 class="mb-3 text-center" style="margin-top: 30px;"><span class="text-white">Already have an account?  </span><a href="<?=base_url();?>home/login">Sign In</a></h6>
                </div>
            </div>
        </div>
    </main>
</body>
</html>