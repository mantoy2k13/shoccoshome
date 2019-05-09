<!DOCTYPE html>
<html lang="en">

  <!-- Header CSS -->
  <?php $this->load->view('common/css');?>
  <link href="<?=base_url();?>assets/css/breadcrumbs.css" rel="stylesheet" type="text/css">
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
            <div class="col-md-9 m-t-10 p-l-0">
                <?php $bPage = $this->uri->segment(3); ?> 
                <?php $cntMgb = $this->Booking_model->count_mgb(); $cntba = $this->Booking_model->count_ba();?>
                <div class="pic-head bg-greyish">                
                    <div class="row">
                        <div class="col-md-12 text-black">
                            <i class="fa fa-book f-25 text-blue "></i> Booking
                        </div>
                        <div class="col-md-12 m-t-10">
                            <a href="<?=base_url();?>booking/booking_as_host" class="p-nav b-700 f-14 active">Become a Host</a>
                            <a href="<?=base_url();?>booking/booking_as_guest" class="p-nav b-700 f-14">Become a Guest</a>
                            <a href="<?=base_url();?>booking/booking_list/1" class="btn bg-orange btn-xs pull-right text-white"><i class="fa fa-history"></i> Booking History</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Breadcrumbs -->
                    <?php $this->load->view('booking/booking_steps/breadcrumbs');?>
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="cus-card">
                                    <div class="cus-card-header">
                                        <i class="fa fa-calendar-alt"></i> Step 3: Fill up book form  <i class="fa fa-question-circle pull-right m-t-5 text-info" data-container="body" data-toggle="popover" data-placement="left" title="Enter your available or desired dates as a host. Fill up all fields below and click Save Dates."></i>
                                        <p class="f-12 m-b-0" style="line-height: 15px;">Enter your available or desired dates as a host. Fill up all fields below and click Save Dates.</p>
                                    </div>
                                    <div class="cus-card-body">
                                        <form onchange="$('.setTimeMsg').html('');">
                                            <div class="row m-t-10"><div class="col-md-12 setTimeMsg"></div></div>
                                            <?php $today = date('Y-m-d'); ?>
                                            <input type="hidden" id="curr_date" value="<?=$today;?>">
                                            <div class="row m-t-10">
                                                <div class="col-md-7">
                                                    <label for="book_avail_from">Date From: </label>
                                                    <input type="date" class="form-control" name="book_avail_from" id="book_avail_from" value="">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="book_time_from">Time From: </label>
                                                    <input type="time" class="form-control" name="book_time_from" id="book_time_from" value="">
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <div class="col-md-7">
                                                    <label for="book_avail_to">Date To: </label>
                                                    <input type="date" class="form-control" name="book_avail_to" id="book_avail_to" value="">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="book_time_to">Time To: </label>
                                                    <input type="time" class="form-control" name="book_time_to" id="book_time_to" value="">
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <div class="col-md-12 m-t-10">
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
                                                <div class="col-md-12 m-t-10">
                                                    <label for="book_note">Additional Info: </label>
                                                    <textarea class="form-control" name="book_note" id="book_note" cols="30" rows="3" placeholder="Any message or additional information.."><?=$bio[0]['book_note'];?></textarea>
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <div class="col-md-12 text-center">
                                                    <button type="button" onclick="checkDateTime()" class="btn btn-success"><i class="fa fa-check"></i> Save and Book</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-md-12">
                                <div class="cus-card">
                                    <div class="cus-card-header">
                                        <i class="fa fa-user"></i> User schedule info<i class="fa fa-question-circle pull-right m-t-5 text-info" data-container="body" data-toggle="popover" data-placement="left" title="Schedule of users and it's basic information."></i>
                                        <p class="f-12 m-b-0" style="line-height: 15px;">Schedule of users and it's basic information.</p>
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
                                            <?php $uid = $this->session->userdata('user_id');?>
                                            <?php if($this->Friends_model->check_if_friends($bio[0]['id'])){ ?>
                                                <?php if($uid != $bio[0]['id']){?>
                                                    <div class="options<?=$bio[0]['id'];?>">
                                                        <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i>  Friends</span>
                                                        <div class="dropdown-menu" aria-labelledby="f-menu">
                                                            <a onclick="request_friends(<?=$bio[0]['id'];?>,3,'<?=$bio[0]['email'];?>')" class="dropdown-item" href="javascript:;">Unfriend</a>
                                                            <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$bio[0]['id'];?>">View profile</a>
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
                                                                <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$bio[0]['id'];?>">View profile</a>
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
                                                                <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$bio[0]['id'];?>">View profile</a>
                                                                <a onclick="instMsg(<?=$bio[0]['id'];?>,'<?=$bio[0]['email'];?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
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
                                                <label for="book_avail_from">Date From: </label>
                                                <input type="date" class="form-control" name="book_avail_from" value="<?=$bio[0]['book_avail_from'] ? date('Y-m-d', strtotime($bio[0]['book_avail_from'])) : '';?>" disabled>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="book_time_from">Time From: </label>
                                                <input type="time" class="form-control" name="book_time_from" id="" value="<?=$bio[0]['book_avail_from'] ? date('H:i', strtotime($bio[0]['book_avail_from'])) : '';?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row m-t-10">
                                            <div class="col-md-7">
                                                <label for="book_avail_to">Date To: </label>
                                                <input type="date" class="form-control" name="book_avail_to" id="" value="<?=$bio[0]['book_avail_to'] ? date('Y-m-d', strtotime($bio[0]['book_avail_to'])) : '';?>" disabled>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="book_time_to">Time To: </label>
                                                <input type="time" class="form-control" name="book_time_to" id="" value="<?=$bio[0]['book_avail_to'] ? date('H:i', strtotime($bio[0]['book_avail_to'])) : '';?>" disabled>
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
                                                <textarea class="form-control" name="book_note" id="" cols="30" rows="3" placeholder="Additional Notes.." disabled><?=$bio[0]['book_note'];?></textarea>
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
    <script src="<?=base_url();?>assets/js/initializations/init_vb.js"></script>
  </body>

</html>
