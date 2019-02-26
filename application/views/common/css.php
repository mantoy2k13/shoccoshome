<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
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

    <!-- Cropper -->
    <link href="<?=base_url();?>assets/vendor/cropper/cropper.css" rel="stylesheet">
    <!-- Fast Select -->
    <link href="<?=base_url();?>assets/vendor/fastselect/fastselect.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/fastselect/custom-select.css" rel="stylesheet">
    
    <?php if($is_page=="homepage" || $is_page=="pet_details"){ ?>
    <!-- Calendar -->
    <script src="<?=base_url();?>assets/vendor/calendar/js/fullcalendar.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/calendar/js/calendar_init.js"></script>
    <?php } ?>
    <input type="hidden" id="base_url" value="<?=base_url(); ?>">
    <audio id="notif">
        <source src="<?=base_url();?>assets/audio/notify.ogg" type="audio/ogg">
    </audio>
</head>