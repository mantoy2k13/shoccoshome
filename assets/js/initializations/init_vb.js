document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('availability');
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
            }
        ],
    });
    
    calendar.render();
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