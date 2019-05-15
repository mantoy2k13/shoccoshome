<!-- Bootstrap core JavaScript -->
<script src="<?=base_url();?>assets/vendor/jquery/jquery.js"></script>
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="<?=base_url();?>assets/vendor/jquery-easing/jquery.easing.js"></script>
<script src="<?=base_url();?>assets/vendor/notifications/notifications.js"></script>
<script src="<?=base_url();?>assets/js/sweetalert.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?=base_url();?>assets/vendor/calendar/js/fullcalendar.min.js"></script>

<!-- Custom scripts for this template -->
<script src="<?=base_url();?>assets/js/custom.js"></script>
<script src="<?=base_url();?>assets/js/dateFormat.js"></script>

<!-- Initializations -->
<script src="<?=base_url();?>assets/js/initializations/init_friends.js"></script>

<?php if($is_page=="add_pet" || $is_page=="my_pets" ){ ?>
    <script src="<?=base_url();?>assets/js/initializations/init_pets.js"></script>
<?php } ?>

<?php if($is_page=="account"){ ?>
    <script src="<?=base_url();?>assets/js/initializations/init_profile.js"></script>
<?php } ?>

<?php if($this->session->userdata('user_email')){ if($is_page!="account"){ ?>
    <?php $is_complete = $this->Account_model->is_complete();?>
    <?php if(!$is_complete['is_complete']){ ?>
        <script src="<?=base_url();?>assets/js/initializations/welcomeModal.js"></script>
<?php } } } ?>
<?php if($is_page=="albums"){ ?>
    <script src="<?=base_url();?>assets/js/initializations/init_album.js"></script>
<?php }?>

<!-- Vendors -->
<script src="<?=base_url();?>assets/vendor/slideshow/js/slideshow.js"></script>
<?php if($is_page=="mail"  || $is_page=="sents" || $is_page=="drafts"){ ?>
    <script src="<?=base_url();?>assets/js/initializations/mail.js"></script>
<?php } ?>
<script src="<?=base_url();?>assets/js/initializations/init_instant_msg.js"></script>

<?php if($is_page=="add_photos" || $is_page=="view_album" || $is_page=="add_pet"){ ?>
    <script src="<?=base_url();?>assets/vendor/cropper/cropper.js"></script>
    <script src="<?=base_url();?>assets/vendor/cropper/initCropper.js"></script>
    <script src="<?=base_url();?>assets/js/initializations/init_pictures.js"></script>
<?php }?>
<?php if($is_page=="pictures"){ ?>
    <script src="<?=base_url();?>assets/js/initializations/init_pictures.js"></script>
<?php }?>

<?php if($is_page=="become_a_guest" || $is_page=="become_a_host" || $is_page=="book_user" || $is_page=="mainpage" || $is_page=="mail"  || $is_page=="sents" || $is_page=="drafts"){ ?>
    <script src="<?=base_url();?>assets/vendor/fastselect/fastselect.js"></script>
    <script src="<?=base_url();?>assets/vendor/fastselect/fastselect.standalone.js"></script>
<?php } ?>

<?php if($is_page=='booking_history'){ ?>
    <script src="<?=base_url();?>assets/vendor/dataTables/dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/dataTables/dataTables.js"></script>
<?php } ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKmCY9-diuULK1hyHnDkElDSPT6mbfB7w&libraries=geometry&sensor=false"></script>

<!-- <h1><?=$is_page;?></h1> -->