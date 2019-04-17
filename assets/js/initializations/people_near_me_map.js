var markers = [];
navigator.geolocation.getCurrentPosition(
    function(position){ // success cb
        $('#mLoader').html('<div class="loading"> Loading..</div>');
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        var mapOptions = {
            zoom: 10,
            center: {lat: lat, lng: lng}
        };
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        renderCalendar(lat, lng);
        $.ajax({
            url: base_url+'booking/getNearUsers',
            dataType: 'JSON',
            type: "POST",
            success: (res)=>{
                console.log(res)
                var locations = [];
                if(res.length!=0){
                    $.each(res, (ind, r)=> {
                        var sAvail = r['sitter_availability'] ? true : false;
                        locations[ind]=[r['id'], r['fullname'], r['user_img'], r['email'], parseFloat(r['user_lat']), parseFloat(r['user_lng']), r['complete_address'], sAvail];
                    });
                    geocodeLatLng(geocoder, map, infowindow, lat, lng, locations);
                    $('#mLoader').html('');
                } else{
                    geocodeLatLng(geocoder, map, infowindow, lat, lng, locations);
                    $('#mLoader').html('');
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
            // console.log(locations)
            for (i = 0; i < locations.length; i++) {  
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][4], locations[i][5]),
                    map: map,
                    icon: base_url + 'assets/img/s-pin-sm.png',
                    title: locations[i][3]
                });
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    var usrImg = (locations[i][2]!="") ? base_url+'assets/img/pictures/usr'+locations[i][0]+'/'+locations[i][2] : base_url+'assets/img/pictures/default.png';
                    
                    if(pet(locations[i][0]) && locations[i][7]){
                        var bookBtn = '<a href="'+base_url+'booking/book_this_user/'+locations[i][0]+'" class="btn bg-orange btn-sm btn-round dropdown-toggle text-white">Book Host</a>'+
                        '<a href="'+base_url+'booking/book_user_pets/'+locations[i][0]+'" class="btn bg-orange btn-sm btn-round dropdown-toggle text-white">Book Guest</a>';
                    } 
                    
                    if(!pet(locations[i][0]) && locations[i][7]){
                        var bookBtn = '<a href="'+base_url+'booking/book_this_user/'+locations[i][0]+'" class="btn bg-orange btn-sm btn-round dropdown-toggle text-white">Book Host</a>';
                    } 
                    
                    if(pet(locations[i][0]) && !locations[i][7]){
                        var bookBtn = '<a href="'+base_url+'booking/book_user_pets/'+locations[i][0]+'" class="btn bg-orange btn-sm btn-round dropdown-toggle text-white">Book Guest</a>';
                    }

                    var contentString = '<div class="card map-card">'+
                        '<div class="card-body">'+
                            '<div class="friend-img">'+
                                '<img src="'+usrImg+'" alt="Default Profile Image">'+
                            '</div>'+
                            '<p class="text-head"><a href="'+base_url+'account/view_bio/'+locations[i][0]+'" target="_blank">'+locations[i][1]+'</a> </p>'+
                            '<p class="f-14 b-700 text-black">'+locations[i][3]+'</p>'+
                            '<p class="text-desc"> '+locations[i][6]+'</p>'+
                            '<div class="row myBookBtn">'+bookBtn+'</div>'+
                        '</div>'+
                    '</div>';
                
                    return function() {
                        infowindow.close();
                        infowindow.setContent(contentString);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
                markers.push(marker);
            }
            var marker = new google.maps.Marker({
                position: latlng,
                icon: base_url + 'assets/img/s-pin-lg.png',
                map: map,
                title: results[0].formatted_address
            });
            infowindow.setContent('<i class="fa fa-map-marker-alt"></i> Hello! You are at '+results[0].formatted_address);
            infowindow.open(map, marker);
            marker.addListener('click', function() {
                infowindow.setContent('<i class="fa fa-map-marker-alt"></i> Hello! You are at '+results[0].formatted_address);
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
function pet(id){
    var obj;
    $.ajax({
        async:false,
        url: base_url+'booking/get_my_avail_pets/'+id,
        success: (p)=>{
            obj= JSON.parse(p);
        }
    });
    return obj;
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

function renderCalendar(curLat, curLng){
    $.ajax({
        url: base_url+'booking/getNearUsers2',
        type: "POST",
        dataType: 'JSON',
        data: {lat: curLat, lng: curLng},
        success: (res)=>{
            var calendarEl = document.getElementById('near_me_calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                header: {
                    left: 'month',
                    center: 'title',
                    right: 'prev,next today'
                },
                navLinks: true, 
                editable: false,
                eventLimit: true, 
                events: res,
                eventClick: function(calEvent) {
                    clickCalendar(calEvent['event']['id'])
                },
                
            });
            calendar.render();
        }
    });
}

function clickCalendar(id) {
    google.maps.event.trigger(markers[id], 'click');
}