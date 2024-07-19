<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'login';

$conne = mysqli_connect($servername, $username, $password, $dbname);
if (!$conne) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$error = "";
$debug_info = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['corre'];
    $clave = $_POST['pass'];

    $debug_info .= "Correo recibido: " . $correo . "<br>";
    $debug_info .= "Clave recibida: " . $clave . "<br>";

    // Prevenir inyección SQL
    $correo = mysqli_real_escape_string($conne, $correo);
    $clave = mysqli_real_escape_string($conne, $clave);

    $query = "SELECT * FROM usuarios WHERE correo = '$correo' AND clave = '$clave'";
    $debug_info .= "Consulta SQL: " . $query . "<br>";

    $resultado = mysqli_query($conne, $query);
    
    if (!$resultado) {
        $debug_info .= "Error en la consulta: " . mysqli_error($conne) . "<br>";
    } else {
        $debug_info .= "Número de filas encontradas: " . mysqli_num_rows($resultado) . "<br>";
    }

    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['nombre_completo'] = $usuario['nombre_completo'];
        header("Location: AutoClassInicio.html");
        exit();
    } else {
        $error = "Correo o contraseña incorrectos";
    }
}

// Verificar la estructura de la tabla
$debug_info .= "Estructura de la tabla usuarios:<br>";
$result = mysqli_query($conne, "DESCRIBE usuarios");
while ($row = mysqli_fetch_assoc($result)) {
    $debug_info .= $row['Field'] . "<br>";
}

// Verificar los datos en la base de datos
$debug_info .= "Datos en la tabla usuarios:<br>";
$query = "SELECT * FROM usuarios";
$result = mysqli_query($conne, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $debug_info .= "ID: " . $row['id'] . ", Nombre: " . $row['nombre_completo'] . ", Correo: " . $row['correo'] . "<br>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<img src="./img/LOGO_AUTOCLASS 1.png" alt="" usemap="#LOGO_AUTOCLASS">
      <map name="#LOGO_AUTOCLASS">
          <area shape="rect" coords="14,74,264,115" href="AutoClassInicio.html">
      </map>

    <div class="login-container">
        <h2>INICIAR SESIÓN</h2>
        <?php
        if (!empty($error)) {
            echo "<p style='color: red;'>$error</p>";
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-group">
                <input type="email" name="corre" placeholder="Ingrese su correo" required>
            <div class="input-group">
                <input type="password" name="pass" placeholder="Ingrese su contraseña" required>
            </div>
            <div class="button-group">
                <button type="submit">INICIAR SESION</button> <br><br>
            </div>
        </form>
        <div class="button-group">
            <a href="register.php"><button type="button" class="register-button">REGISTRATE</button></a>
        </div>
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