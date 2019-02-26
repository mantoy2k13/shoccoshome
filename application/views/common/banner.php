<header class="masthead bg-primary text-white text-center">	
    <button class="btn banner-btn"><i class="fa fa-camera fa-2x"></i> Add Banner</button>
    <div class="profile-big">
    <?php  
        $user_img=$user_logindata->user_img;
        if($user_img) { ?>
            <img src="<?=base_url();?>assets/img/profile_pics/<?=$user_logindata->user_img;?>" alt="Profile Image Big">
        <?php }else{ ?>
            <img src="<?=base_url();?>assets/img/profile2.png" alt="Profile Image Big">
        <?php } ?>
    </div>
</header>