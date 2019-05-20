document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('petCalendar');
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
                start: $('#ndf').val(),
                end: $('#ndt').val(),
                color: '#f90025',
                rendering: 'background'
            }
        ],
    });
    
    calendar.render();
});

var checkDateTime2 = ()=>{
    var curr_date     = $('#curr_date').val();
    var ns_date_from  = $('#ns_date_from').val();
    var ns_date_to    = $('#ns_date_to').val();
    var ns_time_start = $('#ns_time_start').val();
    var ns_time_end   = $('#ns_time_end').val();
    var pet_id   = $('#pet_id').val();
    
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
        }else{
            $.ajax({
                url: base_url+'account/update_need_pet_sitter/'+pet_id,
                method: 'POST',
                data: $('#nsForm').serialize(),
                success: (res)=>{
                    if(res==1){
                        swal({title: "Success!", text: "Your pet was set a time successfully.", type: 
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