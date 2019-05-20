var markers = [];
navigator.geolocation.getCurrentPosition(
    function(position){
        $('#mLoader').html('<div class="loading"> Loading..</div>');
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        var mapOptions = {
            zoom: 10,
            center: {lat: lat, lng: lng}
        };
        map = new google.maps.Map(document.getElementById("my_map"), mapOptions);
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        $.ajax({
            url: base_url+'booking/getNearUsers',
            dataType: 'JSON',
            type: "POST",
            data: {cur_lat: lat, cur_lng: lng},
            success: (res)=>{
                var locations = [];
                if(res.length!=0){
                    $.each(res, (ind, r)=> {
                        locations[ind]=[r['id'], r['fullname'], r['user_img'], r['email'], parseFloat(r['user_lat']), parseFloat(r['user_lng']), r['complete_address'], r['book_type']];
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
            for (i = 0; i < locations.length; i++) {  
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][4], locations[i][5]),
                    map: map,
                    icon: base_url + 'assets/img/s-pin-sm.png',
                    title: locations[i][3]
                });
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    var usrImg = (locations[i][2]!="") ? base_url+'assets/img/pictures/usr'+locations[i][0]+'/'+locations[i][2] : base_url+'assets/img/pictures/default.png';
                    var bookBtn = '<a onclick="viewUser('+locations[i][0]+')" href="javascript:;" class="btn bg-orange btn-xs m-t-10 text-white"><i class="fa fa-calendar-alt"></i> Schedule Info</a>';
                    var book_type = (locations[i][7]==1) ? '<span class="float-badge badge badge-primary">HOST</span>' : '<span class="float-badge badge bg-orange text-white">GUEST</span>';
                    var contentString = '<div class="card map-card">'+
                        '<div class="card-body">'+
                            '<div class="friend-img">'+
                                '<img src="'+usrImg+'" alt="Default Profile Image">'+
                            '</div>'+book_type+
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
            swal("Oops!", "No result's found.", 'warning');
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
    map = new google.maps.Map(document.getElementById("my_map"), mapOptions);
    
    marker = new google.maps.Marker({
      position: defaultLocation,
      map: map,
      icon: base_url + 'assets/img/s-pin-lg.png',
    });
    infowindow.setContent('Your browser\'s location is currently off.!');
    infowindow.open(map, marker);
    marker.addListener('click', function() {
        infowindow.setContent('Your browser\'s location is currently off.!');
        infowindow.open(map, marker);
    });
    swal("Location Failed!", "Please allow your browser to know your location by turning it on.", 'warning');
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

function viewUser(uid){
    $('#mLoader').html('<div class="loading"> Loading..</div>');
    $.ajax({
        url: base_url+'account/get_user_info/'+uid,
        dataType: "JSON",
        success: (res)=>{
            if(res!=0){
                var usrImg = (res['user_img']!="") ? base_url+'assets/img/pictures/usr'+res['id']+'/'+res['user_img'] : base_url+'assets/img/pictures/default.png';
                var sched = '<span class="badge badge-success">'+dateFormat(new Date(res['book_avail_from']), "dd mmm yyyy, hh:MM TT")+'</span> - <span class="badge badge-success">'+dateFormat(new Date(res['book_avail_to']), "dd mmm yyyy, hh:MM TT")+'</span>';
                var book_type = (res['book_type']==1) ? '<span class="badge badge-primary">HOST</span>' : '<span class="badge bg-orange text-white">GUEST</span>';
                var smoke_info = (res['is_smoker']==1) ? '<span class="badge badge-danger"><i class="fa fa-ban"></i> Smoker</span>' : '<span class="badge badge-success"><i class="fa fa-check"></i> Non Smoker</span>';
                var living = (res['living_in']==1) ? 'the house' : 'an apartment';

                $('#user_img_info').attr('src', usrImg);
                $('#fullname_info').html(res['fullname']);
                $('#address_info').html(res['complete_address'])
                $('#schedule_info').html(sched);
                $('#book_type_info').html(book_type);
                $('#cat_list_info').val(res['my_cat']);
                if(res['book_note']){
                    $('book_note_wrapper').html(''+
                        '<label for="time_end">Note/Remarks: </label>'+
                        '<textarea id="note_info" class="form-control" cols="20" rows="3" placeholder="Additional Information.." disabled>'+res['book_note']+'</textarea>'
                    );
                }
                $('#smoke_info').html(smoke_info);
                $('#home_info').html('<i class="fa fa-home"></i> Living in '+living);
                var book_btn = (my_user_id!=res['id']) ? '<a href="'+base_url+'booking/book_user/'+res['book_type']+'/'+res['id']+'" class="btn btn-success btn-sm"><i class="fa fa-phone"></i> Contact '+res['fullname']+'</a>' : '';
                $('#user_footer_btn').html(''+book_btn+
                    '<a target="_blank" href="'+base_url+'account/view_bio/'+res['id']+'" class="btn btn-info btn-sm"><i class="fa fa-user"></i> View Profile</a>'
                );
                $('#mLoader').html('');
                $('#user_info').modal('show');
            } else{
                $('#mLoader').html('');
                swal('Error!', 'A problem fetching datas. Please try again.', 'error');
            }
        }
    });
}