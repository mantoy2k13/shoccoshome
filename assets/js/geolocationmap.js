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
    draggable: true
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
      map: map
      
    });

  }, function(positionError) {
    console.log(positionError);
        var city = new google.maps.LatLng(34.052240, -118.243340);
      var mapOptions = {
        zoom: 15,
        center: city,
        nableHighAccuracy: false,
        maximumAge: 50000
        
      };
      map = new google.maps.Map(document.getElementById("map"), mapOptions);


      marker = new google.maps.Marker({
        position: city,
        map: map        
      });
 
  }, {
    enableHighAccuracy: false
  });
}

$(document).ready(function(){
    initialize();
});