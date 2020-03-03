<?php
   include 'conexionbd.php';

   if (mysqli_connect_errno($conexion)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
   
   $email=$_POST['email'];
	$password=$_POST['password'];

   $sentencia = $conexion->prepare("SELECT * FROM $database.usuarios where (email=? OR username=?) and password=?"); //es unico
	$sentencia->bind_param("sss",$email,$email,$password);
	$sentencia->execute();
	$resultado = $sentencia->get_result();
	$row = $resultado->fetch_assoc();
	$data = $row['id'];


   if($data){
      echo $data;
   }
	
   mysqli_close($conexion);
?>