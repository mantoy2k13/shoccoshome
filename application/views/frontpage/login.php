<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="We care and love your pets, Book Pets, Book users, find a home, book pet, book host, book guest, book users, book pets, find people near you.">
    <meta name="author" content="">

    <title>Shocco - Shocco's Home</title>
    <link rel="shortcut icon" href="<?=base_url();?>assets/img/favicon.ico" type="image/x-icon">
    <link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>assets/css/login-css.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
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
        <div class="container font-baloo">
            <div class=" overlay2 rgba-black-strong">
                <div class="container">
                    <div class="login-wrapper">
                        <a href="<?=base_url();?>"> 
                            <img class="login-logo" id="shLogo" src="<?=base_url();?>assets/img/logo.png" alt="Shocco's Logo">
                        </a>
                        <h3 class="text-white mb-3">Sign in to Shocco's Home</h3>

                        <!-- FB Login -->
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
                        
                        <?php if(isset($_SESSION['email_update_success_msg'])){ ?>
                            <div class="log-alert log-success">
                                <strong><i class="fa fa-check"></i> Registered! </strong> <?=$_SESSION['email_update_success_msg'];?>
                                <span class="closebtn" onclick="$(this).parent().remove()">&times;</span>
                            </div>
                        <?php } ?>
                        <!-- Main Login -->
                        <form role="form" action="<?=base_url();?>auth/user_login" id="adminlog" method="post">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" name="email" class="form-control" id="email" aria-describedby="email" placeholder="Email Address" required="">
                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" class="form-control" id="password" aria-describedby="password" placeholder="Password" required="">
                            </div>
                            <div class="text-center mb-2">
                                <a href="<?=base_url();?>home/forgot_password">Forgot password ? click here</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="sublog" value="sublog" name="sublog" class="btn btn-primary btn-block btn-rounded mb-3">Sign In</button>
                            </div>
                        </form>
                    </div>
                    <h6 class="mb-3 text-center" style="margin-top: 30px;"><span class="text-white">Don't waste time,  </span><a href="<?=base_url();?>home/register">Create a new account</a></h6>
                </div>
            </div>
        </div>
    </main>
    <script>
      
     </script>
</body>
</html>