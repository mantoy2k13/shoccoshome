document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('dCalendar');
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
    
    calendar.render();
});

