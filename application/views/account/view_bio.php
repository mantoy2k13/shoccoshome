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
          <?php foreach($view_bio as $bio){ extract($bio); ?>
            <?php $my_id = $this->session->userdata('user_id');?>
            <?php 
                if($fullname){
                    $getName = $fullname;
                }else{
                    $explodeResultArrayname = explode("@", $email);
                    $getName = ucfirst($explodeResultArrayname[0]);
                }
            ?>
		  <div class="col-md-9 m-t-10 bio-wrapper-info p-l-0">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 bio-head">
                                <div class="bio-img">
                                    <?php if($user_img) { ?>
                                        <img src="<?=base_url();?>assets/img/pictures/usr<?=$id;?>/<?=$user_img;?>" alt="Profile Image">
                                    <?php }else{ ?>
                                        <img src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image">
                                    <?php } ?>
                                </div>
                                <?php $uid = $this->session->userdata('user_id');?>
                                <?php if($this->Friends_model->check_if_friends($id)){ ?>
                                    <?php if($uid != $id){?>
                                        <div class="options<?=$id;?>">
                                            <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i>  Friends</span>
                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                <a onclick="request_friends(<?=$id;?>,3,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Unfriend</a>
                                                <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else {?>
                                    <?php if($this->Friends_model->check_friend_request($id)){ ?>
                                        <?php if($uid != $id){?>
                                            <div class="options<?=$id;?>">
                                                <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i>  Request Sent</span>
                                                <div class="dropdown-menu" aria-labelledby="f-menu">
                                                    <a onclick="request_friends(<?=$id;?>,2,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Remove Request</a>
                                                    <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else {?>
                                        <?php if($uid != $id){?>
                                            <div class="options<?=$id;?>">
                                                <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Add friend</span>
                                                <div class="dropdown-menu" aria-labelledby="f-menu">
                                                    <a onclick="request_friends(<?=$id;?>,1,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Add Friend</a>
                                                    <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                <p class="f-30 b-700 text-orange-d m-b-0"><?=$getName;?></p>
                                <p class="f-25 b-700 text-blue m-b-0"><?=($occupation)?$occupation:'No Occupation';?></p>
                                <p class="f-20 m-b-0 text-black-l"> <?=($complete_address&&$zip_code) ? $complete_address.', '.$zip_code : 'No Address'; ?></p>
                            </div>
                            <div class="col-md-12 m-t-10">
                                <div class="prof-desc">
                                    <div class="row">
                                        <div class="container">
                                            <p class="text-black"><?=($bio)?nl2br($bio):"No Description";?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-20">
                                    <div class="col-md-12">
                                        <div class="pic-head bg-greyish">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <i class="fa fa-image f-25 text-blue"></i> User Images
                                                </div>
                                            </div>
                                        </div>
                                        <?php $user_images_5 = $this->Account_model->get_users_images($user_id, 5);?>
                                        <?php $user_images = $this->Account_model->get_users_images($user_id, 0);?>
                                        <div class="row m-t-10 m-b-10">
                                            <?php if($user_images_5){?>
                                                <div class="<?=(count($user_images_5)!=1) ? 'col-md-6' : 'col-md-12';?>">
                                                    <div class="userImagesBig imgHovGen">
                                                        <?php if($user_images_5){?>
                                                            <img src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$user_images_5[0]['img_name'];?>" alt="Profile  Image" class="zoomable">
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <?php if(count($user_images_5)!=1){?>
                                                    <div class="col-md-6">
                                                        <?php $i=1; foreach($user_images_5 as $k){extract($k); ?>
                                                            <?php if($i!=1){?>
                                                            <div class="usrImgCol">
                                                                <div class="userImages imgHovGen">
                                                                    <img src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$img_name;?>" alt="Profile  Image" class="zoomable">
                                                                    <?php if($i==count($user_images_5)){?>
                                                                    <a class="viewAllImg" href="javascript:;"  data-toggle="modal" data-target="#selPics"><span class="badge badge-danger"><?=count($user_images);?></span>  View all </a>
                                                                    <?php } ?>
                                                                </div>  
                                                            </div>  
                                                        <?php } $i++;}?>   
                                                    </div>
                                                <?php } ?>  
                                            <?php } else{?>  
                                                <div class="col-md-12">
                                                    <div class="alert alert-info f-15">
                                                        <strong><i class="fa fa-check"></i> Empty!</strong> The user has no images.
                                                    </div>
                                                </div>
                                            <?php }?>  
                                        </div>
                                        <div class="pic-head bg-greyish m-t-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <i class="fa fa-paw f-25 text-blue"></i> Pets
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m-t-10 bio-pet-grp">
                                            <?php $user_pets = $this->Account_model->get_my_pets($id);?>
                                            <?php if($user_pets){foreach($user_pets as $pets){ extract($pets); ?>
                                                <div class="col-md-6">
                                                    <div class="card bg-grey friend-card">
                                                        <div class="card-body">
                                                            <div class="pet-bio-img">
                                                                <?php if($primary_pic) { ?>
                                                                    <img src="<?=base_url();?>assets/img/pictures/usr<?=$id;?>/<?=$primary_pic;?>" alt="Profile Image">
                                                                <?php }else{ ?>
                                                                    <img src="<?=base_url();?>assets/img/pictures/default_pet.png" alt="Default Profile Image">
                                                                <?php } ?>
                                                            </div>
                                                            <button class="btn btn-info btn-xs pull-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i></button>
                                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                                <?php if($id==$my_id){ ?>
                                                                <a class="dropdown-item" href="<?=base_url();?>pet/add_new_pet/<?=$pet_id;?>">Edit Pet</a>
                                                                <?php } ?>
                                                                <a class="dropdown-item" href="<?=base_url();?>pet/pet_details/<?=$pet_id;?>">Pet Details</a>
                                                            </div>
                                                            <p class="text-blue f-20 b-700"><a href="<?=base_url();?>pet/pet_details/<?=$pet_id;?>"><?=$pet_name;?></a> </p>
                                                            <p class="f-15 text-black"><?=$description;?></p>
                                                            <p class="b-700 f-14">Breed: <span class="b-700 text-black"><?=$breed_name;?> (<?=$cat_name;?>)</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } } else { ?>
                                                <div class="col-md-12">
                                                    <div class="alert alert-info f-15">
                                                        <strong><i class="fa fa-check"></i> Empty!</strong> The user has no pets.
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="profile-info-wrapper">
                            <p class="f-20 b-700 text-blue">Contact Info</p>
                            <p class="f-15"><span class="text-black b-700">Name</span><br>
                                <?=$getName;?>
                            </p>
                            <p class="f-15"><span class="text-black b-700">Email</span><br><?=$email;?></p>
                            <p class="f-15"><span class="text-black b-700">Mobile</span><br>
                                <?=($mobile_number)?$mobile_number:"No Number";?>
                            </p>
                            <p class="f-15"><span class="text-black b-700">Gender</span><br>
                                <?=($gender)?$gender:"No Number";?>
                            </p>
                            <p class="f-15"><span class="text-black b-700">Occupation</span><br>
                                <?=($occupation)?$occupation:"No Occupation";?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
          <?php } ?>
          <!-- Close Main Content -->
	  </div>
    </section>
    <!-- modal -->
    <div class="modal fade" id="selPics" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-image"></i> User's images</p>
                </div>
                <div class="modal-body">
                        <div class="row">
                               <?php if($user_images){?>
                                    <?php foreach($user_images as $user_img){ extract($user_img);?>
                                        <div class="col-md-3 resfx">
                                            <div class="thumbnail">
                                                <a href="javascript:;">
                                                    <div class="gal-img">
                                                        <img src="<?=base_url();?>assets/img/pictures/usr<?=$user_id?>/<?=$img_name;?>" class="zoomable"style="width:100%" alt="Picture">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php }?>
                                <?php } else{?>
                                    <h1>You don't have user's Images</h1>
                                <?php }?>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>

    <!-- Footer -->
    <?php $this->load->view('mail/pop-ups/inst_msg');?>
    <?php $this->load->view('common/footer');?>
  </body>

</html>
