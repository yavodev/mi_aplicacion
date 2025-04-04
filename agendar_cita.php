<?php
session_start();
include 'config.php';

// Obtener fechas disponibles desde la base de datos
$sql = "SELECT fecha, hora FROM citas_disponibles WHERE fecha >= CURDATE()";
$result = $conn->query($sql);
$fechas_disponibles = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $fechas_disponibles[] = $row;
    }
}

// Procesar el formulario de agendar cita
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : 1;
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $descripcion = $_POST['descripcion'];
    $sql = "INSERT INTO citas (usuario_id, fecha, hora, descripcion) VALUES ($usuario_id, '$fecha', '$hora', '$descripcion')";
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Cita agendada correctamente.";
    } else {
        $mensaje = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/custom.css">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .section-title {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }
    </style>
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
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registro.php">Registrarse</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="carrito-icon">
                    <img src="images/carrito.png" alt="Carrito">
                    <span>3</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <h1 class="section-title text-center">Agendar Cita</h1>
                    <?php if(isset($mensaje)) { echo '<div class="alert alert-info">' . $mensaje . '</div>'; } ?>
                    <form method="post" action="">
                        <div class="form-group mb-3">
                            <label for="fecha">Fecha:</label>
                            <select class="form-control" id="fecha" name="fecha" required>
                                <option value="">Seleccione una fecha</option>
                                <?php
                                foreach ($fechas_disponibles as $fecha) {
                                    echo '<option value="' . $fecha['fecha'] . '">' . $fecha['fecha'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="hora">Hora:</label>
                            <select class="form-control" id="hora" name="hora" required>
                                <option value="">Seleccione una hora</option>
                                <?php
                                foreach ($fechas_disponibles as $fecha) {
                                    echo '<option value="' . $fecha['hora'] . '">' . $fecha['hora'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Agendar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Sobre Nosotros</h3>
                    <p>Información sobre la empresa...</p>
                </div>
                <div class="col-md-4">
                    <h3>Enlaces Rápidos</h3>
                    <ul class="footer-links">
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="cursos.php">Cursos</a></li>
                        <li><a href="agendar_cita.php">Agendar Cita</a></li>
                        <li><a href="contacto.php">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>Contacto</h3>
                    <ul class="footer-contact">
                        <li><i class="fas fa-map-marker-alt"></i> Dirección</li>
                        <li><i class="fas fa-phone"></i> Teléfono</li>
                        <li><i class="fas fa-envelope"></i> Email</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container text-center">
                <p>&copy; 2025 Mi Aplicación. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts al final del body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
