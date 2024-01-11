<?php require_once('Connections/conexion.php'); ?>

<?php

$id=$_GET["id"];

$sql="delete from evento where id_evento='$id'";
$verificar=mysql_query($sql,$conexion) or die(mysql_error());

if($verificar){
	echo"<script type=\"text/javascript\">alert ('Datos Eliminado'); location.href='consultar_eventos.php' </script>";
}
else{
	echo"<script type=\"text/javascript\">alert ('Error'); location.href='consultar_eventos.php' </script>";
	
}
?>