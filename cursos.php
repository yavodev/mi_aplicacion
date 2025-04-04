<?php
session_start();
include 'config.php';

// Obtener los cursos desde la base de datos
$sql = "SELECT * FROM cursos";
$result = $conn->query($sql);
$cursos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cursos[] = $row;
    }
}

// Obtener el contador del carrito
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();

// Handle course selection
if (isset($_GET['select_curso'])) {
    $curso_id = $_GET['select_curso'];
    header("Location: agregar_al_carrito.php?id=" . $curso_id);
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos Disponibles</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="images/logo.png" alt="Logo" class="navbar-logo me-2">
                Inicio
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="cursos.php">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="agendar_cita.php">Agendar Cita</a>
                    </li>
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Mi Cuenta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registro.php">Registrarse</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="carrito-icon">
                    <a href="carrito.php">
                        <img src="images/carrito.png" alt="Carrito">
                        <span><?php echo count($carrito); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="section-title">Cursos Disponibles</h1>
        <div class="row">
            <?php
            if (!empty($cursos)) {
                foreach ($cursos as $curso) {
                    echo '<div class="col-md-4 mb-4">';
                        echo '<div class="curso-card">';
                            echo '<img class="curso-imagen" src="images/' . htmlspecialchars($curso['imagen']) . '" alt="' . htmlspecialchars($curso['titulo']) . '">';
                            echo '<div class="curso-content">';
                                echo '<h3>' . htmlspecialchars($curso['titulo']) . '</h3>';
                                echo '<p>' . htmlspecialchars($curso['descripcion']) . '</p>';
                                echo '<div class="curso-footer">';
                                    echo '<span class="precio">$' . number_format($curso['precio'], 2) . '</span>';
                                    echo '<button type="button" 
                                          onclick="agregarAlCarrito(' . $curso['id'] . ')" 
                                          class="btn btn-primary btn-sm">
                                          Agregar al Carrito
                                          </button>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No hay cursos disponibles.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Scripts al final del body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Agregar el script de carrito -->
    <script src="js/carrito.js"></script>
</body>
</html>
