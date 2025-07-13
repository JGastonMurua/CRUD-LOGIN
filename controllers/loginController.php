<?php
session_start();
require '../includes/db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    header("Location: ../views/login.php?error=campos");
    exit;
}

// Buscar usuario por email
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    header("Location: ../views/login.php?error=email&oldemail=" . urlencode($email));
    exit;
}

$usuario = $resultado->fetch_assoc();

// Verificar si está confirmado
if ($usuario['confirmado'] != 1) {
    header("Location: ../views/login.php?error=confirmacion&oldemail=" . urlencode($email));
    exit;
}

// Verificar contraseña
if (!password_verify($password, $usuario['password'])) {
    header("Location: ../views/login.php?error=clave&oldemail=" . urlencode($email));
    exit;
}

// Guardar toda la información del usuario como array
$_SESSION['usuario'] = [
    'id' => $usuario['id'],
    'nombre' => $usuario['nombre'],
    'email' => $usuario['email']
];

// Redirección a la ruta correcta
header("Location: ../views/estudiantes.php");
exit;
?>