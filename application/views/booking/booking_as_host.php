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
                        
                            <a href="<?=base_url();?>booking/booking_set_dates" class="p-nav b-700 f-14 <?=($is_page=='booking_as_host') ? 'active' : '';?>">Become a Host</a>
                            <a href="<?=base_url();?>booking/booking_set_dates" class="p-nav b-700 f-14 <?=($is_page=='booking_as_guest') ? 'active' : '';?>">Become a Guest</a>
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
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cus-card">
                                    <div class="cus-card-header">
                                        <i class="fa fa-calendar-alt"></i> Become a Host <i class="fa fa-question-circle pull-right m-t-5 text-info" data-container="body" data-toggle="popover" data-placement="left" title="If you want to become a host and watch other pets, you need to set your available time here. If you don't set your available time, other people won't find or search you."></i>
                                        <p class="f-12 m-b-0" style="line-height: 15px;">Post your available dates here to be able to watch someone's pet.</p>
                                    </div>
                                    <div class="cus-card-body">
                                        <form onchange="$('.setTimeMsg2').html('');" id="setTimeForm">
                                            <div class="row m-t-10"><div class="col-md-12 setTimeMsg"></div></div>
                                            <?php $today = date('Y-m-d'); ?>
                                            <input type="hidden" id="curr_date" value="<?=$today;?>">
                                            <input type="hidden" id="book_type" value="1">
                                            <input type="hidden" id="isAvail" value="<?=$bio[0]['isAvail'];?>">
                                            <div class="row m-t-10">
                                                <div class="col-md-7">
                                                    <label for="book_avail_from">Date From: </label>
                                                    <input type="date" class="form-control" name="book_avail_from" id="book_avail_from" value="<?=$bio[0]['book_avail_from'] ? date('Y-m-d', strtotime($bio[0]['book_avail_from'])) : '';?>">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="book_time_from">Time From: </label>
                                                    <input type="time" class="form-control" name="book_time_from" id="book_time_from" value="<?=$bio[0]['book_avail_from'] ? date('H:i', strtotime($bio[0]['book_avail_from'])) : '';?>">
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <div class="col-md-7">
                                                    <label for="book_avail_to">Date To: </label>
                                                    <input type="date" class="form-control" name="book_avail_to" id="book_avail_to" value="<?=$bio[0]['book_avail_to'] ? date('Y-m-d', strtotime($bio[0]['book_avail_to'])) : '';?>">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="book_time_to">Time To: </label>
                                                    <input type="time" class="form-control" name="book_time_to" id="book_time_to" value="<?=$bio[0]['book_avail_to'] ? date('H:i', strtotime($bio[0]['book_avail_to'])) : '';?>">
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <div class="col-md-12 m-t-10">
                                                    <label for="pet_cat" class="f-15">What kind of pet do you like?</label><br />
                                                    <?php $cat_list = ($bio[0]['cat_list']) ? json_decode($bio[0]['cat_list']) : []; ?>
                                                    <select name="pet_cat[]" class="multipleSelect form-control petCat" multiple id="pet_cat_list">
                                                        <?php foreach($categories as $cat){ extract($cat); ?>
                                                            <option value="<?=$cat_id;?>" <?=in_array($cat_id, $cat_list) ? 'selected' : '';?>><?=($cat_name) ? $cat_name : "No Name";?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 m-t-10">
                                                    <label for="book_note">Note/Remarks: </label>
                                                    <textarea class="form-control" name="book_note" id="book_note" cols="30" rows="3" placeholder="Additional Notes.."><?=$bio[0]['book_note'];?></textarea>
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <div class="col-md-12 text-center">
                                                    <button type="button" onclick="checkDateTime()" class="btn btn-success"><i class="fa fa-check"></i> Save Dates</button>
                                                    <?php if($bio[0]['isAvail']){?>
                                                        <button type="button" onclick="unsetDates(1)" class="btn btn-info"><i class="fa fa-history"></i> Unset Dates</button>
                                                    <?php } ?>
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
                                    <i class="fa fa-calendar-alt"></i> Scheduled Dates <i class="fa fa-question-circle pull-right m-t-5 text-info" data-container="body" data-toggle="popover" data-placement="left" title="Scheduled Dates"></i>
                                </div>
                                <div class="cus-card-body">
                                    <p class="f-15 m-b-0 m-t-20 text-center">
                                        <span class="avIcon bg-orange"></span> Host 
                                        <span class="avIcon bg-skyblue"></span> Guest 
                                        <span class="avIcon bg-yellow-l"></span> Today
                                    </p>
                                    <div class="m-t-20" id='users_calendar'></div>
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
    <?php $this->load->view('booking/booking_modal');?>
    <?php $this->load->view('booking/booking_info');?>
    <?php $this->load->view('common/footer');?>
    <?php $this->load->view('mail/pop-ups/inst_msg');?>

    <script src="<?=base_url();?>assets/js/initializations/init_vb.js"></script>
  </body>

</html>
