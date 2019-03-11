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
					<span class="b-700 text-blue">Add New Pet</span>
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
                        <form  action="<?=base_url();?>pet/add_pet" method="post" enctype="multipart/form-data">
                            <!-- Pet Details -->
                            <div class="row form-group">
                                <div class="col-md-12 text-blue f-20 b-700 m-t-20">Pet Details</div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Pet Name</label>
                                    <input onchange="checkPetName()" required id="petName" name="pet_name" value="" type="text" class="form-control" placeholder="Pet Name">
                                    <input id="oldName" value="" type="hidden">
                                    <div id="chk-pname-msg"></div>
                                </div>

                                <div class="col-md-4">
                                    <label class="f-15 text-black">Category</label>
                                    <select name="cat_id" id="cat_id" class="form-control" required>
                                        <option value="" selected="selected">Select Category</option>
                                        <?php foreach($this->Pet_model->get_all_pet_cat() as $cat){ extract($cat); ?>
                                            <option value="<?=$cat_id;?>"> <?=$cat_name;?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="f-15 text-black">Breed</label>
                                    <select name="breed_id" id="breed_id" class="form-control" reqired>
                                        <option value="">Select Breed</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label class="f-15 text-black">Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="Male (neutered)">Male (neutered)</option>
                                        <option value="Male (NOT neutered)">Male (NOT neutered)</option>
                                        <option value="Female (spayed)">Female (spayed)</option>
                                        <option value="Female (NOT spayed)">Female (NOT spayed)</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="f-15 text-black">Color</label>
                                    <select name="color_id" class="form-control">
                                        <option value="">Select Color</option>
                                        <?php foreach($this->Pet_model->get_all_pet_color() as $color){ extract($color); ?>
                                            <option value="<?=$color_id;?>"><?=$color_name;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="f-15 text-black">Located</label>
                                    <select name="located" class="form-control">
                                        <option value="At Home">At Home</option>
                                        <option value="At Shelter">At Shelter</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="f-15 text-black">Adoptable</label>
                                    <select name="adoptable" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-5">
                                    <label class="f-15 text-black">Tags</label>
                                    <input  name="tags" value="" type="text" class="form-control" placeholder="Tags">
                                </div>
                                <div class="col-md-2">
                                    <label class="f-15 text-black">Height</label>
                                    <input  name="height" type="text" class="form-control" placeholder="Height">
                                </div>
                                <div class="col-md-2">
                                    <label class="f-15 text-black">Weight</label>
                                    <input  name="weight" type="text" class="form-control" placeholder="Weight">
                                </div>
                                <div class="col-md-3">
                                    <label class="f-15 text-black">Date of Birth</label>
                                    <input  name="dob" type="date" class="form-control" placeholder="Date of Birth">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Favorite Food</label>
                                    <input  name="fav_food" type="text" class="form-control" placeholder="Favorite Food">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Skills</label>
                                    <input  name="skills" type="text" class="form-control" placeholder="Skills">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Vet Clinic</label>
                                    <input  name="vet_clinic" type="text" class="form-control" placeholder="Vet Clinic">
                                </div>
                            </div>
                            <!-- Vaccinations -->
                            <div class="row form-group vacc-wrapper">
                                <div class="col-md-12 text-blue f-20 b-700 m-t-20">Vaccinations</div>
                                <div class="col-md-12 vacc-parent">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="f-15 text-black">Vaccination Type</label>
                                            <select name="vaccination[]" class="form-control" required>
                                                <option value="">Select Type</option>
                                                <option value="Parvovirus (CPV)">Parvovirus (CPV)</option>
                                                <option value="Canine distemper virus (CDV)">Canine distemper virus (CDV)</option>
                                                <option value="Canine adenovirus (CAV)">Canine adenovirus (CAV)</option>
                                                <option value="Rabies">Rabies</option>
                                                <option value="Canine parainfluenza virus (CPiV)">Canine parainfluenza virus (CPiV)</option>
                                                <option value="Distemper-measles combination vaccine">Distemper-measles combination vaccine</option>
                                                <option value="Bordetella bronchiseptica (Kennel Cough)">Bordetella bronchiseptica (Kennel Cough)</option>
                                                <option value="Leptospira spp">Leptospira spp</option>
                                                <option value="Borrelia burgdorferi (Lyme)">Borrelia burgdorferi (Lyme)</option>
                                                <option value="Giardia">Giardia</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="f-15 text-black">Vaccination Date</label>
                                            <input name="vaccination_date[]" type="date" class="form-control" placeholder="Vaccination" required>
                                        </div>
                                    </div>
                                    <span onclick="addRemVacInfo(1,this)" class="vacc-btn-add" data-toggle="tooltip" title="Add Vaccination Info"><i class="fa fa-plus"></i></span>
                                </div>
                            </div>
                            
                            <!-- Where I live -->
                            <?php foreach($this->Account_model->getAddress() as $adds){ ?>
                            <div class="row form-group">
                                <div class="col-md-12 text-blue f-20 b-700 m-t-20">Where I Live</div>
                                <div class="col-md-12">
                                    <label class="f-15 text-black">Full Address</label>
                                    <input name="full_address" value="<?=$adds['street'].' '.$adds['city'].', '.$adds['zip_code'].', '.$adds['state'].', '.$adds['country'];?>" type="text" class="form-control" placeholder="Full Address" readonly>
                                    <input type="hidden" name="country" value="<?=$adds['country']?>">
                                    <input type="hidden" name="state" value="<?=$adds['state']?>">
                                    <input type="hidden" name="zip_code" value="<?=$adds['zip_code']?>">
                                    <input type="hidden" name="city" value="<?=$adds['city']?>">
                                    <input type="hidden" name="street" value="<?=$adds['street']?>">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 text-center">
                                    <a href="<?=base_url()?>account/account#target_address" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Change Address</a>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <!-- Additional Info -->
                            <div class="row form-group">
                                <div class="col-md-12 text-blue f-20 b-700 m-t-20">Additional Info</div>
                                <div class="col-md-12">
                                    <label class="f-15 text-black">Pet Description</label>
                                    <textarea name="description" class="form-control" cols="30" rows="3" placeholder="Write here..."></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="f-15 text-black">Please list any of your pet's known allergies and medical/health issues</label>
                                    <textarea name="health_issues" class="form-control" cols="30" rows="3" placeholder="Write here..."></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="f-15 text-black">Does your pet take any medications? If so, please provide medication and dosage requirements</label>
                                    <textarea name="medications" class="form-control" cols="30" rows="3" placeholder="Write here..."></textarea>
                                </div>
                            </div>
                            <!-- Lost Notice (For Lost Pets)  -->
                            <div class="row form-group">
                                <div class="col-md-12 text-blue f-20 b-700 m-t-20">Lost Notice (For Lost Pets) </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Activate Notice</label>
                                    <select name="activate_notice" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Notice Title</label>
                                    <input  name="notice_title" type="text" class="form-control" placeholder="Notice Title">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Chip Number</label>
                                    <input  name="chip_no" type="text" class="form-control" placeholder="Chip Number">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Collar Tag</label>
                                    <input  name="collar_tag" type="text" class="form-control" placeholder="Collar Tag">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Reward</label>
                                    <input  name="reward" type="text" class="form-control" placeholder="Reward">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Lost Location</label>
                                    <input  name="lost_location" type="text" class="form-control" placeholder="Lost Location">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label class="f-15 text-black">Lost Date</label>
                                    <input  name="lost_date" type="date" class="form-control" placeholder="Lost Date">
                                </div>
                                <div class="col-md-6">
                                    <label class="f-15 text-black">Other Info</label>
                                    <input  name="other_info" type="text" class="form-control" placeholder="Other Info">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label class="f-15 text-black">Contact Info</label>
                                    <input  name="contact_info" type="text" class="form-control" placeholder="Contact Info">
                                </div>
                                <div class="col-md-6">
                                    <label class="f-15 text-black">Alternate Contact Info</label>
                                    <input  name="alt_contact_info" type="text" class="form-control" placeholder="Alternate Contact Info">
                                </div>
                            </div>
                            <!-- Upload Pets Images -->
                            <div class="row form-group">
                                <div class="col-md-12 m-t-20">
                                    <div class="card">
                                        <div class="card-body drop-images text-center">
                                            <p><i class="fa fa-cloud-download-alt fa-3x text-orange"></i></p>
                                            <p class="text-black">Drag and Drop Images here or <br>Click to Upload</p>
                                            <input type="file" class="drag-files" id="uploadFiles" multiple="multiple" name="images_file[]" accept=".gif, .png, .jpg, .jpeg" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-20 my-upload-pets text-center">
                                    <label for="">Uploaded Images</label>
                                    <input type="hidden" name="album_id" value="0">
                                    <div class="card">
                                        <div class="card-body uploaded-images">
                                            <div class="row uploaded-files">
                                                <div class="col-md-12 emptyImgMsg">
                                                    <div class="alert alert-danger f-15" role="alert">
                                                        <strong><i class="fa fa-check"></i> Empty!</strong> Please upload  image less than 3 mb of size.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" id="addPetBtn" class="btn bg-orange sub-btn" disabled><i class="fa fa-save"></i> Save Pet</button>
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
    <?php $this->load->view('pet/img_crop');?>

  </body>

</html>
