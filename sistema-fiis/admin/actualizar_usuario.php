<?php
require_once '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    $contrasena = $_POST['contrasena'];

    if (!empty($contrasena)) {
    
        $query = "UPDATE usuarios SET nombre_usuario=?, correo=?, contrasena=?, rol=? WHERE id_usuario=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $nombre_usuario, $correo, $contrasena, $rol, $id_usuario);
    } else {
    
        $query = "UPDATE usuarios SET nombre_usuario=?, correo=?, rol=? WHERE id_usuario=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $nombre_usuario, $correo, $rol, $id_usuario);
    }
    if ($stmt->execute()) {
        echo "Usuario actualizado correctamente.";
    } else {
        echo "Error al actualizar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: usuarios.php");
    exit();
}
?>
