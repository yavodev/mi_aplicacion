function actualizarContadorCarrito(count) {
    document.querySelectorAll('.carrito-icon span').forEach(contador => {
        contador.textContent = count;
    });
}

function mostrarModal(titulo, mensaje, tipo = 'info') {
    const modalHTML = `
        <div class="modal fade" id="carritoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ${tipo === 'error' ? 'bg-danger' : tipo === 'success' ? 'bg-success' : 'bg-primary'} text-white">
                        <h5 class="modal-title">${titulo}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>${mensaje}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Limpiar modales anteriores
    const modalContainer = document.getElementById('modalContainer');
    if (!modalContainer) {
        document.body.insertAdjacentHTML('beforeend', '<div id="modalContainer"></div>');
    }
    document.getElementById('modalContainer').innerHTML = modalHTML;

    // Mostrar el nuevo modal
    const modal = new bootstrap.Modal(document.getElementById('carritoModal'));
    modal.show();
}

function agregarAlCarrito(curso_id) {
    fetch('agregar_al_carrito.php?id=' + curso_id, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        actualizarContadorCarrito(data.count);
        
        if (data.yaExiste) {
            mostrarModal(
                'Curso ya en carrito',
                'Este curso ya está en tu carrito de compras.',
                'warning'
            );
        } else {
            mostrarModal(
                'Curso agregado',
                'El curso se ha agregado exitosamente a tu carrito.',
                'success'
            );
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarModal(
            'Error',
            'Hubo un problema al agregar el curso al carrito.',
            'error'
        );
    });
}

function eliminarDelCarrito(curso_id) {
    fetch('eliminar_del_carrito.php?id=' + curso_id, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualizar contador del carrito
            actualizarContadorCarrito(data.count);
            
            // Eliminar la fila del curso
            const cursoRow = document.querySelector('.curso-' + curso_id);
            if (cursoRow) {
                cursoRow.remove();
            }
            
            // Actualizar el total
            actualizarTotal();
            
            // Mostrar mensaje de éxito
            mostrarModal(
                'Éxito',
                'El curso ha sido eliminado del carrito.',
                'success'
            );
            
            // Si el carrito está vacío, mostrar mensaje y botón de "Ver Cursos"
            if (data.count === 0) {
                const container = document.querySelector('.container.mt-5');
                container.innerHTML = `
                    <h1>Tu Carrito</h1>
                    <div class="alert alert-info">
                        No hay cursos en el carrito.
                        <a href="cursos.php" class="btn btn-primary ms-3">Ver Cursos</a>
                    </div>
                `;
            }
        } else {
            mostrarModal(
                'Error',
                data.message || 'Hubo un problema al eliminar el curso del carrito.',
                'error'
            );
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarModal(
            'Error',
            'Hubo un problema al eliminar el curso del carrito.',
            'error'
        );
    });
}

// Función para actualizar el total del carrito
function actualizarTotal() {
    const rows = document.querySelectorAll('tbody tr');
    let total = 0;
    
    rows.forEach(row => {
        const precioText = row.querySelector('td:nth-child(2)').textContent;
        const precio = parseFloat(precioText.replace('$', ''));
        total += precio;
    });
    
    const totalElement = document.querySelector('tfoot strong:last-child');
    if (totalElement) {
        totalElement.textContent = '$' + total.toFixed(2);
    }
}