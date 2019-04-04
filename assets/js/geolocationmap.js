
//   var marker;
//   var map;

// function initialize() {

//   var defaultLocation = new google.maps.LatLng(25.074217, 55.510044);
//   var lat;

//   var mapOptions = {
//     zoom: 15,
//     center: defaultLocation
    
//   };
//   map = new google.maps.Map(document.getElementById("map"), mapOptions);
//   marker = new google.maps.Marker({
//     position: defaultLocation,
//     map: map,
//     draggable: true
//   });
 
//   navigator.geolocation.getCurrentPosition(function(location) {
//     var lat = location.coords.latitude;
//     var lon = location.coords.longitude;

//     var city = new google.maps.LatLng(lat, lon);
//     var mapOptions = {
//       zoom: 15,
//       center: city
//     };
//     map = new google.maps.Map(document.getElementById("map"), mapOptions);


//     marker = new google.maps.Marker({
//       position: city,
//       map: map
//     });

//   }, function(positionError) {
//       var city = new google.maps.LatLng(34.052240, -118.243340);
//       var mapOptions = {
//         zoom: 15,
//         center: city,
//         enableHighAccuracy: false,
//         maximumAge: 50000
        
//       };
//       map = new google.maps.Map(document.getElementById("map"), mapOptions);
//       marker = new google.maps.Marker({
//         position: city,
//         map: map        
//       });
 
//   }, {
//     enableHighAccuracy: false
//   });
// }

// $(document).ready(function(){
//     initialize();
// });

navigator.geolocation.getCurrentPosition(
  function(position){ // success cb
      var lat = position.coords.latitude;
      var lng = position.coords.longitude;
      var mapOptions = {
          zoom: 15,
          center: {lat: lat, lng: lng}
      };
      map = new google.maps.Map(document.getElementById("map"), mapOptions);
      var geocoder = new google.maps.Geocoder;
      var infowindow = new google.maps.InfoWindow;
      geocodeLatLng(geocoder, map, infowindow, lat, lng);
  },
  function(positionError){ // fail cb
      defaultLocation();
  }
);

function geocodeLatLng(geocoder, map, infowindow, lat, lng) {
  var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === 'OK') {
      if (results[0]) {
          var marker = new google.maps.Marker({
              position: latlng,
              icon: base_url + 'assets/img/s-pin-lg.png',
              map: map,
              title: results[0].formatted_address
          });
          infowindow.setContent('Hey! You are here!');
          infowindow.open(map, marker);
          marker.addListener('click', function() {
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(map, marker);
          });
      } else {
          alert('No results found');
      }
    } else {
          alert('Geocoder failed due to: ' + status);
    } 
  });
}

function defaultLocation(){
    var marker, map;
    var defaultLocation = new google.maps.LatLng(34.171810, -118.407349);
    var mapOptions = {
      zoom: 10,
      center: defaultLocation
    };
    var infowindow = new google.maps.InfoWindow;
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    
    marker = new google.maps.Marker({
      position: defaultLocation,
      map: map,
      icon: base_url + 'assets/img/s-pin-lg.png',
    });
    infowindow.setContent('You have turned off your location!');
    infowindow.open(map, marker);
    marker.addListener('click', function() {
        infowindow.setContent('You have turned off your location!');
        infowindow.open(map, marker);
    });
}