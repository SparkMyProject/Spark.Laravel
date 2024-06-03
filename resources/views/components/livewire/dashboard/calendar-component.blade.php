@vite([
'resources/assets/vendor/libs/fullcalendar/fullcalendar.js'
])
<div>
  <h1>Hello, World!</h1>
  <div id="calendar"></div>
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
      }
    });
    calendar.render();
  })
</script>
