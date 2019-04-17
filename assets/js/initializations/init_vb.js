document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('availability');
    var calendarPet = document.getElementById('calendarPet');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        header: {
            left: 'month',
            center: 'title',
            right: 'prev,next today'
        },
        navLinks: true, // can click day/week names to navigate views
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
                title: 'Need Sitter',
                start: $('#pDate_from').val(),
                end: $('#pDate_to').val(),
                color: '#fa5637'
            }
        ],
    });

    var calPet = new FullCalendar.Calendar(calendarPet, {
        header: {
            left: 'month',
            center: 'title',
            right: 'prev,next today'
        },
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: false, // allow "more" link when too many events
        events: [
            {
                title: 'Avalable',
                start: $('#pDate_from').val(),
                end: $('#pDate_to').val(),
                color: '#ff2c00',
                rendering: 'background'
            }
        ],
    });
    
    calendar.render();
    calPet.render();
});

var checkDateTime = ()=>{
    var curr_date  = $('#curr_date').val();
    var date_from  = $('#date_from').val();
    var date_to    = $('#date_to').val();
    
    if(date_from && date_to){
        var date_today = new Date(curr_date);
        var given_date_from = new Date(date_from);
        var given_date_to = new Date(date_to);

        if(given_date_from < date_today){
            $('.setTimeMsg').html(setMsg('Date From must be equal or greater than the date today'));
            $('#date_from').focus();
        } else if(given_date_to < date_today){
            $('.setTimeMsg').html(setMsg('Date To must be equal or greater than the date today'));
            $('#date_to').focus();
        } else if(given_date_to < given_date_from){
            $('.setTimeMsg').html(setMsg('Date From must be equal or less than the date to'));
            $('#date_to').focus();
        } else{
            $.ajax({
                url: base_url+'account/set_sitter_time',
                method: 'POST',
                data: { date_from: date_from, date_to:date_to },
                success: (res)=>{
                    if(res==1){
                        swal({title: "Success!", text: "Set time availability successful.", type: 
                        "success"},
                            function(){ 
                                location.reload();
                            }
                        );
                    } else{
                        swal('Failed!', 'A problem occured please try again.', 'error');
                    }
                }
            });
        }
    } else{
        $('.setTimeMsg').html(setMsg('Please set all dates to proceed'));
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

var resetDate=(t)=>{
    swal({
        title: "Reset Date?",
        text: "All dates will be remove. Continue?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, reset it!",
        closeOnConfirm: false,
        confirmButtonColor: "#f77506",
        showLoaderOnConfirm: true
    },
    function(){
        $.ajax({
            url: base_url+'account/resetDate/'+t,
            success: (res)=>{
                if(res==1){
                    swal({title: "Success!", text: 'Date reset successfully.', type: 
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