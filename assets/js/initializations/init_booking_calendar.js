navigator.geolocation.getCurrentPosition(
    function(position){ // success cb
        var cur_lat         = position.coords.latitude;
        var cur_lng         = position.coords.longitude;
        var isAvail         = $('#isAvail').val();
        var book_avail_from = $('#book_avail_from').val();
        var book_avail_to   = $('#book_avail_to').val();
        $.ajax({
            url: base_url+'booking/get_avail_host',
            type: "POST",
            dataType: 'JSON',
            data: {cur_lat: cur_lat, cur_lng: cur_lng, isAvail: isAvail, book_avail_from: book_avail_from, book_avail_to: book_avail_to},
            success: (res)=>{
                var calendarEl = document.getElementById('users_calendar');
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
                        viewUserDetails(calEvent['event']['id'])
                    },
                    
                });
                calendar.render();
            }
        }); 
    },
    function(){ 
        alert('Failed to get location');
    }
);

var viewUserDetails = (uid)=>{
    $('#mLoader').html('<div class="loading"> Loading..</div>');
    $.ajax({
        url: base_url+'account/get_user_info/'+uid,
        dataType: "JSON",
        success: (res)=>{
            console.log(res)
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
                var book_btn = (my_user_id!=res['id']) ? '<a href="'+base_url+'booking/book_this_user/'+res['id']+'/'+res['book_type']+'" class="btn btn-success btn-sm"><i class="fa fa-phone"></i> Contact '+res['fullname']+'</a>' : '';
                $('#user_footer_btn').html(''+book_btn+
                    '<a href="'+base_url+'account/view_bio/'+res['id']+'" class="btn btn-info btn-sm"><i class="fa fa-user"></i> View Profile</a>'
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