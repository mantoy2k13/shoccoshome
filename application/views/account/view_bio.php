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
            <?php $my_id = $this->session->userdata('user_id');?>
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
                                <?php $uid = $this->session->userdata('user_id');?>
                                <?php if($this->Friends_model->check_if_friends($id)){ ?>
                                    <?php if($uid != $id){?>
                                        <div class="options<?=$id;?>">
                                            <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i>  Friends</span>
                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                <a onclick="request_friends(<?=$id;?>,3,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Unfriend</a>
                                                <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else {?>
                                    <?php if($this->Friends_model->check_friend_request($id)){ ?>
                                        <?php if($uid != $id){?>
                                            <div class="options<?=$id;?>">
                                                <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i>  Request Sent</span>
                                                <div class="dropdown-menu" aria-labelledby="f-menu">
                                                    <a onclick="request_friends(<?=$id;?>,2,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Remove Request</a>
                                                    <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else {?>
                                        <?php if($uid != $id){?>
                                            <div class="options<?=$id;?>">
                                                <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Add friend</span>
                                                <div class="dropdown-menu" aria-labelledby="f-menu">
                                                    <a onclick="request_friends(<?=$id;?>,1,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Add Friend</a>
                                                    <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
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
                                                    <i class="fa fa-image f-25 text-blue"></i> User Image's
                                                </div>
                                            </div>
                                        </div>
                                        <?php $user_images_5 = $this->Account_model->get_users_images($user_id, 5);?>
                                        <?php $user_images = $this->Account_model->get_users_images($user_id, 0);?>
                                        <div class="row m-t-10 m-b-10">
                                            <?php if($user_images_5){?>
                                                <div class="<?=(count($user_images_5)!=1) ? 'col-md-6' : 'col-md-12';?>">
                                                    <div class="userImagesBig imgHovGen">
                                                        <?php if($user_images_5){?>
                                                            <img src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$user_images_5[0]['img_name'];?>" alt="Profile  Image" class="zoomable">
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <?php if(count($user_images_5)!=1){?>
                                                    <div class="col-md-6">
                                                        <?php $i=1; foreach($user_images_5 as $k){extract($k); ?>
                                                            <?php if($i!=1){?>
                                                            <div class="usrImgCol">
                                                                <div class="userImages imgHovGen">
                                                                    <img src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$img_name;?>" alt="Profile  Image" class="zoomable">
                                                                    <?php if($i==count($user_images_5)){?>
                                                                    <a class="viewAllImg" href="javascript:;"  data-toggle="modal" data-target="#selPics"><span class="badge badge-danger"><?=count($user_images_5);?></span>  View all </a>
                                                                    <?php } ?>
                                                                </div>  
                                                            </div>  
                                                        <?php } $i++;}?>   
                                                    </div>
                                                <?php } ?>  
                                            <?php } else{?>  
                                                <div class="col-md-12">
                                                    <div class="alert alert-info f-15">
                                                        <strong><i class="fa fa-check"></i> Empty!</strong> The user has no images.
                                                    </div>
                                                </div>
                                            <?php }?>  
                                        </div>
                                        <div class="pic-head bg-greyish m-t-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <i class="fa fa-paw f-25 text-blue"></i> Pets
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m-t-10 bio-pet-grp">
                                            <?php $user_pets = $this->Account_model->get_my_pets($id);?>
                                            <?php if($user_pets){foreach($user_pets as $pets){ extract($pets); ?>
                                                <div class="col-md-6">
                                                    <div class="card bg-grey friend-card">
                                                        <div class="card-body">
                                                            <div class="pet-bio-img">
                                                                <?php if($primary_pic) { ?>
                                                                    <img src="<?=base_url();?>assets/img/pictures/usr<?=$id;?>/<?=$primary_pic;?>" alt="Profile Image">
                                                                <?php }else{ ?>
                                                                    <img src="<?=base_url();?>assets/img/pictures/default_pet.png" alt="Default Profile Image">
                                                                <?php } ?>
                                                            </div>
                                                            <button class="btn btn-info btn-xs pull-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i></button>
                                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                                <?php if($id==$my_id){ ?>
                                                                <a class="dropdown-item" href="<?=base_url();?>pet/add_new_pet/<?=$pet_id;?>">Edit Pet</a>
                                                                <?php } ?>
                                                                <a class="dropdown-item" href="<?=base_url();?>pet/pet_details/<?=$pet_id;?>">Pet Details</a>
                                                            </div>
                                                            <p class="text-blue f-20 b-700"><a href="<?=base_url();?>pet/pet_details/<?=$pet_id;?>"><?=$pet_name;?></a> </p>
                                                            <p class="f-15 text-black"><?=$description;?></p>
                                                            <p class="b-700 f-14">Breed: <span class="b-700 text-black"><?=$breed_name;?> (<?=$cat_name;?>)</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } } else { ?>
                                                <div class="col-md-12">
                                                    <div class="alert alert-info f-15">
                                                        <strong><i class="fa fa-check"></i> Empty!</strong> The user has no pets.
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
                                <?=($gender)?$gender:"No Number";?>
                            </p>
                            <p class="f-15"><span class="text-black b-700">Occupation</span><br>
                                <?=($occupation)?$occupation:"No Occupation";?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row m-t-20">
                    <?php if($sitter_availability){ ?>
                        <?php 
                            $aDate = json_decode($sitter_availability);
                            $get_date_from = $aDate[0]; $today = date('Y-m-d');
                            $date_from = ($get_date_from < $today) ? $today : $get_date_from;
                            $get_date_to = $aDate[1];
                            $date_to = date('Y-m-d', strtotime($get_date_to . ' +1 day')); ?>
                        <div class="col-md-6">
                            <?php $cb = $this->Booking_model->check_booking($my_id, $id); ?>
                            <form onchange="$('.setTimeMsg').html('');" id="setTimeForm">
                                <p class="f-20 b-700 text-orange-d m-b-0">Book and Contact 
                                <?=$getName;?></p>
                                <div class="row m-t-10"><div class="col-md-12 setTimeMsg"></div></div>
                                <?php if($cb){ ?>
                                    <?php $bdf = json_decode($cb['book_date_from']);
                                          $bdt = json_decode($cb['book_date_to']);
                                          $pl  = json_decode($cb['pet_list']); ?>
                                    
                                    <input type="hidden" id="bdf" value="<?=$bdf[0];?>">
                                    <input type="hidden" id="bdt" value="<?=date('Y-m-d', strtotime($bdt[0] . ' +1 day'));?>">
                                <?php } ?>
                                <?php if($cb) { ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning f-15">
                                                <strong><i class="fa fa-history"></i> Awaiting approvals!</strong> Please wait for the user to respond your request.
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row m-t-10">
                                    <!-- Common Initializations -->
                                    <input type="hidden" id="curr_date" value="<?=date('Y-m-d');?>">
                                    <input type="hidden" name="book_user_id" value="<?=$id;?>">
                                    <input type="hidden" id="book_id" value="<?=($cb) ? $cb['book_id'] : '';?>">
                                    <input type="hidden" name="user_type" value="guest">

                                    <div class="col-md-7">
                                        <label for="date_from">Date From: </label>
                                        <input type="date" class="form-control" name="date_from" id="date_from" value="<?=($cb) ? $bdf[0] : $date_from;?>">
                                        <input type="hidden" id="origDateFrom" value="<?=$date_from;?>">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="time_start">Time Start: </label>
                                        <input value="<?=($cb) ? $bdf[1] : '';?>" type="time" class="form-control" name="time_start" id="time_start">
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-7">
                                        <label for="date_to">Date To: </label>
                                        <input type="date" class="form-control" name="date_to" id="date_to" value="<?=($cb) ? $bdt[0] : $get_date_to;?>">
                                        <input type="hidden" id="origDateTo" value="<?=$get_date_to;?>">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="time_end">Time End: </label>
                                        <input type="time" value="<?=($cb) ? $bdt[1] : '';?>" class="form-control" name="time_end" id="time_end">
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="guest-list col-md-12">
                                        <label for="pet_list">Choose your pet from pet list</label>
                                        <select id="petList" name="pet_list[]" class="multipleSelect form-control" multiple>
                                        <?php if($my_pets){ 
                                            foreach($my_pets as $pets){ extract($pets); ?>
                                            <?php if($cb){ ?>
                                                <?php if(in_array($pet_id, $pl)){ ?>
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
                                    <div class="col-md-12">
                                        <label for="message">Short Message:</label>
                                        <textarea id="message" name="message" class="form-control" cols="20" rows="3" placeholder="Write a message..."><?=($cb) ? $cb['message'] : '';?></textarea>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <button type="button" class="btn bg-blue text-white col-md-12" onclick="checkDateTime(<?=($cb) ? 2 : 1;?>)"><i class="fa fa-check"></i> 
                                            <?=($cb) ? 'Update My Booking' : 'Book '.$getName.' Now';?>
                                        </button>
                                        <?php if($cb){ ?>
                                            <button type="button" class="btn bg-orange text-white col-md-12 m-t-10" onclick="cancelBook(<?=($cb['book_id']);?>, 2)"><i class="fa fa-times"></i> 
                                                Cancel Booking
                                            </button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    <?php } else { ?>
                        <?php $date_from = '';
                              $date_to = '';  
                              $get_date_to = ''; ?>
                        <div class="col-md-6">
                            <p class="f-20 b-700 text-orange-d m-b-0">Book and Contact User</p>
                            <div class="alert alert-warning m-t-20 f-15">
                                <strong><i class="fa fa-times"></i> Unavailable!</strong> User has no available date to contact.
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-6">
                        <p class="f-20 b-700 text-orange-d m-b-0"><?=$getName;?>'s Availability</p>
                        <input type="hidden" id="a_date_from" value="<?=$date_from;?>">
                        <input type="hidden" id="a_date_to" value="<?=$date_to;?>">
                        <div class="m-t-20" id='availability'></div>
                    </div>
                </div>
            </div>
          <?php } ?>
          <!-- Close Main Content -->
	  </div>
    </section>
    <!-- modal -->
    <div class="modal fade" id="selPics" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-image"></i> User's images</p>
                </div>
                <div class="modal-body">
                        <div class="row">
                               <?php if($user_images){?>
                                    <?php foreach($user_images as $user_img){ extract($user_img);?>
                                        <div class="col-md-3 resfx">
                                            <div class="thumbnail">
                                                <a href="javascript:;">
                                                    <div class="gal-img">
                                                        <img src="<?=base_url();?>assets/img/pictures/usr<?=$user_id?>/<?=$img_name;?>" class="zoomable"style="width:100%" alt="Picture">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php }?>
                                <?php } else{?>
                                    <h1>You don't have user's Images</h1>
                                <?php }?>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>

    <!-- Footer -->
    <?php $this->load->view('mail/pop-ups/inst_msg');?>
    <?php $this->load->view('common/footer');?>
    
  
    <script src="<?=base_url();?>assets/js/initializations/init_vbb.js"></script>
  </body>

</html>
