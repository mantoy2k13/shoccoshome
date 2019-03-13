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
                        <span class="btn btn-circle f-20 btn-sm text-white pull-left"> Friend Lists</span>
                        <a href="<?=base_url();?>friends/friend_request" data-placement="left" data-toggle="tooltip" title="View Friend Request" class="text-white pull-right icon-btn"><i class="fa fa-users fa-2x"></i> 
                            <?php $cntReq=$this->Friends_model->count_friend_request();
                                if($cntReq!=0){ ?>
                                <span class="badge bg-red cus-f-badge"><?=$cntReq;?></span>
                            <?php } ?>
                        </a>
                    </div>
                </div>
            </div>
			<div class="row f-list-wrap">
                <?php if($my_friends){ foreach($my_friends as $frnd){ extract($frnd); ?>
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
                                        <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Friends</span>
                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                <a onclick="request_friends(<?=$id;?>,3,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Unfriend</a>
                                                <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$id?>">View Profile</a>
                                                <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                            </div>
                                    </div>
                                <?php } ?>
                                <p class="text-head"><a href="<?=base_url();?>account/view_bio/<?=$id?>"><?=($fullname) ? $fullname : "No Name";?></a> </p>
                                <p class="text-desc"> <?php if($street&&$city&&$zip_code&&$state&&$country){ ?> <?=$street.' '.$city.', '.$zip_code.', '.$state.', '.$country;?><?php } else { echo 'No Address'; }?></p>
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
                <?php } } else {?>
                    <div class="col-md-12">
                        <div class="alert alert-info m-t-20">
                            <strong><i class="fa fa-check"></i> Empty!</strong> You have no friends added.</i>.
                        </div>
                    </div>
                <?php } ?>
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
