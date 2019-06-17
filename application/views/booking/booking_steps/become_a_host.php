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
                <div class="pic-head bg-greyish">                
                    <div class="row">
                        <div class="col-md-12 text-black">
                            <i class="fa fa-book f-25 text-blue "></i> Booking
                        </div>
                        <div class="col-md-12 m-t-10">
                            <a href="<?=base_url();?>booking/become_a_host" class="p-nav b-700 f-14 active">Become a Host</a>
                            <a href="<?=base_url();?>booking/become_a_guest" class="p-nav b-700 f-14">Become a Guest</a>
                            <a href="<?=base_url();?>booking/booking_history/1" class="btn bg-orange btn-xs pull-right text-white"><i class="fa fa-history"></i> Booking History</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cus-card">
                                    <div class="cus-card-header">
                                        <i class="fa fa-calendar-alt"></i> Become a Host: Set your dates 
                                        <p class="f-12 m-b-0" style="line-height: 15px;">Enter your available or desired dates as a host. Fill up all fields below and click Save Dates.</p>
                                    </div>
                                    <div class="cus-card-body">
                                        <form id="bec_host_form" onchange="$('.setTimeMsg').html('');">
                                            <div class="row m-t-10"><div class="col-md-12 setTimeMsg"></div></div>
                                            <?php $today = date('Y-m-d'); ?>
                                            <input type="hidden" id="curr_date" name="curr_date" value="<?=$today;?>">
                                            <input type="hidden" id="book_type" name="book_type" value="1">
                                            <div class="form-group row">
                                                <input id="user_lat" name="user_lat" type="hidden" value="<?=$d['avail_user_lat'] ? $d['avail_user_lat'] : '';?>">
                                                <input id="user_lng" name="user_lng" type="hidden" value="<?=$d['avail_user_lng'] ? $d['avail_user_lng'] : '';?>">
                                                <div class="col-md-12">
                                                    <label for="" class="m-b-0">Enter your location here <span class="text-danger">*</span></label>
                                                    <input id="complete_address" name="complete_address" type="text" class="form-control" placeholder="Enter your address here.." value="<?=$d['avail_address'] ? $d['avail_address'] : '';?>" required>
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <?php $hr = ($d['avail_hrs']) ? json_decode($d['avail_hrs']) : [] ?>
                                                <div class="col-md-7">
                                                    <label for="book_avail_from">Date From: </label>
                                                    <input type="date" class="form-control" name="book_avail_from" id="book_avail_from" value="<?=$d['avail_date_from'] ? date('Y-m-d', strtotime($d['avail_date_from'])) : '';?>">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="book_time_from">Time From: </label>
                                                    <input type="time" class="form-control" name="book_time_from" id="book_time_from" value="<?=$hr ? $hr[0] : '';?>">
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <div class="col-md-7">
                                                    <label for="book_avail_to">Date To: </label>
                                                    <input type="date" class="form-control" name="book_avail_to" id="book_avail_to" value="<?=$d['avail_date_to'] ? date('Y-m-d', strtotime($d['avail_date_to'])) : '';?>">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="book_time_to">Time To: </label>
                                                    <input type="time" class="form-control" name="book_time_to" id="book_time_to" value="<?=$hr ? $hr[1] : '';?>">
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <div class="col-md-12 m-t-10">
                                                    <label for="pet_cat_list" class="f-15">What kind of pet do you like?</label><br />
                                                    <?php $cat_list = ($d['petcat_list']) ? json_decode($d['petcat_list']) : []; ?>
                                                    <select name="pet_cat_list[]" class="multipleSelect form-control petCat" multiple id="pet_cat_list">
                                                        <?php foreach($categories as $cat){ extract($cat); ?>
                                                            <option value="<?=$cat_id;?>" <?=in_array($cat_id, $cat_list) ? 'selected' : '';?>><?=($cat_name) ? $cat_name : "No Name";?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 m-t-10">
                                                    <label for="book_note">Note/Remarks: </label>
                                                    <textarea class="form-control" name="book_note" id="book_note" cols="30" rows="3" placeholder="Additional Notes.."><?=$d['book_note'];?></textarea>
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <div class="col-md-12 text-center">
                                                    <button type="button" onclick="checkDateTime(2)" class="btn btn-success"><i class="fa fa-check"></i> Save and Next</button>
                                                    <?php if($d['avail_id']){?>
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
                </div>
                
            </div>
            <!-- Close Main Content -->
		</div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
    <script src="<?=base_url();?>assets/js/initializations/init_booking_validations.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKmCY9-diuULK1hyHnDkElDSPT6mbfB7w&libraries=places" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/js/initializations/init_prof_add.js"></script>
  </body>

</html>
