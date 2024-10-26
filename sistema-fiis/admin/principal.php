<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
  
    header("Location: index.php"); 
    exit();
}
$nombre_usuario = $_SESSION['nombre_usuario'];
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Matrícula Universitaria</title>
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
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ff7675;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
            margin-left: 10px;
        }
        .welcome-card {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .welcome-text h1 {
            color: #6c5ce7;
            margin: 0;
            font-size: 24px;
        }
        .welcome-text p {
            color: #636e72;
            margin: 10px 0 0;
        }
        .welcome-image img {
            max-width: 200px;
        }
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-icon {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .card h2 {
            margin: 0;
            font-size: 18px;
            color: #2d3436;
        }
        .card p {
            font-size: 24px;
            font-weight: bold;
            color: #6c5ce7;
            margin: 10px 0;
        }
        .card button {
            background-color: #6c5ce7;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .card button:hover {
            background-color: #5641e5;
        }
        .matricula .card-icon { color: #74b9ff; }
        .pagos .card-icon { color: #ffeaa7; }
        .reportes .card-icon { color: #55efc4; }
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
            <header class="header">
                <h1>Sistema de Gestión de Matrículas</h1>
                <div class="user-info">
                    <span><?php echo $rol; ?>: <?php echo $nombre_usuario; ?></span>
                    <div class="user-avatar"><?php echo substr($nombre_usuario, 0, 1); ?></div>
                </div>
            </header>
            <main>
                <div class="welcome-card">
                    <div class="welcome-text">
                        <h1>Bienvenid@ <?php echo $nombre_usuario; ?>! 🎉</h1>
                        <p>Sistema de Gestión de Matrículas</p>
                    </div>
                    <div class="welcome-image">
                        <img src="../img/logofiis.jfif" alt="Welcome illustration">
                    </div>
                </div>
                <div class="dashboard-cards">
                    <div class="card matricula">
                        <div class="card-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h2>Matrícula</h2>
                        <p>2</p>
                        <button>Matrículas</button>
                    </div>
                    <div class="card pagos">
                        <div class="card-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h2>Pagos</h2>
                        <p>S/ 135.00</p>
                        <button>Pagos</button>
                    </div>
                    <div class="card reportes">
                        <div class="card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h2>Reportes</h2>
                        <p>-</p>
                        <button>Reportes</button>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
