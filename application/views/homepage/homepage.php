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
                                <span class="btn btn-circle f-20 btn-sm text-white pull-left"> Dashboard</span>
                            </div>
                        </div>
                    </div>
                    <!-- My Booking Request Summary -->
                    <?php $uid = $this->session->userdata('user_id');?>
                    <?php $mbr = $this->Booking_model->booking_history($uid, 1); 
                        $mgb = $this->Booking_model->booking_history($uid, 2);
                        $cntAllMbr = count($mbr); $cntAllMgb = count($mgb);
                        $cntMbrComp=0; $cntMbrApp=0; $cntMbrNA=0; $cntMbrCanc=0; $cntMbrAw=0; 
                        $cntMgbComp=0; $cntMgbApp=0; $cntMgbNA=0; $cntMgbCanc=0; $cntMgbAw=0; 
                        foreach($mbr as $Mbr){ 
                            if($Mbr['book_status']==1) $cntMbrAw+=1;
                            if($Mbr['book_status']==2) $cntMbrCanc+=1;
                            if($Mbr['book_status']==3) $cntMbrNA+=1;
                            if($Mbr['book_status']==4) $cntMbrApp+=1;
                            if($Mbr['book_status']==5) $cntMbrComp+=1;
                        }

                        foreach($mgb as $Mgb){ 
                            if($Mgb['book_status']==1) $cntMgbAw+=1;
                            if($Mgb['book_status']==2) $cntMgbCanc+=1;
                            if($Mgb['book_status']==3) $cntMgbNA+=1;
                            if($Mgb['book_status']==4) $cntMgbApp+=1;
                            if($Mgb['book_status']==5) $cntMgbComp+=1;
                        }
                    ?>
                   
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
                                                <p><?=$cntMbrComp;?> Completed</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-info"><i class="fa fa-thumbs-up"></i></span> 
                                                <p><?=$cntMbrApp;?> Approved</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-danger"><i class="fa fa-thumbs-down"></i></span> 
                                                <p><?=$cntMbrNA;?> Not Approved</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-danger"><i class="fa fa-times"></i></span> 
                                                <p><?=$cntMbrCanc;?> Cancelled</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-warning"><i class="fa fa-history"></i></span> 
                                                <p><?=$cntMbrAw;?> Awaiting</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-success"><i class="fa fa-list"></i></span> 
                                                <p><?=$cntAllMbr;?> Overall</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="<?=base_url()?>booking/booking_history/1" class="btn bg-orange text-white col-md-12">View Request Table</a>
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
                                                <p><?=$cntMgbComp;?> Completed</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-info"><i class="fa fa-thumbs-up"></i></span> 
                                                <p><?=$cntMgbApp;?> Approved</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-danger"><i class="fa fa-thumbs-down"></i></span> 
                                                <p><?=$cntMgbNA;?> Not Approved</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-danger"><i class="fa fa-times"></i></span> 
                                                <p><?=$cntMgbCanc;?> Cancelled</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-warning"><i class="fa fa-history"></i></span> 
                                                <p><?=$cntMgbAw;?> Pending</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="p-card">
                                                <span class="text-success"><i class="fa fa-list"></i></span> 
                                                <p><?=$cntAllMgb;?> Overall</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="<?=base_url()?>booking/booking_history/2" class="btn bg-orange text-white col-md-12">View Guest Table</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cus-card">
                                <div class="row">
                                    <div class="cus-card-header col-md-12">
                                        <i class="fa fa-calendar-alt"></i> Calendar Schedule <a href="<?=base_url();?>booking/booking_set_dates" class="btn btn-sm text-white bg-orange pull-right"><i class="fa fa-edit"></i> Update Date</a>
                                    </div>
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
