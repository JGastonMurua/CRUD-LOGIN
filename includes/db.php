<?php
// Conexión a la base de datos MySQL usando alwaysdata
$host = 'mysql-escuelacrud.alwaysdata.net';
$user = '422255_admin';
$pass = 'HN2fpF@!czEB4re';
$db   = 'escuelacrud_escu';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

$conn->set_charset('utf8');
?>
