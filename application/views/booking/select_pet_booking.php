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
			<div class="row f-list-wrap">
            <?php $uid = $this->session->userdata('user_id');?>
                <?php $i=0; if($get_avail_pets){?>
                <?php foreach($get_avail_pets as $res){ extract($res); ?>
                <?php if( $user_id != $uid){?>
                    <?php $cb = $this->Booking_model->check_booking($uid, $user_id); ?>
                    <div class="col-md-6 myPets" id="myPets<?=$pet_id;?>">
                        <div class="card bg-grey friend-card">
                            <div class="card-body">
                                <div class="friend-img">
                                    <?php if($primary_pic){ ?>
                                        <img src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$primary_pic;?>" alt="Pet Image">
                                    <?php }else{ ?>
                                        <img src="<?=base_url();?>assets/img/pictures/default_pet.png" alt="Pet Image">
                                    <?php } ?>
                                </div>
                                <button class="btn btn-info btn-xs pull-right dropdown-toggle"  id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</button>
                                <div class="dropdown-menu" aria-labelledby="f-menu">
                                    <a class="dropdown-item" target="_blank" href="<?=base_url();?>pet/pet_details/<?=$pet_id; ?>">Pet Details</a>
                                </div>

                                <p class="text-head"><a href="<?=base_url();?>pet/pet_details/<?=$pet_id; ?>" target="_blank"><?= $pet_name; ?></a> </p>
                                <p class="text-desc"><?=($complete_address&&$zip_code) ? $complete_address.', '.$zip_code : 'No Address'; ?></p>
                                <p class="b-700 f-14">Breed: <span class="b-700 text-black"><?= $breed_name; ?> (<?= $cat_name; ?>)</span></p>
                                <?php $ndf=json_decode($ns_date_from);?>
                                <?php $ndt=json_decode($ns_date_to);?>
                                <p class="b-700 f-14 m-b-0">
                                    Date From: <span class="b-700 text-black"> <?=date('M d',strtotime($ndf[0]));?></span> Date To: <span class="b-700 text-black"><?=date('M d',strtotime($ndt[0]));?></span></p>
                                <p class="b-700 f-14">Owner: <span class="b-700 text-black"><?= $fullname; ?></span></p>
                                <p class="pull-right">
                                    <a href="<?=base_url();?>booking/book_user_pets/<?=$user_id?>" class="btn bg-orange btn-round dropdown-toggle text-white">
                                        Book
                                    </a>
                                    <!-- <?='<span class="badge badge-danger f-12 pull-right m-t-5"><i class="fa fa-check"></i> Waiting for approval</span>'; ?> -->
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } else{ if(count($get_avail_pets) ==1 || ($user_id == $uid && $i==1)){ ?>
                    <div class="col-md-12 f-list-wrap">
                        <div class="alert alert-info f-15">
                            <strong><i class="fa fa-check"></i> Empty!</strong> No pet results found.</i></i>.
                        </div>
                    </div>
                <?php }$i+=1; } ?>
                <?php } } else{ ?>
                    <div class="col-md-12 f-list-wrap">
                        <div class="alert alert-info f-15">
                            <strong><i class="fa fa-check"></i> Empty!</strong> No pet results found.</i></i>.
                        </div>
                    </div>
                <?php } ?>
            </div>
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
