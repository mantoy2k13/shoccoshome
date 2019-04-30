<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="We care and love your pets, Book Pets, Book users, find a home, book pet, book host, book guest, book users, book pets, find people near you.">
    <meta name="author" content="">

    <title>Shocco - Shocco's Home</title>
    <link rel="shortcut icon" href="<?=base_url();?>assets/img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?=base_url();?>assets/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi" rel="stylesheet">
    <!-- Plugin CSS -->
    <link href="<?=base_url();?>assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="<?=base_url();?>assets/css/freelancer.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/sweetalert.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/responsive.css" rel="stylesheet">

    <!-- Calendar-->
    <link href="<?=base_url();?>assets/vendor/calendar/css/fullcalendar.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/calendar/css/custom-calendar.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/slideshow/css/slideshow.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/slideshow/css/responsive-slides.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/notifications/notifications.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/dataTables/dataTable.css" rel="stylesheet">
    <!-- Cropper -->
    <?php if($is_page=="add_photos" || $is_page=="add_pet"){ ?>
      <link href="<?=base_url();?>assets/vendor/cropper/cropper.css" rel="stylesheet">
    <?php }?>
    
    <!-- Fast Select -->
    <link href="<?=base_url();?>assets/vendor/fastselect/fastselect.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/fastselect/custom-select.css" rel="stylesheet">
  

    <?php if($is_page=="homepage" || $is_page=="people_near_me" || $is_page=="pet_details" || $is_page=='book_user_pets' || $is_page=="book_this_user" || $is_page=="booking_set_dates"){ ?>
      <!-- Calendar -->
      <script src="<?=base_url();?>assets/vendor/calendar/js/fullcalendar.min.js"></script>
      <script src="<?=base_url();?>assets/vendor/calendar/js/calendar_init.js"></script>
    <?php } ?>
    <input type="hidden" id="base_url" value="<?=base_url(); ?>">
    <audio id="notif">
        <source src="<?=base_url();?>assets/audio/notify.ogg" type="audio/ogg">
    </audio>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//cdn.rawgit.com/ryandrewjohnson/jquery-fblogin/master/dist/jquery.fblogin.min.js"></script>
   
    <?php if($is_page=='adminpage'){?>
     <!-- Admin Dashboard-->
    <!-- Custom fonts for this template-->
    <link href="<?=base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url();?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <?php }?>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="364585571683-dvn2i1408p68kb6o058hnh9lfafqco7i.apps.googleusercontent.com">
    <script>
        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                window.location.href = base_url+"home/homepage";
            });
        }

        function onLoad() {
            gapi.load('auth2', function() {
                gapi.auth2.init();
            });
        }
    </script>
</head>