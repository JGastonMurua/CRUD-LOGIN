<?php
// ✅ LOGOUT.PHP - Con ruta corregida
session_start();
session_unset();
session_destroy();

// ✅ CORREGIDO: Ruta absoluta que siempre funciona
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];

// Detectar automáticamente la carpeta del proyecto
$script_dir = dirname($_SERVER['SCRIPT_NAME']);
$project_dir = str_replace('/logout.php', '', $script_dir);

$redirect_url = "$protocol://$host$project_dir/views/login.php?mensaje=logout";

header("Location: $redirect_url");
exit;
?>