<!DOCTYPE html>
<html lang="en">

  <!-- Header CSS -->
  <?php $this->load->view('common/css');?>
  <link href="<?=base_url();?>assets/css/breadcrumbs.css" rel="stylesheet" type="text/css">
  <body id="page-top">
  <?php $uid = $this->session->userdata('user_id');?>
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
            <div class="col-md-9 m-t-10 p-l-0">
                <?php $book_type = $this->uri->segment(3); ?> 
                <div class="pic-head bg-greyish">                
                    <div class="row">
                        <div class="col-md-12 text-black">
                            <i class="fa fa-book f-25 text-blue "></i> Booking: Become a <?=($book_type==1)?'guest':'host';?>
                        </div>
                        <div class="col-md-12 m-t-10">
                            <input type="hidden" id="book_type" value="<?=$book_type;?>">
                            <a href="<?=base_url();?>booking/become_a_host" class="p-nav b-700 f-14 <?=($book_type==2)?'active':'';?>">Become a Host</a>
                            <a href="<?=base_url();?>booking/become_a_guest" class="p-nav b-700 f-14 <?=($book_type==1)?'active':'';?>">Become a Guest</a>
                            <a href="<?=base_url();?>booking/booking_history/1" class="btn bg-orange btn-xs pull-right text-white"><i class="fa fa-history"></i> Booking History</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="cus-card">
                                    <div class="cus-card-header">
                                        <i class="fa fa-calendar-alt"></i> Step 3: Fill up book form  
                                        <?=($book && $book['book_status']==1) ? '<span class="badge bg-orange text-white font-san-serif pull-right m-t-5 f-12"><i class="fa fa-history"></i> Waiting for approval</span>' : ''; ?>
                                        <?=($book && $book['book_status']==2) ? '<span class="badge badge-danger font-san-serif pull-right m-t-5 f-12"><i class="fa fa-times"></i> Cancelled</span>' : ''; ?>
                                        <?=($book && $book['book_status']==3) ? '<span class="badge badge-danger font-san-serif pull-right m-t-5 f-12"><i class="fa fa-thumbs-down"></i> Disapproved</span>' : ''; ?>
                                        <?=($book && $book['book_status']==4) ? '<span class="badge badge-info font-san-serif pull-right m-t-5 f-12"><i class="fa fa-thumbs-up"></i> Approve</span>' : ''; ?>
                                        <?=($book && $book['book_status']==5) ? '<span class="badge badge-success font-san-serif pull-right m-t-5 f-12"><i class="fa fa-check"></i> Completed</span>' : ''; ?>
                                        <p class="f-12 m-b-0" style="line-height: 15px;">Enter your available dates to book this user. Dates will depend upon the user's available time and date to book in.</p>
                                    </div>
                                    <div class="cus-card-body">
                                        <form onchange="$('.setTimeMsg').html('');">
                                            <div class="row m-t-10"><div class="col-md-12 setTimeMsg"></div></div>
                                            <?php $today = date('Y-m-d'); ?>
                                            <input type="hidden" id="curr_date" value="<?=$today;?>">
                                            <input type="hidden" id="user_type" value="<?=$bio[0]['book_type'];?>">
                                            <input type="hidden" id="book_to" value="<?=$bio[0]['id'] ? $bio[0]['id'] : '';?>">
                                            <div class="row m-t-10">
                                                <div class="col-md-7">
                                                    <label for="book_avail_from">Date From: </label>
                                                    <input type="date" class="form-control" name="book_avail_from" id="book_avail_from" value="<?=$book ? date('Y-m-d', strtotime($book['book_date_from'])) : '';?>">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="book_time_from">Time From: </label>
                                                    <input type="time" class="form-control" name="book_time_from" id="book_time_from" value="<?=$book ? date('H:i', strtotime($book['book_date_from'])) : '';?>">
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <div class="col-md-7">
                                                    <label for="book_avail_to">Date To: </label>
                                                    <input type="date" class="form-control" name="book_avail_to" id="book_avail_to" value="<?=$book ? date('Y-m-d', strtotime($book['book_date_to'])) : '';?>">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="book_time_to">Time To: </label>
                                                    <input type="time" class="form-control" name="book_time_to" id="book_time_to" value="<?=$book ? date('H:i', strtotime($book['book_date_to'])) : '';?>">
                                                </div>
                                            </div>
                                            
                                            <div class="row m-t-10">
                                                <div class="col-md-12 m-t-10">
                                                    <label for="pet_list">Choose pets  <?=($book_type==2)?'you want to watch':'to be watch';?></label>
                                                    <select id="pet_list" name="pet_list[]" class="multipleSelect form-control" multiple>
                                                    <?php if($my_pets){ 
                                                        foreach($my_pets as $pets){ extract($pets); ?>
                                                        <?php if($book){ ?>
                                                            <?php if(in_array($pet_id, json_decode($book['pet_list']))){ ?>
                                                            <option value="<?=$pet_id;?>" selected><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                                            <?php } else{ ?>
                                                                <option value="<?=$pet_id;?>"><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                                            <?php } ?>
                                                        <?php } else{?>
                                                            <option value="<?=$pet_id;?>"><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                                        <?php } ?>
                                                        <?php } } else { ?>
                                                            <option>You have no pets added.</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php if($book_type==2){?>
                                                <div class="row m-t-10">
                                                    <?php if($my_pets){ ?>
                                                        <?php foreach($my_pets as $p){ ?>
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="card bg-grey friend-card">
                                                                    <div class="card-body">
                                                                        <div class="pet-bio-img">
                                                                            <?php $pet_img = $p['primary_pic'] ? 'usr'.$p['user_id'].'/'.$p['primary_pic'] : 'default_pet.png';?>
                                                                            <img class="zoomable" src="<?=base_url();?>assets/img/pictures/<?=$pet_img;?>" alt="Pet Image">
                                                                        </div>
                                                                        <p class="text-blue f-20 b-700">
                                                                            <a href="<?=base_url();?>pet/pet_details/<?=$p['pet_id']?>" title="<?=$p['pet_name'];?>" target="_blank"><?=$p['pet_name'];?></a>
                                                                        </p>
                                                                        <p class="b-700 f-14">Breed: <span class="b-700 text-black"><?=$p['breed_name'];?></span></p>
                                                                        <p class="b-700 f-14">Cat: <span class="b-700 text-black"><?=$p['cat_name'];?></span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } } else { ?>
                                                        <div class="col-md-12">
                                                            <div class="alert alert-info f-15">
                                                                <strong><i class="fa fa-check"></i> Empty!</strong> No pets found. Pet booked history might be deleted or doesn't exist.
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="short_message">Additional Info: </label>
                                                    <textarea class="form-control" name="short_message" id="short_message" cols="30" rows="3" placeholder="Any message or additional information.."><?=$book ? $book['short_message'] : '';?></textarea>
                                                </div>
                                                <div class="col-md-12 m-t-10">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input ai_box" id="verify_check">
                                                        <label class="custom-control-label f-15" for="verify_check"> I have checked and verified above information.</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <div class="col-md-12 text-center">
                                                    <button type="button" onclick="checkBookTime(<?=$book ? $book['book_id'] : '0';?>)" class="btn btn-success"> <?=$book ? '<i class="fa fa-check"></i> Save changes' : '<i class="fa fa-phone"></i> Save and Book '.$bio[0]['fullname'].' Now';?></button>
                                                    <?php if($book){ ?>
                                                        <button type="button" onclick="cancelBooking(<?=$book['book_id'];?>)" class="btn btn-danger"><i class="fa fa-times"></i> Cancel Booking</button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-md-12">
                                <div class="cus-card">
                                    <div class="cus-card-header">
                                        <i class="fa fa-user"></i> User schedule and info
                                        <p class="f-12 m-b-0" style="line-height: 15px;">User available schedule and my basic information.</p>
                                    </div>
                                    <div class="cus-card-body">
                                        <div class="bio-head">
                                            <div class="bio-img">
                                                <?php if($bio[0]['user_img']) { ?>
                                                    <img src="<?=base_url();?>assets/img/pictures/usr<?=$bio[0]['id'];?>/<?=$bio[0]['user_img'];?>" alt="Profile Image">
                                                <?php }else{ ?>
                                                    <img src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image">
                                                <?php } ?>
                                            </div>  
                                            <!-- Check if Friends -->
                                            <?php if($this->Friends_model->check_if_friends($bio[0]['id'])){ ?>
                                                <?php if($uid != $bio[0]['id']){?>
                                                    <div class="options<?=$bio[0]['id'];?>">
                                                        <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i>  Friends</span>
                                                        <div class="dropdown-menu" aria-labelledby="f-menu">
                                                            <a onclick="request_friends(<?=$bio[0]['id'];?>,3,'<?=$bio[0]['email'];?>')" class="dropdown-item" href="javascript:;">Unfriend</a>
                                                            <a target="_blank" class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$bio[0]['id'];?>">View profile</a>
                                                            <a onclick="instMsg(<?=$bio[0]['id'];?>,'<?=$bio[0]['email'];?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } else {?>
                                                <?php if($this->Friends_model->check_friend_request($bio[0]['id'])){ ?>
                                                    <?php if($uid != $bio[0]['id']){?>
                                                        <div class="options<?=$bio[0]['id'];?>">
                                                            <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i>  Request Sent</span>
                                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                                <a onclick="request_friends(<?=$bio[0]['id'];?>,2,'<?=$bio[0]['email'];?>')" class="dropdown-item" href="javascript:;">Remove Request</a>
                                                                <a target="_blank" class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$bio[0]['id'];?>">View profile</a>
                                                                <a onclick="instMsg(<?=$bio[0]['id'];?>,'<?=$bio[0]['email'];?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } else {?>
                                                    <?php if($uid != $bio[0]['id']){?>
                                                        <div class="options<?=$bio[0]['id'];?>">
                                                            <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Add friend</span>
                                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                                <a onclick="request_friends(<?=$bio[0]['id'];?>,1,'<?=$bio[0]['email'];?>')" class="dropdown-item" href="javascript:;">Add Friend</a>
                                                                <a target="_blank" class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$bio[0]['id'];?>">View profile</a>
                                                                <a onclick="instMsg(<?=$bio[0]['id'];?>,'<?=$bio[0]['email'];?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <!-- Close Check if Friends -->
                                            <?php 
                                                if($bio[0]['fullname']){ $getName = $bio[0]['fullname'];}
                                                else{
                                                    $explodeResultArrayname = explode("@", $bio[0]['email']);
                                                    $getName = ucfirst($explodeResultArrayname[0]);
                                                }
                                            ?>
                                            <p class="f-30 b-700 text-orange-d m-b-0"><?=$getName;?></p>
                                            <p class="f-20 b-700 text-blue m-b-0"><?=($bio[0]['occupation'])?$bio[0]['occupation']:'No Occupation';?></p>
                                            <p class="f-15 m-b-0 text-black-l"> <?=($bio[0]['complete_address']&&$bio[0]['zip_code']) ? $bio[0]['complete_address'].', '.$bio[0]['zip_code'] : 'No Address'; ?></p>
                                        </div>
                                        <p class="f-15 text-black-l font-san-serif">
                                            <?=($bio[0]['book_type']==1) ? '<span class="badge badge-primary"><i class="fa fa-user"></i> HOST</span>' : '<span class="badge bg-orange text-white"><i class="fa fa-user"></i> GUEST</span>'; ?>
                                            <?=($bio[0]['is_smoker']==1) ? '<span class="badge badge-danger"><i class="fa fa-ban"></i> Smoker</span>' : '<span class="badge badge-success"><i class="fa fa-check"></i> Non Smoker</span>'; ?>
                                            <span class="badge badge-info">
                                                <i class="fa fa-home"></i> Living in <?=($bio[0]['living_in']==1) ? 'the house' : 'an apartment'; ?>
                                            </span>
                                        </p>
                                        <div class="row m-t-10">
                                            <div class="col-md-7">
                                                <label>Date From: </label>
                                                <input type="date" class="form-control" value="<?=$bio[0]['book_avail_from'] ? date('Y-m-d', strtotime($bio[0]['book_avail_from'])) : '';?>" id="user_date_from" readonly>
                                            </div>
                                            <div class="col-md-5">
                                                <label>Time From: </label>
                                                <input type="time" class="form-control" value="<?=$bio[0]['book_avail_from'] ? date('H:i', strtotime($bio[0]['book_avail_from'])) : '';?>" id="" readonly>
                                            </div>
                                        </div>
                                        <div class="row m-t-10">
                                            <div class="col-md-7">
                                                <label>Date To: </label>
                                                <input type="date" class="form-control" value="<?=$bio[0]['book_avail_to'] ? date('Y-m-d', strtotime($bio[0]['book_avail_to'])) : '';?>" id="user_date_to" readonly>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="book_time_to">Time To: </label>
                                                <input type="time" class="form-control" name="book_time_to" value="<?=$bio[0]['book_avail_to'] ? date('H:i', strtotime($bio[0]['book_avail_to'])) : '';?>" id="" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 m-t-10">
                                                <label for="pet_cat" class="f-15">I can watch this pets:</label><br />
                                                <?php $cats=''; $cat_list = ($bio[0]['cat_list']) ? json_decode($bio[0]['cat_list']) : []; ?>
                                                <?php foreach($categories as $cat){ extract($cat); if(in_array($cat_id, $cat_list)) { $cats.=$cat_name.', '; } }?>
                                                <input type="text" class="form-control" value="<?=$cats;?>" disabled>
                                            </div>
                                            <div class="col-md-12 m-t-10">
                                                <label for="book_note">Note/Remarks: </label>
                                                <textarea class="form-control" cols="30" rows="3" placeholder="Additional Notes.." disabled><?=$bio[0]['book_note'];?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- Close Main Content -->
		</div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
    <script src="<?=base_url();?>assets/js/initializations/init_booking_validations.js"></script>
  </body>

</html>
