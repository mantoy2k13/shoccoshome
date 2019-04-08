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
                        <span class="btn btn-circle f-20 btn-sm text-white pull-left"> Friend Request</span>
                    </div>
                </div>
            </div>
			<div class="row f-list-wrap">
                <?php if($friend_request){ foreach($friend_request as $frnd){ extract($frnd); ?>
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
                                <?php $uid = $this->session->userdata('user_id');?>
                                <?php if($uid != $id){?>
                                    <div class="options<?=$user_id;?>">
                                        <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Options</span>
                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                <a onclick="process_request(<?=$req_id.','.$user_id;?>,1,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Confirm Friend</a>
                                                <a onclick="process_request(<?=$req_id.','.$user_id;?>,2,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Remove Request</a>
                                                <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$id?>">View Profile</a>
                                                <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                            </div>
                                    </div>
                                <?php } ?>
                                <p class="text-head"><a href="<?=base_url();?>account/view_bio/<?=$id?>"><?=($fullname) ? $fullname : "No Name";?></a> </p>
                                <p class="text-desc"><?=($complete_address&&$zip_code) ? $complete_address.', '.$zip_code : 'No Address'; ?></p>
                                <p class="f-14">Email: <span class="b-700 text-black"><?=$email;?></span></p>
                                <p class="text-desc">
                                    <div class="dropdown">
                                        <button class="btn bg-orange btn-round dropdown-toggle text-white" type="button" id="dropPets" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            View Pets
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropPets">
                                            <?php $get_pets=$this->Friends_model->get_my_pets($id);?>
                                            <?php if($get_pets){ foreach($get_pets as $pets){ extract($pets); ?>
                                                <a class="dropdown-item" href="<?=base_url();?>pet/pet_details/<?=$pet_id;?>" target="_blank"><?=$pet_name;?> (<?=$cat_name;?>)</a>
                                            <?php } } else { ?>
                                                <a class="dropdown-item" href="javascript:;">No pets found.</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } }?>
                <?php if($friend_i_request){ foreach($friend_i_request as $frnds){ extract($frnds); ?>
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
                                <?php $uid = $this->session->userdata('user_id');?>
                                <?php if($uid != $id){?>
                                    <div class="options<?=$id;?>">
                                        <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i>  Request Sent</span>
                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                <a onclick="request_friends(<?=$id;?>,2,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Remove Request</a>
                                                <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$id?>">View Profile</a>
                                                <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                            </div>
                                    </div>
                                <?php } ?>
                                <p class="text-head"><a href="<?=base_url();?>account/view_bio/<?=$id?>"><?=($fullname) ? $fullname : "No Name";?></a> </p>
                                <p class="text-desc"><?=($complete_address&&$zip_code) ? $complete_address.', '.$zip_code : 'No Address'; ?></p>
                                <p class="f-14">Email: <span class="b-700 text-black"><?=$email;?></span></p>
                                <p class="text-desc">
                                    <div class="dropdown">
                                        <button class="btn bg-orange btn-round dropdown-toggle" type="button" id="dropPets" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            View Pets
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropPets">
                                            <?php $get_pets=$this->Friends_model->get_my_pets($id);?>
                                            <?php if($get_pets){ foreach($get_pets as $pets){ extract($pets); ?>
                                                <a class="dropdown-item" href="<?=base_url();?>pet/pet_details/<?=$pet_id;?>" target="_blank"><?=$pet_name;?> (<?=$cat_name;?>)</a>
                                            <?php } } else { ?>
                                                <a class="dropdown-item" href="javascript:;">No pets found.</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } }?>
                <?php if(!$friend_request && !$friend_i_request){ ?>
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <strong><i class="fa fa-check"></i> Empty!</strong> You have no friend request.</i>
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
          </div>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('mail/pop-ups/inst_msg');?>
    <?php $this->load->view('common/footer');?>

  </body>

</html>
