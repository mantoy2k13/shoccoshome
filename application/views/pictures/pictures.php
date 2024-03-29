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
		  <div class="col-md-9 m-t-10 p-l-0">
                <div class="pic-head bg-greyish">
                <input type="hidden" value="<?=(isset($_SESSION['upl_msg'])) ? $_SESSION['upl_msg'] : '0';?>" id="getUplAlert">
                <?php $user_img    = $user_logindata->user_img; ?>
                <?php $cover_photo = $user_logindata->cover_photo; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <i class="fa fa-image f-25 text-blue"></i> Photos
                        </div>
                        <div class="col-md-12 m-t-10">
                            <a href="<?=base_url();?>pictures/pictures" class="p-nav b-700 f-14 active">All Photos</a>
                            <a href="<?=base_url();?>album/albums" class="p-nav b-700 f-14">Albums</a>

                            <?php $cntPhotos = $this->Pictures_model->count_all_photos();?>
                            <?php if($cntPhotos > 0){?>
                                <span class="btn bg-blue-a btn-xs pull-right text-white dropdown-toggle" id="option-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</span>
                                <div class="dropdown-menu option-menu" aria-labelledby="option-menu">
                                    <a onclick="selectAll(1)" class="dropdown-item selAll" href="javascript:;">Select All</a>
                                    <a onclick="delSelected(1)" class="dropdown-item delSelBtn" href="javascript:;">Delete Selected</a>
                                </div>
                            <?php } ?>
                            <a href="<?=base_url();?>pictures/add_photos/1/0" class="btn bg-orange-l btn-xs btn-xs pull-right text-white m-r-5"><i class="fa fa-plus"></i> Add Photos</a>
                        </div>
                    </div>
                </div>
                <div class="gal-wrapper">
                    <?php if($all_pictures){ ?>
                        <form action="javascript:;" id="formImgData">
                            <div class="row">
                                <?php foreach($all_pictures as $pics){ extract($pics); ?>
                                    <div class="col-lg-3 col-md-6 albumImg" id="albumImg<?=$img_id;?>">
                                    <?php $imgD = array($user_img, $cover_photo);?>
                                        <?php $album = $this->Pictures_model->get_album_name($album_id);?>
                                        <div class="thumbnail <?=((in_array($img_name, $imgD))) ? 'highlight': '';?> myAlbumImg" data-toggle="tooltip" title="<?=($album['album_name']) ? $album['album_name'] : 'No Album' ?>">
                                            <a href="javascript:;">
                                                <div class="gal-img">
                                                    <img class="zoomable" src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$img_name;?>" style="width:100%" alt="Image <?=$img_name;?>">
                                                </div>
                                                <span class="btmleft_set_pri" data-toggle="tooltip" <?=($img_name==$user_img) ? 'title="Used as profile image"' : "onclick=\"setPriPhoto('".$img_name."')\"  title='Set as primary image'";?>>
                                                    <i class="fa fa-<?=($img_name==$user_img) ? 'check':'user';?> text-white"></i>
                                                </span>
                                                <span class="btmleft_set_cver" data-toggle="tooltip" <?=($img_name==$cover_photo) ? 'title="Used as cover photo"' : "onclick=\"setCoverPhoto('".$img_name."')\"  title='Set as cover photo'";?>>
                                                    <i class="fa fa-<?=($img_name==$cover_photo) ? 'check' : 'image';?> text-white"></i>
                                                </span>
                                                <?php if(!(in_array($img_name, $imgD))){?>
                                                <div class="custom-control custom-checkbox m-b-5 floatCBox">
                                                    <input type="checkbox" class="custom-control-input ai_box" id="<?=$img_id?>" name="img_id[]" value="<?=$img_id?>">
                                                    <label class="custom-control-label" for="<?=$img_id?>"></label>
                                                </div>
                                                <a href="javascript:;" onclick="delImg(<?=$img_id?>, '<?= $img_name?>', 1)">
                                                    <span class="cust-mod-close bg-red" data-toggle="tooltip" data-placement="left" data-html="true" title="Delete" ><i class="fa fa-times text-white"></i></span>
                                                </a>
                                                <?php }?>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-md-12" id="emptyImg"></div>
                            </div>
                        </form>
                        <div class="row m-t-20">
                            <div class="col-md-12">
                                <nav class="text-center">
                                    <?=$links;?>
                                </nav>
                            </div>
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