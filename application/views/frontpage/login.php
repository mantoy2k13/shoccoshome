<html lang="en"><head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Shocco - Shocco's Login</title>
    <link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url();?>assets/css/login-css.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
</head>
<body>
    <main role="main">
        <div class="container">
            <div class=" overlay2 rgba-black-strong">
                <div class="container">
                    <div class="login-wrapper">
                        <a href="<?=base_url();?>"> 
                            <img class="login-logo" src="<?=base_url();?>assets/img/logo.png">
                        </a>
                        <h3 class="text-white mb-3">Login</h3>

                        <?php
                            $error_msg=$this->session->flashdata('error_msg');
                            $email_update_success_msg=$this->session->flashdata('email_update_success_msg');
                            if($error_msg){
                                echo '<div class="alert alert-danger flash-msg" role="alert"><strong><i class="fa fa-times"></i> Oops! </strong>'.$error_msg.'</div>';
                            }elseif($email_update_success_msg){
                                echo '<div class="alert alert-success flash-msg" role="alert"><strong><i class="fa fa-check"></i> Success! </strong>'.$email_update_success_msg.'</div>';
                            }else{

                            }
                        ?>
                        
                        <form role="form" action="<?=base_url();?>auth/user_login" id="adminlog" method="post">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" name="email" class="form-control" id="email" aria-describedby="email" placeholder="Email Address" required="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" class="form-control" id="password" aria-describedby="password" placeholder="Password" required="">
                            </div>
                            <div class="form-group">
                            <button type="submit" id="sublog" value="sublog" name="sublog" class="btn btn-primary btn-block btn-rounded mb-3">Sign In</button>
                            </div>
                        </form>
                    </div>
                        <br>
                    <div class="container-fluid">
                        <div class="row justify-content-md-center">
                            <div class="col col-md-4">
                                <div class="text-center" role="alert">
                                <a href="<?=base_url();?>home/forgot_password">Forgot password ? click here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 class="mb-3 text-center" style="margin-top: 50px;"><span class="text-white">Don't waste time,  </span><a href="<?=base_url();?>home/register">Create a new account</a></h6>
                </div>
            </div>
        </div>
    </main>
</body>
</html>