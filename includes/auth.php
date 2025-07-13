<?php
session_start();

function isAuth() {
    return isset($_SESSION['usuario']) && is_array($_SESSION['usuario']);
}

function requireAuth() {
    if (!isAuth()) {
        header('Location: /proyecto_crud/views/login.php');
        exit;
    }
}

// ✅ Función para obtener datos del usuario logueado
function getUser() {
    return $_SESSION['usuario'] ?? null;
}

// ✅ Función para obtener ID del usuario
function getUserId() {
    return $_SESSION['usuario']['id'] ?? null;
}
?>