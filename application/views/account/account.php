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
    <section class="content font-baloo">
      <!-- 2nd Navbar -->
      <?php $this->load->view('common/profile-nav');?>

	    <div class="row m-t-10">
            <!-- Left Navbar -->
            <?php $this->load->view('common/left-nav');?>
        
            <!-- Main Content -->
		    <div class="col-md-9 m-t-10 bio-wrapper-inf">

            <input type="hidden" value="<?=(isset($_SESSION['prof_msg'])) ? $_SESSION['prof_msg'] : '0';?>" id="getProfAlert">
            <?php foreach($user_info as $info) { extract($info); ?>
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="acc-img">
                                <?php  
                                if($user_img) { ?>
                                    <img id="img-profile" src="<?=base_url();?>assets/img/pictures/usr<?=$id;?>/<?=$user_img;?>" alt="Profile Image">
                                <?php }else{ ?>
                                    <img id="img-profile" src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image">
                                <?php } ?>
                            <input type="file" name="user_img" class="input-img" id="input-img">
                        </div>
                        <span class="btn bg-orange text-white btn-sm dropdown-toggle m-t-10" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-image"></i> Click to choose image</span>
                        <div class="dropdown-menu" aria-labelledby="f-menu">
                            <a class="dropdown-item" onclick="$('#input-img').trigger('click');" href="javascript:;">Choose from your device</a>
                            <a class="dropdown-item" onclick="cImgChange(1)" href="javascript:;">Choose from your pictures</a>
                            <a class="dropdown-item" onclick="cImgChange(2)" href="javascript:;">Choose from your albums</a>
                        </div>
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
                                <form action="<?=base_url();?>account/account_update" role="form" method="post" enctype="multipart/form-data" >
                                    <div class="form-group row m-t-20">
                                        <div class="col-md-6">
                                            <label for="" class="m-b-0">Fullname</label>
                                            <input type="text" value="<?= $fullname ? $fullname : '' ?>" name="fullname" class="form-control" placeholder="Fullname" required>
                                            <!-- Images -->
                                            <input type="hidden" name="img_data" id="img_data">
                                            <input type="hidden" value="<?=$user_img;?>" name="prof_old_img">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="m-b-0">Occupation</label>
                                            <input type="text" value="<?= $occupation ? $occupation : '' ?>" name="occupation" class="form-control" placeholder="Occupation" required>
                                        </div>
                                    </div>   
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="" class="m-b-0">Email Address</label>
                                            <input type="text" value="<?= $email ? $email : '' ?>" name="email" class="form-control" placeholder="Email Address" required>
                                        </div>
                                    </div>                   
                                    <div class="form-group row" id="target_address">
                                        <div class="col-md-6">
                                            <label for="" class="m-b-0">Mobile</label>
                                            <input type="text" value="<?= $mobile_number ? $mobile_number : '' ?>" name="mobile_number" class="form-control" placeholder="Mobile" required onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="m-b-0">Gender</label>
                                            <select class="form-control" id="" name="gender" required>
                                                <option value="Male" <?=$gender == 'Male' ? 'selected' : ''?>>Male</option>
                                                <option value="Female" <?=$gender == 'Female' ? 'selected' : ''?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <label for="" class="m-b-0">Complete Address</label>
                                            <input id="complete_address" name="complete_address" type="text" class="form-control" placeholder="Enter your address.." value="<?=$complete_address;?>" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="m-b-0">Zip/Postal Code</label>
                                            <input id="postal_code" name="zip_code" type="text" class="form-control" placeholder="Zip/Postal Code" value="<?=$zip_code;?>" required>
                                            <input id="user_lat" name="user_lat" type="hidden" value="<?=$user_lat;?>">
                                            <input id="user_lng" name="user_lng" type="hidden" value="<?=$user_lng;?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="" class="m-b-0">Bio</label>
                                            <textarea name="bio" class="form-control" cols="30" rows="3" placeholder="About yourself.."><?= $bio ? $bio : '' ?></textarea>
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
            <?php } ?>
        </div>
        <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKmCY9-diuULK1hyHnDkElDSPT6mbfB7w&libraries=places" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/js/initializations/init_prof_add.js"></script>
  </body>

</html>
