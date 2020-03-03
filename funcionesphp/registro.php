<?php include ('conexionbd.php');
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	
	$sentencia = $conexion->prepare("SELECT COUNT(*) FROM $database.usuarios where email=? OR username=?"); //es unico
	if(!$sentencia->bind_param("ss",$email,$username)) echo "Error al bindear parametros 1.";
	if(!$sentencia->execute())
		echo "Error 1";
	$resultado = $sentencia->get_result();
	$row = $resultado->fetch_assoc();
	$data = $row['COUNT(*)'];
	
	if($data==0){
		$stmt = $conexion->prepare("INSERT INTO $database.usuarios (username,email,password) VALUES (?,?,?)");
		if(!$stmt->bind_param("sss", $username, $email, $password)) echo "Error al bindear parametros 2.";
		if($stmt->execute()){
			$sentencia = $conexion->prepare("SELECT id FROM $database.usuarios where email=? AND password=?"); //es unico
			$sentencia->bind_param("ss",$email,$password);
			$sentencia->execute();
			$resultado = $sentencia->get_result();
			$row = $resultado->fetch_assoc();
			$data = $row['id'];
		
		   if($data){
			  echo $data;
		   }
		   echo "ok";
		}
		else echo "Error 2";
		$stmt->close();
		
	}
	else
	{
		echo "Error 3: Ya existe un usuario con esos datos!";
	}
	
	mysqli_close($conexion);
 ?>