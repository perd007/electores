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
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_unidad = 10;
$pageNum_unidad = 0;
if (isset($_GET['pageNum_unidad'])) {
  $pageNum_unidad = $_GET['pageNum_unidad'];
}
$startRow_unidad = $pageNum_unidad * $maxRows_unidad;

mysql_select_db($database_conexion, $conexion);
$query_unidad = "SELECT * FROM departamento";
$query_limit_unidad = sprintf("%s LIMIT %d, %d", $query_unidad, $startRow_unidad, $maxRows_unidad);
$unidad = mysql_query($query_limit_unidad, $conexion) or die(mysql_error());
$row_unidad = mysql_fetch_assoc($unidad);

if (isset($_GET['totalRows_unidad'])) {
  $totalRows_unidad = $_GET['totalRows_unidad'];
} else {
  $all_unidad = mysql_query($query_unidad);
  $totalRows_unidad = mysql_num_rows($all_unidad);
}
$totalPages_unidad = ceil($totalRows_unidad/$maxRows_unidad)-1;


$queryString_unidad = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_unidad") == false && 
        stristr($param, "totalRows_unidad") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_unidad = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_unidad = sprintf("&totalRows_unidad=%d%s", $totalRows_unidad, $queryString_unidad);


if($totalRows_unidad<=0){
  echo "<script type=\"text/javascript\">alert ('No existen Unidades Registradas');  location.href='registro_departamento.php' </script>";
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
<title>Documento sin t&iacute;tulo</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
</head>

<body>
<table width="573" border="0" align="center" cellpadding="1" cellspacing="2" class="bordes">
  <tr>
    <th colspan="2" bgcolor="#b60101" scope="col"><span class="Estilo1">Consulta de Electores por Unidad </span></th>
  </tr>
  <tr>
    <td width="287" bgcolor="#b60101"><div align="center" class="Estilo1"><strong>Unidad</strong></div></td>
    <td width="272" bgcolor="#b60101"><div align="center" class="Estilo1"><strong>Cantidad de Electores </strong></div></td>
  </tr>
  <?php do { 
  
  
  
mysql_select_db($database_conexion, $conexion);
$query_electores = "SELECT count(*) FROM elector where unidad='$row_unidad[id_dep]'";
$electores = mysql_query($query_electores, $conexion) or die(mysql_error());
$row_electores = mysql_fetch_assoc($electores);
$totalRows_electores = mysql_num_rows($electores);

  
  ?>
    <tr>
      <td><div align="center"><?php echo $row_unidad['nombre']; ?></div></td>
      <td><div align="center"><?php echo $row_electores['count(*)']; ?></div></td>
    </tr>
    <?php } while ($row_unidad = mysql_fetch_assoc($unidad)); ?>
</table>
<p>
<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_unidad > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_unidad=%d%s", $currentPage, 0, $queryString_unidad); ?>">Primero</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_unidad > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_unidad=%d%s", $currentPage, max(0, $pageNum_unidad - 1), $queryString_unidad); ?>">Anterior</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_unidad < $totalPages_unidad) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_unidad=%d%s", $currentPage, min($totalPages_unidad, $pageNum_unidad + 1), $queryString_unidad); ?>">Siguiente</a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_unidad < $totalPages_unidad) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_unidad=%d%s", $currentPage, $totalPages_unidad, $queryString_unidad); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</p>
</body>
</html>
<?php
mysql_free_result($unidad);

mysql_free_result($electores);
?>
