document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '/citas-eventos-tutores',
        allDaySlot: false,
        slotMinTime: "07:00:00",
        slotMaxTime: "21:00:00",
        contentHeight: 'auto',
        locale: 'es',
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

            const popup = document.getElementById("info-cita-popup");

            // Posiciona la tarjeta donde se hizo clic
            popup.style.left = info.jsEvent.pageX + "px";
            popup.style.top = info.jsEvent.pageY + "px";
            popup.style.display = "block";

            // Establece el link para confirmar cita (QR)
            const botonQR = document.getElementById("generarQRBtn");
            botonQR.href = "/qrcodes/scan/" + info.event.id;

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

            // Configura el boton para eliminar
            const ahora = new Date();
            const fechaCita = new Date(info.event.start);

            const eliminarBtn = document.getElementById("eliminarCitaBtn");

            // Mostrar botón solo si la cita es futura
            if (fechaCita > ahora) {
                eliminarBtn.href = "/citas/eventos-borrar/" + info.event.id;
                eliminarBtn.style.display = 'inline-block';
            } else {
                eliminarBtn.href = "#";
                eliminarBtn.style.display = 'none';
            }
        }
    });

    calendar.render();

    // Oculta el popup al hacer clic fuera de él
    document.addEventListener("click", function (e) {
        const popup = document.getElementById("info-cita-popup");

        if (!popup.contains(e.target) && !e.target.closest(".fc-event")) {
            popup.style.display = "none";
        }
    });
});