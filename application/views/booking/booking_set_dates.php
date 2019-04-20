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
    <section class="content font-baloo">
      <!-- 2nd Navbar -->
		<?php $this->load->view('common/profile-nav');?>

		<div class="row m-t-10">
			<!-- Left Navbar -->
			<?php $this->load->view('common/left-nav');?>
			<?php foreach($view_bio as $bio){ extract($bio); ?>
                <!-- Main Content -->
                <div class="col-md-9 m-t-10 p-l-0">
                    <?php $bPage = $this->uri->segment(3); ?> 
                    <?php $cntMgb = $this->Booking_model->count_mgb(); $cntba = $this->Booking_model->count_ba();?>
                    <div class="pic-head bg-greyish">                
                        <div class="row">
                            <div class="col-md-12 text-black">
                                <i class="fa fa-book f-25 text-blue "></i> Booking List
                            </div>
                            <div class="col-md-12 m-t-10">
                                <a href="<?=base_url();?>booking/booking_list/1" class="p-nav b-700 f-14 <?=($bPage==1) ? 'active' : '';?>">My Request
                                <?php if($cntba!=0){ ?> 
                                    <span class="badge badge-info"><?=$cntba;?></span>
                                <?php } ?>
                                </a>
                                <a href="<?=base_url();?>booking/booking_list/2" class="p-nav b-700 f-14 <?=($bPage==2) ? 'active' : '';?>">People Request
                                <?php if($cntMgb!=0){ ?> 
                                    <span class="badge badge-danger"><?=$cntMgb;?></span>
                                <?php } ?>
                                </a>
                                <a href="<?=base_url();?>booking/booking_set_dates" class="p-nav b-700 f-14 <?=($is_page=='booking_set_dates') ? 'active' : '';?>">Set My Dates
                                </a>
                                <a href="javascript:;" class="btn bg-orange btn-xs pull-right text-white" data-toggle="modal" data-target="#booking_modal"><i class="fa fa-search"></i> Find a home</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="cus-card">
                                        <div class="cus-card-header">
                                            <i class="fa fa-calendar-alt"></i> Become a Host <i class="fa fa-question-circle pull-right m-t-5 text-info" data-container="body" data-toggle="popover" data-placement="left" title="If you want to become a sitter and watch other pets, you need to set your available time here. If you don't set your available time, other people won't find or search you."></i>
                                            <p class="f-12 m-b-0" style="line-height: 15px;">Set your time availability as a sitter.Click the tip button for more info.</p>
                                        </div>
                                        <div class="cus-card-body">
                                            <form onchange="$('.setTimeMsg2').html('');" id="setTimeForm">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="cus-card">
                                        <div class="cus-card-header">
                                            <i class="fa fa-calendar-alt"></i> Become a Guest <i class="fa fa-question-circle pull-right m-t-5 text-info" data-container="body" data-toggle="popover" data-placement="left" title="If you have no time looking for a sitter for your pets, you can set a time when your pets need to be sit and let the sitter find and book your beloved pets."></i>
                                            <p class="f-12 m-b-0" style="line-height: 15px;">Set your pet's time availability here if you need a sitter. Click the tip button for more info.</p>
                                        </div>
                                        <div class="cus-card-body">
                                            <form class="m-t-20" onchange="$('.setTimeMsg2').html('');" id="nsForm">
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
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="cus-card">
                                <div class="row">
                                    <div class="cus-card-header col-md-12">
                                        <i class="fa fa-calendar-alt"></i> My Calendar Dates <i class="fa fa-question-circle pull-right m-t-5 text-info" data-container="body" data-toggle="popover" data-placement="left" title="This calendar will display your schedules. There is a legend color below to easy determined what type of color is this all about. The calendar will show your time availability as a sitter and your pet schedules where you want a sitter to watch your pets. The calendar also displays the current date."></i>
                                    </div>
                                    <div class="cus-card-body">
                                        <p class="f-15 m-b-0 text-center m-t-20">
                                            <span class="avIcon bg-skyblue"></span> Become a Host 
                                            <span class="avIcon bg-orange"></span> Become a Guest
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
                        </div>
                    </div>
                    
                </div>
                <!-- Close Main Content -->
            <?php } ?>
		</div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('booking/booking_modal');?>
    <?php $this->load->view('booking/booking_info');?>
    <?php $this->load->view('common/footer');?>
    <?php $this->load->view('mail/pop-ups/inst_msg');?>
    <script src="<?=base_url();?>assets/js/initializations/init_vb.js"></script>
  </body>

</html>
