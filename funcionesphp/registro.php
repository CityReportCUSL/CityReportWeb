<?php include ('conexionbd.php');
	$nombre=$_GET['nombre'];
	$email=$_GET['email'];
	$password=$_GET['password'];
	
	$sentencia = $conexion->prepare("SELECT COUNT(*) FROM usuarios where email=?"); //es unico
	$sentencia->bind_param("s",$email);
	$sentencia->execute();
	$resultado = $sentencia->get_result();
	$row = $resultado->fetch_assoc();
	$data = $row[0];

	
	if($data==0){
		if(!$stmt = $conexion->prepare("INSERT INTO `usuarios` (nombre,email,password) VALUES (?,?,?)");
		$stmt->bind_param("sss", $nombre, $email, $password);
		if($stmt->execute())
			echo "ok";
		else echo "error";
		$stmt->close();
		
	}
	else
	{
		echo "Ya existe usuario con ese email!";
	}
	
	mysqli_close($conexion);
 ?>