<?php include ('functions.php');
	$nombre=$_POST['nombre'];
	$Latitud=$_POST["Latitud"];
	$Longitud=$_POST["Longitud"];

ejecutarSQLCommand("INSERT INTO  `reportes` (nombre,Latitud,Longitud) VALUES ('$nombre','$Latitud', '$Longitud' ); commit;");


 ?>