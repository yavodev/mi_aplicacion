<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if (password_verify($password, $usuario['contrasena'])) {
            // Guardar información de sesión basada en el rol
            if ($usuario['rol_id'] == 2) { // Administrador
                $_SESSION['admin_id'] = $usuario['id'];
                $_SESSION['admin_rol_id'] = $usuario['rol_id'];
                header('Location: admin_dashboard.php');
            } else { // Usuario normal
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['rol_id'] = $usuario['rol_id'];
                header('Location: dashboard.php');
            }
            exit();
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "Usuario no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h1 class="section-title text-center">Login</h1>
                    <?php if(isset($mensaje)) { echo '<div class="alert alert-info">' . $mensaje . '</div>'; } ?>
                    <form method="post" action="">
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                    </form>
                    <p class="mt-3 text-center">¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts al final del body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>