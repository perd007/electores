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

$maxRows_depar = 15;
$pageNum_depar = 0;
if (isset($_GET['pageNum_depar'])) {
  $pageNum_depar = $_GET['pageNum_depar'];
}
$startRow_depar = $pageNum_depar * $maxRows_depar;

mysql_select_db($database_conexion, $conexion);
$query_depar = "SELECT * FROM departamento";
$query_limit_depar = sprintf("%s LIMIT %d, %d", $query_depar, $startRow_depar, $maxRows_depar);
$depar = mysql_query($query_limit_depar, $conexion) or die(mysql_error());
$row_depar = mysql_fetch_assoc($depar);

if (isset($_GET['totalRows_depar'])) {
  $totalRows_depar = $_GET['totalRows_depar'];
} else {
  $all_depar = mysql_query($query_depar);
  $totalRows_depar = mysql_num_rows($all_depar);
}
$totalPages_depar = ceil($totalRows_depar/$maxRows_depar)-1;

$queryString_depar = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_depar") == false && 
        stristr($param, "totalRows_depar") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_depar = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_depar = sprintf("&totalRows_depar=%d%s", $totalRows_depar, $queryString_depar);
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

			var valor=confirm('¿Esta seguro de Eliminar esta Unidad?');
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
<table width="69%" border="0" align="center" cellpadding="1" cellspacing="2" class="bordes">
  <tr>
    <td colspan="4" align="center" bgcolor="#b60101" class="Estilo1 Estilo2">CONSULTA DE DEPARTAMENTOS</td>
  </tr>
  
  <tr class="Estilo1">
    <td width="41%" align="left" valign="baseline" nowrap="nowrap" bgcolor="#b60101"><div align="center" class="Estilo2">Nombre del departamento</div></td>
    <td width="35%" bgcolor="#b60101"><div align="center" class="Estilo2">Responsable  </div></td>
    <td width="13%" bgcolor="#b60101"><div align="center" class="Estilo2">Modificar</div></td>
    <td width="11%" bgcolor="#b60101"><div align="center" class="Estilo2">Eliminar</div></td>
  </tr>
  <?php do { ?>
    <tr>
      <td align="left" valign="baseline" nowrap="nowrap" bgcolor="#FFFFFF"><div align="center"><?php echo $row_depar['nombre']; ?></div></td>
      <td bgcolor="#FFFFFF"><div align="center"><?php echo $row_depar['responsable']; ?></div></td>
      <td bgcolor="#FFFFFF"><div align="center"><? echo "<a href='modifcar_departamento.php?id= $row_depar[id_dep]'>IR</a>" ?></div></td>
      <td bgcolor="#FFFFFF"><div align="center"><? echo "<a  onClick='return validar()' href= 'eliminar_dep.php?id_dep= $row_depar[id_dep]'>IR</a>" ?></div></td>
    </tr>
    <?php } while ($row_depar = mysql_fetch_assoc($depar)); ?>
</table>
<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_depar > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_depar=%d%s", $currentPage, 0, $queryString_depar); ?>">Primero</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_depar > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_depar=%d%s", $currentPage, max(0, $pageNum_depar - 1), $queryString_depar); ?>">Anterior</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_depar < $totalPages_depar) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_depar=%d%s", $currentPage, min($totalPages_depar, $pageNum_depar + 1), $queryString_depar); ?>">Siguiente</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_depar < $totalPages_depar) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_depar=%d%s", $currentPage, $totalPages_depar, $queryString_depar); ?>">&Uacute;ltimo</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($depar);
?>
