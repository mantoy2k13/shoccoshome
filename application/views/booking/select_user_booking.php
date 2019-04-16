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
                        <span class="btn btn-circle f-20 btn-sm text-white pull-left"> People near you..</span>
                        <a href="javascript:;" data-placement="left" data-toggle="tooltip" title="Book Now" class="text-white pull-right icon-btn">
                            <span data-toggle="modal" data-target="#booking_modal"><i class="fa fa-search fa-2x"></i></span>
                        </a>
                    </div>
                </div>
            </div>
			
            <?php $uid = $this->session->userdata('user_id');?>
                <?php if($get_avail_users){?>
                    <div class="row f-list-wrap">
                        <?php foreach($get_avail_users as $res){ extract($res); ?>
                            <?php $cb = $this->Booking_model->check_booking($uid, $id); ?>
                            <div class="col-md-6">
                                <div class="card bg-grey friend-card">
                                    <div class="card-body">
                                        <div class="friend-img">
                                            <?php if($user_img) { ?>
                                                <img src="<?=base_url();?>assets/img/pictures/usr<?=$id;?>/<?=$user_img;?>" alt="Profile Image">
                                            <?php }else{ ?>
                                                <img src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image">
                                            <?php } ?>
                                        </div>
                                        
                                        <?php if($this->Friends_model->check_if_friends($id)){ ?>
                                            <div class="options<?=$id;?>">
                                                <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i>  Friends</span>
                                                <div class="dropdown-menu" aria-labelledby="f-menu">
                                                    <a onclick="request_friends(<?=$id;?>,3,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Unfriend</a>
                                                    <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$id?>">View Profile</a>
                                                    <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                </div>
                                            </div>
                                        <?php } else {?>
                                            <?php if($this->Friends_model->check_friend_request($id)){ ?>
                                                <div class="options<?=$id;?>">
                                                    <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i>  Request Sent</span>
                                                    <div class="dropdown-menu" aria-labelledby="f-menu">
                                                        <a onclick="request_friends(<?=$id;?>,2,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Remove Request</a>
                                                        <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$id?>">View Profile</a>
                                                        <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                    </div>
                                                </div>
                                            <?php } else {?>
                                                <div class="options<?=$id;?>">
                                                    <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Add friend</span>
                                                    <div class="dropdown-menu" aria-labelledby="f-menu">
                                                        <a onclick="request_friends(<?=$id;?>,1,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Add Friend</a>
                                                        <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$id?>">View Profile</a>
                                                        <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                        <p class="text-head"><a href="<?=base_url();?>account/view_bio/<?=$id?>"><?=($fullname) ? $fullname : "No Name";?></a> </p>
                                        <p class="text-desc"><?=($complete_address&&$zip_code) ? $complete_address.', '.$zip_code : 'No Address'; ?></p>
                                        <p class="f-14">Email: <span class="b-700 text-black"><?=$email;?></span></p>
                                        <p class="m-b-0">
                                            <a href="<?=base_url();?>booking/book_this_user/<?=$id?>" target="_blank" class="btn bg-orange btn-round dropdown-toggle text-white">
                                                Book User
                                            </a>
                                            <?=($cb) ? '<span class="badge badge-danger f-12 pull-right m-t-5"><i class="fa fa-check"></i> Waiting for approval</span>' : ''; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>  
                        <?php } ?>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-md-12">
                            <nav class="text-center">
                                <?=$links;?>
                            </nav>
                        </div>
                    </div>
                <?php } else{ ?>
                    <div class="row">
                        <div class="col-md-12 f-list-wrap">
                            <div class="alert alert-info f-15">
                                <strong><i class="fa fa-check"></i> Empty!</strong> No users found base on your zip code <i>"<?=$zipcode; ?>"</i></i>.
                            </div>
                        </div>
                    </div>
                <?php } ?>
            
          </div>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('booking/booking_modal');?>
    <?php $this->load->view('mail/pop-ups/inst_msg');?>
    <?php $this->load->view('common/footer');?>

  </body>

</html>
