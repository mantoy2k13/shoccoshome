navigator.geolocation.getCurrentPosition(
    function(position){ // success cb
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        var mapOptions = {
            zoom: 10,
            center: {lat: lat, lng: lng}
        };
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        $.ajax({
            url: base_url+'booking/getNearUsers',
            dataType: 'JSON',
            type: "POST",
            success: (res)=>{
                console.log(res);
                var locations = [];
                if(res.length!=0){
                    $.each(res, (ind, r)=> {
                        locations[ind]=[r['email'], parseFloat(r['user_lat']), parseFloat(r['user_lng']), r['complete_address']];
                    });
                    geocodeLatLng(geocoder, map, infowindow, lat, lng, locations);
                } else{
                    geocodeLatLng(geocoder, map, infowindow, lat, lng, locations);
                }
            }
        }); 
    },
    function(){ 
        defaultLocation();
    }
);

function geocodeLatLng(geocoder, map, infowindow, lat, lng, locations) {
    var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
    geocoder.geocode({'location': latlng}, function(results, status) {
      if (status === 'OK') {
        if (results[0]) {
            for (i = 0; i < locations.length; i++) {  
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: base_url + 'assets/img/s-pin-sm.png',
                    title: locations[i][3]
                });
          
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }

            var marker = new google.maps.Marker({
                position: latlng,
                icon: base_url + 'assets/img/s-pin-lg.png',
                map: map,
                title: 'Your location!'
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

function getLocations(){
    var locations = [
        ['Compostela', 10.454450, 124.012400],
        ['Colonade', 10.297790, 123.901500],
        ['Lahug', 10.334300, 123.892792],
        ['Banilad', 10.355040, 123.905319],
        ['Kamputhaw', 10.320270, 123.895160]
    ];

    return locations;
}

function getNearUsers(lat, lng){
    var res;
    $.ajax({
        url: base_url+'booking/getNearUsers',
        dataType: 'JSON',
        type: "POST",
        data: {lat: lat, lng: lng},
        success: (res)=>{
            console.log(res);
        }
    });
}