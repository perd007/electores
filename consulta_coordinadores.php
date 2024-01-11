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


$maxRows_coord = 10;
$pageNum_coord = 0;
if (isset($_GET['pageNum_coord'])) {
  $pageNum_coord = $_GET['pageNum_coord'];
}
$startRow_coord = $pageNum_coord * $maxRows_coord;

mysql_select_db($database_conexion, $conexion);
$query_coord = "SELECT * FROM coordinadores";
$query_limit_coord = sprintf("%s LIMIT %d, %d", $query_coord, $startRow_coord, $maxRows_coord);
$coord = mysql_query($query_limit_coord, $conexion) or die(mysql_error());
$row_coord = mysql_fetch_assoc($coord);

if (isset($_GET['totalRows_coord'])) {
  $totalRows_coord = $_GET['totalRows_coord'];
} else {
  $all_coord = mysql_query($query_coord);
  $totalRows_coord = mysql_num_rows($all_coord);
}
$totalPages_coord = ceil($totalRows_coord/$maxRows_coord)-1;
		
$queryString_coord = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_coord") == false && 
        stristr($param, "totalRows_coord") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_coord = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_coord = sprintf("&totalRows_coord=%d%s", $totalRows_coord, $queryString_coord);


	  if($totalRows_coord==0){
	echo "<script type=\"text/javascript\">alert ('No existen coordinaodres Registrados');  location.href='registro_coordinadores.php' </script>";
	exit;
		}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="*" rel="stylesheet" type="text/css" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<title>Documento sin título</title>
<style type="text/css">
.Estilo2 {color: #FFFFFF}
</style>
</head>
<script language="javascript">
<!--

function validar(){

			var valor=confirm('¿Esta seguro de Eliminar este Coordinador?');
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
<table width="754" class="bordes" border="0" align="center" cellpadding="1" cellspacing="2">
  <tr>
    <th colspan="7" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">CONSULTA DE COORDINADORES</th>
  </tr>
  <tr>
    <th width="177" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Nombre</th>
    <th width="94" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Cedula</th>
    <th width="174" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Centro </th>
    <th width="143" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Direccion</th>
    <th width="103" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Telefono</th>
    <th width="17" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">M</th>
    <th width="17" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">E</th>
  </tr>
  <?php do {
	  
	    mysql_select_db($database_conexion, $conexion);
		$query_centros = "SELECT * FROM centro_votacion where id_centro='$row_coord[centr]'";
		$centros = mysql_query($query_centros, $conexion) or die(mysql_error());
		$row_centros = mysql_fetch_assoc($centros);
		$totalRows_centros = mysql_num_rows($centros);


 ?>
    <tr>
      <td align="center" valign="middle" bgcolor="#f2f0f0"><?php echo $row_coord['nombres']; ?></td>
      <td align="center" valign="middle" bgcolor="#f2f0f0"><?php echo $row_coord['cedula']; ?></td>
      <td align="left" valign="middle" bgcolor="#f2f0f0"><?php echo $row_centros['nombre']; ?></td>
      <td bgcolor="#f2f0f0"><?php echo $row_coord['direccion']; ?></td>
      <td bgcolor="#f2f0f0"><?php echo $row_coord['telefono']; ?></td>
      <td bgcolor="#f2f0f0"><div align="center"><? echo "<a href='modificar_coordinador.php?cedula=$row_coord[cedula]'>IR</a>" ?></div></td>
      <td bgcolor="#f2f0f0"><div align="center"><? echo "<a onClick='return validar()' href='eliminar_coordinador.php?cedula=$row_coord[cedula]'>IR</a>" ?></div></td>
    </tr>
    <?php } while ($row_coord = mysql_fetch_assoc($coord)); ?>

</table>
<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_coord > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_coord=%d%s", $currentPage, 0, $queryString_coord); ?>">Primero</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_coord > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_coord=%d%s", $currentPage, max(0, $pageNum_coord - 1), $queryString_coord); ?>">Anterior</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_coord < $totalPages_coord) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_coord=%d%s", $currentPage, min($totalPages_coord, $pageNum_coord + 1), $queryString_coord); ?>">Siguiente</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_coord < $totalPages_coord) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_coord=%d%s", $currentPage, $totalPages_coord, $queryString_coord); ?>">&Uacute;ltimo</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($coord);
?>
