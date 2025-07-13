new DataTable('#example', {
    layout: {
        bottomEnd: {
            paging: {
                firstLast: false
            }
        }
    }
});

// Función para eliminar estudiante con confirmación
function eliminarEstudiante(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Mostrar loading
            Swal.fire({
                title: 'Eliminando...',
                text: 'Por favor espera',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Redirigir para eliminar
            window.location.href = '../controllers/estudianteController.php?action=eliminar&id=' + id;
        }
    });
}

// Alertas de éxito para formularios
$(document).on('submit', 'form[action*="estudianteController.php"]', function() {
    Swal.fire({
        title: 'Procesando...',
        text: 'Por favor espera',
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
});