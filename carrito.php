<?php
session_start();
include 'config.php';

$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <!-- Incluir la barra de navegación -->
    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-5">
        <h1>Tu Carrito</h1>
        <?php if (!empty($carrito)): ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($carrito as $curso_id):
                            $sql = "SELECT * FROM cursos WHERE id = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $curso_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0):
                                $curso = $result->fetch_assoc();
                                $total += $curso['precio'];
                        ?>
                            <tr class="curso-<?php echo $curso['id']; ?>">
                                <td><?php echo $curso['titulo']; ?></td>
                                <td>$<?php echo $curso['precio']; ?></td>
                                <td>
                                    <button onclick="eliminarDelCarrito(<?php echo $curso['id']; ?>)" 
                                            class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td colspan="2"><strong>$<?php echo number_format($total, 2); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="text-end mt-3">
                <a href="proceso_pago.php" class="btn btn-success">Proceder al Pago</a>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                No hay cursos en el carrito.
                <a href="cursos.php" class="btn btn-primary ms-3">Ver Cursos</a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/carrito.js"></script>
</body>
</html>
