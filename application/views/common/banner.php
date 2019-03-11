<header class="masthead bg-primary text-white text-center">	
    <button class="btn banner-btn"><i class="fa fa-camera fa-2x"></i> Add Banner</button>
    <div class="profile-big">
        <?php $user_img=$user_logindata->user_img; 
            $uid = $this->session->userdata('user_id');
        ?>
        <?php if($user_img) { ?>
            <img src="<?=base_url();?>assets/img/pictures/usr<?=$uid;?>/<?=$user_img;?>" alt="Profile Image">
        <?php }else{ ?>
            <img src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image">
        <?php } ?>
    </div>
</header>