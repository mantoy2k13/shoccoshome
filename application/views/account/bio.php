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
          <?php foreach($view_bio as $bio){ extract($bio); ?>
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
                                <?=($gender)?$gender:"No Gender";?>
                            </p>
                            <p class="f-15"><span class="text-black b-700">Occupation</span><br>
                                <?=($occupation)?$occupation:"No Occupation";?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 bio-head">
                                <div class="bio-img">
                                    <img src="<?=base_url();?><?=($user_img)?'assets/img/profile_pics/'.$user_img:'assets/img/profile2.png';?>" alt="Profile Image">
                                </div>
                                <a href="<?=base_url();?>account/account" class="btn bg-orange text-white pull-right btn-sm"><i class="fa fa-edit"></i> Edit Bio</a>
                                <p class="f-30 b-700 text-orange-d m-b-0"><?=$getName;?></p>
                                <p class="f-25 b-700 text-blue m-b-0"><?=($occupation)?$occupation:'No Occupation';?></p>
                                <p class="f-20 m-b-0 text-black-l"> <?=($address)?$address:'No Address';?></p>
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
                                                    <i class="fa fa-paw f-25 text-blue"></i> Pets
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m-t-10 bio-pet-grp">
                                            <?php $my_pets = $this->Account_model->get_my_pets($id);?>
                                            <?php if($my_pets){foreach($my_pets as $pets){ extract($pets); ?>
                                                <div class="col-md-6">
                                                    <div class="card bg-grey friend-card">
                                                        <div class="card-body">
                                                            <div class="pet-bio-img">
                                                                <img src="<?=base_url();?><?= ($primary_pic) ? 'assets/img/pet/'.$primary_pic : 'assets/img/owner.png';?>" alt="Profile Image">
                                                            </div>
                                                            <button class="btn btn-info btn-xs pull-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i></button>
                                                            <div class="dropdown-menu" aria-labelledby="f-menu">
                                                                <a class="dropdown-item" href="<?=base_url();?>home/add_new_pet/<?=$pet_id;?>">Edit Pet</a>
                                                                <a class="dropdown-item" href="<?=base_url();?>home/pet_details/<?=$pet_id;?>">Pet Details</a>
                                                            </div>
                                                            <p class="text-blue f-20 b-700"><a href="<?=base_url();?>home/pet_details/<?=$pet_id;?>"><?=$pet_name;?></a> </p>
                                                            <p class="f-15 text-black"><?=$description;?></p>
                                                            <p class="b-700 f-14">Breed: <span class="b-700 text-black"><?=$breed_name;?> (<?=$cat_name;?>)</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } } else { ?>
                                                <div class="col-md-12">
                                                    <div class="alert alert-info f-15">
                                                        <strong><i class="fa fa-check"></i> Empty!</strong> You have no pets added. Click <a href="<?=base_url();?>home/add_new_pet">here</a> to add new pets.
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <?php } ?>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>

  </body>

</html>
