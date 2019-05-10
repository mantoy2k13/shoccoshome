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
                        location.href = base_url+'booking/choose_user_calendar';
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

var checkBookTime = (book_id)=>{
    var curr_date       = $('#curr_date').val();
    var book_avail_from = $('#book_avail_from').val();
    var book_avail_to   = $('#book_avail_to').val();
    var book_time_from  = $('#book_time_from').val();
    var book_time_to    = $('#book_time_to').val();
    var pet_list        = $('#pet_list').val();
    var short_message   = $('#short_message').val();
    var user_date_from  = $('#user_date_from').val();
    var user_date_to    = $('#user_date_to').val();
    var user_type       = $('#user_type').val();
    var book_to         = $('#book_to').val();
    var swal_title      = (book_id==0) ? 'Book user now?' : 'Update booking info?';
    var swal_succ       = (book_id==0) ? 'Your booking request was successfully sent to this user. Click "OK" to view booking summary' : 'Booking was updated successfully. Click ok to finish.';
    
    if(book_avail_from && book_time_from && book_avail_to && book_time_to && pet_list.length!=0){
        var date_today      = new Date(curr_date);
        var given_date_from = new Date(book_avail_from);
        var given_date_to   = new Date(book_avail_to);
        var udf             = new Date(user_date_from);
        var udt             = new Date(user_date_to);

        if(given_date_from < date_today){
            $('.setTimeMsg').html(setMsg('Your "Date From" must be equal or greater than the date today!'));
            $('#book_avail_from').focus();
        } else if(given_date_to < date_today){
            $('.setTimeMsg').html(setMsg('Your "Date To" must be equal or greater than the date today!'));
            $('#book_avail_to').focus();
        } else if(given_date_to < given_date_from){
            $('.setTimeMsg').html(setMsg('Your "Date From" must be equal or less than the "Date To"!'));
            $('#book_avail_to').focus();
        } else if(given_date_from < udf || given_date_from > udt){
            $('.setTimeMsg').html(setMsg('Your "Date From" must be equal or greater than the "Date From" of the user!'));
            $('#book_avail_from').focus();
        } else if(given_date_to > udt || given_date_to < udf){
            $('.setTimeMsg').html(setMsg('Your "Date To" must be equal or greater than the "Date To" of the user!'));
            $('#book_avail_to').focus();
        } else if($('#verify_check').prop('checked')==false){
            $('.setTimeMsg').html(setMsg('Make sure to verify all fields and check the box below'));
            $('#verify_check').focus();
        } else{
            swal({
                title: swal_title,
                text: "Make make sure all booking datas are verified and reviewed before proceeding. Continue?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Book Now!",
                closeOnConfirm: false,
                confirmButtonColor: "#f77506",
                showLoaderOnConfirm: true
            },
            function(){
                $.ajax({
                    url: base_url+'booking/book_me_now/'+book_id,
                    method: 'POST',
                    data: { 
                        book_avail_from: book_avail_from, 
                        book_avail_to:   book_avail_to,
                        book_time_from:  book_time_from, 
                        book_time_to:    book_time_to,
                        pet_list:        pet_list,
                        short_message:   short_message,
                        user_type:       user_type,
                        book_to:         book_to
                    },
                    success: (res)=>{
                        if(res!=0){
                            location.href = base_url+'booking/booking_summary/'+res+'/'+book_to;
                        } else{
                            swal('Failed!', 'A problem occured please try again.', 'error');
                        }
                    }   
                });
            });
        }
    } else{
        $('.setTimeMsg').html(setMsg('Please fill all fields to proceed.'));
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