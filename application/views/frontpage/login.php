<html lang="en"><head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Shocco - Shocco's Login</title>
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
                            <img class="login-logo" id="shLogo" src="<?=base_url();?>assets/img/logo.png" alt="Shocco's Logo">
                        </a>
                        <h3 class="text-white mb-3">Sign in to Shocco's Home</h3>

                        <?php
                            $error_msg=$this->session->flashdata('error_msg');
                            $email_update_success_msg=$this->session->flashdata('email_update_success_msg');
                            if($error_msg){
                                echo '<div class="alert alert-danger flash-msg" role="alert"><strong><i class="fa fa-times"></i> Oops! </strong>'.$error_msg.'</div>';
                            }
                            if($email_update_success_msg){
                                echo '<div class="alert alert-success flash-msg" role="alert"><strong><i class="fa fa-check"></i> Success! </strong>'.$email_update_success_msg.'</div>';
                            }
                        ?>

                        <div class="fb-login-button" data-size="large" data-width="100%" data-button-type="login_with" data-auto-logout-link="false" scope="public_profile,email" onlogin="checkLoginState();"></div>
                        <div class="g-signin2" data-onsuccess="onSignIn"></div>

                        <p class="or">- or -</p>
                        
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