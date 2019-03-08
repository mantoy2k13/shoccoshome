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
                            <i class="fa fa-image f-25 text-blue"></i> <?=$view_album["album_name"];?> (<?=$this->Album_model->count_images($view_album["album_id"]);?>)
                        </div>
                        <div class="col-md-12">
                           <p class="album-desc f-12 m-t-10 m-b-0"><?=($view_album["album_desc"]) ? $view_album["album_desc"] : "No Desription.";?></p>
                        </div>
                        <div class="col-md-12">
                            <a href="<?=base_url();?>pictures/pictures" class="p-nav b-700 f-14 active">Album Photos</a>
                            <a href="<?=base_url();?>pictures/pictures" class="p-nav b-700 f-14">All Photos</a>
                            <a href="<?=base_url();?>album/albums" class="p-nav b-700 f-14">Albums</a>
                            <a href="<?=base_url();?>pictures/add_photos" class="btn bg-orange btn-xs pull-right text-white"><i class="fa fa-pen"></i> Edit Album</a>
                            <a href="javascript:;" data-toggle="modal" data-target="#addPhotos" class="btn bg-orange-l btn-xs pull-right text-white m-r-5"><i class="fa fa-plus"></i> Add Photos</a>
                        </div>
                    </div>
                </div>
                <div class="gal-wrapper">
                    <?php if($view_album_images){?>
                        <div class="row img-btn-set">
                            <div class="col-md-12 text-center">
                                <a href="javascript:;" class="btn bg-blue-a text-white btn-xs"><i class="fa fa-copy"></i> Select All </a>
                                <a href="javascript:;" class="btn bg-orange text-white btn-xs"><i class="fa fa-trash"></i> Delete </a>
                                <a href="javascript:;" class="btn bg-orange-l text-white btn-xs"><i class="fa fa-times"></i> Remove </a>
                            </div>
                        </div>
                        <div class="row m-t-10">  
                            <?php foreach($view_album_images as $images){ extract($images); ?>
                                <div class="col-md-3" id="albumImg<?=$img_id;?>">
                                    <div class="thumbnail">
                                        <a href="javascript:;">
                                            <div class="gal-img">
                                                <img class="zoomable" src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$img_name;?>" style="width:100%" alt="Picture">
                                            </div>
                                            <a href="javascript:;" onclick="remFromAlbum(<?= $img_id?>)">
                                                <span class="cust-mod-close bg-orange-l-a rmImg"  data-toggle="tooltip" data-placement="left" data-html="true" title="Remove"><i class="fa fa-times text-white"></i></span>
                                            </a>
                                            <a href="javascript:;" onclick="delImg(<?= $img_id?>, '<?= $img_name?>')">
                                                <span class="cust-mod-edit bg-red rmImg" data-toggle="tooltip" data-placement="left" data-html="true" title="Delete" ><i class="fa fa-trash text-white"></i></span>
                                            </a>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-12 emptyImgMsg"></div>
                        </div>
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

    <!-- Select pictures options -->  
    <div class="modal fade" id="addPhotos" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?=base_url();?>mail/send_message" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <p class="modal-title f-20 text-black"><i class="fa fa-image"></i> Add Photos</p>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:;" data-toggle="modal" data-target="#selDevice" class="chooseLocal">
                                    <i class="fa fa-desktop"></i> Choose from your device
                                </a>
                                <span class="or">- or -</span>
                                <a href="javascript:;" data-toggle="modal" data-target="#selPics" class="chooseAlbum">
                                    <i class="fa fa-image"></i> Choose from your photos
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Select from devices -->  
    <div class="modal fade" id="selDevice" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?=base_url();?>pictures/add_all_photos/view_album" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <p class="modal-title f-20 text-black"><i class="fa fa-image"></i> Choose from device</p>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-md-12 m-t-20">
                                <div class="card">
                                    <div class="card-body drop-images text-center">
                                        <p><i class="fa fa-cloud-download-alt fa-3x text-orange"></i></p>
                                        <p class="text-black">Drag and Drop Images here or <br>Click to Upload</p>
                                        <input type="file" class="drag-files" id="uploadFiles" multiple="multiple" name="images_file[]" accept=".gif, .png, .jpg, .jpeg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 m-t-20 my-upload-pets text-center">
                                <label for="">Uploaded Images</label>
                                <input type="hidden" name="album_id" value="<?=$view_album['album_id'];?>">
                                <div class="card">
                                    <div class="card-body uploaded-images">
                                        <div class="row uploaded-files">
                                            <div class="col-md-12 emptyImgMsg">
                                                <div class="alert alert-danger f-15" role="alert">
                                                    <strong><i class="fa fa-check"></i> Empty!</strong> Please upload  image less than 3 mb of size.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" id="saveImgBtn" class="btn bg-orange sub-btn" disabled><i class="fa fa-save"></i> Save images</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </form>
        </div>
    </div>

    <!-- Select from pictures -->  
    <div class="modal fade" id="selPics" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?=base_url();?>mail/send_message" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <p class="modal-title f-20 text-black"><i class="fa fa-image"></i> Choose from photos</p>
                    </div>
                    <div class="modal-body">
                        <form action="<?=base_url();?>pictures/add_photo_to_album" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <?php //foreach($all_pictures as $pics){ extract($pics); ?>
                                    <div class="col-md-3">
                                        <div class="thumbnail">
                                            <a href="javascript:;">
                                                <div class="gal-img">
                                                    <img src="<?=base_url();?>assets/img/pictures/usr17/p17_5c8234f7e4fab.jpg" style="width:100%" alt="Image">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php// } ?>
                                <div class="col-md-12 text-center">
                                    <button type="submit" id="savePhotosBtn" class="btn bg-orange sub-btn" disabled><i class="fa fa-save"></i> Add to Albums</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>

  </body>
</html>
