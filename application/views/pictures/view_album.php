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
                <?php $user_img    = $user_logindata->user_img; ?>
                <?php $cover_photo = $user_logindata->cover_photo; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <i class="fa fa-image f-25 text-blue"></i> <?=$view_album["album_name"];?> (<?=$this->Album_model->count_images($view_album["album_id"]);?>)
                        </div>
                        <div class="col-md-12">
                           <p class="album-desc f-12 m-t-10 m-b-0"><?=($view_album["album_desc"]) ? $view_album["album_desc"] : "No Desription.";?></p>
                        </div>
                        <div class="col-md-12">
                            <a href="<?=base_url();?>pictures/pictures" class="p-nav b-700 f-14 active">Album Photos</a>
                            <a href="<?=base_url();?>pictures/pictures" class="p-nav b-700 f-14">All Photos</a>
                            <a href="<?=base_url();?>album/albums" class="p-nav b-700 f-14">Albums</a>
                            <?php $cntPhotos = $this->Album_model->count_images($view_album["album_id"]);?>
                            <?php if($cntPhotos > 0){?>
                                <div class="selOption pull-right">
                                    <span class="btn bg-blue-a btn-xs text-white dropdown-toggle" id="option-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</span>
                                    <div class="dropdown-menu option-menu" aria-labelledby="option-menu">
                                        <a onclick="selectAll(1)" class="dropdown-item selAll" href="javascript:;">Select All</a>
                                        <a onclick="delSelected(2)" class="dropdown-item delSelBtn" href="javascript:;">Remove Selected</a>
                                        <a onclick="delSelected(1)" class="dropdown-item delSelBtn" href="javascript:;">Delete Selected</a>
                                        <a onclick="delImg(0, 0, 2)" class="dropdown-item" href="javascript:;">Delete All</a>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="selOption pull-right">
                                <span class="btn bg-orange-l btn-xs text-white dropdown-toggle m-r-5" id="sel-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-plus"></i> Add Photos</span>
                                <div class="dropdown-menu" aria-labelledby="sel-menu">
                                    <a class="dropdown-item" href="<?=base_url();?>pictures/add_photos/2/<?=$view_album['album_id'];?>">Select from device</a>
                                    <a data-toggle="modal" data-target="#selPics" class="dropdown-item" href="javascript:;">Select from photos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gal-wrapper">
                    <?php if($view_album_images){?>
                        <form action="javascript:;" id="formImgData">
                            <div class="row m-t-10">  
                            <div class="col-md-12" id="reload"></div>
                                <?php foreach($view_album_images as $images){ extract($images); ?>
                                    <div class="col-lg-3 col-md-6 albumImg" id="albumImg<?=$img_id;?>">
                                    <?php $imgD = array($user_img, $cover_photo); ?>
                                        <div class="thumbnail <?=(!(in_array($img_name, $imgD))) ? '': 'highlight';?> myAlbumImg">
                                            <a href="javascript:;">
                                                <div class="gal-img">
                                                    <img class="zoomable" src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$img_name;?>" style="width:100%" alt="Picture">
                                                </div>
                                                <a href="javascript:;" onclick="remFromAlbum(<?= $img_id?>)">
                                                    <span class="cust-mod-close bg-orange-l-a rmImg"  data-toggle="tooltip" data-placement="left" data-html="true" title="Remove"><i class="fa fa-times text-white"></i></span>
                                                </a>
                                                <span class="btmleft_set_pri" data-toggle="tooltip" <?=($img_name==$user_img) ? 'title="Used as profile image"' : "onclick=\"setPriPhoto('".$img_name."')\"  title='Set as primary image'";?>>
                                                    <i class="fa fa-<?=($img_name==$user_img) ? 'check' : 'user';?> text-white"></i>
                                                </span>
                                                <span class="btmleft_set_cver" data-toggle="tooltip" <?=($img_name==$cover_photo) ? 'title="Used as cover photo"' : "onclick=\"setCoverPhoto('".$img_name."')\"  title='Set as cover photo'";?>>
                                                    <i class="fa fa-<?=($img_name==$cover_photo) ? 'check' : 'image';?> text-white"></i>
                                                </span>
                                                <?php if(!(in_array($img_name,$imgD))){ ?>
                                                    <a href="javascript:;" onclick="delImg(<?=$img_id?>, '<?= $img_name?>', 1)">
                                                        <span class="cust-mod-edit bg-red rmImg" data-toggle="tooltip" data-placement="left" data-html="true" title="Delete" ><i class="fa fa-trash text-white"></i></span>
                                                    </a>
                                                    <div class="custom-control custom-checkbox m-b-5 floatCBox">
                                                        <input type="checkbox" class="custom-control-input ai_box" id="<?=$img_id?>" name="img_id[]" value="<?=$img_id?>">
                                                        <label class="custom-control-label" for="<?=$img_id?>"></label>
                                                    </div>
                                                <?php } ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-md-12" id="emptyImg"></div>
                            </div>
                        </form>
                    <?php } else{ ?>
                        <div class="alert alert-success alert-dismissible f-15" role="alert">
                            <strong><i class="fa fa-check"></i> Empty!</strong> You have no photos on this album.
                        </div>
                    <?php } ?>
                </div>
          </div>
          <!-- Close Main Content -->
	  </div>
    </section>
    
    <!-- Footer -->
    <?php $this->load->view('common/footer');?>

    <!-- Select pictures options -->  

    <!-- Select from pictures -->  
    <div class="modal fade" id="selPics" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-image"></i> Choose from photos</p>
                </div>
                <div class="modal-body">
                    <form action="javascript:;" id="addPhotoAlbumForm">
                        <div class="row">
                        <?php if($get_img_no_album){ ?>
                            <?php foreach($get_img_no_album as $img){ extract($img); ?>
                                <div class="col-md-3">
                                    <div class="thumbnail">
                                        <a href="javascript:;">
                                            <div class="gal-img">
                                                <img src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$img_name;?>" style="width:100%" alt="Picture">
                                            </div>
                                            <div class="custom-control custom-checkbox m-b-5 floatCBox">
                                                <input type="checkbox" class="custom-control-input selFromAlbumBox" id="<?=$img_id?>" name="img_id[]" value="<?=$img_id?>">
                                                <label class="custom-control-label" for="<?=$img_id?>"></label>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else{ ?>
                            <div class="col-md-12">
                                <div class="alert alert-info alert-dismissible f-15" role="alert">
                                    <strong><i class="fa fa-check"></i> Empty!</strong> There are no photos found that has no album.
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($get_img_no_album){ ?>
                            <div class="col-md-12 text-center">
                                <button onclick="transImgToAlbum(<?=$view_album['album_id'];?>)" type="button" class="btn bg-orange sub-btn"><i class="fa fa-save"></i> Add to Albums</button>
                            </div>
                        <?php } ?>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
  </body>
</html>
