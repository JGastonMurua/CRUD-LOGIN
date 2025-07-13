<?php
require '../includes/db.php';
require '../enviar_correo.php';

$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

if ($password !== $confirm) {
    die('Las contraseñas no coinciden');
}

// Validar si el email ya existe
$sql = "SELECT id FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die('El email ya está registrado');
}

// Hashear contraseña y generar token
$hash = password_hash($password, PASSWORD_DEFAULT);
$token = bin2hex(random_bytes(16));

// Insertar nuevo usuario con token y confirmado en 0
$sql = "INSERT INTO usuarios (nombre, email, password, fecha_registro, token, confirmado)
        VALUES (?, ?, ?, NOW(), ?, 0)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $nombre, $email, $hash, $token);

if ($stmt->execute()) {
    // Enviar correo de confirmación
    enviarCorreoConfirmacion($email, $nombre, $token);

    echo "
    <div style='
        background-color: #d1e7dd;
        color: #0f5132;
        padding: 1rem;
        border: 1px solid #badbcc;
        border-radius: 5px;
        margin: 2rem;
        font-family: sans-serif;
        text-align: center;
    '>
        Registro exitoso. Verifica tu correo para confirmar la cuenta.
        <br><small>Redirigiendo al login...</small>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = '../views/login.php';
        }, 4000);
    </script>
    ";
} else {
    echo "Error al registrar usuario.";
}
?>
