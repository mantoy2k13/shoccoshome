<?php
    @$email=$user_logindata->email;
?>
<div id="mLoader"></div>
<!-- <div class="loading"> Loading..</div> -->

<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <button class="navbar-toggler navbar-toggler-right text-uppercase top-menu-btn text-white" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars fa-2x"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
        <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded <?=($is_page=="mainpage") ? "active" : "";?>" href="<?=base_url();?>">Home</a>
        </li>
        <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded <?=($is_page=="about") ? "active" : "";?>" href="<?=base_url();?>home/about">About</a>
        </li>
        <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded <?=($is_page=="contact") ? "active" : "";?>" href="<?=base_url();?>home/contact">Contact</a>
        </li>

        <?php if($email){ ?> 
        <li class="nav-item mx-0 mx-lg-1 ">
            <a class="nav-link py-3 px-0 px-lg-3 rounded h-nav <?=($is_page=="mail" || $is_page=="drafts" || $is_page=="sents") ? "active" : "";?>" href="<?=base_url();?>mail/mail">Messages 
                <?php $cntMsg=$this->Mail_model->count_mail();?>
                <span class="mainCntM"><?=($cntMsg!=0) ? '<span class="badge bg-red">'.$cntMsg.'</span>' : '';?></span>
            </a>
        </li>
        <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded h-nav <?=($is_page=="account") ? "active" : "";?>" href="<?=base_url();?>account/account">Profile</a>
        </li>
        <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded h-nav" href="javascript:;" onclick="logout('<?=$this->session->userdata('is_social')?>')">Logout</a>
        </li>
        <?php } else { ?>
        <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded h-nav" href="<?=base_url();?>home/login">Login</a>
        </li>
        <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded h-nav" href="<?=base_url();?>home/register">Register</a>
        </li>
        <?php } ?>
        </ul>
    </div>
    
    <div class="nav-brand">
        <a href="<?=base_url();?>">
            <img src="<?=base_url();?>assets/img/logo.png" alt="Navbar Logo">
        </a>
    </div>

    <div class="right-top-nav collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">

        <?php
        if($email){ ?>
            <li class="nav-item mx-0 mx-lg-1">
                <a class="nav-link rounded" href="<?=base_url();?>mail/mail"><i class="fa fa-envelope fa-2x m-t-5"></i> 
                    <span class="mainCnt"><?=($cntMsg!=0) ? '<span class="badge bg-red cust-badge">'.$cntMsg.'</span>' : '';?></span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profile-menus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="profile-img" >
                        <?php $user_img=$user_logindata->user_img; 
                            $uid = $this->session->userdata('user_id');
                        ?>
                        <?php if($user_img) { ?>
                            <img src="<?=base_url();?>assets/img/pictures/usr<?=$uid;?>/<?=$user_img;?>" alt="Profile Image">
                        <?php }else{ ?>
                            <img src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image">
                        <?php } ?>
                    </div>
                    <div class="dropdown-menu prof-menu-custom" aria-labelledby="profile-menus">
                        <a class="dropdown-item" href="<?=base_url();?>account/account"><i class="fa fa-user"></i> Profile</a>
                        <a  class="dropdown-item" href="javascript:;" onclick="logout('<?=$this->session->userdata('is_social')?>')"><i class="fa fa-sign-out-alt"></i> Logout</a>
                    </div>
                </a>
            </li>
        <?php }else{ ?>
            <li class="nav-item mx-0 mx-lg-1 r-nav">
                <a class="nav-link py-3 px-0 px-lg-3 rounded" href="<?=base_url();?>home/login">Login</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1 r-nav">
                <a class="nav-link py-3 px-0 px-lg-3 rounded" href="<?=base_url();?>home/register">Register</a>
            </li>
        <?php } ?>

        </ul>
    </div>
</nav>