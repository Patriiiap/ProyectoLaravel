$(document).ready(function () {
    $('#usuario').on('change', function () {
        const usuarioId = $(this).val();
        $('#profesional').empty().append('<option value="">Cargando...</option>');

        if (usuarioId) {
            $.ajax({
                url: `/api/usuarios/${usuarioId}/profesionales`,
                method: 'GET',
                success: function (data) {
                    $('#profesional').empty().append('<option value="">-- Selecciona un profesional --</option>');
                    data.forEach(function (profesional) {
                        $('#profesional').append(`<option value="${profesional.id}">${profesional.nombre} ${profesional.apellidos}</option>`);
                    });
                },
                error: function () {
                    $('#profesional').empty().append('<option value="">Error al cargar profesionales</option>');
                }
            });
        } else {
            $('#profesional').empty().append('<option value="">-- Selecciona un usuario primero --</option>');
        }
    });
});