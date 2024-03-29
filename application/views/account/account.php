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
                        <form role="form" method="post" enctype="multipart/form-data" id="imgForm">
                            <div class="acc-img">
                                <?php $imgUrl = ($user_img) ? 'usr'.$id.'/'.$user_img : 'default.png'; ?>
                                <img id="img-profile" src="<?=base_url();?>assets/img/pictures/<?=$imgUrl;?>" alt="Default Profile Image" class="zoomable">
                                <input type="file" name="user_img" class="input-img" id="input-img">
                            </div>
                            <span class="btn bg-orange text-white btn-sm dropdown-toggle m-t-10" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-image"></i> Click to choose image</span>
                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                <a class="dropdown-item" onclick="$('#input-img').trigger('click');" href="javascript:;">Choose from your device</a>
                                <a class="dropdown-item" onclick="cImgChange(1)" href="javascript:;">Choose from your pictures</a>
                                <a class="dropdown-item" onclick="cImgChange(2)" href="javascript:;">Choose from your albums</a>
                            </div>
                            <button type="submit" class="btn btn-success btn-xs m-t-10 saveImgBtn d-none"><i class="fa fa-check"></i> Save Image</button>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <p class="f-25 b-700 text-orange-d">Account Settings</p>
                        <ul class="nav nav-tabs">
                            <li class="active nav1" onclick="navTabs(1)"><a data-toggle="tab" href="#account">Basic Info</a></li>
                            <?php if(!$this->session->userdata('is_social')){ ?>
                                <li class="nav2" onclick="navTabs(2)"><a data-toggle="tab" href="#change-acc">Password Settings </a></li>
                            <?php } ?>
                        </ul>

                        <div class="tab-content">
                            <div id="account" class="tab-pane fade in active show">
                                <form action="<?=base_url();?>account/account_update" role="form" method="post" id="accForm" onkeyup="errClear()">
                                    <div id="pass-err-msg2"> </div>
                                    <div class="form-group row m-t-20">
                                        <div class="col-md-6">
                                            <label for="" class="m-b-0">Fullname <span class="text-danger">*</span></label>
                                            <input type="text" value="<?=$fullname?>" name="fullname" class="form-control" placeholder="Fullname" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="m-b-0">Occupation</label>
                                            <input type="text" value="<?=$occupation ? $occupation : '' ?>" name="occupation" class="form-control" placeholder="Occupation" required>
                                        </div>
                                    </div>   
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="" class="m-b-0">Email Address <span class="text-danger">*</span></label>
                                            <input onkeyup="checkEmail()" type="text" value="<?=$email;?>" name="email" id="newEmail" class="form-control" placeholder="Email Address" required>
                                            <input id="oldEmail" value="<?=$email;?>" type="hidden">
                                            <div id="chk-email-msg"></div>
                                        </div>
                                    </div>                   
                                    <div class="form-group row" id="target_address">
                                        <div class="col-md-6">
                                            <label for="" class="m-b-0">Mobile : <span class="text-success country"></span></label>
                                            <input type="tel" value="<?= $mobile_number ? $mobile_number : '' ?>" name="mobile_number" class="form-control tel" pattern="\d*" x-autocompletetype="tel" placeholder="Mobile Phone Number" autofocus>
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
                                        <input id="user_lat" name="user_lat" type="hidden" value="<?=$user_lat;?>">
                                        <input id="user_lng" name="user_lng" type="hidden" value="<?=$user_lng;?>">
                                        <div class="col-md-12">
                                            <label for="" class="m-b-0">Enter your address and click the suggestions below <span class="text-danger">*</span></label>
                                            <input id="complete_address" name="complete_address" type="text" class="form-control" placeholder="Enter your address here.." value="<?=$complete_address;?>" required>
                                        </div>
                                    </div>
                                    <?php $decAdd = ($en_address) ? json_decode($en_address) : []; ?>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label class="m-b-0">Street #</label>
                                            <input id="street_number" name="street_number" type="text" class="form-control" placeholder="Street Number" value="<?=($decAdd) ? $decAdd->street_number : '';?>"  disabled>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="m-b-0">Street Address</label>
                                            <input id="route" name="street_address" type="text" class="form-control" placeholder="Street Address" value="<?=($decAdd) ? $decAdd->street_address : '';?>"  disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="m-b-0">City</label>
                                            <input id="locality" name="city" type="text" class="form-control" placeholder="City" value="<?=($decAdd) ? $decAdd->city : '';?>"  disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="m-b-0">State</label>
                                            <input id="administrative_area_level_1" name="state" type="text" class="form-control" placeholder="State" value="<?=($decAdd) ? $decAdd->state : '';?>"  disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="m-b-0">Country</label>
                                            <input id="country" name="country" type="text" class="form-control" placeholder="Country" value="<?=($decAdd) ? $decAdd->country : '';?>" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="m-b-0">Zipcode</label>
                                            <input id="postal_code" name="zip_code" type="text" class="form-control" placeholder="Zip/Postal Code" value="<?=($decAdd) ? $decAdd->zip_code : '';?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="target_address">
                                        <div class="col-md-6">
                                            <label for="" class="m-b-0">Do you smoke?</label>
                                            <select class="form-control" id="is_smoker" name="is_smoker" required>
                                                <option value="1" <?=$is_smoker=='1' ? 'selected' : ''?>>Yes</option>
                                                <option value="0" <?=$is_smoker=='0' ? 'selected' : ''?>>No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="m-b-0">I'm living in:</label>
                                            <select class="form-control" id="living_in" name="living_in" required>
                                                <option value="1" <?=$living_in=='1' ? 'selected' : ''?>>a House</option>
                                                <option value="2" <?=$living_in=='2' ? 'selected' : ''?>>an Apartment</option>
                                            </select>
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
                                            <button onclick="updateProfile()" type="button" class="btn bg-orange font-san-serif sub-btn" id="accSaveBtn"><i class="fa fa-save"></i> Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php if(!$this->session->userdata('is_social')){ ?>
                            <div id="change-acc" class="tab-pane fade">
                                <form action="<?=base_url();?>account/change_password" role="form" id="formChangePass" method="post" enctype="multipart/form-data" onkeyup="errClear()">
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
                                            <button type="button" class="btn bg-orange font-san-serif sub-btn" onclick="checkPass()"><i class="fa fa-pen"></i> Save Password</button>
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
    <script src="<?=base_url();?>assets/vendor/phone-code/jquery.caret.js"></script>
    <script src="<?=base_url();?>assets/vendor/phone-code/jquery.mobilePhoneNumber.js"></script>
  </body>

</html>
