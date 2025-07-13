<?php
// ✅ Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ✅ Detectar la ruta base según desde dónde se incluye este archivo
$current_dir = dirname($_SERVER['PHP_SELF']);
$is_in_views = strpos($current_dir, '/views') !== false;
$base_path = $is_in_views ? '../' : './';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
        .navbar-brand { font-weight: bold; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="<?= $base_path ?>views/estudiantes.php">🏫 Sistema Escolar</a>

    <?php if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])): ?>
        <div class="d-flex align-items-center ms-auto text-white">
            <span class="me-3">👤 <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></span>
            <a href="<?= $base_path ?>logout.php" class="btn btn-sm btn-outline-light">Cerrar sesión</a>
        </div>
    <?php endif; ?>
</nav>

<div class="container mt-4">