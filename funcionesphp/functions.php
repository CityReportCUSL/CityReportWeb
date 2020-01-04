<?php 
include 'conexionbd.php';
header( 'Content-Type: text/html;charset=utf-8' );


function ejecutarSQLCommand($commando){
 
 $mysqli = new mysqli($hostname_localhost,  $username_localhost, $password_localhost ,$database_localhost);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

if ( $mysqli->multi_query($commando)) {
     if ($resultset = $mysqli->store_result()) {
    	while ($row = $resultset->fetch_array(MYSQLI_BOTH)) {
    		
    	}
    	$resultset->free();
     }
    
   
}

$mysqli->close();
echo "ok";
}

function getSQLResultSet($commando){
 
 $mysqli = new mysqli($hostname_localhost,  $username_localhost, $password_localhost ,$database_localhost);
 
/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

if ( $mysqli->multi_query($commando)) {
	return $mysqli->store_result();
	
   
}



$mysqli->close();
}


?>
