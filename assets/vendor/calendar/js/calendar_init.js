document.addEventListener('DOMContentLoaded', function() {
var calendarEl = document.getElementById('calendar');

var calendar = new FullCalendar.Calendar(calendarEl, {
    header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,basicWeek,basicDay'
    },
    navLinks: true, // can click day/week names to navigate views
    editable: false,
    eventLimit: false, // allow "more" link when too many events
    events: [
    {
        title: 'All Day Event',
        start: '2019-01-01'
    },
    {
        title: 'Long Event',
        start: '2019-01-07',
        end: '2019-01-10',
        color: '#f90025',
    },
    {
        groupId: 999,
        title: 'Repeating Event',
        start: '2019-01-09T16:00'
    },
    {
        groupId: 999,
        title: 'Repeating Event',
        start: '2019-01-16T16:00:00'
    },
    {
        title: 'Conference',
        start: '2019-01-11',
        end: '2019-01-13'
    },
    {
        title: 'Meeting',
        start: '2019-01-12T10:30:00',
        end: '2019-01-12T12:30:00',
        color: '#f90025',
    },
    {
        title: 'Lunch',
        start: '2019-01-12T12:00:00',
        color: '#f90025'
    },
    {
        title: 'Meeting',
        start: '2019-01-12T14:30:00',
        color: '#f90025',
    },
    {
        title: 'Happy Hour',
        start: '2019-01-12T17:30:00',
        color: '#f90025',
    },
    {
        title: 'Dinner',
        start: '2019-01-12T20:00:00'
    },
    {
        title: 'Birthday Party',
        start: '2019-01-13 16:00',
        end: '2019-01-16 10:00'
    },
    {
        title: 'Click for Google',
        url: 'http://google.com/',
        start: '2019-01-28',
        color: '#f90025',
    }
    ]
});

calendar.render();
});
