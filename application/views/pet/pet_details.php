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
		  <?php foreach($pet_details as $data) { extract($data); ?>
		  <div class="col-md-9 m-t-10 p-l-0 p-details">
			<div class="panel panel-default bg-gray">
				<div class="panel-heading pointed">
					<span class="b-700 text-blue"><i class="fa fa-paw"></i> Pet Details</span>
					
					<?php if($user_id == $this->session->userdata('user_id')){ ?>
						<a href="<?=base_url();?>pet/add_new_pet/<?= ($pet_id) ? $pet_id : '' ?>" class="btn btn-sm text-white bg-orange pull-right"><i class="fa fa-edit"></i> Edit Pet</a>
					<?php } ?>
				</div>			
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="row">
								<div class="col-md-12">
									<p class="f-20 b-700 text-blue m-b-0"><?= $pet_name; ?></p>
									<p class="f-15 m-b-0"><?php if($complete_address&&$zip_code){ ?> <?=$complete_address.', '.$zip_code;?><?php } else { echo 'No Address'; }?></p>
								</div>
								<div class="col-md-12">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner carousel-inner300">
										
											<div class="pet-details-img carousel-item active c-img-wrapper pet-slider">
												<img class="d-block w-100 c-px" src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$primary_pic;?>" alt="Slider Image">
											</div>
                                            <?php $json_pet_images = json_decode($pet_images);
                                                   if($json_pet_images){ foreach($json_pet_images as $img){ 
												   if($primary_pic!=$img){ ?>
													<div class="pet-details-img carousel-item item c-img-wrapper pet-slider">
														<img class="d-block w-100 c-px" src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$img;?>" alt="Slider Image">
													</div>
                                            <?php } } } else{ ?>
                                                <div class="pet-details-img carousel-item active c-img-wrapper pet-slider">
													<img class="d-block w-100" src="<?=base_url();?>assets/img/pictures/default_pet.png" alt="Slider Image">
                                                </div>
											<?php } ?>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
									<p class="f-15 m-b-0 m-t-10 text-black">
									    <b>Pet Description</b><br>
										<?=$description ? $description : 'No description available' ?>
									</p>
									<div class="detail-list m-t-20">
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Category:</span> <?=$cat_name ? $cat_name : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Breed:</span> <?=$breed_name ? $breed_name : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Color:</span> <?=$color_name ? $color_name : 'No data' ?>
											</div>
										</div>
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">DOB:</span> <?=$dob ? $dob : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Gender:</span> <?=$gender ? $gender : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Height:</span> <?=$height ? $height : 'No data' ?>
											</div>
										</div>
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Weight:</span> <?=$weight ? $weight : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Food:</span> <?=$fav_food ? $fav_food : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Sports:</span> <?=$fav_food ? $fav_food : 'No data' ?>
											</div>
										</div>
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Located:</span> <?=$located ? $located : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Skills:</span> <?=$skills ? $skills : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Clinic:</span> <?=$vet_clinic ? $vet_clinic : 'No data' ?>
											</div>
										</div>
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Adoptable:</span> <?=$adoptable ? $adoptable : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Status:</span> <?=$fav_food ? $fav_food : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Tags:</span> <?=$tags ? $tags : 'No data' ?>
											</div>
										</div>
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Chip No:</span> <?=$chip_no ? $chip_no : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Collar Tag:</span> <?=$collar_tag ? $collar_tag : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Zip Code:</span> <?=$zip_code ? $zip_code : 'No data' ?>
											</div>
										</div>
										<div class="row">
											<div class="col md-12 f-15 d-lbl text">
												<span class="text-blue b-700">Vaccinations:</span>
											</div>
										</div>
										<?php $vacc_date = json_decode($vaccination_date); ?>
										<?php $i=0; if($vaccination){ foreach(json_decode($vaccination) as $vacc){ ?>
										<div class="row">
											<div class="col md-6 f-15 d-lbl">
												<span class="text-blue b-700">Vaccination Type:</span> <?= $vacc; ?>
											</div>
											<div class="col md-6 f-15 d-lbl">
												<span class="text-blue b-700">Vaccination Date:</span> <?= $vacc_date[$i]; ?>
											</div>
										</div>
										<?php $i+=1; } } else{ ?>
											<div class="row">
												<div class="col md-6 f-15 d-lbl">
													<span class="text-blue b-700">Vaccination Type:</span> No data
												</div>
												<div class="col md-6 f-15 d-lbl">
													<span class="text-blue b-700">Vaccination Date:</span> No data
												</div>
											</div>
										<?php } ?>
										<div class="row">
											<div class="col md-12 f-15 d-lbl">
												<span class="text-blue b-700">Additional Info:</span> <br>
												<p class="f-15 m-b-0 m-t-20 text-black">
													<b>Please list any of your pet's known allergies and medical/health issues</b><br>
													<?=$health_issues ? $health_issues : 'No health issues available' ?>
												</p>
												<p class="f-15 m-b-0 m-t-10 text-black">
													<b>Does your pet take any medications? If so, please provide medication and dosage requirements</b><br>
													<?=$medications ? $medications : 'No medications available' ?>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<?php 
								$ndf = json_decode($ns_date_from);
								$ndt = json_decode($ns_date_to);
								$today = date('Y-m-d');
								if($ndf&&$ndt){
									$get_date_from = $ndf[0]; 
									$date_from = ($get_date_from < $today) ? $today : $get_date_from;
									$get_date_to = $ndt[0];
									$date_to = date('Y-m-d', strtotime($get_date_to . ' +1 day')); 
								}else{
									$date_from=''; $date_to='';
								}
							?>	

							<input type="hidden" id="ndf" value="<?=$date_from;?>">
							<input type="hidden" id="ndt" value="<?=$date_to;?>">
							<input type="hidden" id="curr_date" value="<?=$today;?>">
							<div class="row">
								<div class="col-md-12">
									<p class="f-20 b-700 text-orange-d">My pet schedule for sitter</p>
								</div>
							</div>
							<div id='petCalendar'></div>
							<?php if($user_id == $this->session->userdata('user_id')){ ?>
								<div class="row">
									<div class="col-md-12 m-t-20">
										<a href="<?=base_url();?>booking/booking_set_dates" class="btn bg-orange text-white col-md-12"><i class="fa fa-edit"></i> Edit schedule</a>
									</div>
								</div>
							<?php } ?>
							<?php if($ndf&&$ndt&&$user_id != $this->session->userdata('user_id')){ ?>
								<div class="row">
									<div class="col-md-12 m-t-20">
										<a href="<?=base_url();?>booking/book_user_pets/<?=$user_id;?>" class="btn bg-orange text-white col-md-12"><i class="fa fa-paw"></i> Book Pet</a>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
          </div>	
          <!-- Close Main Content -->
	  </div>
	  <?php } ?>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
	<script src="<?=base_url();?>assets/js/initializations/init_pet_sched.js"></script>

  </body>

</html>
