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
                            <a href="<?=base_url();?>booking/become_a_host" class="p-nav b-700 f-14">Become a Host</a>
                            <a href="<?=base_url();?>booking/become_a_guest" class="p-nav b-700 f-14 active">Become a Guest</a>
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
                                        <i class="fa fa-calendar-alt"></i> Become a Guest: Set your dates  <i class="fa fa-question-circle pull-right m-t-5 text-info" data-container="body" data-toggle="popover" data-placement="left" title="Enter your available or desired dates as a guest. Fill up all fields below and click Save Dates."></i>
                                        <p class="f-12 m-b-0" style="line-height: 15px;">Enter your available or desired dates as a guest. Fill up all fields below and click Save Dates.</p>
                                    </div>
                                    <div class="cus-card-body">
                                        <form id="bec_guest_form" onchange="$('.setTimeMsg').html('');">
                                            <div class="row m-t-10"><div class="col-md-12 setTimeMsg"></div></div>
                                            <?php $today = date('Y-m-d'); ?>
                                            <input type="hidden" id="curr_date" name="curr_date" value="<?=$today;?>">
                                            <input type="hidden" id="book_type" name="book_type" value="2">
                                            <input type="hidden" id="isAvail"   name="isAvail"   value="<?=$bio[0]['isAvail'];?>">
                                            <div class="form-group row">
                                                <input id="user_lat" name="user_lat" type="hidden">
                                                <input id="user_lng" name="user_lng" type="hidden">
                                                <div class="col-md-12">
                                                    <label for="" class="m-b-0">Enter your location here <span class="text-danger">*</span></label>
                                                    <input id="complete_address" name="complete_address" type="text" class="form-control" placeholder="Enter your address here.." required>
                                                </div>
                                            </div>
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
                                                    <label for="pet_list">Choose your pet from your list. <a href="<?=base_url();?>pet/add_new_pet">Click here</a> to add new pets.</label>
                                                    <?php $pet_list = ($bio[0]['cat_list']) ? json_decode($bio[0]['cat_list']) : []; ?>
                                                    <select name="pet_cat_list[]" class="multipleSelect form-control petList" multiple required id="pet_cat_list">
                                                        <?php if($my_pets){ foreach($my_pets as $pets){ extract($pets); ?>
                                                            <option value="<?=$pet_id;?>" <?=in_array($pet_id, $pet_list) ? 'selected' : '';?>><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                                        <?php } } else { ?>
                                                            <option value="" selected>You have no pets added.</option>
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
                                                    <?php if($my_pets){ ?>
                                                        <button type="button" onclick="checkDateTime(1)" class="btn btn-success"><i class="fa fa-check"></i> Save and Next</button>
                                                    <?php } if($bio[0]['isAvail']){?>
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
