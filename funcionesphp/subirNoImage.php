<?php include 'config.php';
	
	//ESTABLECIMIENTO DE CONEXIÓN
	$conexion= new mysqli($hostname,$username,$password,$database);
	if ($conexion->connect_errno) {
		echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
	}

	//RECIBIR LOS DATOS DE LA APP
	$nombre=$_POST['nombre'];
	$Latitud=$_POST["Latitud"];
	$Longitud=$_POST["Longitud"];
	$autor=$_POST["autor"];

	//INSERCIÓN EN LA BASE DE DATOS
	if(!$stmt=$conexion->prepare("INSERT INTO reportes(nombre,Latitud,Longitud,autor) VALUES (?,?,?,?)"))
		echo "Falló la preparación de la sentencia";
	
	if(!$stmt->bind_param("ssss",$nombre,$Latitud,$Longitud,$autor))
		echo "Falló el bindeo de parametros";
	
	if($stmt->execute())
		echo "ok";
	else echo "error";

	//CIERRE DE CONEXION
	$stmt->close();
	mysqli_close($conexion);

 ?>