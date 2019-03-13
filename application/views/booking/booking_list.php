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
					<span class="b-700 text-blue">Choose Pet to Book</span>
					<a href="javascript:;" class="btn btn-sm text-white bg-orange pull-right"><i class="fa fa-plus"></i> Create new post</a>
				</div>			
				<div class="panel-body">

                    <div class="row f-list-wrap">
                        <div class="col-md-6">
                            <div class="card bg-grey friend-card">
                                <div class="card-body">
                                    <div class="friend-img">
                                        <img src="<?=base_url();?>assets/img/owner.png" alt="Profile Image">
                                    </div>
                                    <button class="btn btn-info btn-xs pull-right dropdown-toggle"  id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</button>
                                    <div class="dropdown-menu" aria-labelledby="f-menu">
                                        <a class="dropdown-item" href="javascript:;">Booking</a>
                                        <a class="dropdown-item" href="<?=base_url();?>pet/pet_details">Pet Details</a>
                                    </div>
                                    <p class="text-head"><a href="javascript:;">Tigger</a> </p>
                                    <p class="text-desc">Los Angeles, CA, USA</p>
                                    <p class="b-700 m-t-10 f-14">Category: <span class="b-700 text-black">Dog</span></p>
                                    <p class="b-700 f-14">Breed: <span class="b-700 text-black">Dog</span> </p>
                                    <p class="b-700 f-14">Post Date: <span class="b-700 text-black">Dog</span> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-grey friend-card">
                                <div class="card-body">
                                    <div class="friend-img">
                                        <img src="<?=base_url();?>assets/img/owner.png" alt="Friend Image">
                                    </div>
                                    <button class="btn btn-info btn-xs pull-right dropdown-toggle"  id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</button>
                                    <div class="dropdown-menu" aria-labelledby="f-menu">
                                        <a class="dropdown-item" href="javascript:;">Booking</a>
                                        <a class="dropdown-item" href="<?=base_url();?>pet/pet_details">Pet Details</a>
                                    </div>
                                    <p class="text-head"><a href="javascript:;">Tigger</a> </p>
                                    <p class="text-desc">Los Angeles, CA, USA</p>
                                    <p class="b-700 m-t-10 f-14">Category: <span class="b-700 text-black">Dog</span></p>
                                    <p class="b-700 f-14">Breed: <span class="b-700 text-black">Dog</span> </p>
                                    <p class="b-700 f-14">Post Date: <span class="b-700 text-black">Dog</span> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-grey friend-card">
                                <div class="card-body">
                                    <div class="friend-img">
                                        <img src="<?=base_url();?>assets/img/owner.png" alt="Friend Image">
                                    </div>
                                    <button class="btn btn-info btn-xs pull-right dropdown-toggle"  id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</button>
                                    <div class="dropdown-menu" aria-labelledby="f-menu">
                                        <a class="dropdown-item" href="javascript:;">Booking</a>
                                        <a class="dropdown-item" href="<?=base_url();?>pet/pet_details">Pet Details</a>
                                    </div>
                                    <p class="text-head"><a href="javascript:;">Tigger</a> </p>
                                    <p class="text-desc">Los Angeles, CA, USA</p>
                                    <p class="b-700 m-t-10 f-14">Category: <span class="b-700 text-black">Dog</span></p>
                                    <p class="b-700 f-14">Breed: <span class="b-700 text-black">Dog</span> </p>
                                    <p class="b-700 f-14">Post Date: <span class="b-700 text-black">Dog</span> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-grey friend-card">
                                <div class="card-body">
                                    <div class="friend-img">
                                        <img src="<?=base_url();?>assets/img/owner.png" alt="Friend Image">
                                    </div>
                                    <button class="btn btn-info btn-xs pull-right dropdown-toggle"  id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</button>
                                    <div class="dropdown-menu" aria-labelledby="f-menu">
                                        <a class="dropdown-item" href="javascript:;">Booking</a>
                                        <a class="dropdown-item" href="<?=base_url();?>pet/pet_details">Pet Details</a>
                                    </div>
                                    <p class="text-head"><a href="javascript:;">Tigger</a> </p>
                                    <p class="text-desc">Los Angeles, CA, USA</p>
                                    <p class="b-700 m-t-10 f-14">Category: <span class="b-700 text-black">Dog</span></p>
                                    <p class="b-700 f-14">Breed: <span class="b-700 text-black">Dog</span> </p>
                                    <p class="b-700 f-14">Post Date: <span class="b-700 text-black">Dog</span> </p>
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
