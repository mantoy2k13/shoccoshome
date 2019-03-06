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
                    <?php $is_complete = $this->Account_model->is_complete();?>
                    <?php if($is_complete['is_complete'] != 1){ ?>
                        <div class="alert alert-warning f-15 m-t-20" role="alert">
                            <strong><i class="fa fa-check"></i> Oops!</strong> You can not add your pets if profile is not completed. Adding of pets needs your profile address. Click <a href="<?=base_url()?>account/account">here</a> to update your profile now.
                        </div>
                    <?php } else { ?>
                        <form  action="<?=base_url();?>pet/<?= $actionurl; ?>" method="post" enctype="multipart/form-data">
                            <!-- Pet Details -->
                            <div class="row form-group">
                                <div class="col-md-12 text-blue f-20 b-700 m-t-20">Pet Details</div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Pet Name</label>
                                    <input onchange="checkPetName()" required id="petName" name="pet_name" value="<?= @$get_single_pet_data[0]->pet_name ? @$get_single_pet_data[0]->pet_name : '' ?>" type="text" class="form-control" placeholder="Pet Name">
                                    <input id="oldName" value="<?= @$get_single_pet_data[0]->pet_name ? @$get_single_pet_data[0]->pet_name : '' ?>" type="hidden">
                                    <input name="user_id" value="<?= $user_logindata->id; ?>" type="hidden" class="form-control" placeholder="user id">
                                    <input name="pet_id" value="<?= @$get_single_pet_data[0]->pet_id ? @$get_single_pet_data[0]->pet_id : '' ?>" type="hidden" class="form-control" placeholder="Pet Id">
                                    <div id="chk-pname-msg"></div>
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
                                    <label class="f-15 text-black">Tags</label>
                                    <input  name="tags" value="<?= @$get_single_pet_data[0]->tags ? @$get_single_pet_data[0]->tags : '' ?>" type="text" class="form-control" placeholder="Tags">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="Male (neutered)" <?=@$get_single_pet_data[0]->gender === 'Male (neutered)' ? 'selected' : ''?>>Male (neutered)</option>
                                        <option value="Male (NOT neutered)" <?=@$get_single_pet_data[0]->gender === 'Male (NOT neutered)' ? 'selected' : ''?>>Male (NOT neutered)</option>
                                        <option value="Female (spayed)" <?=@$get_single_pet_data[0]->gender === 'Female (spayed)' ? 'selected' : ''?>>Female (spayed)</option>
                                        <option value="Female (NOT spayed)" <?=@$get_single_pet_data[0]->gender === 'Female (NOT spayed)' ? 'selected' : ''?>>Female (NOT spayed)</option>
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
                                    <label class="f-15 text-black">Favorite Food</label>
                                    <input  name="fav_food" value="<?= @$get_single_pet_data[0]->fav_food ? @$get_single_pet_data[0]->fav_food : '' ?>" type="text" class="form-control" placeholder="Favorite Food">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Skills</label>
                                    <input  name="skills" value="<?= @$get_single_pet_data[0]->skills ? @$get_single_pet_data[0]->skills : '' ?>" type="text" class="form-control" placeholder="Skills">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Vet Clinic</label>
                                    <input  name="vet_clinic" value="<?= @$get_single_pet_data[0]->vet_clinic ? @$get_single_pet_data[0]->vet_clinic : '' ?>"  type="text" class="form-control" placeholder="Vet Clinic">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label class="f-15 text-black">Located</label>
                                    <select name="located" class="form-control">
                                        <option value="At Home" <?=@$get_single_pet_data[0]->located === 'At Home' ? 'selected' : ''?>>At Home</option>
                                        <option value="At Shelter" <?=@$get_single_pet_data[0]->located === 'At Shelter' ? 'selected' : ''?>>At Shelter</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="f-15 text-black">Adoptable</label>
                                    <select name="adoptable" class="form-control">
                                        <option value="Yes" <?=@$get_single_pet_data[0]->adoptable === 'Yes' ? 'selected' : ''?>>Yes</option>
                                        <option value="No" <?=@$get_single_pet_data[0]->adoptable === 'No' ? 'selected' : ''?>>No</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Vaccinations</label>
                                    <!-- <input name="vaccination" value="<?= @$get_single_pet_data[0]->vaccination ? @$get_single_pet_data[0]->vaccination : '' ?>"  type="text" class="form-control" placeholder="Vaccination" required> -->
                                    <select name="vaccination" class="form-control">
                                        <option value="Parvovirus (CPV)" <?=@$get_single_pet_data[0]->vaccination === 'Parvovirus (CPV)' ? 'selected' : ''?>>Parvovirus (CPV)</option>
                                        <option value="Canine distemper virus (CDV)" <?=@$get_single_pet_data[0]->vaccination === 'Canine distemper virus (CDV)' ? 'selected' : ''?>>Canine distemper virus (CDV)</option>
                                        <option value="Canine adenovirus (CAV)" <?=@$get_single_pet_data[0]->vaccination === 'Canine adenovirus (CAV)' ? 'selected' : ''?>>Canine adenovirus (CAV)</option>
                                        <option value="Rabies" <?=@$get_single_pet_data[0]->vaccination === 'Rabies' ? 'selected' : ''?>>Rabies</option>
                                        <option value="Canine parainfluenza virus (CPiV)" <?=@$get_single_pet_data[0]->vaccination === 'Canine parainfluenza virus (CPiV)' ? 'selected' : ''?>>Canine parainfluenza virus (CPiV)</option>
                                        <option value="Distemper-measles combination vaccine" <?=@$get_single_pet_data[0]->vaccination === 'Distemper-measles combination vaccine' ? 'selected' : ''?>>Distemper-measles combination vaccine</option>
                                        <option value="Bordetella bronchiseptica (Kennel Cough)" <?=@$get_single_pet_data[0]->vaccination === 'Bordetella bronchiseptica (Kennel Cough)' ? 'selected' : ''?>>Bordetella bronchiseptica (Kennel Cough)</option>
                                        <option value="Leptospira spp" <?=@$get_single_pet_data[0]->vaccination === 'Leptospira spp' ? 'selected' : ''?>>Leptospira spp</option>
                                        <option value="Borrelia burgdorferi (Lyme)" <?=@$get_single_pet_data[0]->vaccination === 'Borrelia burgdorferi (Lyme)' ? 'selected' : ''?>>Borrelia burgdorferi (Lyme)</option>
                                        <option value="Giardia" <?=@$get_single_pet_data[0]->vaccination === 'Giardia' ? 'selected' : ''?>>Giardia</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="f-15 text-black">Vaccination Date</label>
                                    <input name="vaccination_date" value="<?= @$get_single_pet_data[0]->vaccination_date ? @$get_single_pet_data[0]->vaccination_date : '' ?>"  type="date" class="form-control" placeholder="Vaccination" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="f-15 text-black">Pet Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="3" placeholder="Write here..."><?= @$get_single_pet_data[0]->description ? @$get_single_pet_data[0]->description : '' ?></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="f-15 text-black">Please list any of your pet's known allergies and medical/health issues</label>
                                    <textarea name="health_issues" class="form-control" cols="30" rows="3" placeholder="Write here..."><?= @$get_single_pet_data[0]->health_issues ? @$get_single_pet_data[0]->health_issues : '' ?></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="f-15 text-black">Does your pet take any medications? If so, please provide medication and dosage requirements</label>
                                    <textarea name="medications" class="form-control" cols="30" rows="3" placeholder="Write here..."><?= @$get_single_pet_data[0]->medications ? @$get_single_pet_data[0]->medications : '' ?></textarea>
                                </div>
                            </div>

                            <!-- Where I live -->
                            <?php foreach($this->Account_model->getAddress() as $adds){ ?>
                            <div class="row form-group">
                                <div class="col-md-12 text-blue f-20 b-700 m-t-20">Where I Live</div>
                                <div class="col-md-6">
                                    <label class="f-15 text-black">Country</label>
                                    <input required readonly name="country" value="<?=$adds['country']?>" type="text" class="form-control" placeholder="Country">
                                </div>
                                <div class="col-md-6">
                                    <label class="f-15 text-black">State</label> 
                                    <input required readonly name="state" value="<?=$adds['state']?>" type="text" class="form-control" placeholder="State">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="f-15 text-black">City</label>
                                    <input required readonly name="city" value="<?=$adds['city']?>" type="text" class="form-control" placeholder="City">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Street</label>
                                    <input readonly required name="street" value="<?=$adds['street']?>" type="text" class="form-control" placeholder="Street">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Zip/Postal Code</label>
                                    <input readonly name="zip_code" value="<?=$adds['zip_code']?>" type="text" class="form-control" placeholder="Zip/Postal Code">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 text-center">
                                    <a href="<?=base_url()?>account/account#target_address" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Change Address</a>
                                </div>
                            </div>
                            <?php } ?>
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
                                                            $getImgName = substr($pet_img, 15);
                                                    ?>
                                                    
                                                    <div class="col-md-3 img_uploaded oldImg<?=$isl;?>">
                                                        <div class="u-pet-img <?=($getImgName==$get_single_pet_data[0]->primary_pic) ? 'highlight' : '';?>">
                                                            <img class="w-100 u-img1" src="<?=base_url();?>assets/img/pet/<?=$getImgName;?>" alt="Pet Image" <?=($getImgName==$get_single_pet_data[0]->primary_pic) ? 'title="Primary Image"' : '';?>>
                                                        </div>
                                                        <span class="cust-mod-close rmImg" title="Remove Image" onclick="delImgPet(<?=$get_single_pet_data[0]->pet_id;?>,'<?=$pet_img;?>', <?=$isl;?>, <?=($getImgName==$get_single_pet_data[0]->primary_pic) ? 1 : 0;?>)"><i class="fa fa-times text-white"></i></span>
                                                        <?php if($getImgName!=$get_single_pet_data[0]->primary_pic){ ?>
                                                            <span class="cust-mod-edit setBtn<?=$isl;?>" onclick="setPrimary(<?=$get_single_pet_data[0]->pet_id;?>,'<?=$getImgName;?>')" title="Set as primary image"><i class="fa fa-image text-white"></i></span>
                                                        <?php } ?>
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
                                    <button type="submit" id="addPetBtn" class="btn bg-orange sub-btn" <?=($get_single_pet_data) ? '' : 'disabled';?>><i class="fa fa-save"></i> <?= $submit_pet; ?></button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
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
