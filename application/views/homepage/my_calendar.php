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
                    <div class="m-header bg-orange-l">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="btn btn-circle f-20 btn-sm text-white pull-left"> My Calendar</span>
                            </div>
                        </div>
                    </div>
                    <!-- My Booking Request Summary -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cus-card">
                                <div class="row">
                                    <div class="cus-card-header col-md-12">
                                        <p class="f-12 m-b-0">dsdsad</p>
                                        <i class="fa fa-calendar-alt"></i> All User Schedules based on radius
                                    </div>
                                </div>
                                
                                <div class="cus-card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="dCalendar"></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div> <!-- Close Main Content -->
            </div>
        </section>
    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
    <script src="<?=base_url();?>assets/js/initializations/init_dashboard.js"></script>
  </body>

</html>
