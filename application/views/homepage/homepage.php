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
        <section class="content">
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
                                <span class="btn btn-circle f-20 btn-sm text-white pull-left"> Dashboard</span>
                            </div>
                        </div>
                    </div>
                    <?php $today = date('Y-m-d'); if($view_bio[0]['sitter_availability']){ 
                            $aDate = json_decode($view_bio[0]['sitter_availability']);
                            $date_from = ($aDate[0] < $today) ? $today : $aDate[0];
                            $date_to = date('Y-m-d', strtotime($aDate[1] . ' +1 day'));
                        } else{ $date_from = '';$date_to = ''; } 

                        if($get_my_pets_to_sit){ 
                            $ndf = json_decode($get_my_pets_to_sit[0]['ns_date_from']);  
                            $ndt = json_decode($get_my_pets_to_sit[0]['ns_date_to']);
                            $date_from2 = ($ndf[0] < $today) ? $today : $ndf[0]; 
                            $date_to2 = date('Y-m-d', strtotime($ndt[0] . ' +1 day')); 
                        } else{ $date_from2 = ''; $date_to2 = ''; } ?>

                    <input type="hidden" id="a_date_from" value="<?=$date_from;?>">
                    <input type="hidden" id="a_date_to" value="<?=$date_to;?>">
                    <input type="hidden" id="pDate_from" value="<?=$date_from2;?>">
                    <input type="hidden" id="pDate_to" value="<?=$date_to2;?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="cus-card">
                                <div class="cus-card-header">
                                    <i class="fa fa-history"></i> My Booking Request Summary
                                </div>
                                <div class="cus-card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-success"><i class="fa fa-check"></i></span> 
                                                <p>3 Completed</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-info"><i class="fa fa-thumbs-up"></i></span> 
                                                <p>3 Approved</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-danger"><i class="fa fa-thumbs-down"></i></span> 
                                                <p>3 Not Approved</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-danger"><i class="fa fa-times"></i></span> 
                                                <p>3 Cancelled</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-warning"><i class="fa fa-history"></i></span> 
                                                <p>3 Awaiting</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-success"><i class="fa fa-list"></i></span> 
                                                <p>3 Overall</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="<?=base_url()?>booking/booking_list/1" class="btn bg-orange text-white col-md-12">View Request Table</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cus-card">
                                <div class="cus-card-header">
                                    <i class="fa fa-users"></i> Guest Request Summary
                                </div>
                                <div class="cus-card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-success"><i class="fa fa-check"></i></span> 
                                                <p>3 Completed</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-info"><i class="fa fa-thumbs-up"></i></span> 
                                                <p>3 Approved</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-danger"><i class="fa fa-thumbs-down"></i></span> 
                                                <p>3 Not Approved</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-danger"><i class="fa fa-times"></i></span> 
                                                <p>3 Cancelled</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-warning"><i class="fa fa-history"></i></span> 
                                                <p>3 Awaiting</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-success"><i class="fa fa-list"></i></span> 
                                                <p>3 Overall</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="<?=base_url()?>booking/booking_list/2" class="btn bg-orange text-white col-md-12">View Guest Table</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cus-card">
                                <div class="cus-card-header">
                                    <i class="fa fa-calendar-alt"></i> Calendar Schedule <a href="<?=base_url();?>account/bio" class="btn btn-sm text-white bg-orange pull-right"><i class="fa fa-edit"></i> Update Date</a>
                                </div>
                                <div class="cus-card-body">
                                    <div class="row">
                                        <div id="dCalendar"></div>
                                    </div>
                                    <p class="f-15 m-b-0 text-center m-t-20">
                                        <span class="avIcon bg-skyblue"></span> Available 
                                        <span class="avIcon bg-orange"></span> Need Sitter
                                        <span class="avIcon bg-yellow-l"></span> Today
                                    </p>
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
