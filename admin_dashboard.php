<?php
session_start();
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
?>
<!DOCTYPE html> el usuario es administrador
<html lang="es">SION['admin_id']) || $_SESSION['admin_rol_id'] != 2) {
<head>ader('Location: login.php');
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->s
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Tu CSS personalizado -->/editar curso
    <link rel="stylesheet" href="css/custom.css">($_POST['curso_form'])) {
</head>tulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
<body>recio = $_POST['precio'];
    <!-- Barra de navegación -->'name'];
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">cionado una
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="images/logo.png" alt="Logo" class="navbar-logo me-2">
                Home = $target_dir . basename($imagen);
            </a>oaded_file($_FILES['imagen']['tmp_name'], $target_file);
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>'curso_id'])) {
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">= '$titulo', descripcion = '$descripcion', precio = '$precio', imagen = '$target_file' WHERE id = $curso_id";
                        <a class="nav-link" href="cursos.php">Cursos</a>
                    </li>curso
                    <li class="nav-item">o, descripcion, precio, imagen) VALUES ('$titulo', '$descripcion', '$precio', '$target_file')";
                        <a class="nav-link" href="agendar_cita.php">Agendar Cita</a>
                    </li>
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <li class="nav-item">nte.";
                            <a class="nav-link" href="dashboard.php">Mi Cuenta</a>
                        </li>guardar el curso: " . $conn->error;
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                        </li>ashboard.php');
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Iniciar Sesión</a>
                        </li>egar/editar tema
                        <li class="nav-item">sset($_POST['tema_form'])) {
                            <a class="nav-link" href="registro.php">Registrarse</a>
                        </li>];
                    <?php endif; ?>];
                </ul>ST['video_url'];
                <div class="carrito-icon">
                    <a href="carrito.php">
                        <img src="images/carrito.png" alt="Carrito">
                        <span><?php echo count($carrito); ?></span>
                    </a>emas SET titulo = ?, contenido = ?, video_url = ? WHERE id = ?";
                </div>>prepare($sql);
            </div>d_param("sssi", $titulo, $contenido, $video_url, $tema_id);
        </div>
    </nav> Agregar nuevo tema
        $sql = "INSERT INTO temas (curso_id, titulo, contenido, video_url) VALUES (?, ?, ?, ?)";
    <div id="carouselExampleIndicators" class="carousel slide carousel-container" data-bs-ride="carousel">
        <div class="carousel-indicators">id, $titulo, $contenido, $video_url);
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
        </div>je = "Tema guardado correctamente.";
        <div class="carousel-inner">
            <div class="carousel-item active">" . $stmt->error;
                <img src="images/hero.jpg" class="d-block w-100" alt="Imagen 1">
            </div>
            <div class="carousel-item">hp');
                <img src="images/imagen1.jpg" class="d-block w-100" alt="Imagen 2">
            </div>
            <div class="carousel-item">
                <img src="images/imagen2.jpg" class="d-block w-100" alt="Imagen 3">
            </div>elete'])) {
        </div>= $_GET['delete'];
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>= "Curso eliminado correctamente.";
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>rror;
        </button>
    </div>
    header('Location: admin_dashboard.php');
    <!-- Sección de Servicios -->
    <section class="servicios py-5">
        <div class="container">
            <h2 class="section-title mb-5">Nuestros Servicios</h2>
            <div class="row">])) {
                <div class="col-md-4 mb-4">
                    <div class="service-card">_id";
                        <i class="fas fa-briefcase service-icon"></i>
                        <h3>Consultoría Empresarial</h3>
                        <p>Optimización del rendimiento organizacional y bienestar laboral. Estrategias personalizadas para el éxito de su empresa.</p>
                        <a href="servicios.php#consultoria" class="btn btn-primary">Más información</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">;
                    <div class="service-card">
                        <i class="fas fa-brain service-icon"></i>
                        <h3>Salud Mental Corporativa</h3>
                        <p>Programas de bienestar emocional y mental para equipos de trabajo. Evaluación y seguimiento personalizado.</p>
                        <a href="servicios.php#salud-mental" class="btn btn-primary">Más información</a>
                    </div>
                </div>-8">
                <div class="col-md-4 mb-4">vice-width, initial-scale=1.0">
                    <div class="service-card">
                        <i class="fas fa-chalkboard-teacher service-icon"></i>
                        <h3>Conferencias</h3>bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                        <p>Charlas especializadas en liderazgo, gestión del estrés y desarrollo organizacional.</p>
                        <a href="servicios.php#conferencias" class="btn btn-primary">Más información</a>
                    </div>navegación para el administrador -->
                </div> navbar-expand-lg navbar-dark bg-dark">
            </div>="container-fluid">
        </div> class="navbar-brand" href="admin_dashboard.php">Panel de Administración</a>
    </section>utton class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
         <span class="navbar-toggler-icon"></span>
    <!-- Sección de Cursos Destacados -->     </button>




















































































































</html></body>    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    <!-- Scripts al final del body -->    </footer>        </div>            </div>                </div>                    </div>                        <p>&copy; 2025 Tu Empresa. Todos los derechos reservados.</p>                    <div class="col-md-12 text-center">                <div class="row">            <div class="container">        <div class="footer-bottom">        </div>            </div>                </div>                    </ul>                        <li><i class="fas fa-envelope"></i> contacto@ejemplo.com</li>                        <li><i class="fas fa-phone"></i> +1 234 567 890</li>                        <li><i class="fas fa-map-marker-alt"></i> Dirección de la oficina</li>                    <ul class="footer-contact">                    <h3>Contacto</h3>                <div class="col-md-4 mb-4">                </div>                    </ul>                        <li><a href="contacto.php">Contacto</a></li>                        <li><a href="blog.php">Blog</a></li>                        <li><a href="servicios.php">Servicios</a></li>                        <li><a href="cursos.php">Cursos</a></li>                    <ul class="footer-links">                    <h3>Enlaces Rápidos</h3>                <div class="col-md-4 mb-4">                </div>                    <p>Expertos en psicología empresarial y desarrollo organizacional, comprometidos con el bienestar y éxito de su empresa.</p>                    <h3>Sobre Nosotros</h3>                <div class="col-md-4 mb-4">            <div class="row">        <div class="container py-5">    <footer class="footer">    <!-- Footer -->    </section>        </div>            </div>                <!-- Agregar más testimonios aquí -->                </div>                    </div>                        </div>                            </div>                                <p>Directora de RRHH</p>                                <h4>María González</h4>                            <div>                            <img src="images/cliente1.jpg" alt="Cliente" class="testimonio-imagen">                        <div class="testimonio-autor">                        </div>                            <p>"La consultoría empresarial transformó completamente nuestra cultura organizacional."</p>                        <div class="testimonio-texto">                    <div class="testimonio-card">                <div class="col-md-4 mb-4">            <div class="row">            <h2 class="section-title mb-5">Lo que dicen nuestros clientes</h2>        <div class="container">    <section class="testimonios py-5">    <!-- Sección de Testimonios -->    </section>        </div>            </div>                <a href="cursos.php" class="btn btn-lg btn-outline-primary">Ver todos los cursos</a>            <div class="text-center mt-4">            </div>                </div>                    </div>                        </div>                            </div>                                <a href="agregar_al_carrito.php?id=3" class="btn btn-primary btn-sm">Agregar al carrito</a>                                <span class="precio">$129.99</span>                            <div class="curso-footer">                            <p>Implementa programas de bienestar en tu empresa para mejorar la productividad.</p>                            <h3>Bienestar Corporativo</h3>                        <div class="curso-content">                        <img src="images/curso3.jpg" alt="Curso de Bienestar Corporativo" class="curso-imagen">                    <div class="curso-card">                <div class="col-md-4 mb-4">                </div>                    </div>                        </div>                            </div>                                <a href="agregar_al_carrito.php?id=2" class="btn btn-primary btn-sm">Agregar al carrito</a>                                <span class="precio">$149.99</span>                            <div class="curso-footer">                            <p>Aprende a gestionar proyectos de manera eficiente y efectiva.</p>                            <h3>Gestión de Proyectos</h3>                        <div class="curso-content">                        <img src="images/curso2.jpg" alt="Curso de Gestión de Proyectos" class="curso-imagen">                    <div class="curso-card">                <div class="col-md-4 mb-4">                </div>                    </div>                        </div>                            </div>                                <a href="agregar_al_carrito.php?id=1" class="btn btn-primary btn-sm">Agregar al carrito</a>                                <span class="precio">$199.99</span>                            <div class="curso-footer">                            <p>Desarrolla habilidades de liderazgo basadas en la inteligencia emocional.</p>                            <h3>Liderazgo Efectivo</h3>                        <div class="curso-content">                        <img src="images/curso1.jpg" alt="Curso de Liderazgo" class="curso-imagen">                    <div class="curso-card">                <div class="col-md-4 mb-4">            <div class="row">            <h2 class="section-title mb-5">Cursos Destacados</h2>        <div class="container">    <section class="cursos-destacados py-5 bg-light">            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Vista Usuario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_logout.php">Cerrar Sesión Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Admin Dashboard</h1>
        <?php if (isset($mensaje)) { echo "<div class='alert alert-info'>$mensaje</div>"; } ?>

        <!-- Formulario para agregar/editar curso -->
        <form action="admin_dashboard.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="curso_form" value="1">
            <input type="hidden" name="curso_id" value="<?php echo isset($curso['id']) ? $curso['id'] : ''; ?>">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo isset($curso['titulo']) ? $curso['titulo'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo isset($curso['descripcion']) ? $curso['descripcion'] : ''; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo isset($curso['precio']) ? $curso['precio'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Curso</button>
        </form>

        <!-- Tabla de cursos -->
        <h2 class="mt-5">Cursos</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($curso = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $curso['id']; ?></td>
                    <td><?php echo $curso['titulo']; ?></td>
                    <td><?php echo $curso['descripcion']; ?></td>
                    <td><?php echo $curso['precio']; ?></td>
                    <td><img src="<?php echo $curso['imagen']; ?>" alt="<?php echo $curso['titulo']; ?>" width="100"></td>
                    <td>
                        <a href="admin_dashboard.php?edit=<?php echo $curso['id']; ?>" class="btn btn-warning">Editar</a>
                        <a href="admin_dashboard.php?delete=<?php echo $curso['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este curso?');">Eliminar</a>
                        <a href="admin_dashboard.php?view_temas=<?php echo $curso['id']; ?>" class="btn btn-info">Ver Temas</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Formulario para agregar/editar tema -->
        <?php if (isset($_GET['view_temas'])) {
            $curso_id = $_GET['view_temas'];
            $sql = "SELECT * FROM temas WHERE curso_id = $curso_id";
            $result_temas = $conn->query($sql);
        ?>
        <h2 class="mt-5">Temas del Curso</h2>
        <form action="admin_dashboard.php" method="post">
            <input type="hidden" name="tema_form" value="1">
            <input type="hidden" name="curso_id" value="<?php echo $curso_id; ?>">
            <input type="hidden" name="tema_id" value="<?php echo isset($tema['id']) ? $tema['id'] : ''; ?>">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título del Tema</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo isset($tema['titulo']) ? $tema['titulo'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido</label>
                <textarea class="form-control" id="contenido" name="contenido" required><?php echo isset($tema['contenido']) ? $tema['contenido'] : ''; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="video_url" class="form-label">URL del Video</label>
                <input type="text" class="form-control" id="video_url" name="video_url" value="<?php echo isset($tema['video_url']) ? $tema['video_url'] : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Tema</button>
        </form>

        <!-- Tabla de temas -->
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Video URL</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($tema = $result_temas->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $tema['id']; ?></td>
                    <td><?php echo $tema['titulo']; ?></td>
                    <td><?php echo $tema['contenido']; ?></td>
                    <td><?php echo $tema['video_url']; ?></td>
                    <td>
                        <a href="admin_dashboard.php?edit_tema=<?php echo $tema['id']; ?>" class="btn btn-warning">Editar</a>
                        <a href="admin_dashboard.php?delete_tema=<?php echo $tema['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este tema?');">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>