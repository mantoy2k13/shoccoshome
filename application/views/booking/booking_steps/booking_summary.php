<!DOCTYPE html>
<html lang="en">

  <!-- Header CSS -->
  <?php $this->load->view('common/css');?>
  <link href="<?=base_url();?>assets/css/breadcrumbs.css" rel="stylesheet" type="text/css">
  <body id="page-top">
  <?php $uid = $this->session->userdata('user_id');?>
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
                            <i class="fa fa-book f-25 text-blue "></i> Booking
                        </div>
                        <div class="col-md-12 m-t-10">
                            <a href="<?=base_url();?>booking/booking_as_host" class="p-nav b-700 f-14 active">Become a Host</a>
                            <a href="<?=base_url();?>booking/booking_as_guest" class="p-nav b-700 f-14">Become a Guest</a>
                            <a href="<?=base_url();?>booking/booking_list/1" class="btn bg-orange btn-xs pull-right text-white"><i class="fa fa-history"></i> Booking History</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Breadcrumbs -->
                    <?php $this->load->view('booking/booking_steps/breadcrumbs');?>
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cus-card">
                                    <div class="cus-card-header">
                                        <i class="fa fa-edit"></i> Booking summary
                                        <?=($book['book_status']==1) ? '<span class="badge bg-orange text-white font-san-serif pull-right m-t-5"><i class="fa fa-history"></i> Waiting for approval</span>' : ''; ?>
                                        <?=($book['book_status']==2) ? '<span class="badge badge-danger font-san-serif pull-right m-t-5"><i class="fa fa-times"></i> Cancelled</span>' : ''; ?>
                                        <?=($book['book_status']==3) ? '<span class="badge badge-danger font-san-serif pull-right m-t-5"><i class="fa fa-thumbs-down"></i> Disapproved</span>' : ''; ?>
                                        <?=($book['book_status']==4) ? '<span class="badge badge-info font-san-serif pull-right m-t-5"><i class="fa fa-thumbs-up"></i> Approve</span>' : ''; ?>
                                        <?=($book['book_status']==5) ? '<span class="badge badge-success font-san-serif pull-right m-t-5"><i class="fa fa-check"></i> Completed</span>' : ''; ?>
                                        <p class="f-12 m-b-0" style="line-height: 15px;">Your booking summary is summarize below. You can still edit it if you want to.</p>
                                    </div>
                                    <div class="cus-card-body">
                                        <div class="row m-t-10">
                                            <div class="col-md-12">
                                                <div class="bio-head">
                                                    <div class="bio-img">
                                                        <?php $bio_img = $bio[0]['user_img'] ? 'usr'.$bio[0]['id'].'/'.$bio[0]['user_img'] : 'default.png'; ?>
                                                        <img class="zoomable" src="<?=base_url();?>assets/img/pictures/<?=$bio_img;?>" alt="Default Profile Image">
                                                    </div>  
                                                    <?php 
                                                        if($bio[0]['fullname']){ $getName = $bio[0]['fullname'];}
                                                        else{
                                                            $explodeResultArrayname = explode("@", $bio[0]['email']);
                                                            $getName = ucfirst($explodeResultArrayname[0]);
                                                        }
                                                    ?>
                                                    <p class="f-30 b-700 text-orange-d m-b-0">Booked To: <?=$getName;?></p>
                                                    <p class="f-20 b-700 text-blue m-b-0"><?=($bio[0]['occupation'])?$bio[0]['occupation']:'No Occupation';?></p>
                                                    <p class="f-15 m-b-0 text-black-l"> <?=($bio[0]['complete_address']&&$bio[0]['zip_code']) ? $bio[0]['complete_address'].', '.$bio[0]['zip_code'] : 'No Address'; ?></p>
                                                </div>
                                                <p class="f-15 text-black-l font-san-serif">
                                                    <?=($bio[0]['book_type']==1) ? '<span class="badge badge-primary"><i class="fa fa-user"></i> HOST</span>' : '<span class="badge bg-orange text-white"><i class="fa fa-user"></i> GUEST</span>'; ?>
                                                    <?=($bio[0]['is_smoker']==1) ? '<span class="badge badge-danger"><i class="fa fa-ban"></i> Smoker</span>' : '<span class="badge badge-success"><i class="fa fa-check"></i> Non Smoker</span>'; ?>
                                                    <span class="badge badge-info">
                                                        <i class="fa fa-home"></i> Living in <?=($bio[0]['living_in']==1) ? 'the house' : 'an apartment'; ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-md-7">
                                                <label>Date From: </label>
                                                <input type="date" class="form-control" value="<?=$book['book_date_from'] ? date('Y-m-d', strtotime($book['book_date_from'])) : '';?>" disabled>
                                            </div>
                                            <div class="col-md-5">
                                                <label>Time From: </label>
                                                <input type="time" class="form-control" value="<?=$book['book_date_from'] ? date('H:i', strtotime($book['book_date_from'])) : '';?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row m-t-10">
                                            <div class="col-md-7">
                                                <label>Date To: </label>
                                                <input type="date" class="form-control" value="<?=$book['book_date_to'] ? date('Y-m-d', strtotime($book['book_date_to'])) : '';?>" disabled>
                                            </div>
                                            <div class="col-md-5">
                                                <label>Time To: </label>
                                                <input type="time" class="form-control" value="<?=$book['book_date_from'] ? date('H:i', strtotime($book['book_date_to'])) : '';?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row m-t-10">
                                            <div class="col-md-12 m-t-10">
                                                <label>Additional Info: </label>
                                                <textarea class="form-control" cols="30" rows="3" placeholder="Any message or additional information.." disabled><?=$book['short_message']?></textarea>
                                            </div>
                                        </div>
                                        <div class="row m-t-10">
                                            <div class="col-md-12">
                                                <label class="text-orange">Pets requested</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php if($my_pets){ foreach($my_pets as $pets){ extract($pets); ?>
                                            <?php $pet_req = $book['pet_list'] ? json_decode($book['pet_list']) : []; ?>
                                                <?php if(in_array($pet_id, $pet_req)){ ?>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <div class="card bg-grey friend-card">
                                                            <div class="card-body">
                                                                <div class="pet-bio-img">
                                                                    <?php $pet_img = $primary_pic ? 'usr'.$book['book_by'].'/'.$primary_pic : 'default_pet.png';?>
                                                                    <img class="zoomable" src="<?=base_url();?>assets/img/pictures/<?=$pet_img?>" alt="Pet Image">
                                                                </div>
                                                                <p class="text-blue f-20 b-700">
                                                                    <a href="<?=base_url();?>pet/pet_details/<?=$pet_id?>" target="_blank"><?=$pet_name;?></a>
                                                                </p>
                                                                <p class="b-700 f-14">Breed: <span class="b-700 text-black"><?=$breed_name;?></span></p>
                                                                <p class="b-700 f-14">Cat: <span class="b-700 text-black"><?=$cat_name;?></span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } } else { ?>
                                                <div class="col-md-12">
                                                    <div class="alert alert-info f-15">
                                                        <strong><i class="fa fa-check"></i> Empty!</strong> No pets found. Pet booked history might be deleted or doesn't exist.
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="row m-t-10">
                                            <div class="col-md-12 text-right">
                                                <a href="<?=base_url();?>booking/update_book_user/<?=$book['book_id'].'/'.$book['book_to'].'/'.'1';?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit booking</a>
                                                <a href="javascript:;" class="btn btn-success"><i class="fa fa-check"></i> Finish</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- Close Main Content -->
		</div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
    <script src="<?=base_url();?>assets/js/initializations/init_booking_validations.js"></script>
  </body>

</html>