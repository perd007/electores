<?php require_once('Connections/conexion.php'); ?>
<?php

$cedula=$_GET["cedula"];

mysql_select_db($database_conexion, $conexion);
$query_elector = "SELECT * FROM elector where cedula=$cedula";
$elector = mysql_query($query_elector, $conexion) or die(mysql_error());
$row_elector = mysql_fetch_assoc($elector);
$totalRows_elector = mysql_num_rows($elector);

mysql_select_db($database_conexion, $conexion);
$query_centro = "SELECT * FROM centro_votacion where id_centro='$row_elector[centro]'";
$centro = mysql_query($query_centro, $conexion) or die(mysql_error());
$row_centro = mysql_fetch_assoc($centro);
$totalRows_centro = mysql_num_rows($centro);

mysql_select_db($database_conexion, $conexion);
$query_unidad = "SELECT * FROM departamento where id_dep='$row_elector[unidad]'";
$unidad = mysql_query($query_unidad, $conexion) or die(mysql_error());
$row_unidad = mysql_fetch_assoc($unidad);
$totalRows_unidad = mysql_num_rows($unidad);

mysql_select_db($database_conexion, $conexion);
$query_patrulla = "SELECT * FROM patrulla where id_patrulla='$row_elector[patrulla]'";
$patrulla = mysql_query($query_patrulla, $conexion) or die(mysql_error());
$row_patrulla = mysql_fetch_assoc($patrulla);
$totalRows_patrulla = mysql_num_rows($patrulla);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
<!--
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<body>
<table align="center" class="bordes">
  <tr valign="baseline">
    <td colspan="2" align="left" nowrap="nowrap" bgcolor="#b60101"><div align="center" class="Estilo2">DETALLE DEL ELECTOR </div></td>
  </tr>
  <tr valign="baseline">
    <td width="225" align="left" nowrap="nowrap"><div align="right"><strong>Cedula del Elector:</strong></div></td>
    <td width="279"><strong><?php echo $row_elector['cedula']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left"><div align="right"><strong>Nombre del Elector:</strong></div></td>
    <td><strong><?php echo $row_elector['nombre']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left"><div align="right"><strong>Apellido del Elector:</strong></div></td>
    <td><strong><?php echo $row_elector['apellido']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left"><div align="right"><strong>Telefono del Elector:</strong></div></td>
    <td><strong><?php echo $row_elector['telefono']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left"><div align="right"><strong>Unidad:</strong></div></td>
    <td><strong><?php echo $row_unidad['nombre']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left"><div align="right"><strong>Sala de Batalla:</strong></div></td>
    <td><strong><?php echo $row_elector['sala']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left"><div align="right"><strong>Consejo Comunal:</strong></div></td>
    <td><strong><?php echo $row_elector['consejo']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td valign="middle"   align="left"><div align="right"><strong>Direccion de Habitacion:</strong></div></td>
    <td><strong><?php echo $row_elector['direccion']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left"><div align="right"><strong>Centro de Votacion:</strong></div></td>
    <td><strong><?php echo $row_centro['nombre']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left"><div align="right"><strong>Patrulla:</strong></div></td>
    <td><strong><?php echo $row_patrulla['nombre']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left"><div align="right"><strong>Mesa de Votacion:</strong></div></td>
    <td><strong><?php echo $row_elector['mesa']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left"><div align="right"><strong>Situacion Politica:</strong></div></td>
    <td><strong><?php echo $row_elector['potica']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left"><div align="right"><strong> Situacion Laboral:</strong></div></td>
    <td><strong><?php echo $row_elector['laboral']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td nowrap="nowrap" align="left"><div align="right"><strong>¿Firmo contra el Presidente?:</strong></div></td>
    <td><strong><?php echo $row_elector['firmo']; ?></strong></td>
  </tr>
  <tr valign="baseline">
    <td colspan="2" align="center" nowrap="nowrap" bgcolor="#b60101"><a href="consulta_electores.php">
    <input type="button" value="REGRESAR" /></a></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($elector);

mysql_free_result($centro);

mysql_free_result($unidad);

mysql_free_result($patrulla);
?>
