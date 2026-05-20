
// Confirmación personalizada
function confirmAction(message, url) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: message || 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, continuar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

// Notificación de éxito
function showSuccess(message) {
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: message,
        timer: 3000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
}

// Notificación de error
function showError(message) {
    Swal.fire({
        icon: 'error',
        title: '¡Error!',
        text: message,
        confirmButtonColor: '#d33'
    });
}

// Notificación de información
function showInfo(message) {
    Swal.fire({
        icon: 'info',
        title: 'Información',
        text: message,
        confirmButtonColor: '#4361ee'
    });
}

// Cargando
function showLoading(message = 'Procesando...') {
    Swal.fire({
        title: message,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

// Cerrar loading
function closeLoading() {
    Swal.close();
}

// Formulario modal
function showFormModal(title, htmlContent) {
    Swal.fire({
        title: title,
        html: htmlContent,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        preConfirm: () => {
            // Aquí procesas el formulario
            return true;
        }
    });
}