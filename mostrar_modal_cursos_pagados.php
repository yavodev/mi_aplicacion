<?php
session_start();
if (!isset($_SESSION['cursos_ya_pagados'])) {
    header('Location: carrito.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cursos ya pagados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <div class="modal fade" id="cursosYaPagadosModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Cursos ya adquiridos</h5>
                </div>
                <div class="modal-body">
                    <p>Los siguientes cursos ya han sido pagados anteriormente:</p>
                    <ul>
                        <?php foreach ($_SESSION['cursos_ya_pagados'] as $curso): ?>
                            <li><?php echo htmlspecialchars($curso); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <p>Estos cursos ya están disponibles en tu dashboard.</p>
                </div>
                <div class="modal-footer">
                    <a href="dashboard.php" class="btn btn-primary">Ir a mi Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal(document.getElementById('cursosYaPagadosModal'));
            modal.show();
        });
    </script>
</body>
</html>