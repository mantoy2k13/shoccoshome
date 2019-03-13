<?php $cover_photo = $user_logindata->cover_photo; ?>
<?php $uid = $this->session->userdata('user_id'); ?>
<header class="masthead bg-primary text-white text-center" <?=($cover_photo) ? 'style="background-image: url('.base_url().'assets/img/pictures/usr'.$uid.'/'.$cover_photo.')"' : '';?>>	

    <button class="btn banner-btn"><i class="fa fa-camera fa-2x"></i> Change Cover <??></button>
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