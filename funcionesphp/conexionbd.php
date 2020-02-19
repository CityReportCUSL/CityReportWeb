<?php include 'config.php';
    $conexion=mysqli_connect($hostname,$username,$password,$database);
    if ($conexion->connect_errno) {
        echo "Falló la conexión a la base de datos: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
    }
?>