<?php require_once('Connections/conexion.php'); ?>
<? include("login.php"); ?>
<?php

 
//validar usuario

if($validacion==true){
	if($Admi==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Eliminaciones'); location.href='consultaUsuarios.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href=''consultaUsuarios.php'  </script>";
 exit;
}
?>
<?php

$id=$_GET['id'];
mysql_select_db($database_conexion, $conexion);
$query_usuarios = "SELECT * FROM seguridad where administrar=1 and id_seg!=$id";
$usuarios = mysql_query($query_usuarios, $conexion) or die(mysql_error());
$row_usuarios = mysql_fetch_assoc($usuarios);
$totalRows_usuarios = mysql_num_rows($usuarios);

if($totalRows_usuarios==0){
echo"<script type=\"text/javascript\">alert ('Debe existir al menos un usuario con el permiso de administrar'); location.href='consultaUsuarios.php' </script>";
exit;
}


mysql_select_db($database_conexion, $conexion);
$query_usuarios2 = "SELECT * FROM seguridad where id_seg=$id";
$usuarios2 = mysql_query($query_usuarios2, $conexion) or die(mysql_error());
$row_usuarios2 = mysql_fetch_assoc($usuarios2);

 //conexion 
mysql_select_db($database_conexion, $conexion);
  

$sql="delete from seguridad where id_seg='$id'";
$verificar=mysql_query($sql,$conexion) or die(mysql_error());

if($verificar){
	if($_COOKIE["usr"]==$row_usuarios2["usuario"])
	echo"<script type=\"text/javascript\">alert ('Datos Eliminado'); location.href='cerrarSesion.php' </script>";
	else
	echo"<script type=\"text/javascript\">alert ('Datos Eliminado'); location.href='consultaUsuarios.php' </script>";
}
else
	echo"<script type=\"text/javascript\">alert ('Error'); location.href='consultaUsuarios.php' </script>";
	


mysql_free_result($usuarios);
?>