<?php
session_start();
// Eliminar solo las variables de sesión del administrador
unset($_SESSION['admin_id']);
unset($_SESSION['admin_rol_id']);
header('Location: login.php');
exit();
?>