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
                    <div class="m-header bg-orange-l">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="btn btn-circle f-20 btn-sm text-white pull-left"><i class="fa fa-map-marker-alt"></i> Who's near me</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <?php if($getNearPeople){ foreach($getNearPeople as $p){ extract($p); ?>
                                    <div class="col-md-12">
                                        <div class="card bg-grey friend-card">
                                            <div class="card-body">
                                                <div class="friend-img">
                                                    <?php if($user_img) { ?>
                                                        <img src="<?=base_url();?>assets/img/pictures/usr<?=$id;?>/<?=$user_img;?>" alt="Profile Image">
                                                    <?php }else{ ?>
                                                        <img src="<?=base_url();?>assets/img/pictures/default.png" alt="Default Profile Image">
                                                    <?php } ?>
                                                </div>
                                                <div>
                                                    <span class="btn btn-info btn-xs pull-right dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-paw"></i> Options</span>
                                                    <div class="dropdown-menu" aria-labelledby="f-menu">
                                                        <a class="dropdown-item" href="<?=base_url();?>account/view_bio/<?=$id?>">View Profile</a>
                                                        <a onclick="instMsg(<?=$id;?>,'<?=$email;?>')" class="dropdown-item" href="javascript:;">Send Message</a>
                                                    </div>
                                                </div>
                                                <p class="text-head"><a href="<?=base_url();?>account/view_bio/<?=$id?>"><?=($fullname) ? $fullname : "No Name";?></a> </p>
                                                <p class="text-desc"> <?php if($street&&$city&&$zip_code&&$state&&$country){ ?> <?=$street.' '.$city.', '.$zip_code.', '.$state.', '.$country;?><?php } else { echo 'No Address'; }?></p>
                                                <p class="f-14">Email: <span class="b-700 text-black"><?=$email;?></span></p>
                                                <div>
                                                    <button class="btn bg-orange btn-round dropdown-toggle text-white" type="button" id="dropPets" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Book
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropPets">
                                                        <a class="dropdown-item" href="<?=base_url();?>booking/book_this_user/<?=$id?>">Book User</a>
                                                        <?php $get_pets=$this->Friends_model->get_my_pets($id);?>
                                                        <?php if($get_pets){ foreach($get_pets as $pets){ extract($pets); ?>
                                                            <?php if($isAvailable){ ?>
                                                                <a class="dropdown-item" href="<?=base_url();?>booking/book_user_pets/<?=$id?>">Book User Pets</a>
                                                            <?php break; } ?>
                                                        <?php } } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?> 
                                    <div class="row m-t-20">
                                        <div class="col-md-12">
                                            <nav class="text-center">
                                                <?=$links;?>
                                            </nav>
                                        </div>
                                    </div>
                                    <?php } else{ ?>
                                    <div class="col-md-12 m-t-20">
                                        <div class="alert alert-info f-15">
                                            <b><i class="fa fa-check"></i> Oops!</b> We coudn't find poeple near you.
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6 map-section">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" id="cur_lat" name="cur_lat" />
                                    <input type="hidden" id="cur_lng" name="cur_lng" /> 
                                    <div id="map" style="height:800px;"></div>
                                </div>
                            </div>
                        </div>
                    </div> <!--Close row-->
                </div> <!-- Close Main Content -->
            </div>
        </section>
    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
    <?php $this->load->view('mail/pop-ups/inst_msg');?>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKmCY9-diuULK1hyHnDkElDSPT6mbfB7w&libraries=geometry&sensor=false"></script> -->
    <script src="<?=base_url();?>assets/js/initializations/people_near_me_map.js"></script>
  </body>

</html>
