document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '/citas-eventos-profesionales',
        allDaySlot: false,
        slotMinTime: "07:00:00",
        slotMaxTime: "21:00:00",
        contentHeight: 'auto',
        height: 'auto',
        slotMinHeight: 60,
        locale: 'es',
        //botones para cambiar de vista (mes, semana, dia)
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },

        eventClick: function (info) {
            info.jsEvent.preventDefault();

            const popup = document.getElementById("qr-popup");

            // Posiciona la tarjeta justo donde se hizo clic
            popup.style.left = info.jsEvent.pageX + "px";
            popup.style.top = info.jsEvent.pageY + "px";
            popup.style.display = "block";

            const botonQR = document.getElementById("generarQRBtn");
            botonQR.href = "/qrcodes/generate/" + info.event.id;

            // Información de la cita
            const infoCita = document.getElementById("info-cita");
            infoCita.innerHTML = `
            <strong>${info.event.title}</strong><br>
            📅 ${new Date(info.event.start).toLocaleDateString()}<br>
            ⏰ ${new Date(info.event.start).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}
             - ${new Date(info.event.end).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}<br>
            👤 Profesional: ${info.event.extendedProps.nombre_profesional}<br>
            👥 Usuario: ${info.event.extendedProps.nombre_usuario}<br>
            📌 Estado: ${info.event.extendedProps.asistencia_realizada}
            `;

        }
    });
    calendar.render();

    // Oculta el popup al hacer clic fuera de él
    document.addEventListener("click", function (e) {
        const popup = document.getElementById("qr-popup");

        if (!popup.contains(e.target) && !e.target.closest(".fc-event")) {
            popup.style.display = "none";
        }
    });
});