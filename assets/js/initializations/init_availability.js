document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('availability');
    
    var d = new Date();
    var month = d.getMonth() + 1;
    var getMonth = month < 10 ? '0' + month : '' + month;
    var strDate = d.getFullYear() + "-" + getMonth + "-" + d.getDate();

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
                start: strDate,
                end: '2019-03-26',
                color: '#00f9f0',
                rendering: 'background'
            }
        ],
    });
    
    calendar.render();
});

