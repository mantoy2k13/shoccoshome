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
                <div class="cus-card">
                    <div class="cus-card-header"><i class="fa fa-history"></i> <?=($bPage==1) ? 'My Request' : 'People Request';?> <p class="f-15 m-b-0">List of your bookings below</p></div>
                    <div class="cus-card-body">
                        <div class="table-resp-custom m-t-10">
                            <table class="table table-hover m-t-20" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Book ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($booking_list as $bl){ extract($bl); ?>
                                        <tr>
                                            <td><?=$book_id;?></td>
                                            <td class="text-center">
                                                <a href="<?=base_url();?>account/view_bio/<?=$id?>">
                                                    <div class="profile-img">
                                                        <?php if($user_img) { ?>
                                                            <img src="<?=base_url();?>assets/img/pictures/usr<?=$id;?>/<?=$user_img;?>" alt="Profile Image">
                                                        <?php }else{ ?>
                                                            <img src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image">
                                                        <?php } ?>
                                                    </div>
                                                </a>
                                            </td>
                                            <td><a href="<?=base_url();?>account/view_bio/<?=$id?>" data-toggle="tooltip" data-placement="right" title="<?=$email;?>"><?=($fullname) ? $fullname : "No Name";?></a> </td>
                                            <td class="text-center"><?=($complete_address&&$zip_code) ? $complete_address.', '.$zip_code : 'No Address'; ?></td>
                                            <td class="text-center">
                                                <?=($book_status==1) ? '<span class="badge bg-orange text-white"><i class="fa fa-history"></i> Waiting for approval</span>' : ''; ?>
                                                <?=($book_status==2) ? '<span class="badge badge-danger"><i class="fa fa-times"></i> Cancelled</span>' : ''; ?>
                                                <?=($book_status==3) ? '<span class="badge badge-danger"><i class="fa fa-thumbs-down"></i> Disapproved</span>' : ''; ?>
                                                <?=($book_status==4) ? '<span class="badge badge-info"><i class="fa fa-thumbs-up"></i> Approve</span>' : ''; ?>
                                                <?=($book_status==5) ? '<span class="badge badge-success"><i class="fa fa-check"></i> Completed</span>' : ''; ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-info"><?=$this->Account_model->relative_date(strtotime($book_date));?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="btn bg-blue-a btn-xs text-white dropdown-toggle" id="option-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options </span>
                                                <div class="dropdown-menu option-menu" aria-labelledby="option-menu">
                                                    <?php if($bPage==1){ ?>
                                                        <?php if($book_status==1){ ?>
                                                            <a onclick="bookAppr(<?=$book_id;?>,2)" class="dropdown-item" href="javascript:;">Cancel Booking</a>
                                                            <a onclick="editBookingInfo(<?=$book_id;?>, '<?=$user_type;?>')" class="dropdown-item" href="javascript:;">Edit Info</a>
                                                        <?php } ?>
                                                        <?php if($book_status==4){ ?>
                                                            <a onclick="bookAppr(<?=$book_id;?>,5)" class="dropdown-item" href="javascript:;">Complete Booking</a>
                                                            <a onclick="editBookingInfo(<?=$book_id;?>, '<?=$user_type;?>')" class="dropdown-item" href="javascript:;">Edit Info</a>
                                                        <?php } ?>
                                                    <?php } else{ ?>
                                                        <?php if($book_status==1){ ?>
                                                            <input type="hidden" id="userID" value="<?=$id;?>">
                                                            <input type="hidden" id="userEmail" value="<?=$email;?>">
                                                            <a onclick="bookAppr(<?=$book_id;?>,4,'<?=$user_type;?>')" class="dropdown-item" href="javascript:;">Approve</a>
                                                            <a onclick="bookAppr(<?=$book_id;?>,3,'<?=$user_type;?>')" class="dropdown-item" href="javascript:;">Disapprove</a>
                                                        <?php } ?>
                                                        <?php if($book_status==3){ ?>
                                                            <a onclick="bookAppr(<?=$book_id;?>,1)" class="dropdown-item" href="javascript:;">Mark as pending</a>
                                                        <?php } ?>
                                                        <?php if($book_status==4){ ?>
                                                            <a onclick="bookAppr(<?=$book_id;?>,5)" class="dropdown-item" href="javascript:;">Complete Booking</a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <a onclick="bookingInfo(<?=$book_id;?>,<?=$bPage;?>, <?=$book_status;?>)" class="dropdown-item" href="javascript:;">Booking Info</a>
                                                    <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
    <?php $this->load->view('booking/edit_booking_info');?>
    <?php $this->load->view('common/footer');?>
    <?php $this->load->view('mail/pop-ups/inst_msg');?>
    <script src="<?=base_url();?>assets/js/initializations/init_bl.js"></script>    
  </body>

</html>
