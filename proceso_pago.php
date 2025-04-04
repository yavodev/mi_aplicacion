<?php
session_start();
include 'config.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
$cursos_ya_pagados = array();

if (!empty($carrito)) {
    // Verificar cursos ya pagados
    foreach ($carrito as $curso_id) {
        $check_sql = "SELECT * FROM usuario_cursos WHERE usuario_id = ? AND curso_id = ? AND pagado = 1";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("ii", $usuario_id, $curso_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            // Obtener información del curso
            $curso_sql = "SELECT titulo FROM cursos WHERE id = ?";
            $curso_stmt = $conn->prepare($curso_sql);
            $curso_stmt->bind_param("i", $curso_id);
            $curso_stmt->execute();
            $curso_result = $curso_stmt->get_result();
            $curso = $curso_result->fetch_assoc();
            $cursos_ya_pagados[] = $curso['titulo'];
        }
    }
    
    if (!empty($cursos_ya_pagados)) {
        // Si hay cursos ya pagados, mostrar modal
        $_SESSION['cursos_ya_pagados'] = $cursos_ya_pagados;
        header('Location: mostrar_modal_cursos_pagados.php');
        exit();
    }

    // Proceder con el pago de cursos no pagados
    $conn->begin_transaction();
    
    try {
        foreach ($carrito as $curso_id) {
            $insert_sql = "INSERT INTO usuario_cursos (usuario_id, curso_id, pagado) 
                          VALUES (?, ?, 1) 
                          ON DUPLICATE KEY UPDATE pagado = 1";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("ii", $usuario_id, $curso_id);
            $insert_stmt->execute();
        }
        
        $conn->commit();
        $_SESSION['carrito'] = array();
        $_SESSION['mensaje'] = "¡Pago procesado correctamente!";
        header('Location: dashboard.php');
        exit();
        
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error'] = "Error al procesar el pago: " . $e->getMessage();
        header('Location: carrito.php');
        exit();
    }
} else {
    $_SESSION['error'] = "No hay cursos en el carrito";
    header('Location: carrito.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proceso de Pago</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Mi Aplicación</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="cursos.php">Cursos</a></li>
                <li class="nav-item"><a class="nav-link" href="agendar_cita.php">Agendar Cita</a></li>
                <li class="nav-item"><a class="nav-link" href="carrito.php">Carrito</a></li>
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Mi Cuenta</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Proceso de Pago</h1>
        <div class="alert alert-success"><?php echo $mensaje; ?></div>
        <a href="index.php" class="btn btn-primary">Volver a la página principal</a>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
