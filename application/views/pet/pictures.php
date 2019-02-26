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
                <div class="pic-head bg-greyish">
                    <div class="row">
                        <div class="col-md-12">
                            <i class="fa fa-image f-25 text-blue"></i> Photos
                        </div>
                        <div class="col-md-12 m-t-10">
                            <a href="javascript:;" class="p-nav b-700 f-14 active">All Photos</a>
                            <a href="javascript:;" class="p-nav b-700 f-14">Albums</a>
                            <a href="javascript:;" class="btn bg-orange-l btn-xs pull-right m-l-10"><i class="fa fa-plus"></i> Add Photos</a>
                            <a href="javascript:;" class="btn bg-orange-l btn-xs pull-right"><i class="fa fa-plus"></i> Create Album</a>
                        </div>
                    </div>
                </div>
                <div class="gal-wrapper">
                    <!-- daryl 
                        fetch all pets
                    -->
                    <?php if(count($all_pictures) > 0):?>
                        <?php if(is_array($all_pictures) || is_object($all_pictures)):?>
                            <?php foreach($all_pictures as $all_pics):
                                $pet_images = $all_pics->pet_images;
                                $all_pets = json_decode($pet_images);
                            ?>
                            <div class="row">
                                <?php foreach($all_pets as $all_pet):?>
                                     <div class="col-md-3">
                                        <div class="thumbnail">
                                            <a href="javascript:;">
                                                <div class="gal-img">
                                                    <img class="zoomable" src="<?=base_url();?><?php echo $all_pet;?>" style="width:100%" alt="Profile Image">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <?php endforeach;?>
                            <?php else:?>
                                 <div class="gal-img">
                                    <img src="<?=base_url();?>assets/img/owner.png" style="width:100%" alt="Profile Image">
                                 </div>
                        <?php endif;?>
                    <?php else:?>
                        <div class="alert alert-success alert-dismissible f-15" role="alert">
                            <strong><i class="fa fa-check"></i> Empty!</strong> You have no pet pictures uploaded.
                        </div>
                    <?php endif?>
                    <!-- end fetch pets-->
                </div>
          </div>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>

  </body>
</html>
