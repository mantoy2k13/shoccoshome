
<?php
 if($get_single_pet_data){
    $add_pet_title='Update Pet';
    $submit_pet='Update Pet';
    $actionurl='update_pet';
    $required='';
 }else{
    $add_pet_title='Add New Pet';
    $submit_pet='Save Pet';
    $actionurl='add_pet';
    $required='required';
 }
?>

<!DOCTYPE html>
<html lang="en">

  <!-- Header CSS -->
  <?php $this->load->view('common/css');?>

    <?php 
    if($get_single_pet_data){
    $get_country_name=$get_single_pet_data[0]->country;
    $get_state_name=$get_single_pet_data[0]->state;
    echo "
      <script>
        var country='$get_country_name';
        var state='$get_state_name';
      </script>
    ";
    }else{
    $get_country_name='Select country';
    $get_state_name='Select region';
    echo "
        <script>
        var country='$get_country_name';
        var state='$get_state_name';
        </script>
    ";
    }
    ?>

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
		  <div class="col-md-9 m-t-10 p-l-0 p-details">
			<div class="panel panel-default bg-gray">
				<div class="panel-heading pointed">
					<span class="b-700 text-blue"><?= $add_pet_title; ?></span>

                    <?php
                     @$pet_id=$get_single_pet_data[0]->pet_id;
                     $get_breed_details=$this->Pet_model->get_all_pet_data($pet_id);
                     @$get_breed_name=$get_breed_details[0]->breed_name;;
                    ?>

                    <a href="<?=base_url();?>home/my_pets" class="btn btn-sm text-white bg-orange pull-right"><i class="fa fa-paw"></i> My Pets</a>
				</div>			
				<div class="panel-body">

                    <input type="hidden" value="<?=(isset($_SESSION['pet_msg'])) ? $_SESSION['pet_msg'] : '0';?>" id="getPetAlert">

                    <form  action="<?=base_url();?>pet/<?= $actionurl; ?>" method="post" enctype="multipart/form-data">
                        <!-- Pet Details -->
                        <div class="row form-group">
                            <div class="col-md-12 text-blue f-20 b-700 m-t-20">Pet Details</div>
                            <div class="col-md-4">
                                <label class="f-15 text-black">Pet Name</label>
                                <input required name="pet_name" value="<?= @$get_single_pet_data[0]->pet_name ? @$get_single_pet_data[0]->pet_name : '' ?>" type="text" class="form-control" placeholder="Pet Name">
                                <input name="user_id" value="<?= $user_logindata->id; ?>" type="hidden" class="form-control" placeholder="user id">
                                <input name="pet_id" value="<?= @$get_single_pet_data[0]->pet_id ? @$get_single_pet_data[0]->pet_id : '' ?>" type="hidden" class="form-control" placeholder="Pet Id">
                            </div>

                            <div class="col-md-4">
                                <label class="f-15 text-black">Category</label>
                                <select name="cat_id" id="cat_id" class="form-control" required>
                                    <option value="" selected="selected">Select Category</option>
                                    <?php foreach($get_all_pet_cat as $show_all_pet_cat){ ?>
                                       <option value="<?= $show_all_pet_cat->cat_id ?>" <?php echo ($show_all_pet_cat->cat_id == @$get_single_pet_data[0]->cat_id) ? "selected='selected'" : "" ?>> <?=$show_all_pet_cat->cat_name ?> </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="f-15 text-black">Breed</label>
                                <select name="breed_id" id="breed_id" class="form-control" <?=$required; ?>>
                                    <option value="<?= @$get_single_pet_data[0]->breed_id ? @$get_single_pet_data[0]->breed_id : '' ?>"><?= @$get_breed_name ? @$get_breed_name : 'Select Breed' ?></option>
                                </select>
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="f-15">Tags</label>
                                <input  name="tags" value="<?= @$get_single_pet_data[0]->tags ? @$get_single_pet_data[0]->tags : '' ?>" type="text" class="form-control" placeholder="Tags">
                            </div>
                            <div class="col-md-4">
                                <label class="f-15 text-black">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="Male" <?=@$get_single_pet_data[0]->gender === 'Male' ? 'selected' : ''?>>Male</option>
                                    <option value="Female" <?=@$get_single_pet_data[0]->gender === 'Female' ? 'selected' : ''?>>Female</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="f-15 text-black">Color</label>
                                <select name="color_id" class="form-control">
                                    <?php foreach($get_all_pet_color as $show_all_pet_color){ ?>
                                       <option value="<?= $show_all_pet_color->color_id ?>" <?php echo ($show_all_pet_color->color_id == @$get_single_pet_data[0]->color_id) ? "selected='selected'" : "" ?>> <?= $show_all_pet_color->color_name ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="f-15 text-black">Height</label>
                                <input  name="height"value="<?= @$get_single_pet_data[0]->height ? @$get_single_pet_data[0]->height : '' ?>" type="text" class="form-control" placeholder="Height">
                            </div>
                            <div class="col-md-4">
                                <label class="f-15 text-black">Weight</label>
                                <input  name="weight" value="<?= @$get_single_pet_data[0]->weight ? @$get_single_pet_data[0]->weight : '' ?>" type="text" class="form-control" placeholder="Weight">
                            </div>
                            <div class="col-md-4">
                                <label class="f-15 text-black">Date of Birth</label>
                                <input  name="dob" value="<?= @$get_single_pet_data[0]->dob ? @$get_single_pet_data[0]->dob : '' ?>" type="date" class="form-control" placeholder="Date of Birth">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="f-15">Favorite Food</label>
                                <input  name="fav_food" value="<?= @$get_single_pet_data[0]->fav_food ? @$get_single_pet_data[0]->fav_food : '' ?>" type="text" class="form-control" placeholder="Favorite Food">
                            </div>
                            <div class="col-md-4">
                                <label class="f-15">Skills</label>
                                <input  name="skills" value="<?= @$get_single_pet_data[0]->skills ? @$get_single_pet_data[0]->skills : '' ?>" type="text" class="form-control" placeholder="Skills">
                            </div>
                            <div class="col-md-4">
                                <label class="f-15">Vet Clinic</label>
                                <input  name="vet_clinic" value="<?= @$get_single_pet_data[0]->vet_clinic ? @$get_single_pet_data[0]->vet_clinic : '' ?>"  type="text" class="form-control" placeholder="Vet Clinic">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class="f-15 text-black">Located</label>
                                <select name="located" class="form-control">
                                    <option value="At Home" <?=@$get_single_pet_data[0]->located === 'At Home' ? 'selected' : ''?>>At Home</option>
                                    <option value="At Shelter" <?=@$get_single_pet_data[0]->located === 'At Shelter' ? 'selected' : ''?>>At Shelter</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="f-15 text-black">Adoptable</label>
                                <select name="adoptable" class="form-control">
                                    <option value="Yes" <?=@$get_single_pet_data[0]->adoptable === 'Yes' ? 'selected' : ''?>>Yes</option>
                                    <option value="No" <?=@$get_single_pet_data[0]->adoptable === 'No' ? 'selected' : ''?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="f-15">Description</label>
                                <textarea name="description" class="form-control" cols="30" rows="3" placeholder="Pet Description..."><?= @$get_single_pet_data[0]->description ? @$get_single_pet_data[0]->description : '' ?></textarea>
                            </div>
                        </div>

                        <!-- Where I live -->
                        <div class="row form-group">
                            <div class="col-md-12 text-blue f-20 b-700 m-t-20">Where I Live</div>
                            <div class="col-md-6">
                                <label class="f-15 text-black">Country</label>
                                <select name="country"  class="crs-country form-control" data-region-id="three">
                                    <option value="Select Country">Select Country</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="f-15 text-black">State</label> 
                                <select name="state" id="three" class="form-control" data-value="shortcode">
                                    <option value="Select State"><?=@$get_single_pet_data[0]->state; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="f-15 text-black">City</label>
                                <input required name="city" value="<?= @$get_single_pet_data[0]->city ? @$get_single_pet_data[0]->city : '' ?>" type="text" class="form-control" placeholder="City">
                            </div>
                            <div class="col-md-4">
                                <label class="f-15 text-black">Street</label>
                                <input  name="street" value="<?= @$get_single_pet_data[0]->street ? @$get_single_pet_data[0]->street : '' ?>" type="text" class="form-control" placeholder="Street">
                            </div>
                            <div class="col-md-4">
                                <label class="f-15 text-black">Zip/Postal Code</label>
                                <input  name="zip_code" value="<?= @$get_single_pet_data[0]->zip_code ? @$get_single_pet_data[0]->zip_code : '' ?>" type="text" class="form-control" placeholder="Zip/Postal Code">
                            </div>
                        </div>
                        <!-- Lost Notice (For Lost Pets)  -->
                        <div class="row form-group">
                            <div class="col-md-12 text-blue f-20 b-700 m-t-20">Lost Notice (For Lost Pets) </div>
                            <div class="col-md-4">
                                <label class="f-15 text-black">Activate Notice</label>
                                <select name="activate_notice" class="form-control">
                                    <option value="Yes" <?=@$get_single_pet_data[0]->activate_notice === 'Yes' ? 'selected' : ''?>>Yes</option>
                                    <option value="No" <?=@$get_single_pet_data[0]->activate_notice === 'No' ? 'selected' : ''?>>No</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="f-15 text-black">Notice Title</label>
                                <input  name="notice_title" value="<?= @$get_single_pet_data[0]->notice_title ? @$get_single_pet_data[0]->notice_title : '' ?>" type="text" class="form-control" placeholder="Notice Title">
                            </div>
                            <div class="col-md-4">
                                <label class="f-15 text-black">Chip Number</label>
                                <input  name="chip_no" value="<?= @$get_single_pet_data[0]->chip_no ? @$get_single_pet_data[0]->chip_no : '' ?>" type="text" class="form-control" placeholder="Chip Number">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label class="f-15 text-black">Collar Tag</label>
                                <input  name="collar_tag" value="<?= @$get_single_pet_data[0]->collar_tag ? @$get_single_pet_data[0]->collar_tag : '' ?>" type="text" class="form-control" placeholder="Collar Tag">
                            </div>
                            <div class="col-md-4">
                                <label class="f-15 text-black">Reward</label>
                                <input  name="reward" value="<?= @$get_single_pet_data[0]->reward ? @$get_single_pet_data[0]->reward : '' ?>" type="text" class="form-control" placeholder="Reward">
                            </div>
                            <div class="col-md-4">
                                <label class="f-15 text-black">Lost Location</label>
                                <input  name="lost_location" value="<?= @$get_single_pet_data[0]->lost_location ? @$get_single_pet_data[0]->lost_location : '' ?>" type="text" class="form-control" placeholder="Lost Location">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class="f-15 text-black">Lost Date</label>
                                <input  name="lost_date" value="<?= @$get_single_pet_data[0]->lost_date ? @$get_single_pet_data[0]->lost_date : '' ?>" type="date" class="form-control" placeholder="Lost Date">
                            </div>
                            <div class="col-md-6">
                                <label class="f-15 text-black">Other Info</label>
                                <input  name="other_info" value="<?= @$get_single_pet_data[0]->other_info ? @$get_single_pet_data[0]->other_info : '' ?>" type="text" class="form-control" placeholder="Other Info">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class="f-15 text-black">Contact Info</label>
                                <input  name="contact_info" value="<?= @$get_single_pet_data[0]->contact_info ? @$get_single_pet_data[0]->contact_info : '' ?>" type="text" class="form-control" placeholder="Contact Info">
                            </div>
                            <div class="col-md-6">
                                <label class="f-15 text-black">Alternate Contact Info</label>
                                <input  name="alt_contact_info" value="<?= @$get_single_pet_data[0]->alt_contact_info ? @$get_single_pet_data[0]->alt_contact_info : '' ?>" type="text" class="form-control" placeholder="Alternate Contact Info">
                            </div>
                        </div>
                        <!-- Upload Pets Images -->
                        <div class="row form-group">
                            <div class="col-md-12 text-blue f-20 b-700 m-t-20">Upload Pet Images</div>
                            <div class="col-md-12 m-t-20">
                                <label for="">Drag or Click image to upload</label>
                                <div class="card">
                                    <div class="card-body drop-images text-center">
                                        <p><i class="fa fa-cloud-download-alt fa-3x text-orange"></i></p>
                                        <p class="text-black">Drag and Drop Images here or <br>Click to Upload</p>
                                        <input type="file" class="drag-files" id="uploadFiles" multiple="multiple" name="images_file[]" accept=".gif, .png, .jpg, .jpeg" <?= $required; ?> >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 m-t-20 my-upload-pets">
                                <label for="">Uploaded Images</label>
                                <div class="card">
                                    <div class="card-body uploaded-images">
                                        <div class="row uploaded-files">
                                           <?php if($get_single_pet_data){ ?>
                                                <?php $json_pet_images = json_decode(@$get_single_pet_data[0]->pet_images);
                                                $countpetimages=count($json_pet_images);
                                                if(!$json_pet_images){
                                                    @$imgalert.='
                                                        <div class="alert alert-danger f-15" role="alert">
                                                            <strong><i class="fa fa-check"></i> Empty!</strong> Please upload atleast 1 pet image (maximum of 4 images and less than 1 mb of size).
                                                        </div>
                                                    ';  
                                                }

                                                $isl=0;
                                                    foreach($json_pet_images as $pet_img):
                                                ?>
                                                <div class="col-md-3 img_uploaded oldImg<?=$isl;?>">
                                                    <div class="u-pet-img highlight">
                                                        <img class="w-100 u-img1" src="<?=base_url().$pet_img;?>" alt="Pet Image" >
                                                    </div>
                                                    <span class="cust-mod-close rmImg" title="Remove Image" onclick="delImgPet(<?=$get_single_pet_data[0]->pet_id;?>,'<?=$pet_img;?>', <?=$isl;?>)"><i class="fa fa-times text-white"></i></span>
                                                </div>
                                                <?php $isl++; endforeach; ?>
                                            <?php }else{ ?>
                                                <?php 
                                                    @$imgalert.='
                                                        <div class="alert alert-danger f-15" role="alert">
                                                            <strong><i class="fa fa-check"></i> Empty!</strong> Please upload atleast 1 pet image (maximum of 4 images and less than 1 mb of size).
                                                        </div>
                                                    ';
                                                ?>
                                            <?php } ?>

                                            <div class="col-md-12 emptyImgMsg">
                                                <span id="ajaxshowimgalert"><?=@$imgalert; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn bg-orange sub-btn"><i class="fa fa-save"></i> <?= $submit_pet; ?></button>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
          </div>
          <!-- Close Main Content -->
	  </div>
    </section>
  
    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
<!-- Footer -->
    <?php $this->load->view('pet/img_crop');?>

  </body>

</html>
