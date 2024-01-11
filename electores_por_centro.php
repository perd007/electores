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
$centro=$_GET["centro"];
mysql_select_db($database_conexion, $conexion);
$query_centro = "SELECT * FROM centro_votacion where id_centro=$centro";
$centro = mysql_query($query_centro, $conexion) or die(mysql_error());
$row_centro = mysql_fetch_assoc($centro);
$totalRows_centro = mysql_num_rows($centro);




$currentPage = $_SERVER["PHP_SELF"];

$maxRows_electores = 10;
$pageNum_electores = 0;
if (isset($_GET['pageNum_electores'])) {
  $pageNum_electores = $_GET['pageNum_electores'];
}
$startRow_electores = $pageNum_electores * $maxRows_electores;

mysql_select_db($database_conexion, $conexion);
$query_electores = "SELECT * FROM elector where centro='$row_centro[id_centro]'";
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



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
.Estilo2 {color: #FFFFFF}
</style>
</head>

<body>
<table width="744" class="bordes" border="0" align="center" cellpadding="1" cellspacing="2">
  <tr>
    <th colspan="4" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">CENTRO: <?php echo $row_centro['nombre']; ?></th>
  </tr>
  <tr>
    <th width="241" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Nombre</th>
    <th width="75" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Cedula</th>
    <th width="124" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Telefono</th>
    <th width="286" align="center" valign="middle" bgcolor="#b60101" class="Estilo1 Estilo2" scope="col">Direccion</th>
  </tr>
 
  <?php do { ?>
    <tr>
      <td align="center" valign="middle" bgcolor="#f2f0f0"><?php echo $row_electores['nombre']; ?> <?php echo $row_electores['apellido']; ?></td>
      <td align="center" valign="middle" bgcolor="#f2f0f0"><?php echo $row_electores['cedula']; ?></td>
      <td align="left" valign="middle" bgcolor="#f2f0f0"><?php echo $row_electores['telefono']; ?></td>
      <td bgcolor="#f2f0f0"><?php echo $row_electores['direccion']; ?></td>
    </tr>
    <?php } while ($row_electores = mysql_fetch_assoc($electores)); ?>
  <tr>
      <td colspan="4" align="center" valign="middle" bgcolor="#f2f0f0"><a href="electores_por_centro_pdf.php?centro=<?php echo $row_centro['id_centro']; ?>&nombre=<?php echo $row_centro['nombre']; ?>" target="contenido"><input type="submit" name="button" id="button" value="GENERAR PDF" /></a></td>
    </tr>
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
</p>
</body>
</html>
<?php
mysql_free_result($electores);

mysql_free_result($centro);
?>
