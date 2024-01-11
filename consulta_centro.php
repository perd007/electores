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

$maxRows_centro = 20;
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

$queryString_centro = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_centro") == false && 
        stristr($param, "totalRows_centro") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_centro = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_centro = sprintf("&totalRows_centro=%d%s", $totalRows_centro, $queryString_centro);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<script language="javascript">
<!--

function validar(){

			var valor=confirm('¿Esta seguro de Eliminar este Centro?');
			if(valor==false){
			return false;
			}
			else{
			return true;
			}
		
}
//-->
</script>
<body>
<table border="0" align="center" cellpadding="1" cellspacing="2" class="bordes">
  <tr align="center">
    <td colspan="6" bgcolor="#b60101" class="Estilo1 Estilo2">CENTRO DE VOTACION</td>
  </tr>
  <tr align="center" class="Estilo1">
    <td width="205" bgcolor="#b60101"><span class="Estilo2">Nombre</span></td>
    <td width="197" bgcolor="#b60101"><span class="Estilo2">Parroquia</span></td>
    <td width="106" bgcolor="#b60101"><span class="Estilo2">Mesas</span></td>
    <th width="77" valign="middle" bgcolor="#b60101" scope="col"><span class="Estilo2">Modificar</span></th>
    <th width="67" valign="middle" bgcolor="#b60101" scope="col"><span class="Estilo2">Detalles</span></th>
    <th width="61" valign="middle" bgcolor="#b60101" scope="col"><span class="Estilo2">Eliminar</span></th>
  </tr>
  <?php do { ?>
  <tr>
    <td bgcolor="#f2f0f0"><div align="center"><?php echo $row_centro['nombre']; ?>&nbsp; </div></td>
    <td bgcolor="#f2f0f0"><div align="center"><?php echo $row_centro['parroquia']; ?>&nbsp; </div></td>
    <td bgcolor="#f2f0f0"><div align="center"><?php echo $row_centro['mesas']; ?>&nbsp; </div></td>
    <td bgcolor="#f2f0f0"><div align="center"><? echo "<a href='modificar_centro.php?id=$row_centro[id_centro]'>IR</a>" ?></div></td>
    <td bgcolor="#f2f0f0"><div align="center"><? echo "<a href='detalle_centro.php?id=$row_centro[id_centro]'>IR</a>" ?></div></td>
    <td bgcolor="#f2f0f0"><div align="center"><? echo "<a onClick='return validar()' href='eliminar_centro_ce.php?id=$row_centro[id_centro]'>IR</a>" ?></div></td>
  </tr>
  <?php } while ($row_centro = mysql_fetch_assoc($centro)); ?>
</table>
<br />
<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_centro > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_centro=%d%s", $currentPage, 0, $queryString_centro); ?>">Primero</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_centro > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_centro=%d%s", $currentPage, max(0, $pageNum_centro - 1), $queryString_centro); ?>">Anterior</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_centro < $totalPages_centro) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_centro=%d%s", $currentPage, min($totalPages_centro, $pageNum_centro + 1), $queryString_centro); ?>">Siguiente</a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_centro < $totalPages_centro) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_centro=%d%s", $currentPage, $totalPages_centro, $queryString_centro); ?>">Último</a>
      <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($centro);
?>
