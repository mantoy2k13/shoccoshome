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
                        <div class="col-md-12 map-section">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" id="cur_lat" name="cur_lat" />
                                    <input type="hidden" id="cur_lng" name="cur_lng" /> 
                                    <div id="map" style="height:800px;"></div>
                                </div>
                            </div>
                            <div class="row m-t-20">
                                <div class="col-md-12">
                                    <nav class="text-center">
                                        <?=$links;?>
                                    </nav>
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
