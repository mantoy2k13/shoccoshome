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
                        <div class="cus-card">
                            <div class="row">
                                <div class="cus-card-header col-md-12">
                                    <i class="fa fa-calendar-alt"></i> Step 2: Choose a user to contact <i class="fa fa-question-circle pull-right m-t-5 text-info" data-container="body" data-toggle="popover" data-placement="left" title="Click the user on the calendar to view their information. Click the calendar number date to expand and view more users."></i>
                                    <p class="f-12 m-b-0" style="line-height: 15px;">Click the user on the calendar to view their information. Click the calendar number date to expand and view more users.</p>
                                </div>
                                <div class="cus-card-body">
                                    <p class="f-15 m-b-0 text-center">
                                        <span class="avIcon bg-orange"></span> Guest
                                        <span class="avIcon bg-native-blue"></span> Host
                                        <span class="avIcon bg-yellow-l"></span> Today
                                    </p>
                                    <input type="hidden" id="isAvail" value="<?=$bio[0]['isAvail'];?>">
                                    <input type="hidden" name="book_avail_from" id="book_avail_from" value="<?=$bio[0]['book_avail_from'] ? date('Y-m-d', strtotime($bio[0]['book_avail_from'])) : '';?>">
                                    <input type="hidden" name="book_avail_to" id="book_avail_to" value="<?=$bio[0]['book_avail_to'] ? date('Y-m-d', strtotime($bio[0]['book_avail_to'])) : '';?>">
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
    <?php $this->load->view('booking/booking_steps/booking_info');?>
    <?php $this->load->view('common/footer');?>
    <script src="<?=base_url();?>assets/js/initializations/init_booking_calendar.js"></script>
  </body>

</html>
