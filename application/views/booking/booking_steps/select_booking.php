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
                            <i class="fa fa-book f-25 text-blue "></i> Booking: Select booking type
                        </div>
                        <div class="col-md-12 m-t-10">
                            <a href="<?=base_url();?>booking/booking_as_host" class="p-nav b-700 f-14 active">Book Now</a>
                            <a href="<?=base_url();?>booking/booking_history/1" class="p-nav b-700 f-14">Booking History</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                        <div class="col-md-12 text-center m-t-10">
                            <p class="text-blue f-30">What do you like to become?</p>
                        </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="cus-card text-center">
                                    <div class="cus-card-header">
                                        <p class="f-30 m-b-0"><i class="fa fa-paw"></i> Become a Guest  </p>
                                    </div>
                                    <div class="cus-card-body">
                                        <p class="f-20 text-blue">I want somebody to watch my pets</p>
                                        <a href="<?=base_url();?>booking/become_a_guest" class="btn bg-orange text-white"><i class="fa fa-check"></i> I want to become a guest</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="cus-card text-center">
                                    <div class="cus-card-header">
                                        <p class="f-30 m-b-0" ><i class="fa fa-user"></i> Become a Host  </p>
                                    </div>
                                    <div class="cus-card-body">
                                        <p class="f-20 text-blue">I want to watch someone's pets</p>
                                        <a href="<?=base_url();?>booking/become_a_host" class="btn bg-orange text-white"><i class="fa fa-check"></i> I want to become a host</a>
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
