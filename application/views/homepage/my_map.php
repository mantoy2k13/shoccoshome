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
                    <div class="m-header bg-orange-l">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="btn btn-circle f-20 btn-sm text-white pull-left"><i class="fa fa-map-marker"></i> My Map</span>
                            </div>
                        </div>
                    </div>
                    <!-- My Booking Request Summary -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?=base_url();?>home/set_radius_length" method="POST">
                                        <div class="row">
                                        <input type="hidden" name="my_link" value="my_map">
                                            <div class="col-lg-4 col-md-12">
                                                <label class="text-black m-b-0 f-15">Radius Value:</label>
                                                <input name="length_value" value="<?=(isset($_SESSION['length_value'])) ? $_SESSION['length_value'] : '50'; ?>" type="text" class="form-control f-15 decimalOnly" placeholder="Length Value" required/>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label class="text-black m-b-0 f-15">Radius Length type:</label>
                                                <select name="length_type" class="form-control f-15">
                                                    <option value="km" <?=(isset($_SESSION['length_type']) && ($_SESSION['length_type']=='km')) ? 'selected' : ''; ?>>Kilometers</option>
                                                    <option value="m" <?=(isset($_SESSION['length_type']) && ($_SESSION['length_type']=='m')) ? 'selected' : ''; ?>>Meters</option>
                                                    <option value="mi" <?=(isset($_SESSION['length_type']) && ($_SESSION['length_type']=='mi')) ? 'selected' : ''; ?>>Miles</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <label class="text-black m-b-0 f-15">Apply Changes:</label>
                                                <button type="submit" class="btn bg-orange text-white col-md-12"><i class="fa fa-edit"></i> Change Radius</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="cus-card">
                                <div class="row">
                                    <div class="cus-card-header col-md-12">
                                        <i class="fa fa-calendar-alt"></i> All user locations based on radius
                                    </div>
                                </div>
                                
                                <div class="cus-card-body">
                                    <div class="row">
                                        <div id="my_map" class="custMap" style="height:800px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Close Main Content -->
            </div>
        </section>
    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
    <?php $this->load->view('booking/booking_steps/booking_info');?>
    <script src="<?=base_url();?>assets/js/initializations/init_my_maps.js"></script>
  </body>

</html>
