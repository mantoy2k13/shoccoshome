<!DOCTYPE html>
<html lang="en">

  <!-- Header CSS -->
  <?php $this->load->view('common/css');?>

  <body id="page-top">

    <!-- Navigation -->
    <?php $this->load->view('common/main-nav');?>

    <!-- Banner -->
    <?php $this->load->view('common/banner');?>

    <!-- Portfolio Grid Section -->
    <section class="content">
      <!-- 2nd Navbar -->
      <?php $this->load->view('common/profile-nav');?>

	    <div class="row m-t-10">
            <!-- Left Navbar -->
            <?php $this->load->view('common/left-nav');?>
        
            <!-- Main Content -->
		    <div class="col-md-9 m-t-10 bio-wrapper-inf">

            <input type="hidden" value="<?=(isset($_SESSION['prof_msg'])) ? $_SESSION['prof_msg'] : '0';?>" id="getProfAlert">

            <div class="row">
                <div class="col-md-3">
                    <div class="acc-img">
                            <?php  
                            $user_img=$user_logindata->user_img;
                            if($user_img) { ?>
                                <img id="img-profile" src="<?=base_url();?>assets/img/profile_pics/<?=$user_logindata->user_img;?>" alt="Profile Image">
                            <?php }else{ ?>
                                <img id="img-profile" src="<?=base_url();?>assets/img/profile2.png" alt="Profile Image">
                            <?php } ?>
                        
                        <span class="cust-mod-edit-prof" onclick="" title="Choose image"><i class="fa fa-pen text-white"></i></span>
                        <i class="fa fa-upload upload-icon"></i>
                        <input type="file" name="user_img" class="input-img" id="input-img">
                    </div>
                    <p class="m-t-10 text-blue f-15 upload-text">Choose from your Pictures</p>
                </div>
                <div class="col-md-9">
                    <p class="f-25 b-700 text-orange-d">Account</p>
                    <ul class="nav nav-tabs">
                        <li class="active nav1" onclick="navTabs(1)"><a data-toggle="tab" href="#account">Basic Info</a></li>
                        <?php if(!$this->session->userdata('is_social')){ ?>
                        <li class="nav2" onclick="navTabs(2)"><a data-toggle="tab" href="#change-acc">Password Settings </a></li>
                        <?php } ?>
                    </ul>

                    <div class="tab-content">
                        <div id="account" class="tab-pane fade in active show">
                            <form action="<?=base_url();?>account/account_update" role="form" id="adminlog" method="post" enctype="multipart/form-data" >
                                <div class="form-group row m-t-20">
                                    <div class="col-md-6">
                                        <label for="" class="m-b-0">Fullname</label>
                                        <input type="hidden" value="<?= $user_logindata->id ?>" name="id" class="form-control" placeholder="id" required>
                                        <input type="text" value="<?= $user_logindata->fullname ? $user_logindata->fullname : '' ?>" name="fullname" class="form-control" placeholder="Fullname" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="m-b-0">Occupation</label>
                                        <input type="text" value="<?= $user_logindata->occupation ? $user_logindata->occupation : '' ?>" name="occupation" class="form-control" placeholder="Occupation" required>
                                    </div>
                                </div>   
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="" class="m-b-0">Email Address</label>
                                        <input type="text" value="<?= $user_logindata->email ? $user_logindata->email : '' ?>" name="email" class="form-control" placeholder="Email Address" required>
                                    </div>
                                </div>                   
                                <div class="form-group row" id="target_address">
                                    <div class="col-md-6">
                                        <label for="" class="m-b-0">Mobile</label>
                                        <input type="text" value="<?= $user_logindata->mobile_number ? $user_logindata->mobile_number : '' ?>" name="mobile_number" class="form-control" placeholder="Mobile" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="m-b-0">Gender</label>
                                        <select class="form-control" id="" name="gender" required>
                                            <option value="male" <?=$user_logindata->gender === 'male' ? 'selected' : ''?>>Male</option>
                                            <option value="female" <?=$user_logindata->gender === 'female' ? 'selected' : ''?>>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="" class="m-b-0">Country</label>
                                        <input type="hidden" id="defCountry" value="<?=($user_logindata) ? $user_logindata->country : '';?>">
                                        <select name="country" id="country_id" class="crs-country form-control" data-region-id="three" required >
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="m-b-0">State</label>
                                        <input type="hidden" id="defState" value="<?=($user_logindata) ? $user_logindata->state : '';?>">
                                        <select name="state"  id="three" class="form-control" data-value="shortcode" required >
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label class="">City</label>
                                        <input required name="city" value="<?php echo ($user_logindata) ? $user_logindata->city : '';?>" type="text" class="form-control" placeholder="City" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="">Street</label>
                                        <input  name="street" value="<?php echo ($user_logindata) ? $user_logindata->street : '';?>" type="text" class="form-control" placeholder="Street" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="">Zip/Postal Code</label>
                                        <input  name="zip_code" value="<?php echo ($user_logindata) ? $user_logindata->zip_code : '';?>" type="text" class="form-control" placeholder="Zip/Postal Code" required>
                                    </div>
                                </div>                               
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="" class="m-b-0">Bio</label>
                                        <textarea name="bio" class="form-control" cols="30" rows="3" placeholder="About yourself.."><?= $user_logindata->bio ? $user_logindata->bio : '' ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn bg-orange sub-btn">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php if(!$this->session->userdata('is_social')){ ?>
                        <div id="change-acc" class="tab-pane fade">
                            <form action="<?=base_url();?>account/change_password" role="form" id="formChangePass" method="post" enctype="multipart/form-data" onkeypress="errClear()">
                                <div id="pass-err-msg"> </div>
                                <div class="form-group row m-t-20">
                                    <div class="col-md-12">
                                        <label for="" class="m-b-0">Current Password</label>
                                        <input type="password" id="curPassword" name="curPassword" class="form-control" placeholder="Current Password" required>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="" class="m-b-0">New Password</label>
                                        <input type="password" id="nPassword" name="nPassword" class="form-control" placeholder="New Password" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="" class="m-b-0">Confirm Password</label>
                                        <input type="password" id="cPassword" name="cPassword" class="form-control" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn bg-orange sub-btn" onclick="checkPass()"><i class="fa fa-pen"></i> Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>

  </body>

</html>
