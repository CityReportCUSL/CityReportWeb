<?PHP include 'config.php';
	
	//ESTABLECIMIENTO DE CONEXIÓN
	$conexion = new mysqli($hostname,$username,$password,$database);
	if ($conexion->connect_errno) {
		echo "Falló la conexión a MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
	}
	
	//RECIBIR LOS DATOS DE LA APP
	$foto = $_POST["foto"];
	$nombre = $_POST["nombre"];
	$Latitud=$_POST["Latitud"];
	$Longitud=$_POST["Longitud"];
	
	//OBTENER PRÓXIMO ID A INSERTAR
	$consulta="SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cityreportBD' AND TABLE_NAME = 'reportes'";
	$resultado=mysqli_query($conexion,$consulta);
	$linea=mysqli_fetch_assoc($resultado);
		$id=$linea['AUTO_INCREMENT'];
	
	$path = "../uploads/$id.jpg"; 			// RUTA A LA IMAGEN SUBIDA AL SV
	$path_min = "../uploads/$id-min.jpg"; 	//RUTA A LA MINIATURA DE LA IMAGEN
	//SUBIR LA IMAGEN AL SERVIDOR
	file_put_contents($path,base64_decode($foto));
	
	
	//INSERCIÓN EN LA BASE DE DATOS
	if(!$stmt=$conexion->prepare("INSERT INTO `reportes`(nombre,foto,Latitud,Longitud, miniatura) VALUES (?,?,?,?,?)"))
		echo "Falló la preparación de la sentencia";

	if(!$stmt->bind_param("ssdds",$nombre,$path,$Latitud,$Longitud,$path_min))
		echo "Falló el bindeo de parametros";
	
	if(!$stmt->execute())
		echo "error";

	//CIERRE DE CONEXION
	$stmt->close();
	mysqli_close($conexion);

	//CREACION IMAGEN EN MINIATURA PARA MOSTRAR EN EL LISTADO DE REPORTES DE LA WEB
	include 'miniatura.php';
	createThumbnail($path,"../uploads/$id-min.jpg",300);
	
	echo("ok"); //Mensaje enviado ok en la aplicacion
	
?>