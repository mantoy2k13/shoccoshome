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
		  <?php foreach($get_all_pet_data as $show_get_all_pet_data) { ?>
		  <div class="col-md-9 m-t-10 p-l-0 p-details">
			<div class="panel panel-default bg-gray">
				<div class="panel-heading pointed">
					<span class="b-700 text-blue"><i class="fa fa-paw"></i> Pet Details</span>
					<a href="javascript:;" class="btn btn-sm text-white bg-black-l">Booking History</a>
				</div>			
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="row">
								<div class="col-md-12">
									<p class="f-20 b-700 text-blue m-b-0"><?= $show_get_all_pet_data->pet_name; ?></p>
									<p class="f-15 m-b-0"><?php if($show_get_all_pet_data->street&&$show_get_all_pet_data->city&&$show_get_all_pet_data->zip_code&&$show_get_all_pet_data->state&&$show_get_all_pet_data->country){ ?> <?=$show_get_all_pet_data->street.' '.$show_get_all_pet_data->city.', '.$show_get_all_pet_data->zip_code.', '.$show_get_all_pet_data->state.', '.$show_get_all_pet_data->country;?><?php } else { echo 'No Address'; }?></p>
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
												<img class="d-block w-100 c-px" src="<?=base_url();?>assets/img/pet/<?=$show_get_all_pet_data->primary_pic;?>" alt="Slider Image">
											</div>
                                            <?php 
                                                $pet_images = $show_get_all_pet_data->pet_images;
                                                $json_pet_images = json_decode($pet_images);
                                                if(is_array($json_pet_images) || is_object($json_pet_images)){
                                                    foreach($json_pet_images as $pet_img){
													$pet_img = substr($pet_img, 15);
                                            ?>
											<?php if($pet_img!=$show_get_all_pet_data->primary_pic){?>
                                                <div class="pet-details-img carousel-item item c-img-wrapper pet-slider">
                                                    <img class="d-block w-100 c-px" src="<?=base_url();?>assets/img/pet/<?=$pet_img;?>" alt="Slider Image">
                                                </div>
											<?php } ?>

                                            <?php } } else{ ?>
                                                    <div class="pet-details-img carousel-item active c-img-wrapper pet-slider">
                                                    <img class="d-block w-100" src="<?=base_url();?>assets/img/image-icon.png" alt="Slider Image">
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
									<p class="b-700 m-t-10 f-15 m-b-0"><span class="text-black">Category:</span>  <?= $show_get_all_pet_data->cat_name; ?></p>
									<p class="b-700 f-15 m-b-0"><span class="text-black">Breed: </span><?= $show_get_all_pet_data->breed_name; ?> </p>
									<p class="b-700 f-15 m-b-0"><span class="text-black">Skills:</span> <?= @$show_get_all_pet_data->skills ? @$show_get_all_pet_data->skills : 'No data' ?> </p>
									<p class="f-15 m-b-0 m-t-10 text-black">
									    <?= @$show_get_all_pet_data->description ? @$show_get_all_pet_data->description : 'No description available' ?>
									</p>
									<div class="detail-list m-t-20">
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Category:</span> <?= @$show_get_all_pet_data->cat_name ? @$show_get_all_pet_data->cat_name : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Breed:</span> <?= @$show_get_all_pet_data->breed_name ? @$show_get_all_pet_data->breed_name : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Color:</span> <?= @$show_get_all_pet_data->color_name ? @$show_get_all_pet_data->color_name : 'No data' ?>
											</div>
										</div>
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">DOB:</span> <?= @$show_get_all_pet_data->dob ? @$show_get_all_pet_data->dob : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Gender:</span> <?= @$show_get_all_pet_data->gender ? @$show_get_all_pet_data->gender : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Height:</span> <?= @$show_get_all_pet_data->height ? @$show_get_all_pet_data->height : 'No data' ?>
											</div>
										</div>
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Weight:</span> <?= @$show_get_all_pet_data->weight ? @$show_get_all_pet_data->weight : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Food:</span> <?= @$show_get_all_pet_data->fav_food ? @$show_get_all_pet_data->fav_food : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Sports:</span> <?= @$show_get_all_pet_data->fav_food ? @$show_get_all_pet_data->fav_food : 'No data' ?>
											</div>
										</div>
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Located:</span> <?= @$show_get_all_pet_data->located ? @$show_get_all_pet_data->located : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Skills:</span> <?= @$show_get_all_pet_data->skills ? @$show_get_all_pet_data->skills : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Clinic:</span> <?= @$show_get_all_pet_data->vet_clinic ? @$show_get_all_pet_data->vet_clinic : 'No data' ?>
											</div>
										</div>
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Adoptable:</span> <?= @$show_get_all_pet_data->adoptable ? @$show_get_all_pet_data->adoptable : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Status:</span> <?= @$show_get_all_pet_data->fav_food ? @$show_get_all_pet_data->fav_food : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Tags:</span> <?= @$show_get_all_pet_data->tags ? @$show_get_all_pet_data->tags : 'No data' ?>
											</div>
										</div>
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Chip No:</span> <?= @$show_get_all_pet_data->chip_no ? @$show_get_all_pet_data->chip_no : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Collar Tag:</span> <?= @$show_get_all_pet_data->collar_tag ? $show_get_all_pet_data->collar_tag : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Zip Code:</span> <?= @$show_get_all_pet_data->zip_code ? $show_get_all_pet_data->zip_code : 'No data' ?>
											</div>
										</div>
										<div class="row">
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Vaccination:</span> <?= @$show_get_all_pet_data->vaccination ? @$show_get_all_pet_data->vaccination : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Vaccination Date:</span> <?= @$show_get_all_pet_data->vaccination_date ? $show_get_all_pet_data->vaccination_date : 'No data' ?>
											</div>
											<div class="col md-4 f-15 d-lbl">
												<span class="text-blue b-700">Others:</span> <?= @$show_get_all_pet_data->other_info ? $show_get_all_pet_data->other_info : 'No data' ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group row">
								<div class="col-md-5">
									<input type="date" class="form-control" placeholder="Zip Code">
								</div>
								<div class="col-md-2 text-center"><span class="badge badge-info cal-badge">To</span></div>
								<div class="col-md-5">
									<input type="date" class="form-control" placeholder="Zip Code">
								</div>
							</div>
							<div id='calendar'></div>
							<div class="col-md-12">
							<?php if($show_get_all_pet_data->user_id == $this->session->userdata('user_id')){ ?>
									<a href="<?=base_url();?>home/add_new_pet/<?= ($show_get_all_pet_data->pet_id) ? $show_get_all_pet_data->pet_id : '' ?>" class="btn bg-orange sub-btn w-100"><i class="fa fa-edit"></i> Edit Pet</a>
							<?php } ?>
							</div>
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

  </body>

</html>
