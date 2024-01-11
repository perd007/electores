<?php require_once('Connections/conexion.php'); ?>
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

$maxRows_evento = 20;
$pageNum_evento = 0;
if (isset($_GET['pageNum_evento'])) {
  $pageNum_evento = $_GET['pageNum_evento'];
}
$startRow_evento = $pageNum_evento * $maxRows_evento;

mysql_select_db($database_conexion, $conexion);
$query_evento = "SELECT * FROM eventos";
$query_limit_evento = sprintf("%s LIMIT %d, %d", $query_evento, $startRow_evento, $maxRows_evento);
$evento = mysql_query($query_limit_evento, $conexion) or die(mysql_error());
$row_evento = mysql_fetch_assoc($evento);

if (isset($_GET['totalRows_evento'])) {
  $totalRows_evento = $_GET['totalRows_evento'];
} else {
  $all_evento = mysql_query($query_evento);
  $totalRows_evento = mysql_num_rows($all_evento);
}
$totalPages_evento = ceil($totalRows_evento/$maxRows_evento)-1;

mysql_select_db($database_conexion, $conexion);
$query_func = "SELECT * FROM funcionarios";
$func = mysql_query($query_func, $conexion) or die(mysql_error());
$row_func = mysql_fetch_assoc($func);
$totalRows_func = mysql_num_rows($func);

mysql_select_db($database_conexion, $conexion);
$query_asistencia = "SELECT * FROM asistencia";
$asistencia = mysql_query($query_asistencia, $conexion) or die(mysql_error());
$row_asistencia = mysql_fetch_assoc($asistencia);
$totalRows_asistencia = mysql_num_rows($asistencia);

$queryString_evento = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_evento") == false && 
        stristr($param, "totalRows_evento") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_evento = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_evento = sprintf("&totalRows_evento=%d%s", $totalRows_evento, $queryString_evento);

if($totalRows_evento<=0){
  echo "<script type=\"text/javascript\">alert ('Debe registrar primero al menos un Evento');  location.href='registrar_eventos.php' </script>";
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.Estilo2 {color: #FFFFFF}
</style>
</head>
<script language="javascript">
<!--

function validar(){

			var valor=confirm('¿Esta seguro de Eliminar este Evento?');
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
    <th colspan="4" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">CONSULTA DE EVENTOS</th>
  </tr>
  <tr>
    <th align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Descripcion</th>
    <th width="153" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Fecha</th>
    <th width="31" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">M</th>
    <th width="24" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">E</th>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center" valign="middle" bgcolor="#f2f0f0"><?php echo $row_evento['descripcion']; ?></td>
      <td align="center" bgcolor="#f2f0f0"><?php echo $row_evento['fecha']; ?></td>
      <td bgcolor="#f2f0f0"><div align="center"><? if($row_evento["estado"]=="ABIERTO"){ echo "<a href='modificar_evento.php?codigo=$row_evento[codigo]'>IR</a>"; }?></div></td>
      <td bgcolor="#f2f0f0"><div align="center"><? if($row_evento["estado"]=="ABIERTO"){ echo "<a onClick='return validar()' href='eliminar_evento.php?id=$row_evento[id_evento]'>IR</a>"; } ?></div></td>
    </tr>
    <?php } while ($row_evento = mysql_fetch_assoc($evento)); ?>

</table>
<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_evento > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_evento=%d%s", $currentPage, 0, $queryString_evento); ?>">Primero</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_evento > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_evento=%d%s", $currentPage, max(0, $pageNum_evento - 1), $queryString_evento); ?>">Anterior</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_evento < $totalPages_evento) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_evento=%d%s", $currentPage, min($totalPages_evento, $pageNum_evento + 1), $queryString_evento); ?>">Siguiente</a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_evento < $totalPages_evento) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_evento=%d%s", $currentPage, $totalPages_evento, $queryString_evento); ?>">&Uacute;ltimo</a>
      <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($evento);

mysql_free_result($func);

mysql_free_result($asistencia);
?>
