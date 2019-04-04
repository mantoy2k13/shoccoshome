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
                                <span class="btn btn-circle f-20 btn-sm text-white pull-left"> Who's near me</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-grey friend-card">
                                <div class="card-body">
                                    <div class="friend-img">
                                        <img src="http://localhost/shocco_2019/assets/img/pictures/usr27/p27_5c9af39b7ce5d.jpg" alt="Profile Image">
                                    </div>
                                    <div class="options27">
                                        <span class="badge badge-default pull-right b-hover dropdown-toggle" id="f-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-check"></i> Friends</span>
                                        <div class="dropdown-menu" aria-labelledby="f-menu">
                                            <a onclick="request_friends(27,3,'tom2@yopmail.com')" class="dropdown-item" href="javascript:;">Unfriend</a>
                                            <a class="dropdown-item" href="http://localhost/shocco_2019/account/view_bio/27">View Profile</a>
                                            <a onclick="instMsg(27,'tom2@yopmail.com')" class="dropdown-item" href="javascript:;">Send Message</a>
                                        </div>
                                    </div>
                                    <p class="text-head"><a href="http://localhost/shocco_2019/account/view_bio/27">Host Account</a> </p>
                                    <p class="text-desc">  123 mandaue, 6014, CA, United States</p>
                                    <p class="f-14">Email: <span class="b-700 text-black">tom2@yopmail.com</span></p>
                                    <p class="text-desc"></p>
                                    <div class="dropdown">
                                        <button class="btn bg-orange btn-round dropdown-toggle text-white" type="button" id="dropPets" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            View Pets
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropPets">
                                            <a class="dropdown-item" href="javascript:;">No pets found.</a>
                                        </div>
                                    </div>
                                </div>
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
                    </div>
                </div> <!-- Close Main Content -->
            </div>
        </section>
    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKmCY9-diuULK1hyHnDkElDSPT6mbfB7w&libraries=geometry&sensor=false"></script>
    <script src="<?=base_url();?>assets/js/initializations/people_near_me_map.js"></script>
  </body>

</html>
