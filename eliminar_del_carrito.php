<?php
session_start();
include 'includes/carrito_funciones.php';

// Asegurarse de que la respuesta sea JSON
header('Content-Type: application/json');

// Prevenir output antes de los headers
ob_clean();

if (isset($_GET['id'])) {
    $curso_id = intval($_GET['id']);
    $count = actualizarCarrito($curso_id, 'eliminar');
    
    echo json_encode([
        'success' => true,
        'message' => 'Curso eliminado correctamente',
        'count' => $count
    ]);
    exit();
}

echo json_encode([
    'success' => false,
    'message' => 'Error al eliminar el curso'
]);
exit();
?>