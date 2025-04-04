<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $avatar = $_FILES['avatar']['name'];

    // Subir el avatar si se ha seleccionado uno
    if ($avatar) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($avatar);
        move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file);

        // Ajustar el tamaño de la imagen
        $image = imagecreatefromstring(file_get_contents($target_file));
        $width = imagesx($image);
        $height = imagesy($image);
        $new_width = 100;
        $new_height = 100;
        $thumb = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($thumb, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagejpeg($thumb, $target_file, 80);

        $avatar_sql = ", avatar = '$target_file'";
    } else {
        $avatar_sql = "";
    }

    // Actualizar la contraseña si se ha proporcionado una nueva
    if ($password) {
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);
        $password_sql = ", contrasena = '$password_hashed'";
    } else {
        $password_sql = "";
    }

    // Actualizar los datos del usuario
    $sql = "UPDATE usuarios SET nombre = '$nombre', email = '$email' $password_sql $avatar_sql WHERE id = $usuario_id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Perfil actualizado correctamente.";
    } else {
        $_SESSION['mensaje'] = "Error: " . $conn->error;
    }

    header('Location: dashboard.php');
    exit();
}
?>