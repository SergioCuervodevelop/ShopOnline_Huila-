
// ========== ESPERA A QUE EL DOM ESTÉ LISTO ==========
document.addEventListener('DOMContentLoaded', function() {
    
    // Inicializar tooltips
    initTooltips();
    
    // Inicializar animaciones
    initAnimations();
    
    // Inicializar confirmaciones
    initConfirmations();
    
    // Inicializar búsqueda en tablas
    initSearchTable();
    
    // Inicializar gráficos
    initCharts();
    
    // Dark mode toggle
    initDarkMode();
    
    // Mostrar notificaciones
    showNotifications();
});

// ========== FUNCIÓN: TOOLTIPS ==========
function initTooltips() {
    const elements = document.querySelectorAll('[data-tooltip]');
    elements.forEach(el => {
        el.addEventListener('mouseenter', function(e) {
            const tooltip = document.createElement('div');
            tooltip.className = 'custom-tooltip';
            tooltip.textContent = this.getAttribute('data-tooltip');
            tooltip.style.position = 'absolute';
            tooltip.style.backgroundColor = '#1a1a2e';
            tooltip.style.color = 'white';
            tooltip.style.padding = '5px 10px';
            tooltip.style.borderRadius = '5px';
            tooltip.style.fontSize = '12px';
            tooltip.style.zIndex = '1000';
            tooltip.style.pointerEvents = 'none';
            
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
            tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';
            
            this.addEventListener('mouseleave', function() {
                tooltip.remove();
            });
        });
    });
}

// ========== FUNCIÓN: ANIMACIONES AL SCROLL ==========
function initAnimations() {
    const animatedElements = document.querySelectorAll('.fade-in-up, .card-modern, .stat-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });
}

// ========== FUNCIÓN: CONFIRMACIONES DE ELIMINACIÓN ==========
function initConfirmations() {
    const deleteButtons = document.querySelectorAll('.btn-delete, [onclick*="confirm"]');
    
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            const originalOnClick = this.getAttribute('onclick');
            if (originalOnClick && originalOnClick.includes('confirm')) {
                // Ya tiene confirmación nativa
                return;
            }
            
            e.preventDefault();
            
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
                    window.location.href = this.href;
                }
            });
        });
    });
}

// ========== FUNCIÓN: BÚSQUEDA EN TABLAS ==========
function initSearchTable() {
    const searchInput = document.createElement('div');
    searchInput.className = 'mb-3';
    searchInput.innerHTML = `
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="tableSearch" class="form-control" placeholder="Buscar...">
        </div>
    `;
    
    const tables = document.querySelectorAll('.table-responsive table');
    tables.forEach(table => {
        const parent = table.closest('.card-body') || table.parentElement;
        if (parent && !parent.querySelector('#tableSearch')) {
            parent.insertBefore(searchInput.cloneNode(true), table);
            
            const searchField = parent.querySelector('#tableSearch');
            if (searchField) {
                searchField.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = table.querySelectorAll('tbody tr');
                    
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    });
                });
            }
        }
    });
}

// ========== FUNCIÓN: GRÁFICOS CON CHART.JS ==========
function initCharts() {
    // Verificar si existe Chart.js
    if (typeof Chart === 'undefined') return;
    
    // Gráfico de ventas
    const salesChart = document.getElementById('salesChart');
    if (salesChart) {
        new Chart(salesChart, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [{
                    label: 'Ventas',
                    data: [12, 19, 15, 17, 14, 20],
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    }
    
    // Gráfico de productos
    const productsChart = document.getElementById('productsChart');
    if (productsChart) {
        new Chart(productsChart, {
            type: 'doughnut',
            data: {
                labels: ['Electrónica', 'Ropa', 'Hogar', 'Deportes'],
                datasets: [{
                    data: [30, 25, 20, 25],
                    backgroundColor: ['#4361ee', '#06d6a0', '#ff9e00', '#ef476f']
                }]
            }
        });
    }
}

// ========== FUNCIÓN: MODO OSCURO ==========
function initDarkMode() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    if (!darkModeToggle) return;
    
    // Verificar preferencia guardada
    const darkMode = localStorage.getItem('darkMode') === 'enabled';
    if (darkMode) {
        document.body.classList.add('dark-mode');
        darkModeToggle.innerHTML = '<i class="fas fa-sun"></i> Modo Claro';
    }
    
    darkModeToggle.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('darkMode', 'enabled');
            this.innerHTML = '<i class="fas fa-sun"></i> Modo Claro';
            showToast('Modo oscuro activado', 'info');
        } else {
            localStorage.setItem('darkMode', 'disabled');
            this.innerHTML = '<i class="fas fa-moon"></i> Modo Oscuro';
            showToast('Modo claro activado', 'info');
        }
    });
}

// ========== FUNCIÓN: NOTIFICACIONES TOAST ==========
function showToast(message, type = 'success') {
    const toastContainer = document.getElementById('toastContainer');
    if (!toastContainer) return;
    
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type} border-0 fade-in-up`;
    toast.setAttribute('role', 'alert');
    toast.setAttribute('aria-live', 'assertive');
    toast.setAttribute('aria-atomic', 'true');
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-info-circle'} me-2"></i>
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    
    toastContainer.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast, { delay: 3000 });
    bsToast.show();
    
    toast.addEventListener('hidden.bs.toast', () => toast.remove());
}

// ========== FUNCIÓN: MOSTRAR NOTIFICACIONES ==========
function showNotifications() {
    const mensaje = new URLSearchParams(window.location.search).get('mensaje');
    const error = new URLSearchParams(window.location.search).get('error');
    
    if (mensaje) {
        showToast(mensaje, 'success');
    }
    
    if (error) {
        showToast(error, 'danger');
    }
}

// ========== FUNCIÓN: VALIDACIÓN DE FORMULARIOS ==========
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return true;
    
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });
    
    return isValid;
}

// ========== FUNCIÓN: EXPORTAR TABLA A EXCEL ==========
function exportToExcel(tableId, filename = 'reporte.xlsx') {
    const table = document.getElementById(tableId);
    if (!table) return;
    
    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.table_to_sheet(table);
    XLSX.utils.book_append_sheet(wb, ws, 'Reporte');
    XLSX.writeFile(wb, filename);
}

// ========== FUNCIÓN: IMPRIMIR TABLA ==========
function printTable(tableId) {
    const table = document.getElementById(tableId);
    if (!table) return;
    
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
            <head>
                <title>Reporte</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body { padding: 20px; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #4361ee; color: white; }
                </style>
            </head>
            <body>
                ${table.outerHTML}
                <script>window.print();<\/script>
            </body>
        </html>
    `);
    printWindow.document.close();
}

// ========== FUNCIÓN: ACTUALIZAR RELOJ EN TIEMPO REAL ==========
function updateClock() {
    const clockElement = document.getElementById('realTimeClock');
    if (!clockElement) return;
    
    const now = new Date();
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };
    clockElement.textContent = now.toLocaleDateString('es-ES', options);
}

setInterval(updateClock, 1000);
updateClock();

// ========== FUNCIÓN: ANIMACIÓN DE CARGA ==========
function showLoading() {
    const loader = document.createElement('div');
    loader.className = 'loader-overlay';
    loader.innerHTML = '<div class="loader"></div>';
    loader.style.position = 'fixed';
    loader.style.top = '0';
    loader.style.left = '0';
    loader.style.width = '100%';
    loader.style.height = '100%';
    loader.style.backgroundColor = 'rgba(0,0,0,0.5)';
    loader.style.zIndex = '9999';
    loader.style.display = 'flex';
    loader.style.justifyContent = 'center';
    loader.style.alignItems = 'center';
    document.body.appendChild(loader);
    
    setTimeout(() => {
        loader.remove();
    }, 500);
}

// ========== FUNCIÓN: MENSAJE DE BIENVENIDA ==========
function showWelcomeMessage() {
    const hour = new Date().getHours();
    let greeting = '';
    
    if (hour < 12) greeting = 'Buenos días';
    else if (hour < 18) greeting = 'Buenas tardes';
    else greeting = 'Buenas noches';
    
    console.log(`${greeting}! Bienvenido a ShopOnline Huila`);
}

showWelcomeMessage();

// ========== EXPORTAR FUNCIONES GLOBALES ==========
window.exportToExcel = exportToExcel;
window.printTable = printTable;
window.validateForm = validateForm;
window.showToast = showToast;