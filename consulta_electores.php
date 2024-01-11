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
$query_electores = "SELECT * FROM elector";
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
  echo "<script type=\"text/javascript\">alert ('Debe registrar primero al menos un elector');  location.href='registro_elector.php' </script>";
  }
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

			var valor=confirm('¿Esta seguro de Eliminar este Elector?');
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
<table width="744" class="bordes" border="0" align="center" cellpadding="1" cellspacing="2">
  <tr>
    <th colspan="7" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">CONSULTA DE ELECTORES </th>
  </tr>
  <tr>
    <th width="149" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Nombre</th>
    <th width="76" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Cedula</th>
    <th width="257" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Centro </th>
    <th width="153" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Direccion</th>
    <th width="31" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">M</th>
    <th width="24" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">E</th>
    <th width="20" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">D</th>
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
      <td align="left" valign="middle" bgcolor="#f2f0f0"><?php echo $row_centros['nombre']; ?></td>
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
?>
