<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRATE</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="./img_l/LOGO_AUTOCLASS 1.png" alt="Logo">

    <div class="login-container">
        <h2>REGISTRAR</h2>
        <form action="register.php" method="post">
            <div class="input-group">
                <input type="text" placeholder="Ingrese su nombre" name="nombrecompleto" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Ingrese su correo" name="corre" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Ingrese su contraseña" name="pass" required>
            </div>
          
            <div class="button-group">
                    <button type="submit" class="register-button">REGISTRATE</button>  <br><br>
            </div>
            </form>
            <div class="button-group">
                    <a href="login.php"><button type="submit" class="register-button">INICIAR SESION</button> 
                </a>
       
    </div>

    <footer class="footer">
        <div class="social-media">
            <a href="#"><img src="redes_l/facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img src="redes_l/instagram-icon.png" alt="Instagram"></a>
            <a href="#"><img src="redes_l/youtube-icon.png" alt="YouTube"></a>
        </div>
    </footer>
</body>
</html>

<?php

error_reporting(0);

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'login';

$conne = mysqli_connect($servername, $username, $password, $dbname);

/* if($conne){
    echo "Base de datos conectada con exito";
}else {
    echo "No se pudo conectar a la base de datos";
}
 */

$nombrecomp = $_POST['nombrecompleto'];
$corree = $_POST['corre'];
$clav = $_POST['pass'];

$query = "INSERT INTO usuarios (nombre_completo, correo, clave) 
VALUE ('$nombrecomp', '$corree', '$clav')";

$ejecutar = mysqli_query($conne, $query);


?>