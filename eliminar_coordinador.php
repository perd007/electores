<?php require_once('Connections/conexion.php'); ?>
<? include("login.php"); ?>

<?php

 
//validar usuario

if($validacion==true){
	if($eli==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Eliminaciones'); location.href='fondo.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='fondo.php'  </script>";
 exit;
}

$id=$_GET["cedula"];

$sql="delete from coordinadores where cedula='$id'";
$verificar=mysql_query($sql,$conexion) or die(mysql_error());

if($verificar){
	echo"<script type=\"text/javascript\">alert ('Datos Eliminado'); location.href='consulta_coordinadores.php' </script>";
}
else{
	echo"<script type=\"text/javascript\">alert ('Error'); location.href='consulta_coordinadores.php' </script>";
	
}
?>