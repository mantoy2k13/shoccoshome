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
		  <div class="col-md-9 m-t-10 p-l-0 p-details">
            <div class="panel panel-default bg-gray">
				<div class="panel-heading pointed">
					<span class="b-700 text-blue">My Pet Lists</span>
					<a href="<?=base_url();?>pet/add_new_pet" class="btn btn-sm text-white bg-orange pull-right"><i class="fa fa-plus"></i> Add New Pet</a>
				</div>			
				<div class="panel-body">
                    <input type="hidden" value="<?=(isset($_SESSION['pet_msg'])) ? $_SESSION['pet_msg'] : '0';?>" id="getPetAlert">
                    <div class="row f-list-wrap">
                        <?php if($get_pet_data){ ?>
                        <div class="col-md-12 m-t-20" id="emptyPets"></div>
                        <?php foreach($get_pet_data as $data){ extract($data);  ?>
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
                                            <a class="dropdown-item" href="<?=base_url();?>pet/add_new_pet/<?=$pet_id; ?>">Edit Pet</a>
                                            <a class="dropdown-item" href="javascript:;" onclick="delPet(<?=$pet_id; ?>)">Delete Pet</a>
                                            <a class="dropdown-item" href="<?=base_url();?>pet/pet_details/<?=$pet_id; ?>">Pet Details</a>
                                        </div>

                                        <p class="text-head"><a href="<?=base_url();?>pet/pet_details/<?=$pet_id; ?>"><?= $pet_name; ?></a> </p>
                                        <p class="text-desc"><?= $description; ?></p>
                                        <p class="b-700 m-t-10 f-14">Category: <span class="b-700 text-black"><?= $cat_name; ?></span></p>
                                        <p class="b-700 f-14">Breed: <span class="b-700 text-black"><?= $breed_name; ?> </span></p>
                                        <p class="b-700 f-14">Added: <span class="b-700 badge badge-info font-san-serif"><?=$this->Account_model->relative_date(strtotime($date_added)); ?> </span></p>
                                    </div>
                                </div>
                            </div>
                        <?php } }else{ ?>
                            <div class="col-md-12 m-t-20">
                                <div class="alert alert-info f-15">
                                    <b><i class="fa fa-check"></i> Empty!</b> You have no pets added. Click <a href="<?=base_url();?>pet/add_new_pet">here</a> to add your pet.
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-md-12">
                            <nav class="text-center">
                                <?=$links;?>
                            </nav>
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
