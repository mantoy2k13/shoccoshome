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
		  <div class="col-md-9 m-t-10 p-l-0 p-details">
            <div class="panel panel-default bg-gray">
				<div class="panel-heading pointed">
					<span class="b-700 text-blue">News Feed</span>
					<a href="<?=base_url();?>home/new_post" class="btn btn-sm text-white bg-orange pull-right"><i class="fa fa-plus"></i> Create new post</a>
				</div>			
				<div class="panel-body">
                    <div class="row f-list-wrap">
                        <div class="col-md-6">
                            <div class="card bg-grey friend-card">
                                <div class="card-body">
                                    <div class="friend-img">
                                        <img src="<?=base_url();?>assets/img/owner.png" alt="Profile Image">
                                    </div>
                                    <!-- Button Menus -->
                                    <button class="btn btn-info btn-xs pull-right dropdown-toggle"  id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</button>
                                    <div class="dropdown-menu" aria-labelledby="f-menu">
                                        <a class="dropdown-item" href="javascript:;">Book Now</a>
                                        <a class="dropdown-item" href="<?=base_url();?>pet/pet_details">More Details</a>
                                    </div>
                                    <!-- Owner -->
                                    <p class="text-head"><a href="javascript:;">Annah</a> </p>
                                    <!-- Description -->
                                    <p class="b-700 f-14 text-black">Description for Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                    <!-- Address -->
                                    <p class="text-desc f-14 text-black">Los Angeles, CA, USA</p>
                                    <!-- Date to Sit -->
                                    <p class="f-14 text-black">Date to sit: <span class="badge badge-warning">Feb 21, 2019</span> to <span class="badge badge-warning">Feb 22, 2019</span></p>
                                    <!-- Pets and Availability -->  
                                    <p class="b-700 m-t-10 f-14">
                                        <span class="badge bg-orange-l text-white">3 Dogs</span> 
                                        <span class="badge bg-orange-l text-white">2 Cats</span>
                                        <span class="badge badge-success">Available</span>
                                        <span class="badge badge-danger">Not Available</span>
                                    </p>
                                    <!-- Posted -->
                                    <p class="b-700 f-14 text-black"><span class="badge badge-info text-white">Posted: Feb 12, 2019</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-grey friend-card">
                                <div class="card-body">
                                    <div class="friend-img">
                                        <img src="<?=base_url();?>assets/img/owner.png" alt="Profile Image">
                                    </div>
                                    <!-- Button Menus -->
                                    <button class="btn btn-info btn-xs pull-right dropdown-toggle"  id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</button>
                                    <div class="dropdown-menu" aria-labelledby="f-menu">
                                        <a class="dropdown-item" href="javascript:;">Book Now</a>
                                        <a class="dropdown-item" href="<?=base_url();?>pet/pet_details">More Details</a>
                                    </div>
                                    <!-- Owner -->
                                    <p class="text-head"><a href="javascript:;">Annah</a> </p>
                                    <!-- Description -->
                                    <p class="b-700 f-14 text-black">Description for Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                    <!-- Address -->
                                    <p class="text-desc f-14 text-black">Los Angeles, CA, USA</p>
                                    <!-- Date to Sit -->
                                    <p class="f-14 text-black">Date to sit: <span class="badge badge-warning">Feb 21, 2019</span> to <span class="badge badge-warning">Feb 22, 2019</span></p>
                                    <!-- Pets and Availability -->  
                                    <p class="b-700 m-t-10 f-14">
                                        <span class="badge bg-orange-l text-white">3 Dogs</span> 
                                        <span class="badge bg-orange-l text-white">2 Cats</span>
                                        <span class="badge badge-success">Available</span>
                                        <span class="badge badge-danger">Not Available</span>
                                    </p>
                                    <!-- Posted -->
                                    <p class="b-700 f-14 text-black"><span class="badge badge-info text-white">Posted: Feb 12, 2019</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-grey friend-card">
                                <div class="card-body">
                                    <div class="friend-img">
                                        <img src="<?=base_url();?>assets/img/owner.png" alt="Profile Image">
                                    </div>
                                    <!-- Button Menus -->
                                    <button class="btn btn-info btn-xs pull-right dropdown-toggle"  id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</button>
                                    <div class="dropdown-menu" aria-labelledby="f-menu">
                                        <a class="dropdown-item" href="javascript:;">Book Now</a>
                                        <a class="dropdown-item" href="<?=base_url();?>pet/pet_details">More Details</a>
                                    </div>
                                    <!-- Owner -->
                                    <p class="text-head"><a href="javascript:;">Annah</a> </p>
                                    <!-- Description -->
                                    <p class="b-700 f-14 text-black">Description for Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                    <!-- Address -->
                                    <p class="text-desc f-14 text-black">Los Angeles, CA, USA</p>
                                    <!-- Date to Sit -->
                                    <p class="f-14 text-black">Date to sit: <span class="badge badge-warning">Feb 21, 2019</span> to <span class="badge badge-warning">Feb 22, 2019</span></p>
                                    <!-- Pets and Availability -->  
                                    <p class="b-700 m-t-10 f-14">
                                        <span class="badge bg-orange-l text-white">3 Dogs</span> 
                                        <span class="badge bg-orange-l text-white">2 Cats</span>
                                        <span class="badge badge-success">Available</span>
                                        <span class="badge badge-danger">Not Available</span>
                                    </p>
                                    <!-- Posted -->
                                    <p class="b-700 f-14 text-black"><span class="badge badge-info text-white">Posted: Feb 12, 2019</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-grey friend-card">
                                <div class="card-body">
                                    <div class="friend-img">
                                        <img src="<?=base_url();?>assets/img/owner.png" alt="Profile Image">
                                    </div>
                                    <!-- Button Menus -->
                                    <button class="btn btn-info btn-xs pull-right dropdown-toggle"  id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</button>
                                    <div class="dropdown-menu" aria-labelledby="f-menu">
                                        <a class="dropdown-item" href="javascript:;">Book Now</a>
                                        <a class="dropdown-item" href="<?=base_url();?>pet/pet_details">More Details</a>
                                    </div>
                                    <!-- Owner -->
                                    <p class="text-head"><a href="javascript:;">Annah</a> </p>
                                    <!-- Description -->
                                    <p class="b-700 f-14 text-black">Description for Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                    <!-- Address -->
                                    <p class="text-desc f-14 text-black">Los Angeles, CA, USA</p>
                                    <!-- Date to Sit -->
                                    <p class="f-14 text-black">Date to sit: <span class="badge badge-warning">Feb 21, 2019</span> to <span class="badge badge-warning">Feb 22, 2019</span></p>
                                    <!-- Pets and Availability -->  
                                    <p class="b-700 m-t-10 f-14">
                                        <span class="badge bg-orange-l text-white">3 Dogs</span> 
                                        <span class="badge bg-orange-l text-white">2 Cats</span>
                                        <span class="badge badge-success">Available</span>
                                        <span class="badge badge-danger">Not Available</span>
                                    </p>
                                    <!-- Posted -->
                                    <p class="b-700 f-14 text-black"><span class="badge badge-info text-white">Posted: Feb 12, 2019</span></p>
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

  </body>

</html>
