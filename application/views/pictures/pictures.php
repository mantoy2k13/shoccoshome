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
                <input type="hidden" value="<?=(isset($_SESSION['upl_msg'])) ? $_SESSION['upl_msg'] : '0';?>" id="getUplAlert">
                    <div class="row">
                        <div class="col-md-12">
                            <i class="fa fa-image f-25 text-blue"></i> Photos
                        </div>
                        <div class="col-md-12 m-t-10">
                            <a href="<?=base_url();?>pictures/pictures" class="p-nav b-700 f-14 active">All Photos</a>
                            <a href="<?=base_url();?>album/albums" class="p-nav b-700 f-14">Albums</a>
                            <a href="<?=base_url();?>pictures/add_photos" class="btn bg-orange-l btn-xs pull-right text-white"><i class="fa fa-plus"></i> Add Photos</a>
                        </div>
                    </div>
                </div>
                <div class="gal-wrapper">
                    <?php if($all_pictures){ ?>
                        <div class="row">
                            <?php foreach($all_pictures as $pics){ extract($pics); ?>
                                <div class="col-md-3">
                                    <div class="thumbnail">
                                        <a href="javascript:;">
                                            <div class="gal-img">
                                                <img class="zoomable" src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$img_name;?>" style="width:100%" alt="Image <?=$img_name;?>">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-success alert-dismissible f-15" role="alert">
                            <strong><i class="fa fa-check"></i> Empty!</strong> You have no pet pictures uploaded.
                        </div>  
                    <?php } ?>    
                </div>
          </div>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>

  </body>
</html>
