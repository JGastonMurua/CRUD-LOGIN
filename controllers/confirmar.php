<?php
require_once '../includes/db.php';

if (!isset($_GET['token'])) {
    die('Token no proporcionado');
}

$token = $_GET['token'];

// Buscar usuario con ese token
$sql = "SELECT * FROM usuarios WHERE token = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Confirmar cuenta: borrar token y marcar como confirmado
    $sql = "UPDATE usuarios SET token = NULL, confirmado = 1 WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();

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
        ✅ Cuenta confirmada correctamente.
        <br><br>
        <a href='../views/login.php'>Iniciar sesión</a>
    </div>
    ";
} else {
    echo "
    <div style='
        background-color: #f8d7da;
        color: #842029;
        padding: 1rem;
        border: 1px solid #f5c2c7;
        border-radius: 5px;
        margin: 2rem;
        font-family: sans-serif;
        text-align: center;
    '>
        ⚠️ Token inválido o cuenta ya confirmada.
        <br><br>
        <a href='../views/login.php'>Volver al login</a>
    </div>
    ";
}
?>
