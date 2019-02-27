var marker;
var map;

function initialize() {
  var defaultLocation = new google.maps.LatLng(25.074217, 55.510044);
  var lat;

  var mapOptions = {
    zoom: 15,
    center: defaultLocation
    
  };
  map = new google.maps.Map(document.getElementById("map"), mapOptions);
  marker = new google.maps.Marker({
    position: defaultLocation,
    map: map,
    draggable: true,
  });
  google.maps.event.addListener(marker, 'position_changed',

    function(event) {
      update();
    });
  navigator.geolocation.getCurrentPosition(function(location) {
    lat = location.coords.latitude;
    lon = location.coords.longitude;

    var city = new google.maps.LatLng(lat, lon);
    var mapOptions = {
      zoom: 15,
      center: city
    };
    map = new google.maps.Map(document.getElementById("map"), mapOptions);


    marker = new google.maps.Marker({
      position: city,
      map: map,
      
    });

    google.maps.event.addListener(marker, 'position_changed',

      function(event) {
        update();
      });

    update();
  }, function(positionError) {
    //alert("getCurrentPosition failed: " + positionError.message);
       var city = new google.maps.LatLng(34.052240, -118.243340);
    var mapOptions = {
      zoom: 15,
      center: city
      
    };
    map = new google.maps.Map(document.getElementById("map"), mapOptions);


    marker = new google.maps.Marker({
      position: city,
      map: map,
      
    });
  }, {
    enableHighAccuracy: true
  });
}

$(document).ready(function(){
    initialize();
});