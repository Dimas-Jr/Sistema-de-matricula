<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Sistema de Matrícula FIIS</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="login-container">
        <img src="img/logofiis.jfif" alt="Logo FIIS" class="logo">
        <h1>Inicio de Sesión</h1>
        <form action="login.php" method="POST">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required placeholder="ejemplo@unfv.edu.pe">
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required placeholder="**********">
            
            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>
