<!-- Bootstrap core JavaScript -->
<script src="<?=base_url();?>assets/vendor/jquery/jquery.js"></script>
<!-- <script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script> -->
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="<?=base_url();?>assets/vendor/jquery-easing/jquery.easing.js"></script>
<script src="<?=base_url();?>assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?=base_url();?>assets/vendor/notifications/notifications.js"></script>

<!-- Contact Form JavaScript -->
<script src="<?=base_url();?>assets/js/jqBootstrapValidation.js"></script>

<!-- Contact Form JavaScript -->
<script src="<?=base_url();?>assets/js/sweetalert.min.js"></script>

<!-- Initializations -->
<?php if($is_page=="add_pet" || $is_page=="my_pets"){ ?>
<script src="<?=base_url();?>assets/js/initializations/init_pets.js"></script>
<?php } ?>

<script src="<?=base_url();?>assets/js/initializations/init_friends.js"></script>

<?php if($is_page=="account"){ ?>
    <script src="<?=base_url();?>assets/js/initializations/init_profile.js"></script>
<?php } ?>

<!-- Custom scripts for this template -->
<!-- <script src="<?=base_url();?>assets/js/freelancer.js"></script> -->
<script src="<?=base_url();?>assets/js/custom.js"></script>
<script src="<?=base_url();?>assets/js/dateFormat.js"></script>

<!-- Vendors -->
<script src="<?=base_url();?>assets/vendor/slideshow/js/slideshow.js"></script>
<?php if($is_page=="add_pet"){ ?>
<!-- Cropper -->
<script src="<?=base_url();?>assets/vendor/cropper/cropper.js"></script>
<script src="<?=base_url();?>assets/vendor/cropper/initCropper.js"></script>
<?php } ?>

<script src="<?=base_url();?>assets/vendor/crs/crs.js"></script>
<script src="<?=base_url();?>assets/vendor/crs/jquery.crs.js"></script>
<script src="<?=base_url();?>assets/js/geolocationmap.js"></script>
<?php if($is_page=="mail"  || $is_page=="sents" || $is_page=="drafts"){ ?>
<!-- Fast Select -->
<script src="<?=base_url();?>assets/vendor/fastselect/fastselect.min.js"></script>
<script src="<?=base_url();?>assets/vendor/fastselect/fastselect.standalone.js"></script>
<script src="<?=base_url();?>assets/js/initializations/mail.js"></script>
<?php } ?>

<?php if($this->session->userdata('user_email')){ if($is_page!="account"){ ?>
    <?php $is_complete = $this->Account_model->is_complete();?>
    <?php if(!$is_complete['is_complete']){ ?>
    <script src="<?=base_url();?>assets/js/initializations/welcomeModal.js"></script>
<?php } } } ?>
<?php if($is_page=="albums"  || $is_page=="pictures"){ ?>
<script src="<?=base_url();?>assets/js/initializations/init_album.js"></script>
<?php }?>