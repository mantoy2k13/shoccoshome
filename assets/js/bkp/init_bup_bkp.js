document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('availability');
    var bdf = $('#bdf').val();
    var bdt = $('#bdt').val();
    var calendar = new FullCalendar.Calendar(calendarEl, {
        header: {
            left: 'month',
            center: 'title',
            right: 'prev,next today'
        },
        navLinks: false, // can click day/week names to navigate views
        editable: false,
        eventLimit: false, // allow "more" link when too many events
        events: [
            {
                title: 'Avalable',
                start: $('#a_date_from').val(),
                end: $('#a_date_to').val(),
                color: '#00f9f0',
                rendering: 'background'
            },
            {
                title: (bdf && bdt) ? 'Requested Date' : '',
                start: (bdf) ? bdf : '',
                end: (bdt) ? bdt : ''
            }
        ],
    });
    
    calendar.render();
});

var checkDateTime = (type)=>{
    var curr_date  = $('#curr_date').val();
    var date_from  = $('#date_from').val();
    var date_to    = $('#date_to').val();
    var time_start = $('#time_start').val();
    var time_end   = $('#time_end').val();
    var odf        = $('#origDateFrom').val();
    var odt        = $('#origDateTo').val();

    if(date_from && date_to && time_start && time_end){
        var date_today = new Date(curr_date);
        var given_date_from = new Date(date_from);
        var given_date_to = new Date(date_to);
        var origDateFrom = new Date(odf);
        var origDateTo = new Date(odt);

        if(given_date_from < date_today){
            $('.setTimeMsg').html(setMsg('Date From must be equal or greater than the date today'));
            $('#date_from').focus();
        } else if(given_date_to < date_today){
            $('.setTimeMsg').html(setMsg('Date To must be equal or greater than the date today'));
            $('#date_to').focus();
        } else if(given_date_from < origDateFrom || given_date_from > origDateTo){
            $('.setTimeMsg').html(setMsg('Date From must be equal or less than the date of pet\'s schedule.'));
            $('#date_from').focus();
        } else if(given_date_to > origDateTo || given_date_to < origDateFrom){
            $('.setTimeMsg').html(setMsg('Date To must be equal or less than the date of pet\'s schedule.'));
            $('#date_to').focus();
        } else if(given_date_to < given_date_from){
            $('.setTimeMsg').html(setMsg('Date From must be equal or less than the date to'));
            $('#date_to').focus();
        } else{
            if(type==1){ 
                var url = base_url + 'booking/book_pet_user';
                var text = 'You have successfully book a pet\' pets.';
            }else{
                var url = base_url + 'booking/update_book_pet_user/'+$('#book_id').val();
                var text = 'Booking data was successfully updated.';
            }
            
            swal({
                title: "Continue?",
                text: "Make sure you have to complete and data and check dates. Continue?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, continue!",
                closeOnConfirm: false,
                confirmButtonColor: "#f77506",
                showLoaderOnConfirm: true
            },
            function(){
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: $('#setTimeForm').serialize(),
                    success: (res)=>{
                        if(res==1){
                            swal({title: "Success!", text: text, type: 
                            "success"}, function(){ location.reload(); });
                        } else{
                            swal('Failed!', 'A problem occured please try again.', 'error');
                        }
                    }
                });
            });
        }
    } else{
        $('.setTimeMsg').html(setMsg('Please fill all fields to proceed'));
    }
}

var cancelBook = (bid, status)=>{
    swal({
        title: "Cancel?",
        text: "This booking will be cancelled.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, cancel it!",
        closeOnConfirm: false,
        confirmButtonColor: "#f77506",
        showLoaderOnConfirm: true
    },
    function(){
        $.ajax({
            url: base_url + "booking/bookng_approvals/"+bid+'/'+status,
            success: function(res){
                if(res==1){
                    swal({title: "Cancelled!", text: 'Booking was cancelled sucessfully!', type: 
                        "success"}, function(){ location.reload(); });
                } else{
                    swal("Failed",'A problem occured please try again.', 'error');
                }
            }
        }); 
    });
}

var setMsg = (msg)=>{
    var setMsg = '';
    setMsg += '<div class="alert alert-danger f-15 alert-dismissible" role="alert">';
    setMsg += '<strong><i class="fa fa-times"></i> Oops!</strong> '+msg+'.';
    setMsg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    setMsg += '<span aria-hidden="true">&times;</span>';
    setMsg += '</button>';
    setMsg += '</div>';
    return setMsg;
}