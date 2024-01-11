<?php require_once('Connections/conexion.php'); ?>
<?php 

//recepcion de datos
$usuario= $_POST["usuario"];
$contrasena= $_POST["clave"];



 mysql_select_db($database_conexion, $conexion);
//ejecucuion de la sentemcia sql
$sql="select * from seguridad where usuario='$usuario' and clave='$contrasena'";
$resultado= mysql_query($sql)or die(mysql_error());
$fila=mysql_fetch_array($resultado);

//verificar si  son validos los datos
if($fila["usuario"]!=$usuario){
echo "<script type=\"text/javascript\">alert ('Usted no es un usuario registrado');  location.href='index.php' </script>";
exit;
}
else{

 setcookie("usr",$usuario,time()+7776000);
 setcookie("clv",$contrasena,time()+7776000);




include ("inicio.php");


}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de Gestion para Redes Socialistas de Innovacion Productiva </title>
</head>
<body>
</body>
</html>