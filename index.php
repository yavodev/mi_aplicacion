<?php
session_start();
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
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
                <span>Home</span>
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

    <!-- Carrusel -->
    <div style="margin-top: 2rem;">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/hero.jpg" class="d-block w-100" alt="Imagen 1">
                </div>
                <div class="carousel-item">
                    <img src="images/imagen1.jpg" class="d-block w-100" alt="Imagen 2">
                </div>
                <div class="carousel-item">
                    <img src="images/imagen2.jpg" class="d-block w-100" alt="Imagen 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <!-- Sección de Servicios -->
    <section class="servicios py-5">
        <div class="container">
            <h2 class="section-title mb-5">Nuestros Servicios</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <i class="fas fa-briefcase service-icon"></i>
                        <h3>Consultoría Empresarial</h3>
                        <p>Optimización del rendimiento organizacional y bienestar laboral. Estrategias personalizadas para el éxito de su empresa.</p>
                        <a href="servicios.php#consultoria" class="btn btn-primary">Más información</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <i class="fas fa-brain service-icon"></i>
                        <h3>Salud Mental Corporativa</h3>
                        <p>Programas de bienestar emocional y mental para equipos de trabajo. Evaluación y seguimiento personalizado.</p>
                        <a href="servicios.php#salud-mental" class="btn btn-primary">Más información</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <i class="fas fa-chalkboard-teacher service-icon"></i>
                        <h3>Conferencias</h3>
                        <p>Charlas especializadas en liderazgo, gestión del estrés y desarrollo organizacional.</p>
                        <a href="servicios.php#conferencias" class="btn btn-primary">Más información</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Cursos Destacados -->
    <section class="cursos-destacados py-5 bg-light">
        <div class="container">
            <h2 class="section-title mb-5">Cursos Destacados</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="curso-card">
                        <img src="images/curso1.jpg" alt="Curso de Liderazgo" class="curso-imagen">
                        <div class="curso-content">
                            <h3>Liderazgo Efectivo</h3>
                            <p>Desarrolla habilidades de liderazgo basadas en la inteligencia emocional.</p>
                            <div class="curso-footer">
                                <span class="precio">$199.99</span>
                                <a href="agregar_al_carrito.php?id=1" class="btn btn-primary btn-sm">Agregar al carrito</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="curso-card">
                        <img src="images/curso2.jpg" alt="Curso de Gestión de Proyectos" class="curso-imagen">
                        <div class="curso-content">
                            <h3>Gestión de Proyectos</h3>
                            <p>Aprende a gestionar proyectos de manera eficiente y efectiva.</p>
                            <div class="curso-footer">
                                <span class="precio">$149.99</span>
                                <a href="agregar_al_carrito.php?id=2" class="btn btn-primary btn-sm">Agregar al carrito</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="curso-card">
                        <img src="images/curso3.jpg" alt="Curso de Bienestar Corporativo" class="curso-imagen">
                        <div class="curso-content">
                            <h3>Bienestar Corporativo</h3>
                            <p>Implementa programas de bienestar en tu empresa para mejorar la productividad.</p>
                            <div class="curso-footer">
                                <span class="precio">$129.99</span>
                                <a href="agregar_al_carrito.php?id=3" class="btn btn-primary btn-sm">Agregar al carrito</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="cursos.php" class="btn btn-lg btn-outline-primary">Ver todos los cursos</a>
            </div>
        </div>
    </section>

    <!-- Sección de Testimonios -->
    <section class="testimonios py-5">
        <div class="container">
            <h2 class="section-title mb-5">Lo que dicen nuestros clientes</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonio-card">
                        <div class="testimonio-texto">
                            <p>"La consultoría empresarial transformó completamente nuestra cultura organizacional."</p>
                        </div>
                        <div class="testimonio-autor">
                            <img src="images/cliente1.jpg" alt="Cliente" class="testimonio-imagen">
                            <div>
                                <h4>María González</h4>
                                <p>Directora de RRHH</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Agregar más testimonios aquí -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h3>Sobre Nosotros</h3>
                    <p>Expertos en psicología empresarial y desarrollo organizacional, comprometidos con el bienestar y éxito de su empresa.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h3>Enlaces Rápidos</h3>
                    <ul class="footer-links">
                        <li><a href="cursos.php">Cursos</a></li>
                        <li><a href="servicios.php">Servicios</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="contacto.php">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h3>Contacto</h3>
                    <ul class="footer-contact">
                        <li><i class="fas fa-map-marker-alt"></i> Dirección de la oficina</li>
                        <li><i class="fas fa-phone"></i> +1 234 567 890</li>
                        <li><i class="fas fa-envelope"></i> contacto@ejemplo.com</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>&copy; 2025 Tu Empresa. Todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts al final del body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>