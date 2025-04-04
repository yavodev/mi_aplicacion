<?php
session_start();
include 'includes/carrito_funciones.php';

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || 
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    // Si no es una petición AJAX, redirigir
    if (isset($_GET['id'])) {
        $curso_id = intval($_GET['id']);
        actualizarCarrito($curso_id, 'agregar');
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// Asegurarse de que la respuesta sea JSON
header('Content-Type: application/json');

// Prevenir output antes de los headers
ob_clean();

if (isset($_GET['id'])) {
    $curso_id = intval($_GET['id']);
    
    // Verificar si el curso ya está en el carrito
    if (isset($_SESSION['carrito']) && in_array($curso_id, $_SESSION['carrito'])) {
        echo json_encode([
            'success' => true,
            'yaExiste' => true,
            'count' => count($_SESSION['carrito'])
        ]);
        exit();
    }
    
    $count = actualizarCarrito($curso_id, 'agregar');
    
    echo json_encode([
        'success' => true,
        'yaExiste' => false,
        'count' => $count
    ]);
    exit();
}

echo json_encode([
    'success' => false,
    'message' => 'ID de curso no proporcionado'
]);
exit();
