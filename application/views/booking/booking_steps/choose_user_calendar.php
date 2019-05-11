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
                <?php $book_type = $this->uri->segment(3); ?> 
                <div class="pic-head bg-greyish">                
                    <div class="row">
                        <div class="col-md-12 text-black">
                            <i class="fa fa-book f-25 text-blue "></i> Booking: Become a <?=($book_type==1)?'guest':'host';?>
                        </div>
                        <div class="col-md-12 m-t-10">
                            <a href="<?=base_url();?>booking/become_a_host" class="p-nav b-700 f-14 <?=($book_type==2)?'active':'';?>">Become a Host</a>
                            <a href="<?=base_url();?>booking/become_a_guest" class="p-nav b-700 f-14 <?=($book_type==1)?'active':'';?>">Become a Guest</a>
                            <a href="<?=base_url();?>booking/booking_history/1" class="btn bg-orange btn-xs pull-right text-white"><i class="fa fa-history"></i> Booking History</a>
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
                                    <input type="hidden" id="isAvail" value="<?=$bio[0]['isAvail'];?>">
                                    <input type="hidden" id="book_type" value="<?=$book_type;?>">
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
