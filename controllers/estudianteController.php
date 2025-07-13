<?php
require '../includes/auth.php';
require '../includes/db.php';
require '../models/Estudiante.php';

$action = $_GET['action'] ?? 'listar';
$estudianteModel = new Estudiante($conn);
session_start();
$usuario_id = $_SESSION['usuario']['id'];

function subirImagen($file) {
    $permitidos = ['image/jpeg', 'image/png', 'image/webp'];
    if (!empty($file['name']) && in_array($file['type'], $permitidos)) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nombre = uniqid() . '.' . $ext;
        $destino = '../uploads/' . $nombre;
        move_uploaded_file($file['tmp_name'], $destino);
        return $nombre;
    }
    return null;
}

// CREAR
if ($action == 'crear' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $imagen = subirImagen($_FILES['imagen']) ?? 'default.png';
    $data = array_merge($_POST, [
        'imagen' => $imagen,
        'usuario_id' => $usuario_id
    ]);

    if ($estudianteModel->crear($data)) {
        header('Location: ../views/estudiantes.php?mensaje=creado');
    } else {
        header('Location: ../views/estudiantes.php?error=1');
    }
    exit;
}

// EDITAR
if ($action == 'editar' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $imagen = subirImagen($_FILES['imagen']) ?? $_POST['imagen_actual'];

    $data = array_merge($_POST, ['imagen' => $imagen]);
    unset($data['id'], $data['imagen_actual']);

    if ($estudianteModel->actualizar($id, $data)) {
        header('Location: ../views/estudiantes.php?mensaje=editado');
    } else {
        header('Location: ../views/estudiantes.php?error=1');
    }
    exit;
}

// ELIMINAR
if ($action == 'eliminar') {
    $id = $_GET['id'];

    if ($estudianteModel->eliminar($id)) {
        header('Location: ../views/estudiantes.php?mensaje=eliminado');
    } else {
        header('Location: ../views/estudiantes.php?error=1');
    }
    exit;
}
