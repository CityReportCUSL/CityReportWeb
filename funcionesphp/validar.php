<?php
   include 'conexionbd.php';

   if (mysqli_connect_errno($conexion)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
	
   $email = $_POST['email'];
   $password = $_POST['password'];
   $result = mysqli_query($conexion,"SELECT * FROM usuarios where email='$email' and password='$password'");
   $row = mysqli_fetch_array($result);
   $data = $row[0];

   if($data){
      echo $data;
   }
	
   mysqli_close($conexion);
?>