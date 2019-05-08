navigator.geolocation.getCurrentPosition(
    function(position){ // success cb
        var cur_lat   = position.coords.latitude;
        var cur_lng   = position.coords.longitude;
        var isAvail   = $('#isAvail').val();
        var book_type = $('#book_type').val();
        var book_avail_from = $('#book_avail_from').val();
        var book_avail_to = $('#book_avail_to').val();
        $.ajax({
            url: base_url+'booking/get_avail_host',
            type: "POST",
            dataType: 'JSON',
            data: {cur_lat: cur_lat, cur_lng: cur_lng, isAvail: isAvail, book_type: book_type, book_avail_from: book_avail_from, book_avail_to: book_avail_to},
            success: (res)=>{
                console.log(res)
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
    alert(uid)
}

var checkDateTime = ()=>{
    var curr_date       = $('#curr_date').val();
    var book_avail_from = $('#book_avail_from').val();
    var book_avail_to   = $('#book_avail_to').val();
    var book_time_from  = $('#book_time_from').val();
    var book_time_to    = $('#book_time_to').val();
    var pet_cat_list    = $('#pet_cat_list').val();
    var book_type       = $('#book_type').val();
    var book_note       = $('#book_note').val();
    
    if(book_avail_from && book_time_from && book_avail_to && book_time_to && pet_cat_list.length!=0){
        var date_today      = new Date(curr_date);
        var given_date_from = new Date(book_avail_from);
        var given_date_to   = new Date(book_avail_to);

        if(given_date_from < date_today){
            $('.setTimeMsg').html(setMsg('Date From must be equal or greater than the date today'));
            $('#book_avail_from').focus();
        } else if(given_date_to < date_today){
            $('.setTimeMsg').html(setMsg('Date To must be equal or greater than the date today'));
            $('#book_avail_to').focus();
        } else if(given_date_to < given_date_from){
            $('.setTimeMsg').html(setMsg('Date From must be equal or less than the date to'));
            $('#book_avail_to').focus();
        } else{
            $.ajax({
                url: base_url+'account/set_my_dates',
                method: 'POST',
                data: { 
                    book_avail_from: book_avail_from, 
                    book_avail_to:   book_avail_to,
                    book_time_from:  book_time_from, 
                    book_time_to:    book_time_to,
                    pet_cat_list:    pet_cat_list,
                    book_type:       book_type,
                    book_note:       book_note
                },
                success: (res)=>{
                    console.log(res)
                    if(res==1){
                        swal({title: "Success!", text: "Your time was successfully set as a host.", type: 
                        "success"}, function(){ location.reload(); });
                    } else{
                        swal('Failed!', 'A problem occured please try again.', 'error');
                    }
                }
            });
        }
    } else{
        $('.setTimeMsg').html(setMsg('Please fill all fields to proceed.'));
    }
}

var checkDateTime2 = ()=>{
    var curr_date     = $('#curr_date').val();
    var ns_date_from  = $('#ns_date_from').val();
    var ns_date_to    = $('#ns_date_to').val();
    var ns_time_start = $('#ns_time_start').val();
    var ns_time_end   = $('#ns_time_end').val();
    var petList       = $('#petList').val();
    
    if(ns_date_from && ns_date_to && ns_time_start && ns_time_end){
        var date_today = new Date(curr_date);
        var given_date_from = new Date(ns_date_from);
        var given_date_to = new Date(ns_date_to);

        if(given_date_from < date_today){
            $('.setTimeMsg2').html(setMsg('Date From must be equal or greater than the date today'));
            $('#ns_date_from').focus();
        } else if(given_date_to < date_today){
            $('.setTimeMsg2').html(setMsg('Date To must be equal or greater than the date today'));
            $('#ns_date_to').focus();
        } else if(given_date_to < given_date_from){
            $('.setTimeMsg2').html(setMsg('Date From must be equal or less than the date to'));
            $('#ns_date_to').focus();
        } else if(petList==""){
            $('.setTimeMsg2').html(setMsg('Please select your pets.'));
            $('#petList').focus();
        }else{
            $.ajax({
                url: base_url+'account/need_sitter_set_time',
                method: 'POST',
                data: $('#nsForm').serialize(),
                success: (res)=>{
                    if(res==1){
                        swal({title: "Success!", text: "All pet was set a time successfully. You can view your pets to see the calendar.", type: 
                        "success"},function(){ location.reload(); });
                    } else{
                        swal('Failed!', 'A problem occured please try again.', 'error');
                    }
                }
            });
        }
    } else{
        $('.setTimeMsg2').html(setMsg('Please set all dates to proceed'));
    }
}

var unsetDates=(t)=>{
    swal({
        title: "Unset Dates?",
        text: "All dates will be remove. Continue?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, unset it!",
        closeOnConfirm: false,
        confirmButtonColor: "#f77506",
        showLoaderOnConfirm: true
    },
    function(){
        $.ajax({
            url: base_url+'account/unset_dates/'+t,
            success: (res)=>{
                if(res==1){
                    swal({title: "Success!", text: 'All dates was unset successfully.', type: 
                    "success"}, function(){ location.reload(); });
                } else{
                    swal('Failed!', 'A problem occured please try again.', 'error');
                }
            }
        });
    });
}

function setMsg(msg){
    var setMsg = '';
    setMsg += '<div class="alert alert-danger f-15 alert-dismissible" role="alert">';
    setMsg += '<strong><i class="fa fa-times"></i> Oops!</strong> '+msg+'.';
    setMsg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    setMsg += '<span aria-hidden="true">&times;</span>';
    setMsg += '</button>';
    setMsg += '</div>';
    return setMsg;
}