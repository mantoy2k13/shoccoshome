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
          <?php foreach($view_bio as $bio){ extract($bio); ?>
            <?php 
                if($fullname){
                    $getName = $fullname;
                }else{
                    $explodeResultArrayname = explode("@", $email);
                    $getName = ucfirst($explodeResultArrayname[0]);
                }
            ?>
		  <div class="col-md-9 m-t-10 bio-wrapper-info p-l-0">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 bio-head">
                                <div class="bio-img">
                                    <?php if($user_img) { ?>
                                        <img src="<?=base_url();?>assets/img/pictures/usr<?=$id;?>/<?=$user_img;?>" alt="Profile Image">
                                    <?php }else{ ?>
                                        <img src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image">
                                    <?php } ?>
                                </div>
                                <a href="<?=base_url();?>account/account" class="btn bg-orange text-white pull-right btn-sm"><i class="fa fa-edit"></i> Edit Bio</a>
                                <p class="f-30 b-700 text-orange-d m-b-0"><?=$getName;?></p>
                                <p class="f-25 b-700 text-blue m-b-0"><?=($occupation)?$occupation:'No Occupation';?></p>
                                <p class="f-20 m-b-0 text-black-l"> <?php if($street&&$city&&$zip_code&&$state&&$country){ ?> <?=$street.' '.$city.', '.$zip_code.', '.$state.', '.$country;?><?php } else { echo 'No Address'; }?></p>
                            </div>
                            <div class="col-md-12 m-t-10">
                                <div class="prof-desc">
                                    <div class="row">
                                        <div class="container">
                                            <p class="text-black"><?=($bio)?nl2br($bio):"No Description";?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-20">
                                    <div class="col-md-12">
                                        <div class="pic-head bg-greyish">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <i class="fa fa-paw f-25 text-blue"></i> Pets
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m-t-10 bio-pet-grp">
                                            <?php $my_pets = $this->Account_model->get_my_pets($id);?>
                                            <?php if($my_pets){foreach($my_pets as $pets){ extract($pets); ?>
                                                <div class="col-md-6">
                                                    <div class="card bg-grey friend-card">
                                                        <div class="card-body">
                                                            <div class="pet-bio-img">
                                                                <?php if($primary_pic) { ?>
                                                                    <img src="<?=base_url();?>assets/img/pictures/usr<?=$id;?>/<?=$primary_pic;?>" alt="Pet Image">
                                                                <?php }else{ ?>
                                                                    <img src="<?=base_url();?>assets/img/pictures/default_pet.png" alt="Default Pet Image">
                                                                <?php } ?>
                                                            </div>
                                                            <button class="btn btn-info btn-xs pull-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i></button>
                                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                                <a class="dropdown-item" href="<?=base_url();?>pet/add_new_pet/<?=$pet_id;?>">Edit Pet</a>
                                                                <a class="dropdown-item" href="<?=base_url();?>pet/pet_details/<?=$pet_id;?>">Pet Details</a>
                                                            </div>
                                                            <p class="text-blue f-20 b-700"><a href="<?=base_url();?>pet/pet_details/<?=$pet_id;?>"><?=$pet_name;?></a> </p>
                                                            <p class="f-15 text-black"><?=$description;?></p>
                                                            <p class="b-700 f-14">Breed: <span class="b-700 text-black"><?=$breed_name;?> (<?=$cat_name;?>)</span></p>
                                                            <span class="badge bg-orange text-white f-12 pull-right"><?=($isAvailable ==1)? 'Need Sitter': '';?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } } else { ?>
                                                <div class="col-md-12">
                                                    <div class="alert alert-info f-15">
                                                        <strong><i class="fa fa-check"></i> Empty!</strong> You have no pets added. Click <a href="<?=base_url();?>pet/add_new_pet">here</a> to add new pets.
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="profile-info-wrapper">
                            <p class="f-20 b-700 text-blue">Contact Info</p>
                            <p class="f-15"><span class="text-black b-700">Name</span><br>
                                <?=$getName;?>
                            </p>
                            <p class="f-15"><span class="text-black b-700">Email</span><br><?=$email;?></p>
                            <p class="f-15"><span class="text-black b-700">Mobile</span><br>
                                <?=($mobile_number)?$mobile_number:"No Number";?>
                            </p>
                            <p class="f-15"><span class="text-black b-700">Gender</span><br>
                                <?=($gender)?$gender:"No Gender";?>
                            </p>
                            <p class="f-15"><span class="text-black b-700">Occupation</span><br>
                                <?=($occupation)?$occupation:"No Occupation";?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row m-t-20">
                    <div class="col-md-6">
                        <form onchange="$('.setTimeMsg2').html('');" id="setTimeForm">
                            <p class="f-20 b-700 text-orange-d m-b-0">As a sitter availability <i class="fa fa-question-circle pull-right m-t-5 text-info" data-container="body" data-toggle="popover" title="Tips!" data-placement="left" data-content="If you want to become a sitter and watch other pets, you need to set your available time here. If you don't set your available time, other people won't find or search you."></i></p>
                            <div class="row m-t-10"><div class="col-md-12 setTimeMsg"></div></div>
                            <?php $today = date('Y-m-d'); if($sitter_availability){ 
                                $aDate = json_decode($sitter_availability);
                                $get_date_from = $aDate[0]; 
                                $date_from = ($get_date_from < $today) ? $today : $get_date_from;
                                $get_date_to = $aDate[1];
                                $date_to = date('Y-m-d', strtotime($get_date_to . ' +1 day'));
                            } else{ 
                                $get_date_to = '';
                                $date_from = '';
                                $date_to = '';  
                            } ?>
                            <div class="row m-t-10">
                                <div class="col-md-12">
                                    <label for="date_from">Date From: </label>
                                    <input type="hidden" id="curr_date" value="<?=$today;?>">
                                    <input type="date" class="form-control" name="date_from" id="date_from" value="<?=$date_from;?>">
                                </div>
                                <div class="col-md-12 m-t-10">
                                    <label for="date_to">Date To: </label>
                                    <input type="date" class="form-control" name="date_to" id="date_to" value="<?=$get_date_to;?>">
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-md-6">
                                    <button type="button" onclick="checkDateTime()" class="btn btn-success col-md-12 m-b-5"><i class="fa fa-check"></i> Save My Date</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" onclick="resetDate(1)" class="btn btn-info col-md-12"><i class="fa fa-history"></i> Reset Date</button>
                                </div>
                            </div>
                        </form>
                        <form class="m-t-20" onchange="$('.setTimeMsg2').html('');" id="nsForm">
                            <p class="f-20 b-700 text-orange-d m-b-0">I Need a Sitter Form <i class="fa fa-question-circle pull-right m-t-5 text-info" data-container="body" data-toggle="popover" title="Tips!" data-placement="left" data-content="If you have no time looking for a sitter for your pets, you can set a time when your pets need to be sit and let the sitter find and book your beloved pets."></i></p>
                            <?php if($get_my_pets_to_sit){ $ndf = json_decode($get_my_pets_to_sit[0]['ns_date_from']);  
                                $ndt = json_decode($get_my_pets_to_sit[0]['ns_date_to']);
                                $get_date_from2 = $ndf[0]; 
                                $date_from2 = ($get_date_from2 < $today) ? $today : $get_date_from2; 
                                $get_date_to2 = $ndt[0];
                                $date_to2 = date('Y-m-d', strtotime($get_date_to2 . ' +1 day')); 
                            } else{
                                $date_from2 = ''; $get_date_to2 = '';
                                $ndt = ''; $ndf = ''; $date_to2 = '';
                            }?>
                            <div class="row m-t-10"><div class="col-md-12 setTimeMsg2"></div></div>
                            <div class="row m-t-10">
                                <div class="col-md-7">
                                    <label for="date_from">Date From: </label>
                                    <input type="date" class="form-control" name="ns_date_from" id="ns_date_from" value="<?=$date_from2;?>">
                                </div>
                                <div class="col-md-5">
                                    <label for="ns_time_start">Time Start: </label>
                                    <input value="<?=$ndf ? $ndf[1] : '';?>" type="time" class="form-control" name="ns_time_start" id="ns_time_start">
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-md-7">
                                    <label for="ns_date_to">Date To: </label>
                                    <input type="date" class="form-control" name="ns_date_to" id="ns_date_to" value="<?=$get_date_to2;?>">
                                </div>
                                <div class="col-md-5">
                                    <label for="ns_time_end">Time End: </label>
                                    <input value="<?=$ndt ? $ndt[1] : '';?>" type="time" class="form-control" name="ns_time_end" id="ns_time_end">
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="guest-list col-md-12">
                                    <label for="pet_list">Choose your pet from pet list</label>
                                    <select id="petList" name="pet_list[]" class="multipleSelect form-control" multiple  onchange="showDiv(this)">
                                    <?php if($get_my_pets_to_sit) foreach($get_my_pets_to_sit as $a){ $getPl[] = $a['pet_id']; } ?>
                                    <?php if($my_pets){ 
                                        foreach($my_pets as $pets){ extract($pets); ?>
                                            <?php if($getPl){ ?>
                                                <?php if(in_array($pet_id, $getPl)){ ?>
                                                <option value="<?=$pet_id;?>" selected><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                                <?php } else{ ?>
                                                    <option value="<?=$pet_id;?>"><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                                <?php } ?>
                                            <?php } else{?>
                                                <option value="<?=$pet_id;?>"><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                            <?php } ?>
                                        <?php } } else { ?>
                                            <option value="">You have no pets added.</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-md-6">
                                    <button type="button" onclick="checkDateTime2()" class="btn btn-success col-md-12 m-b-5"><i class="fa fa-check"></i> Save Pet Date</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" onclick="resetDate(2)" class="btn btn-info col-md-12"><i class="fa fa-history"></i> Reset Date</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <p class="f-20 b-700 text-orange-d m-b-0">My Calendar <i class="fa fa-question-circle pull-right m-t-5 text-info" data-container="body" data-toggle="popover" title="Tips!" data-placement="left" data-content="This calendar will display your schedules. There is a legend color below to easy determined what type of color is this all about. The calendar will show your time availability as a sitter and your pet schedules where you want a sitter to watch your pets. The calendar also displays the current date."></i></p>
                        <p class="f-15 m-b-0 text-center m-t-20">
                            <span class="avIcon bg-skyblue"></span> Available 
                            <span class="avIcon bg-orange"></span> Need Sitter
                            <span class="avIcon bg-yellow-l"></span> Today
                        </p>
                        <div class="m-t-20" id='availability'></div>
                        <input type="hidden" id="a_date_from" value="<?=$date_from;?>">
                        <input type="hidden" id="a_date_to" value="<?=$date_to;?>">
                        <input type="hidden" id="pDate_from" value="<?=$date_from2;?>">
                        <input type="hidden" id="pDate_to" value="<?=$date_to2;?>">
                    </div>
                </div>
            </div>
          <?php } ?>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
    <script src="<?=base_url();?>assets/js/initializations/init_vb.js"></script>
    
  </body>

</html>
