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
                            <i class="fa fa-history f-25 text-blue "></i> Booking History
                        </div>
                        <div class="col-md-12 m-t-10">
                            <a href="<?=base_url();?>booking/booking_history/1" class="p-nav b-700 f-14 <?=($bPage==1) ? 'active' : '';?>">My Requests
                            <?php if($cntba!=0){ ?> 
                                <span class="badge badge-info"><?=$cntba;?></span>
                            <?php } ?>
                            </a>
                            <a href="<?=base_url();?>booking/booking_history/2" class="p-nav b-700 f-14 <?=($bPage==2) ? 'active' : '';?>">Requesters
                            <?php if($cntMgb!=0){ ?> 
                                <span class="badge badge-danger"><?=$cntMgb;?></span>
                            <?php } ?>
                            </a>
                            <a href="<?=base_url();?>booking/select_booking" class="btn bg-orange btn-xs pull-right text-white"><i class="fa fa-phone"></i> Book Now</a>
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
                                        <th>Book ID <?=$is_page;?></th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center" style="width:90px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($booking_history as $bl){ extract($bl); ?>
                                        <tr>
                                            <td><?=$book_id;?></td>
                                            <td class="text-center">
                                                <div class="profile-img">
                                                    <?php $prof_img = ($user_img) ? 'usr'.$id.'/'.$user_img : 'default.png';?>
                                                    <img class="zoomable" src="<?=base_url();?>assets/img/pictures/<?=$prof_img;?>" alt="Profile Image">
                                                </div>
                                            </td>
                                            <td><a href="<?=base_url();?>account/view_bio/<?=$id?>" data-toggle="tooltip" data-placement="right" title="<?=$email;?>"><?=($fullname) ? $fullname : "No Name";?></a> <?=($book_type==1) ? '<span class="badge badge-primary font-san-serif"><i class="fa fa-user"></i> HOST</span>' : '<span class="badge bg-orange text-white font-san-serif"><i class="fa fa-user"></i> GUEST</span>'; ?></td>
                                            <td class="text-center"><?=($complete_address&&$zip_code) ? $complete_address.', '.$zip_code : 'No Address'; ?></td>
                                            <td class="text-center font-san-serif">
                                                <?=($book_status==1) ? '<span class="badge bg-orange text-white"><i class="fa fa-history"></i> Waiting for approval</span>' : ''; ?>
                                                <?=($book_status==2) ? '<span class="badge badge-danger"><i class="fa fa-times"></i> Cancelled</span>' : ''; ?>
                                                <?=($book_status==3) ? '<span class="badge badge-danger"><i class="fa fa-thumbs-down"></i> Disapproved</span>' : ''; ?>
                                                <?=($book_status==4) ? '<span class="badge badge-info"><i class="fa fa-thumbs-up"></i> Approve</span>' : ''; ?>
                                                <?=($book_status==5) ? '<span class="badge badge-success"><i class="fa fa-check"></i> Completed</span>' : ''; ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-info font-san-serif"><?=$this->Account_model->relative_date(strtotime($book_date));?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="btn bg-blue-a btn-xs text-white dropdown-toggle" id="option-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options </span>
                                                <div class="dropdown-menu option-menu" aria-labelledby="option-menu">
                                                    <?php if($bPage==1){ ?>
                                                        <?php if($book_status==1){ ?>
                                                            <a onclick="bookAppr(<?=$book_id;?>,2)" class="dropdown-item" href="javascript:;">Cancel Booking</a>
                                                            <a class="dropdown-item" href="<?=base_url();?>booking/book_user/<?=(($bPage==1) ? 2 : 1).'/'.$id;?>">Edit Info</a>
                                                        <?php } ?>
                                                        <?php if($book_status==4){ ?>
                                                            <a onclick="bookAppr(<?=$book_id;?>,5)" class="dropdown-item" href="javascript:;">Complete Booking</a>
                                                            <a class="dropdown-item" href="<?=base_url();?>booking/book_user/<?=(($bPage==1) ? 2 : 1).'/'.$id;?>">Edit Info</a>
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
                                                    <a href="<?=base_url();?>booking/view_booking_info/<?=$bPage.'/'.$id.'/'.$book_type.'/'.$book_id;?>" target="_blank" class="dropdown-item" >Booking Info</a>
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
    <?php $this->load->view('common/footer');?>
    <?php $this->load->view('mail/pop-ups/inst_msg');?>
    <script src="<?=base_url();?>assets/js/initializations/init_booking_validations.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable( {
                order: [[ 0, 'desc' ]]
            });
        });
    </script>
  </body>

</html>
