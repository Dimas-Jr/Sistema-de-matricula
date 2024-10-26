<?php
require_once 'db/db.php'; 

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['email'];
    $contrasena = $_POST['password'];

    if (!empty($correo) && !empty($contrasena)) {
       
        $query = "SELECT * FROM usuarios WHERE correo = ? AND contrasena = ? LIMIT 1";
        if ($conn && !$conn->connect_error) {
           
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param('ss', $correo, $contrasena);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $usuario = $result->fetch_assoc();
                    
                    $_SESSION['id_usuario'] = $usuario['id_usuario'];
                    $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
                    $_SESSION['rol'] = $usuario['rol'];

                    if ($usuario['rol'] == 'Administrador') {
                        header("Location: admin/principal.php");
                    } elseif ($usuario['rol'] == 'Alumno') {
                        header("Location: usuarios/principal.php");
                    }
                    exit();
                } else {
                    echo "Correo o contraseña incorrectos.";
                }

                $stmt->close();
            } else {
                echo "Error al preparar la consulta.";
            }
        } else {
            echo "Error en la conexión a la base de datos.";
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }
}
if ($conn) {
    $conn->close();
}
?>
