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
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}



$currentPage = $_SERVER["PHP_SELF"];

$maxRows_electores = 15;
$pageNum_electores = 0;
if (isset($_GET['pageNum_electores'])) {
  $pageNum_electores = $_GET['pageNum_electores'];
}
$startRow_electores = $pageNum_electores * $maxRows_electores;

mysql_select_db($database_conexion, $conexion);
$query_electores = "SELECT * FROM elector where cedula='$_POST[cedula];'";
$query_limit_electores = sprintf("%s LIMIT %d, %d", $query_electores, $startRow_electores, $maxRows_electores);
$electores = mysql_query($query_limit_electores, $conexion) or die(mysql_error());
$row_electores = mysql_fetch_assoc($electores);

if (isset($_GET['totalRows_electores'])) {
  $totalRows_electores = $_GET['totalRows_electores'];
} else {
  $all_electores = mysql_query($query_electores);
  $totalRows_electores = mysql_num_rows($all_electores);
}
$totalPages_electores = ceil($totalRows_electores/$maxRows_electores)-1;



$queryString_electores = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_electores") == false && 
        stristr($param, "totalRows_electores") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_electores = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_electores = sprintf("&totalRows_electores=%d%s", $totalRows_electores, $queryString_electores);

if( $totalRows_electores<=0){
  echo "<script type=\"text/javascript\">alert ('Esta cedula no esta registrada');  location.href='consulta_eleccedu.php' </script>";
  }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo2 {color: #FFFFFF}
-->
</style>
</head>

<body>
<table width="772" border="0" align="center" cellpadding="1" cellspacing="2" class="bordes">
  <tr class="Estilo1">
    <th colspan="7" align="center" valign="middle" bgcolor="#b60101" scope="col"><span class="Estilo2">CONSULTA DE ELECTOR POR CEDULA </span></th>
  </tr>
  <tr class="Estilo1">
    <th width="167" align="center" valign="middle" bgcolor="#b60101" scope="col"><span class="Estilo2">NOMBRE</span></th>
    <th width="75" align="center" valign="middle" bgcolor="#b60101" scope="col"><span class="Estilo2">CEDULA</span></th>
    <th width="251" align="center" valign="middle" bgcolor="#b60101" scope="col"><span class="Estilo2">CENTRO </span></th>
    <th width="157" align="center" valign="middle" bgcolor="#b60101" class="Estilo2" scope="col">DIRECCION</th>
    <th width="25" align="center" valign="middle" bgcolor="#b60101" scope="col"><span class="Estilo2">M</span></th>
    <th width="28" align="center" valign="middle" bgcolor="#b60101" scope="col"><span class="Estilo2">E</span></th>
    <th width="35" align="center" valign="middle" bgcolor="#b60101" scope="col"><span class="Estilo2">D</span></th>
  </tr>
  <?php do { 
  
  mysql_select_db($database_conexion, $conexion);
$query_centros = "SELECT * FROM centro_votacion where id_centro='$row_electores[centro]'";
$centros = mysql_query($query_centros, $conexion) or die(mysql_error());
$row_centros = mysql_fetch_assoc($centros);
$totalRows_centros = mysql_num_rows($centros);
  
  $c=$row_electores['cedula'];
  ?>
  <tr>
    <td align="center" valign="middle" bgcolor="#f2f0f0"><?php echo $row_electores['nombre']; ?> <?php echo $row_electores['apellido']; ?></td>
    <td align="center" valign="middle" bgcolor="#f2f0f0"><?php echo $c; ?></td>
    <td align="center" valign="middle" bgcolor="#f2f0f0"><?php echo $row_centros['nombre']; ?></td>
    <td bgcolor="#f2f0f0"><?php echo $row_electores['direccion']; ?></td>
    <td bgcolor="#f2f0f0"><div align="center"><? echo "<a href='modificar_elector.php?cedula=$row_electores[cedula]'>IR</a>" ?></div></td>
    <td bgcolor="#f2f0f0"><div align="center"><? echo "<a onClick='return validar()' href='eliminar_elector.php?cedula=$row_electores[cedula]'>IR</a>" ?></div></td>
    <td bgcolor="#f2f0f0"><div align="center"><? echo "<a  href='detalle_elector.php?cedula=$row_electores[cedula]'>IR</a>" ?></div></td>
  </tr>
  <?php } while ($row_electores = mysql_fetch_assoc($electores)); ?>
</table>
<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_electores > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_electores=%d%s", $currentPage, 0, $queryString_electores); ?>">Primero</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_electores > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_electores=%d%s", $currentPage, max(0, $pageNum_electores - 1), $queryString_electores); ?>">Anterior</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_electores < $totalPages_electores) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_electores=%d%s", $currentPage, min($totalPages_electores, $pageNum_electores + 1), $queryString_electores); ?>">Siguiente</a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_electores < $totalPages_electores) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_electores=%d%s", $currentPage, $totalPages_electores, $queryString_electores); ?>">&Uacute;ltimo</a>
      <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($electores);

mysql_free_result($centros);
?>
