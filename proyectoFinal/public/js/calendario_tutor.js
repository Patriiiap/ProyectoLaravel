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

            const popup = document.getElementById("qr-popup");

            // Posiciona la tarjeta justo donde se hizo clic
            popup.style.left = info.jsEvent.pageX + "px";
            popup.style.top = info.jsEvent.pageY + "px";
            popup.style.display = "block";

            const botonQR = document.getElementById("generarQRBtn");
            botonQR.href = "/qrcodes/scan/" + info.event.id;

            // Configura el botón
            // const botonQR = document.getElementById("generarQRBtn");
            // botonQR.onclick = function () {
            // alert("Generar QR para la cita con ID: " + info.event.id);
            // };
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