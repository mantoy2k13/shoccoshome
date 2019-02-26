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
    <script>

    //Check if browser supports W3C Geolocation API
   if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
   } 
   else {
      alert('It seems like Geolocation, which is required for this page, is not enabled in your browser. Please use a browser which supports it.');
   }

   function successFunction(position) {
      var lat = position.coords.latitude;
      var long = position.coords.longitude;
      var mapProp= {
                center:new google.maps.LatLng(lat,long),
                zoom:15,
      };
      var map = new google.maps.Map(document.getElementById("map"),mapProp);
      var marker = new google.maps.Marker({
         position: mapProp.center,
         title:"Hello World!"
      });
      marker.setMap(map);
   }
   function errorFunction(position) {
	   alert('Error!');
   }
   
      //   function myMap() {
      //       var mapProp= {
      //           center:new google.maps.LatLng(51.508742,-0.120850),
      //           zoom:5,
      //       };
      //       var map = new google.maps.Map(document.getElementById("map"),mapProp);
      //   }
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKmCY9-diuULK1hyHnDkElDSPT6mbfB7w&libraries=geometry&callback=successFunction"></script>
</html>
