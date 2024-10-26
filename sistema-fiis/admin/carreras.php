<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
  
    header("Location: index.php");
    exit();
}
require_once('../db/db.php');

$sql = "SELECT id_carrera, nombre_carrera, descripcion, duracion, facultad FROM carreras";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Carreras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: orangered;
            color: #ecf0f1;
            padding-top: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }
        .sidebar-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #34495e;
        }
        .sidebar-header img {
            width: 100px;
            border-radius: 50%;
        }
        .sidebar-header h2 {
            margin-top: 10px;
            font-size: 1.5em;
        }
        .sidebar-menu {
            list-style-type: none;
            padding: 0;
        }
        .sidebar-menu li {
            padding: 15px 20px;
            transition: background-color 0.3s;
        }
        .sidebar-menu li:hover {
            background-color: orange;
        }
        .sidebar-menu a {
            color: #ecf0f1;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .sidebar-menu i {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }
        .logout {
            padding: 15px 20px;
            background-color: #e74c3c;
            text-align: center;
            border-radius: 4px;
            transition: background-color 0.3s;
            margin: 20px;
            color: #ecf0f1;
            text-decoration: none;
            display: block;
        }
        .logout:hover {
            background-color: #c0392b;
        }
        .main-content {
            margin-left: 250px;
            flex-grow: 1;
            background-color: #f0f2f5;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .add-button {
            background-color: #4285f4;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        .controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        select, input[type="search"] {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #495057;
        }
        .options {
            display: flex;
            gap: 10px;
        }
        .edit, .delete {
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
        }
        .edit {
            color: #ffc107;
        }
        .delete {
            color: #dc3545;
        }
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .page-button {
            background-color: #4285f4;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="principal.php">
                <img src="../img/logofiis.jfif" alt="Logo del Sistema">
            </a>
            <h2>Sistema de Matrícula</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="usuarios.php"><i class="fas fa-users"></i> Usuarios</a></li>
            <li><a href="estudiantes.php"><i class="fas fa-user-graduate"></i> Estudiantes</a></li>
            <li><a href="carreras.php"><i class="fas fa-graduation-cap"></i> Carreras</a></li>
            <li><a href="cursos.php"><i class="fas fa-book-open"></i> Cursos</a></li>
            <li><a href="docentes.php"><i class="fas fa-chalkboard-teacher"></i> Docentes</a></li>
            <li><a href="matriculas.php"><i class="fas fa-clipboard-list"></i> Matrículas</a></li>
            <li><a href="horarios.php"><i class="fas fa-calendar-alt"></i> Horarios</a></li>
            <li><a href="../logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="container">
            <div class="header">
                <h1>CARRERAS</h1>
                <button class="add-button">+ Agregar carrera</button>
            </div>
            <div class="controls">
                <div>
                    Mostrar 
                    <select>
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                    </select>
                    registros
                </div>
                <div>
                    Buscar: <input type="search">
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCIÓN</th>
                        <th>DURACIÓN (Semestres)</th>
                        <th>FACULTAD</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verificar si hay resultados
                    if (mysqli_num_rows($resultado) > 0) {
                        // Recorrer y mostrar los resultados
                        while($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>" . $fila['id_carrera'] . "</td>";
                            echo "<td>" . $fila['nombre_carrera'] . "</td>";
                            echo "<td>" . $fila['descripcion'] . "</td>";
                            echo "<td>" . $fila['duracion'] . "</td>";
                            echo "<td>" . $fila['facultad'] . "</td>";
                            echo '<td class="options">
                                    <span class="edit">✏️</span>
                                    <span class="delete">🗑️</span>
                                  </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No se encontraron carreras</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="pagination">
                <div>Mostrando registros del 1 al <?php echo mysqli_num_rows($resultado); ?> de un total de <?php echo mysqli_num_rows($resultado); ?> registros</div>
                <div>
                    <button class="page-button">Anterior</button>
                    <button class="page-button" style="background-color: #6c757d;">1</button>
                    <button class="page-button">Siguiente</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
