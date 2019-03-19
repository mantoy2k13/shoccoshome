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
		  <div class="col-md-9 m-t-10 p-l-0">
			<div class="panel panel-orange">
				<div class="panel-heading" style="padding:15px;">
                    <span class="b-700 text-white"><i class="fa fa-pen"></i> Create Booking Post</span>
                </div>
                <form action="javascript:;" method="POST">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="message_to">Zip Code: </label>
                                <input value="<?=$zipcode;?>" type="text" class="form-control" name="zipcode" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));">
                            </div>
                            <div class="col-md-4">
                                <label for="message_to">Choose an option:</label>
                                <select class="form-control" name="user_type" onchange="getHostGuest(this);">
                                    <option value="guest" <?=($user_type=='guest') ? 'selected' : '';?>>Be a Guest</option>
                                    <option value="host" <?=($user_type=='host') ? 'selected' : '';?>>Be a Host</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="message_to">Post Status:</label>
                                <select class="form-control" name="post_status">
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                                </select>
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="guest-list col-md-12" style="<?=($user_type=='guest') ? 'display:block;' : 'display:none;';?>">
                                <label for="pet_list">Choose your pet from pet list</label>
                                <select id="petList" name="pet_list[]" class="multipleSelect form-control" multiple>
                                    <?php if($my_pets){ 
                                        foreach($my_pets as $pets){ extract($pets); ?>
                                            <?php if(in_array($pet_id, $pet_list)){ ?>
                                                <option value="<?=$pet_id;?>" selected><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                            <?php } else{ ?>
                                                <option value="<?=$pet_id;?>"><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                            <?php } ?>
                                        
                                        <?php } } else { ?>
                                            <?php if($this->session->userdata('user_email')){?>
                                                <option value="">You have no pets added.</option>
                                            <?php } else { ?>
                                                <option value="">Please login to view your pets.</option>
                                            <?php } ?>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-12 host-list mainpage-list" style="<?=($user_type=='host') ? 'display:block;' : 'display:none;';?>">
                                <label for="pet_cat">Choose your category</label><br />
                                <select id="petCat" name="pet_cat[]" class="multipleSelect form-control" multiple>
                                    <?php foreach($categories as $cat){ extract($cat); ?>
                                        <?php if(in_array($cat_id, $pet_cat)){ ?>
                                            <option value="<?=$cat_id;?>" selected><?=$cat_name;?></option>
                                        <?php } else{ ?>
                                            <option value="<?=$cat_id;?>"><?=$cat_name;?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-md-3">
                                <label for="date_from">Date From: </label>
                                <input type="date" class="form-control" name="date_from">
                            </div>
                            <div class="col-md-3">
                                <label for="time_start">Time Start: </label>
                                <input type="time" class="form-control" name="time_start">
                            </div>

                            <div class="col-md-3">
                                <label for="date_to">Date To: </label>
                                <input type="date" class="form-control" name="date_to">
                            </div>
                            <div class="col-md-3">
                                <label for="time_end">Time End: </label>
                                <input type="time" class="form-control" name="time_end">
                            </div>
                        </div>
    
                        <div class="row text-center">
                            <div class="col-md-12">
                                <button type="submit" class="btn bg-orange sub-btn"><i class="fa fa-save"></i> Save Post</button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
          </div>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>

  </body>

</html>
