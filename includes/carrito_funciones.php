<?php
function actualizarCarrito($curso_id, $accion = 'agregar') {
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    if ($accion == 'agregar') {
        // Eliminar la verificación de límite de cursos
        if (!in_array($curso_id, $_SESSION['carrito'])) {
            $_SESSION['carrito'][] = $curso_id;
        }
    } else if ($accion == 'eliminar') {
        $key = array_search($curso_id, $_SESSION['carrito']);
        if ($key !== false) {
            unset($_SESSION['carrito'][$key]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar el array
        }
    }

    return count($_SESSION['carrito']);
}

function obtenerCarrito() {
    return isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
}