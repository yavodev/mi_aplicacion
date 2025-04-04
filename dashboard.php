<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

include 'config.php';

$rol_id = $_SESSION['rol_id'];
$usuario_id = $_SESSION['usuario_id'];

// Obtener datos del usuario
$sql = "SELECT * FROM usuarios WHERE id = $usuario_id";
$result = $conn->query($sql);
$usuario = $result->fetch_assoc();

// Obtener citas del usuario
$sql_citas = "SELECT * FROM citas WHERE usuario_id = $usuario_id";
$result_citas = $conn->query($sql_citas);

// Obtener cursos pagados del usuario con su contenido
$sql_cursos_pagados = "SELECT cursos.*, temas.titulo AS tema_titulo, temas.contenido AS tema_contenido, temas.video_url AS tema_video_url
                       FROM cursos
                       INNER JOIN usuario_cursos ON cursos.id = usuario_cursos.curso_id
                       LEFT JOIN temas ON cursos.id = temas.curso_id
                       WHERE usuario_cursos.usuario_id = $usuario_id AND usuario_cursos.pagado = 1";
$result_cursos_pagados = $conn->query($sql_cursos_pagados);

// Obtener cursos del carrito
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
$cursos_carrito = array();
if (!empty($carrito)) {
    $curso_ids = implode(',', array_keys($carrito));
    $sql_cursos_carrito = "SELECT * FROM cursos WHERE id IN ($curso_ids)";
    $result_cursos_carrito = $conn->query($sql_cursos_carrito);
    if ($result_cursos_carrito->num_rows > 0) {
        while ($curso = $result_cursos_carrito->fetch_assoc()) {
            $cursos_carrito[] = $curso;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/custom.css">
    <style>
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }
        .dropdown-menu {
            left: auto;
            right: 0;
            background-color: #343a40; /* Color de fondo oscuro de Bootstrap */
        }
        .dropdown-item {
            color: #ffffff; /* Color de texto blanco */
        }
        .dropdown-item:hover {
            background-color: #007bff; /* Color de fondo azul de Bootstrap */
            color: #ffffff; /* Color de texto blanco */
        }
        .carrito-icon {
            position: relative;
            display: flex;
            align-items: center;
            margin-left: 15px;
        }
        .carrito-icon img {
            width: 24px;
            height: 24px;
        }
        .carrito-icon span {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #dc3545;
            color: white;
            font-size: 11px;
            border-radius: 50%;
            padding: 2px 6px;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Mi Cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <img src="<?php echo isset($usuario['avatar']) && !empty($usuario['avatar']) ? $usuario['avatar'] : 'images/avatar.png'; ?>" alt="Avatar" class="avatar dropdown-toggle" id="avatarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <ul class="dropdown-menu" aria-labelledby="avatarDropdown">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal">Editar Perfil</a></li>
                                <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    </li>
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
        <h1 class="section-title">Dashboard</h1>
        <?php if ($rol_id == 1): ?>
            <!-- Vista para clientes -->
            <h2>Bienvenido, Cliente</h2>
            <p>Aquí puedes ver tus cursos y citas agendadas.</p>

            <!-- Cursos en el Carrito -->
            <h3>Cursos en el Carrito</h3>
            <?php if (!empty($cursos_carrito)): ?>
                <div class="row">
                    <?php foreach ($cursos_carrito as $curso): ?>
                        <div class="col-md-4">
                            <div class="card mb-4 curso-preview locked">
                                <img src="images/<?php echo $curso['imagen']; ?>" class="card-img-top" alt="<?php echo $curso['titulo']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $curso['titulo']; ?></h5>
                                    <p class="card-text"><?php echo $curso['descripcion']; ?></p>
                                    <a href="#" class="btn btn-secondary disabled">Ver Vista Previa</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No tienes cursos en el carrito.</p>
            <?php endif; ?>
            
            <!-- Cursos Pagados -->
            <h3>Mis Cursos</h3>
            <?php if ($result_cursos_pagados->num_rows > 0): ?>
                <div class="row">
                    <?php
                    $current_curso_id = null;
                    $first_curso = true; // Flag to track the first curso
                    while($curso = $result_cursos_pagados->fetch_assoc()):
                        if ($current_curso_id != $curso['id']) {
                            // Close the previous curso if it's not the first one
                            if (!$first_curso) {
                                echo '</ul>
                                                        </div>
                                                    </div>
                                                </div>';
                            }
                            // Start a new curso
                            echo '<div class="col-md-4">
                                    <div class="card mb-4">
                                        <img src="images/' . $curso['imagen'] . '" class="card-img-top" alt="' . $curso['titulo'] . '">
                                        <div class="card-body">
                                            <h5 class="card-title">' . $curso['titulo'] . '</h5>
                                            <p class="card-text">' . $curso['descripcion'] . '</p>
                                            <h6>Temas:</h6>
                                            <ul>';
                            $current_curso_id = $curso['id'];
                            $first_curso = false; // Set the flag to false after the first curso
                        }
                        echo '<li>' . $curso['tema_titulo'] . ' - ' . $curso['tema_contenido'];
                        if ($curso['tema_video_url']) {
                            echo '<br><video width="320" height="240" controls><source src="' . $curso['tema_video_url'] . '" type="video/mp4">Tu navegador no soporta el elemento de video.</video>';
                        }
                        echo '</li>';
                    endwhile;
                    // Close the last curso if there are any cursos
                    if (!$first_curso) {
                        echo '</ul>
                                                        </div>
                                                    </div>
                                                </div>';
                    }
                    ?>
                </div>
            <?php else: ?>
                <p>No has pagado por ningún curso aún.</p>
            <?php endif; ?>

            <!-- Mis Citas -->
            <h3>Mis Citas</h3>
            <?php if ($result_citas->num_rows > 0): ?>
                <div class="row">
                    <?php while($cita = $result_citas->fetch_assoc()): ?>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Cita Programada</h5>
                                    <p class="card-text">
                                        <i class="far fa-calendar-alt"></i> <?php echo $cita['fecha']; ?><br>
                                        <i class="far fa-clock"></i> <?php echo $cita['hora']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>No tienes citas programadas.</p>
            <?php endif; ?>
        <?php elseif ($rol_id == 2): ?>
            <!-- Vista para administradores -->
            <h2>Bienvenido, Administrador</h2>
            <p>Aquí puedes gestionar los cursos y citas.</p>
            <a href="admin_dashboard.php" class="btn btn-primary">Ir al Panel de Administración</a>
        <?php endif; ?>
    </div>

    <!-- Modal para editar perfil -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Editar Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="update_profile.php" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario['email']; ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small class="form-text text-muted">Deja en blanco si no deseas cambiar la contraseña.</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar">Avatar:</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts al final del body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Agregar el script de carrito -->
    <script src="js/carrito.js"></script>
</body>
</html>