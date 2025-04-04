<?php
session_start();
// Eliminar solo las variables de sesión del usuario
unset($_SESSION['usuario_id']);
unset($_SESSION['rol_id']);
header('Location: login.php');
exit();
?>