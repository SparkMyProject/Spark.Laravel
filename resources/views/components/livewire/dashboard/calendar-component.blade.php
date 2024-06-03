@vite([
'resources/assets/vendor/libs/fullcalendar/fullcalendar.js',
'resources/assets/vendor/libs/fullcalendar/fullcalendar.scss'
])
<div>
  <h1>Hello, World!</h1>
  <div id="calendar"></div>
  @foreach($events as $event)
    <p>{{$event}}</p>
  @endforeach
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');
    let calendar = new Calendar(calendarEl, {
      plugins: [window.dayGridPlugin, window.timegridPlugin, window.listPlugin],
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek'
      },
      // add events
      events: {!! json_encode($events->toArray()) !!},
    });
    calendar.render();
  })
</script>
