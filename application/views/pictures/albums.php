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
                    <input type="hidden" value="<?=(isset($_SESSION['album_msg'])) ? $_SESSION['album_msg'] : '0';?>" id="getAlbumAlert">
                        <div class="col-md-12">
                            <i class="fa fa-image f-25 text-blue"></i> Albums
                        </div>
                        <div class="col-md-12 m-t-10">
                            <a href="<?=base_url();?>pictures/pictures" class="p-nav b-700 f-14">All Photos</a>
                            <a href="<?=base_url();?>album/albums" class="p-nav b-700 f-14 active">Albums</a>
                            <a href="javascript:;" class="btn bg-orange-l btn-xs pull-right text-white"  onClick="add_album()"><i class="fa fa-plus"></i> Create Album</a>
                        </div>
                    </div>
                </div>
                <div class="gal-wrapper">
                    <?php if($all_albums){?>
                        <div class="row">    
                            <?php foreach($all_albums as $album){ extract($album); ?>
                                <div class="col-md-3">
                                    <div class="thumbnail" onclick="location.href='<?=base_url();?>album/view_album/<?=$album_id;?>'">
                                        <a href="javascript:;">
                                            <div class="gal-img">
                                                <img src="<?=base_url();?>assets/img/image-icon.png" style="width:100%" alt="Picture">
                                            </div>
                                        </a>
                                        <p class="m-t-10 m-b-0 f-15 b-700 text-center text-black"><?=$album_name;?> (10)</p>
                                        <p class="m-b-0 f-12 text-center album-desc"><?=$album_desc;?></p>
                                    </div>
                                    <a href="javascript:;" id="<?=$album_id?>" class="update_album">
                                        <span class="cust-mod-edit" data-toggle="tooltip" data-html="true" data-placement="left" title="Edit Albums">
                                            <i class="fa fa-pen text-white"></i>
                                        </span>
                                    </a>
                                    <a href="javascript:;" id="<?=$album_id?>" onclick="delete_album(<?= $album_id?>)">
                                        <span class="cust-mod-close rmImg" title="Remove Album"  data-toggle="tooltip" data-placement="left" data-html="true"><i class="fa fa-times text-white"></i></span>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else{ ?>
                        <div class="alert alert-success alert-dismissible f-15" role="alert">
                            <strong><i class="fa fa-check"></i> Empty!</strong> You have no albums added.
                        </div>
                    <?php } ?>
                </div>
          </div>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('pictures/add_album');?>
    <?php $this->load->view('common/footer');?>
    
  </body>
</html>
