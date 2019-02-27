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

            <form action="<?=base_url();?>account/account_update" role="form" id="adminlog" method="post" enctype="multipart/form-data" >
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
                            <i class="fa fa-upload upload-icon"></i>
                            <input type="file" name="user_img" class="input-img" id="input-img">
                        </div>
                        <p class="m-t-10 text-blue f-15 upload-text">Drag or Click image to upload</p>
                    </div>
                    <div class="col-md-9">
                        <p class="f-25 b-700 text-orange-d">Account</p>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="" class="m-b-0">Fullname</label>
                                <input type="text" value="<?= $user_logindata->fullname ? $user_logindata->fullname : '' ?>" name="fullname" class="form-control" placeholder="Fullname">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="m-b-0">Occupation</label>
                                <input type="text" value="<?= $user_logindata->occupation ? $user_logindata->occupation : '' ?>" name="occupation" class="form-control" placeholder="Occupation">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="" class="m-b-0">Email Address</label>
                                <input type="text" value="<?= $user_logindata->email ? $user_logindata->email : '' ?>" name="email" class="form-control" placeholder="Email Address">
                                <input type="hidden" value="<?= $user_logindata->id ? $user_logindata->id : '' ?>" name="id" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="" class="m-b-0">Password</label>
                                <input type="password"  name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        
                        <div class="form-group row" id="target_address">
                            <div class="col-md-6">
                                <label for="" class="m-b-0">Mobile</label>
                                <input type="number" value="<?= $user_logindata->mobile_number ? $user_logindata->mobile_number : '' ?>" name="mobile_number" class="form-control" placeholder="Mobile">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="m-b-0">Gender</label>
                                <select class="form-control" id="" name="gender">
                                    <option value="male" <?=$user_logindata->gender === 'male' ? 'selected' : ''?>>Male</option>
                                    <option value="female" <?=$user_logindata->gender === 'female' ? 'selected' : ''?>>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="" class="m-b-0">Country</label>
                                <select name="country" id="country_id" class="crs-country form-control" data-region-id="three" >
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="m-b-0">State</label>
                                <select name="state"  id="three" class="form-control" data-value="shortcode">
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="">City</label>
                                <input required name="city" value="<?php echo ($user_logindata) ? $user_logindata->city : '';?>" type="text" class="form-control" placeholder="City">
                            </div>
                            <div class="col-md-4">
                                <label class="">Street</label>
                                <input  name="street" value="<?php echo ($user_logindata) ? $user_logindata->street : '';?>" type="text" class="form-control" placeholder="Street">
                            </div>
                            <div class="col-md-4">
                                <label class="">Zip/Postal Code</label>
                                <input  name="zip_code" value="<?php echo ($user_logindata) ? $user_logindata->zip_code : '';?>" type="text" class="form-control" placeholder="Zip/Postal Code">
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
                    </div>
                </div>
            </form>
        </div>
        <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>

  </body>

</html>
