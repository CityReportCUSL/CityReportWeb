<?PHP include ('functions.php');

	include 'conexionbd.php';

	$foto = $_POST["foto"];
	$nombre = $_POST["nombre"];
	$Latitud=$_POST["Latitud"];
	$Longitud=$_POST["Longitud"];

	
	$consulta="SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'cityreport-bd' AND TABLE_NAME = 'reportes'";
	$resultado=mysqli_query($conexion,$consulta);
	
	$linea=mysqli_fetch_array($resultado);
	$id=$linea['AUTO_INCREMENT'];


	
	$path = "../uploads/$id.jpg";

	file_put_contents($path,base64_decode($foto));
	
	$sql="INSERT INTO reportes(nombre,foto,Latitud,Longitud) VALUES ('$nombre','$path','$Latitud','$Longitud')";
	ejecutarSQLCommand($sql);
	


	
	mysqli_close($conexion);
?>