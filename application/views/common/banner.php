<?php $cover_photo = $user_logindata->cover_photo;  $cover_pos = $user_logindata->cover_pos; ?>
<?php $all_pictures = $this->Pictures_model->get_all_pictures();?>
<?php $uid = $this->session->userdata('user_id'); ?>
<header class="masthead bg-primary text-white text-center" <?=($cover_photo) ? 'style="background-image: url('.base_url().'assets/img/pictures/usr'.$uid.'/'.$cover_photo.')"' : '';?>>	
    <button class="btn banner-btn" data-toggle="modal" data-target="#chCover"><i class="fa fa-camera fa-2x"></i> Change Cover </button>
    <?php if($cover_photo){ ?>
    <div class="coverContainer">
        <img class="cover-photo-custom" data-top="0"  data-left="0" src="<?=base_url().'assets/img/pictures/usr'.$uid.'/'.$cover_photo;?>" style="top: <?=($cover_pos) ? $cover_pos.'px' : 'unset';?>;" />
    </div>
    <button class="btn banner-btn-sm repos"><i class="fa fa-arrows-alt fa-2x"></i> Reposition </button>
    <button class="btn banner-btn-sm savePos d-none"><i class="fa fa-save fa-2x"></i> Save Changes </button>
    <p class="covertxt d-none"><i class="fa fa-hand-rock"></i> Drag up or down image to adjust</p>
    <?php } ?>
</header>

    <div class="profile-big">
        <?php $user_img=$user_logindata->user_img; 
            $uid = $this->session->userdata('user_id');
        ?>
        <?php if($user_img) { ?>
            <img src="<?=base_url();?>assets/img/pictures/usr<?=$uid;?>/<?=$user_img;?>" alt="Profile Image">
        <?php }else{ ?>
            <img src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image">
        <?php } ?>
    </div>
    <!-- Select from pictures -->  
    <div class="modal fade" id="chCover" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p class="modal-title f-20 text-black"><i class="fa fa-image"></i> Choose from photos</p>
                </div>
                <div class="modal-body">
                    <form  id="addPhotoAlbumForm">
                        <div class="row">
                        <?php if($all_pictures){ ?>
                            <?php foreach($all_pictures as $img){ extract($img); ?>
                                <div class="col-md-3 resfx">
                                    <div class="thumbnail">
                                        <a href="javascript:;">
                                            <div class="gal-img">
                                                <a href="javascript:;" onclick="setCoverPhoto('<?=$img_name;?>')"><img src="<?=base_url();?>assets/img/pictures/usr<?=$user_id;?>/<?=$img_name;?>" style="width:100%" alt="Picture"></a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else{ ?>
                            <div class="col-md-12">
                                <div class="alert alert-info alert-dismissible f-15" role="alert">
                                    <strong><i class="fa fa-check"></i> Empty!</strong> There are no photos found in your pictures.
                                </div>
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
    