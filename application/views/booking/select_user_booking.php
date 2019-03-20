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
                        <span class="btn btn-circle f-20 btn-sm text-white pull-left"> Search results near you..</span>
                        <a href="javascript:;" data-placement="left" data-toggle="tooltip" title="Book Now" class="text-white pull-right icon-btn">
                            <span data-toggle="modal" data-target="#booking_modal"><i class="fa fa-search fa-2x"></i></span>
                        </a>
                    </div>
                </div>
            </div>
			<div class="row f-list-wrap">
            <?php $uid = $this->session->userdata('user_id');?>
                <?php if($get_avail_users){?>
                <?php foreach($get_avail_users as $res){ extract($res); ?>
                <?php if( $id != $uid){?>
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
                                <?php if($uid != $id){?>
                                    <div class="options<?=$id;?>">
                                        <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i>  Friends</span>
                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                <a onclick="request_friends(<?=$id;?>,3,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Unfriend</a>
                                                <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$id?>">View Profile</a>
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
                                                    <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$id?>">View Profile</a>
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
                                                    <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$id?>">View Profile</a>
                                                    <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <p class="text-head"><a href="<?=base_url();?>account/view_bio/<?=$id?>"><?=($fullname) ? $fullname : "No Name";?></a> </p>
                            <p class="text-desc"><?php if($street&&$city&&$zip_code&&$state&&$country){ ?> <?=$street.' '.$city.', '.$zip_code.', '.$state.', '.$country;?><?php } else { echo 'No Address'; }?></p>
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
               
               <?php }} } else{ ?>
                    <div class="col-md-12 f-list-wrap">
                        <div class="alert alert-info">
                            <strong><i class="fa fa-check"></i> Empty!</strong> No users found base on your zip code <i>"<?=$zipcode; ?>"</i></i>.
                        </div>
                    </div>
                <?php } ?>
            </div>
          </div>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Modal -->  
    <div class="modal fade msgModalCustom" id="booking_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?=base_url();?>booking/select_and_book" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <p class="modal-title f-20 text-black"><i class="fa fa-search"></i> Find a home</p>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="zipcode">Enter your Zip Code</label>
                                <input type="text" class="form-control" name="zipcode" placeholder="Zip Code" required onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="user_type">Select your type</label>
                                <select name="user_type" class="form-control" onchange="getHostGuest(this);" required>
                                    <option value="guest">Be a Guest</option>
                                    <option value="host">Be a Host</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="guest-list col-md-12">
                                <label for="pet_list">Choose your pet from pet list</label>
                                <?php if($this->session->userdata('user_email')){?>
                                    <select id="petList" name="pet_list[]" class="multipleSelect form-control" multiple>
                                    <?php if($my_pets){ 
                                        foreach($my_pets as $pets){ extract($pets); ?>
                                            <option value="<?=$pet_id;?>"><?=$pet_name;?> (<?=$cat_name ;?>)</option>
                                        <?php } } else { ?>
                                            <?php if($this->session->userdata('user_email')){?>
                                                <option value="">You have no pets added.</option>
                                            <?php } else { ?>
                                                <option value="">Please login to view your pets.</option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <select class="form-control">
                                        <option value="">Sign In or Sign Up now</option>
                                    </select>
                                <?php } ?>
                            </div>
                            <div class="col-md-12 host-list mainpage-list">
                                <label for="pet_cat">Choose your category</label><br />
                                <?php if($this->session->userdata('user_email')){?>
                                    <select id="petCat" name="pet_cat[]" class="multipleSelect form-control" multiple>
                                        <?php foreach($categories as $cat){ extract($cat); ?>
                                            <option value="<?=$cat_id;?>"><?=($cat_name) ? $cat_name : "No Name";?></option>
                                        <?php } ?>
                                    </select>
                                <?php } else { ?>
                                    <select class="form-control">
                                        <option value="">Sign In or Sign Up now</option>
                                    </select>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Find a home</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php $this->load->view('mail/pop-ups/inst_msg');?>
    <?php $this->load->view('common/footer');?>

  </body>

</html>
