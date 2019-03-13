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
          <?php if($pd){
                $btnText  = 'Update Pet';
                $postType = 'update';
                $formTxt  = 'Update Pet Details';
                $formUrl  = 'pet/add_pet/'.$pd['pet_id'];
            } else{
                $btnText  = 'Save Pet';
                $formTxt  = 'Add New Pet';
                $formUrl  = 'pet/add_pet';
                $postType = 'add';
            }
           ?>
          <!-- Main Content -->
		  <div class="col-md-9 m-t-10 p-l-0 p-details">
			<div class="panel panel-default bg-gray">
				<div class="panel-heading pointed">
					<span class="b-700 text-blue"><?=$formTxt; ?></span>
                    <a href="<?=base_url();?>pet/my_pets" class="btn btn-sm text-white bg-orange-l pull-right"><i class="fa fa-paw"></i> My Pets</a>
                    <?php if($pd) { ?>
                    <a href="<?=base_url();?>pet/add_new_pet" class="btn btn-sm text-white bg-orange pull-right m-r-5"><i class="fa fa-plus"></i> Add New Pet</a>
                    <?php } ?>
				</div>			
				<div class="panel-body">
                    <input type="hidden" value="<?=(isset($_SESSION['pet_msg'])) ? $_SESSION['pet_msg'] : '0';?>" id="getPetAlert">
                    <?php $is_complete = $this->Account_model->is_complete();?>
                    <?php if($is_complete['is_complete'] != 1){ ?>
                        <div class="alert alert-warning f-15 m-t-20" role="alert">
                            <strong><i class="fa fa-times"></i> Oops!</strong> You can not add your pets if profile is not completed. Adding of pets needs your profile address. Click <a href="<?=base_url()?>account/account">here</a> to update your profile now.
                        </div>
                    <?php } else { ?>
                        <form  action="<?=base_url().$formUrl;?>" method="post" enctype="multipart/form-data">
                            <!-- Pet Details -->
                            <div class="row form-group">
                                <div class="col-md-12 text-blue f-20 b-700 m-t-20">Pet Details</div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Pet Name</label>
                                    <input onchange="checkPetName()" required id="petName" name="pet_name" value="<?=($pd) ? $pd['pet_name'] : ''; ?>" type="text" class="form-control" placeholder="Pet Name">
                                    <input id="oldName" value="<?=($pd) ? $pd['pet_name'] : ''; ?>" type="hidden">
                                    <div id="chk-pname-msg"></div>
                                </div>

                                <div class="col-md-4">
                                    <label class="f-15 text-black">Category</label>
                                    <select name="cat_id" id="cat_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        <?php foreach($this->Pet_model->get_all_pet_cat() as $cat){ extract($cat); ?>
                                            <option value="<?=$cat_id;?>" <?=($pd) ? (($pd['cat_id']==$cat_id) ? 'selected' : '') : ''; ?>> <?=$cat_name;?> </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="f-15 text-black">Breed</label>
                                    <?php $bName = ($pd) ? $this->Pet_model->get_breed_name($pd['breed_id']) : ''; ?>
                                    <select name="breed_id" id="breed_id" class="form-control" required>
                                        <option value="<?=($pd) ? $pd['breed_id'] : ''; ?>"><?=($pd) ? $bName['breed_name'] : 'Select Breed';?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <label class="f-15 text-black">Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="Male (neutered)" <?=($pd) ? (($pd['gender']=="Male (neutered)") ? 'selected' : '') : ''; ?>>Male (neutered)</option>
                                        <option value="Male (NOT neutered)" <?=($pd) ? (($pd['gender']=="Male (NOT neutered") ? 'selected' : '') : ''; ?>>Male (NOT neutered)</option>
                                        <option value="Female (spayed)" <?=($pd) ? (($pd['gender']=="Female (spayed)") ? 'selected' : '') : ''; ?>>Female (spayed)</option>
                                        <option value="Female (NOT spayed)" <?=($pd) ? (($pd['gender']=="Female (NOT spayed)") ? 'selected' : '') : ''; ?>>Female (NOT spayed)</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="f-15 text-black">Color</label>
                                    <select name="color_id" class="form-control" required>
                                        <option value="">Select Color</option>
                                        <?php foreach($this->Pet_model->get_all_pet_color() as $color){ extract($color); ?>
                                            <option value="<?=$color_id;?>" <?=($pd) ? (($pd['color_id']==$color_id) ? 'selected' : '') : ''; ?>><?=$color_name;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="f-15 text-black">Located</label>
                                    <select name="located" class="form-control">
                                        <option value="At Home" <?=($pd) ? (($pd['color_id']=="At Home") ? 'selected' : '') : ''; ?>>At Home</option>
                                        <option value="At Shelter" <?=($pd) ? (($pd['color_id']=="At Shelter") ? 'selected' : '') : ''; ?>>At Shelter</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="f-15 text-black">Adoptable</label>
                                    <select name="adoptable" class="form-control">
                                        <option value="Yes" <?=($pd) ? (($pd['color_id']=="Yes") ? 'selected' : '') : ''; ?>>Yes</option>
                                        <option value="No" <?=($pd) ? (($pd['color_id']=="No") ? 'selected' : '') : ''; ?>>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-5">
                                    <label class="f-15 text-black">Tags</label>
                                    <input  name="tags" value="<?=($pd) ? $pd['tags'] : ''; ?>" type="text" class="form-control" placeholder="Tags">
                                </div>
                                <div class="col-md-2">
                                    <label class="f-15 text-black">Height</label>
                                    <input value="<?=($pd) ? $pd['height'] : ''; ?>" name="height" type="text" class="form-control" placeholder="Height">
                                </div>
                                <div class="col-md-2">
                                    <label class="f-15 text-black">Weight</label>
                                    <input value="<?=($pd) ? $pd['weight'] : ''; ?>" name="weight" type="text" class="form-control" placeholder="Weight">
                                </div>
                                <div class="col-md-3">
                                    <label class="f-15 text-black">Date of Birth</label>
                                    <input value="<?=($pd) ? $pd['dob'] : ''; ?>" name="dob" type="date" class="form-control" placeholder="Date of Birth">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Favorite Food</label>
                                    <input value="<?=($pd) ? $pd['fav_food'] : ''; ?>" name="fav_food" type="text" class="form-control" placeholder="Favorite Food">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Skills</label>
                                    <input value="<?=($pd) ? $pd['skills'] : ''; ?>" name="skills" type="text" class="form-control" placeholder="Skills">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Vet Clinic</label>
                                    <input value="<?=($pd) ? $pd['vet_clinic'] : ''; ?>" name="vet_clinic" type="text" class="form-control" placeholder="Vet Clinic">
                                </div>
                            </div>
                            <!-- Vaccinations -->
                            <div class="row form-group vacc-wrapper">
                                <div class="col-md-12 text-blue f-20 b-700 m-t-20 vaccTitle">Vaccinations</div>
                                <?php $vacc_date = json_decode($pd['vaccination_date']); ?>
								<?php $i=0; if($pd['vaccination']&&$pd['vaccination']!=="null"){ foreach(json_decode($pd['vaccination']) as $vacc){ ?>
                                <div class="col-md-12 vacc-parent">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="f-15 text-black">Vaccination Type</label>
                                            <select name="vaccination[]" class="form-control" required>
                                                <option value="">Select Type</option>
                                                <option value="Parvovirus (CPV)" <?= ($vacc=='Parvovirus (CPV)') ? 'selected' : '' ?>>Parvovirus (CPV)</option>
                                                <option value="Canine distemper virus (CDV)" <?= ($vacc=='Canine distemper virus (CDV)') ? 'selected' : '' ?>>Canine distemper virus (CDV)</option>
                                                <option value="Canine adenovirus (CAV)" <?= ($vacc=='Canine adenovirus (CAV)') ? 'selected' : '' ?>>Canine adenovirus (CAV)</option>
                                                <option value="Rabies" <?= ($vacc=='Rabies') ? 'selected' : '' ?>>Rabies</option>
                                                <option value="Canine parainfluenza virus (CPiV)" <?= ($vacc=='Canine parainfluenza virus (CPiV)') ? 'selected' : '' ?>>Canine parainfluenza virus (CPiV)</option>
                                                <option value="Distemper-measles combination vaccine" <?= ($vacc=='Distemper-measles combination vaccine') ? 'selected' : '' ?>>Distemper-measles combination vaccine</option>
                                                <option value="Bordetella bronchiseptica (Kennel Cough)" <?= ($vacc=='Bordetella bronchiseptica (Kennel Cough)') ? 'selected' : '' ?>>Bordetella bronchiseptica (Kennel Cough)</option>
                                                <option value="Leptospira spp" <?= ($vacc=='Leptospira spp') ? 'selected' : '' ?>>Leptospira spp</option>
                                                <option value="Borrelia burgdorferi (Lyme)" <?= ($vacc=='Borrelia burgdorferi (Lyme)') ? 'selected' : '' ?>>Borrelia burgdorferi (Lyme)</option>
                                                <option value="Giardia" <?= ($vacc=='Giardia') ? 'selected' : '' ?>>Giardia</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="f-15 text-black">Vaccination Date</label>
                                            <input value="<?=$vacc_date[$i];?>" name="vaccination_date[]" type="date" class="form-control" placeholder="Vaccination" required>
                                        </div>
                                    </div>
                                    <?php if($i==0){ ?>
                                        <span onclick="addRemVacInfo(1,this)" class="vacc-btn-add" data-toggle="tooltip" title="Add Vaccination Info"><i class="fa fa-plus"></i></span>
                                    <?php }else{ ?>
                                        <span onclick="remVaccInfo(<?=$i;?>,<?=$pd['pet_id'];?>,'<?=$vacc;?>','<?=$vacc_date[$i];?>',this)" class="vacc-btn-rem" data-toggle="tooltip" title="Remove Info"><i class="fa fa-times"></i></span>
                                    <?php } ?>
                                </div>
                                <?php $i+=1; } } else{ ?>
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
                                <?php } ?>
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
                                    <textarea name="description" class="form-control" cols="30" rows="3" placeholder="Write here..."><?=($pd) ? $pd['description'] : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="f-15 text-black">Please list any of your pet's known allergies and medical/health issues</label>
                                    <textarea name="health_issues" class="form-control" cols="30" rows="3" placeholder="Write here..."><?=($pd) ? $pd['health_issues'] : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label class="f-15 text-black">Does your pet take any medications? If so, please provide medication and dosage requirements</label>
                                    <textarea name="medications" class="form-control" cols="30" rows="3" placeholder="Write here..."><?=($pd) ? $pd['medications'] : ''; ?></textarea>
                                </div>
                            </div>
                            <!-- Lost Notice (For Lost Pets)  -->
                            <div class="row form-group">
                                <div class="col-md-12 text-blue f-20 b-700 m-t-20">Lost Notice (For Lost Pets) </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Activate Notice</label>
                                    <select name="activate_notice" class="form-control">
                                        <option value="Yes" <?=($pd) ? (($pd['activate_notice']=="Yes") ? 'selected' : '') : ''; ?>>Yes</option>
                                        <option value="No" <?=($pd) ? (($pd['activate_notice']=="Yes") ? 'selected' : '') : ''; ?>>No</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Notice Title</label>
                                    <input value="<?=($pd) ? $pd['notice_title'] : ''; ?>" name="notice_title" type="text" class="form-control" placeholder="Notice Title">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Chip Number</label>
                                    <input value="<?=($pd) ? $pd['chip_no'] : ''; ?>" name="chip_no" type="text" class="form-control" placeholder="Chip Number" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Collar Tag</label>
                                    <input value="<?=($pd) ? $pd['collar_tag'] : ''; ?>" name="collar_tag" type="text" class="form-control" placeholder="Collar Tag">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Reward</label>
                                    <input value="<?=($pd) ? $pd['reward'] : ''; ?>" name="reward" type="text" class="form-control" placeholder="Reward">
                                </div>
                                <div class="col-md-4">
                                    <label class="f-15 text-black">Lost Location</label>
                                    <input value="<?=($pd) ? $pd['lost_location'] : ''; ?>" name="lost_location" type="text" class="form-control" placeholder="Lost Location">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label class="f-15 text-black">Lost Date</label>
                                    <input value="<?=($pd) ? $pd['lost_date'] : ''; ?>" name="lost_date" type="date" class="form-control" placeholder="Lost Date">
                                </div>
                                <div class="col-md-6">
                                    <label class="f-15 text-black">Other Info</label>
                                    <input value="<?=($pd) ? $pd['other_info'] : ''; ?>" name="other_info" type="text" class="form-control" placeholder="Other Info">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label class="f-15 text-black">Contact Info</label>
                                    <input value="<?=($pd) ? $pd['contact_info'] : ''; ?>" name="contact_info" type="text" class="form-control" placeholder="Contact Info">
                                </div>
                                <div class="col-md-6">
                                    <label class="f-15 text-black">Alternate Contact Info</label>
                                    <input value="<?=($pd) ? $pd['alt_contact_info'] : ''; ?>" name="alt_contact_info" type="text" class="form-control" placeholder="Alternate Contact Info">
                                </div>
                            </div>
                            <!-- Upload Pets Images -->
                            <div class="row form-group">
                                <div class="col-md-12 text-blue f-20 b-700 m-t-20">Choose pet images</div>
                                <div class="col-md-12 text-center">
                                    <a href="javascript:;" class="btn btn-success" data-toggle="modal" data-target="#selPics"><i class="fa fa-image"></i> Choose from photos</a>
                                    <span class="or">- or -</span>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body drop-images text-center">
                                            <p><i class="fa fa-cloud-download-alt fa-3x text-orange"></i></p>
                                            <p class="text-black">Drag and Drop files or <br>Click to select from your device</p>
                                            <input type="file" class="drag-files" id="uploadFiles" multiple="multiple" name="images_file[]" accept=".gif, .png, .jpg, .jpeg" <?=($pd) ? '' : 'required'; ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-20 my-upload-pets text-center">
                                    <label for="">Uploaded Images</label>
                                    <input type="hidden" name="album_id" value="0">
                                    <div class="card">
                                        <div class="card-body uploaded-images">
                                            <div class="row uploaded-files">
                                                <?php $pet_images = json_decode($pd['pet_images']); ?>
                                                <?php if($pet_images && $pd['pet_images']!=="null"){ ?>
                                                    <div class="col-md-12 emptyImgMsg"></div>
                                                    <?php foreach($pet_images as $imgName){ ?>
                                                    <?php $unqImg = preg_replace('/\.[^.\s]{3,4}$/', '', $imgName); ?>
                                                    <div class="col-md-3 img_uploaded <?=$unqImg;?>" <?=($imgName==$pd['primary_pic']) ? 'data-toggle="tooltip" data-placement="top" title="My Primary Picture"' : ''; ?> >
                                                        <div class="u-pet-img <?=($imgName==$pd['primary_pic']) ? 'highlight' : ''; ?>">
                                                            <img class="w-100" src="<?=base_url();?>assets/img/pictures/usr<?=$pd['user_id'];?>/<?=$imgName;?>" alt="Pet Image">
                                                        </div>
                                                        <?php if($imgName!=$pd['primary_pic']){?>
                                                            <span class="cust-mod-close rmImg" data-toggle="tooltip" data-placement="left" title="Remove Image" onclick="delImgPet(<?=$pd['pet_id'];?>,'<?=$imgName;?>',this)">
                                                                <i class="fa fa-times text-white"></i>
                                                            </span>
                                                            <span class="cust-mod-edit setBtn1" onclick="setPrimary(<?=$pd['pet_id'];?>,'<?=$imgName;?>')" data-toggle="tooltip" data-placement="left" title="Set as primary">
                                                                <i class="fa fa-image text-white"></i>
                                                            </span>
                                                        <?php } ?>
                                                        <input name="imgFromPics[]" value="<?=$imgName;?>" hidden>
                                                    </div>
                                                <?php } } else{?>
                                                    <div class="col-md-12 emptyImgMsg">
                                                        <div class="alert alert-danger f-15" role="alert">
                                                            <strong><i class="fa fa-check"></i> Empty!</strong> Please upload image less than 3 mb of size.
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" name="postType" value="<?=$postType;?>" id="addPetBtn" class="btn bg-orange sub-btn" <?=($pd) ? '' : 'disabled'; ?>><i class="fa fa-save"></i> <?= $btnText; ?></button>
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

    <!-- Select from pictures -->  
    <div class="modal fade" id="selPics" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-image"></i> Choose from photos</p>
                </div>
                <div class="modal-body">
                    <form action="javascript:;" id="addPhotoAlbumForm">
                        <div class="row">
                        <?php if($all_pictures){ ?>
                            <?php foreach($all_pictures as $img){ extract($img); ?>
                                <div class="col-md-3">
                                    <div class="thumbnail">
                                        <a href="javascript:;">
                                            <div class="gal-img">
                                                <img src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$img_name;?>" style="width:100%" alt="Picture">
                                            </div>
                                            <div class="custom-control custom-checkbox m-b-5 floatCBox">
                                                <input type="checkbox" class="custom-control-input selFromPics" id="<?=$img_id?>" name="imgFromPics[]" value="<?=$img_name?>">
                                                <label class="custom-control-label" for="<?=$img_id?>"></label>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else{ ?>
                            <div class="col-md-12">
                                <div class="alert alert-info alert-dismissible f-15" role="alert">
                                    <strong><i class="fa fa-check"></i> Empty!</strong> There are no photos found in your pictures.
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($all_pictures){ ?>
                            <div class="col-md-12 text-center">
                                <button onclick="addToPictures(<?=$user_id;?>)" type="button" class="btn bg-orange sub-btn"><i class="fa fa-save"></i> Add pictures</button>
                            </div>
                        <?php } ?>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
  
    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
    <?php $this->load->view('pet/img_crop');?>

  </body>

</html>
