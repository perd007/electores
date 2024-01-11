<?php require_once('Connections/conexion.php'); ?>
<? include("login.php"); ?>
<?php 
//validar usuario
if($validacion==true){
	if($cons==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Consultas'); location.href='fondo.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='fondo.php'  </script>";
 exit;
}
?>
<?php
$maxRows_centro = 10;
$pageNum_centro = 0;
if (isset($_GET['pageNum_centro'])) {
  $pageNum_centro = $_GET['pageNum_centro'];
}
$startRow_centro = $pageNum_centro * $maxRows_centro;

mysql_select_db($database_conexion, $conexion);
$query_centro = "SELECT * FROM centro_votacion";
$query_limit_centro = sprintf("%s LIMIT %d, %d", $query_centro, $startRow_centro, $maxRows_centro);
$centro = mysql_query($query_limit_centro, $conexion) or die(mysql_error());
$row_centro = mysql_fetch_assoc($centro);

if (isset($_GET['totalRows_centro'])) {
  $totalRows_centro = $_GET['totalRows_centro'];
} else {
  $all_centro = mysql_query($query_centro);
  $totalRows_centro = mysql_num_rows($all_centro);
}
$totalPages_centro = ceil($totalRows_centro/$maxRows_centro)-1;

if( $totalRows_centro<=0){
  echo "<script type=\"text/javascript\">alert ('No existen Centros de Votacion Registrados');  location.href='registro_Centro.php' </script>";
  }
  
mysql_select_db($database_conexion, $conexion);
$query_elec = "SELECT * FROM elector ";
$elec = mysql_query($query_elec, $conexion) or die(mysql_error());
$row_elec = mysql_fetch_assoc($elec);
$totalRows_elec = mysql_num_rows($elec);
  if($totalRows_elec<=0){
  echo "<script type=\"text/javascript\">alert ('No existen electores Registrados');  location.href='registro_elector.php' </script>";
  }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
</head>

<body>
<table width="576" border="0" align="center" cellpadding="1" cellspacing="2" class="bordes">
  <tr>
    <th colspan="2" bgcolor="#b60101" scope="col"><span class="Estilo1">Consulta de Electores por Centro de Votacion </span></th>
  </tr>
  <tr>
    <td width="337" bgcolor="#b60101"><div align="center" class="Estilo1"><strong>Centro de Votacion </strong></div></td>
    <td width="225" bgcolor="#b60101"><div align="center" class="Estilo1"><strong>Cantidad de Electores </strong></div></td>
  </tr>
  
  <?php do {
  
  mysql_select_db($database_conexion, $conexion);
$query_electores = "SELECT count(*) FROM elector where centro='$row_centro[id_centro]'";
$electores = mysql_query($query_electores, $conexion) or die(mysql_error());
$row_electores = mysql_fetch_assoc($electores);
$totalRows_electores = mysql_num_rows($electores);
  
   ?>
    <tr>
      <td><div align="center"><?php echo $row_centro['nombre']; ?></div></td>
      <td>
      <div align="center"><a href="electores_por_centro.php?centro=<?php echo $row_centro['id_centro']; ?>" target="contenido"><?php echo $row_electores['count(*)']; ?></div></a></td>
    </tr>
    <?php } while ($row_centro = mysql_fetch_assoc($centro)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($centro);

mysql_free_result($electores);
?>
