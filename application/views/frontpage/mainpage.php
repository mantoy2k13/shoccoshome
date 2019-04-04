<!DOCTYPE html>
<html lang="en">
  <!-- Header CSS -->
  <?php $this->load->view('common/css');?>

  <body id="page-top">

    <!-- Navigation -->
    <?php $this->load->view('common/main-nav');?>

    <!-- Banner -->
    <?php $this->load->view('frontpage/main_banner');?>

    <!-- Portfolio Grid Section -->
    <section class="map-section">
        <div id="map"></div>
    </section>
    <section class="content">
	  <div class="row m-t-10">
          <!-- Main Content -->
		    <div class="features col-md-3">
              <div class="big-icon">
                 <i class="fa fa-user"></i>
              </div>
              <p>PROFILE</p>
           </div>
           <div class="features col-md-3">
              <div class="big-icon">
                 <i class="fa fa-clipboard"></i>
              </div>
              <p>POSTING BOARD</p>
           </div>
           <div class="features col-md-3">
              <div class="big-icon">
                 <i class="fa fa-comments"></i>
              </div>
              <p>MESSAGE</p>
           </div>
           <div class="features col-md-3">
              <div class="big-icon">
                 <i class="fa fa-taxi"></i>
              </div>
              <p>UBER</p>
           </div>
          <!-- Close Main Content -->
      </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>

  </body>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKmCY9-diuULK1hyHnDkElDSPT6mbfB7w&libraries=geometry&sensor=false"></script>
   <script src="<?=base_url();?>assets/js/geolocationmap.js"></script>
</html>
