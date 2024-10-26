<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}
require_once('../db/db.php');
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];

    $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        header("Location: usuarios.php?mensaje=Usuario eliminado con éxito");
        exit();
    } else {
        
        header("Location: usuarios.php?mensaje=Error al eliminar el usuario");
        exit();
    }
} else {
    header("Location: usuarios.php?mensaje=ID de usuario no especificado");
    exit();
}
?>
