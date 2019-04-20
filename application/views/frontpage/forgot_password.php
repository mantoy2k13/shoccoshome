<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="We care and love your pets, Book Pets, Book users, find a home, book pet, book host, book guest, book users, book pets, find people near you.">
    <meta name="author" content="">

    <title>Shocco - Shocco's Home</title>
    <link rel="shortcut icon" href="<?=base_url();?>assets/img/favicon.ico" type="image/x-icon">
    <link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
    <!-- Plugin CSS -->
    <link href="<?=base_url();?>assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="<?=base_url();?>assets/css/login-css.css" rel="stylesheet" type="text/css">
    <input type="hidden" id="base_url" value="<?=base_url()?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
</head>
<body>

    <main role="main">
        <div class="container">
            <div class=" overlay2 rgba-black-strong">
                <div class="container">
                <div id="mLoader"></div>
                    <div class="login-wrapper">
                        <a href="<?=base_url();?>"> 
                            <img class="login-logo" src="<?=base_url();?>assets/img/logo.png" alt="Shocco's Logo">
                        </a>
                        <h3 class="text-white mb-3">Please insert your email</h3>

                        <?php
                            $error_msg=$this->session->flashdata('error_msg');
                            if($error_msg){
                                echo '<div class="alert alert-danger flash-msg" role="alert">'.$error_msg.'</div>';
                            }
                        ?>
                        
                        <form action="javascript:;">
                            <div class="row">
                                <div class="col-md-12" id="error-msg">
                                   
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="recovery_email" class="form-control" id="recovery_email"  placeholder="Email Address" required="">
                                    </div>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <button type="button" onclick="recoverPassword()" class="btn btn-primary btn-block btn-rounded mb-3">Send a link to recover password</button>
                            </div>
                        </form>
                    </div>
                        <br>
                    <div class="container-fluid">
                        <div class="row justify-content-md-center">
                            <div class="col col-md-4">
                                <div class="text-center" role="alert">
                                    <a href="<?=base_url();?>">Back to Homepage</a> <span class="text-white">|</span>
                                    <a href="<?=base_url();?>home/login">Sign In</a>
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
<!-- Bootstrap core JavaScript -->
<script src="<?=base_url();?>assets/vendor/jquery/jquery.js"></script>
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="<?=base_url();?>assets/vendor/jquery-easing/jquery.easing.js"></script>
<script src="<?=base_url();?>assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?=base_url();?>assets/vendor/notifications/notifications.js"></script>

<!-- Contact Form JavaScript -->
<script src="<?=base_url();?>assets/js/jqBootstrapValidation.js"></script>
<script src="<?=base_url();?>assets/js/initializations/init_recovery.js"></script>
</html>