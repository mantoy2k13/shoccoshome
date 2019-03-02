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
					<span class="b-700 text-blue">Search pet results...</span>
				</div>			
				<div class="panel-body">
                    <div class="row f-list-wrap">
                        <?php
                        //echo "<pre>";
                        //print_r($search_results);
                       // echo "</pre>";

                        if($search_results){ foreach($search_results as $res) {?>
                            <div class="col-md-6">
                                <div class="card bg-grey friend-card">
                                    <div class="card-body">
                                        <div class="friend-img">
                                     
                                            <img src="<?=base_url();?>assets/img/owner.png" alt="Profile Image">
                                          
                                        </div>
                                        <button class="btn btn-info btn-xs pull-right dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</button>
                                        <div class="dropdown-menu" aria-labelledby="f-menu">
                                            <a class="dropdown-item" href="<?=base_url();?>home/pet_details/<?=$res->pet_id;?>">Pet Details</a>
                                            <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$res->user_id;?>">View Owner</a>
                                        </div>
                                        <p class="text-head"><a href="<?=base_url();?>home/pet_details/<?=$res->pet_id;?>"><?=$res->pet_name;?></a> </p>
                                        <p class="text-desc"><?=$res->description;?></p>
                                        <p class="b-700 m-t-10 f-14">Category: <span class="b-700 text-black"><?=$res->cat_name;?></span></p>
                                        <p class="b-700 f-14">Breed: <span class="b-700 text-black"><?=$res->breed_name;?> </span></p>
                                        <p class="b-700 f-14">Color: <span class="b-700 text-black"><?=$res->color_name;?> </span></p>
                                    </div>
                                </div>
                            </div>
                        <?php } } else {?>
                            <div class="col-md-12 m-t-20">
                                <div class="alert alert-info">
                                    <strong><i class="fa fa-check"></i> Empty!</strong> There are no pets matches your search.</i>.
                                </div>
                            </div>
                        <?php } ?>



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
