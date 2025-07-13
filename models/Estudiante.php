<?php
class Estudiante {
    private $conn;

    public function __construct($conexion) {
        $this->conn = $conexion;
    }

    public function obtenerTodos() {
    $sql = "SELECT * FROM estudiantes";
    return $this->conn->query($sql);
    }


    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM estudiantes WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function crear($data) {
        $sql = "INSERT INTO estudiantes (nombre, apellido, edad, curso, email, telefono, direccion, imagen, fecha_registro, usuario_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            'ssisssssi',
            $data['nombre'], $data['apellido'], $data['edad'], $data['curso'], $data['email'],
            $data['telefono'], $data['direccion'], $data['imagen'], $data['usuario_id']
        );
        return $stmt->execute();
    }

    public function actualizar($id, $data) {
        $sql = "UPDATE estudiantes SET nombre=?, apellido=?, edad=?, curso=?, email=?, telefono=?, direccion=?, imagen=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            'ssisssssi',
            $data['nombre'], $data['apellido'], $data['edad'], $data['curso'], $data['email'],
            $data['telefono'], $data['direccion'], $data['imagen'], $id
        );
        return $stmt->execute();
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM estudiantes WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
