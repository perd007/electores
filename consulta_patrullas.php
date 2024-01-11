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

$maxRows_patrullas = 10;
$pageNum_patrullas = 0;
if (isset($_GET['pageNum_patrullas'])) {
  $pageNum_patrullas = $_GET['pageNum_patrullas'];
}
$startRow_patrullas = $pageNum_patrullas * $maxRows_patrullas;

mysql_select_db($database_conexion, $conexion);
$query_patrullas = "SELECT * FROM patrulla";
$query_limit_patrullas = sprintf("%s LIMIT %d, %d", $query_patrullas, $startRow_patrullas, $maxRows_patrullas);
$patrullas = mysql_query($query_limit_patrullas, $conexion) or die(mysql_error());
$row_patrullas = mysql_fetch_assoc($patrullas);

if (isset($_GET['totalRows_patrullas'])) {
  $totalRows_patrullas = $_GET['totalRows_patrullas'];
} else {
  $all_patrullas = mysql_query($query_patrullas);
  $totalRows_patrullas = mysql_num_rows($all_patrullas);
}
$totalPages_patrullas = ceil($totalRows_patrullas/$maxRows_patrullas)-1;

$queryString_patrullas = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_patrullas") == false && 
        stristr($param, "totalRows_patrullas") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_patrullas = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_patrullas = sprintf("&totalRows_patrullas=%d%s", $totalRows_patrullas, $queryString_patrullas);




if($totalRows_patrullas<=0){
  echo "<script type=\"text/javascript\">alert ('Debe registrar primero al menos una patrulla');  location.href='registro_patrullas.php' </script>";
  }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo2 {color: #FFFFFF}
-->
</style>
</head>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script>
function validar(){

			var valor=confirm('¿Esta seguro de Eliminar esta Patrulla?');
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
<table width="720" border="0" align="center" cellpadding="1" cellspacing="2" bordercolor="#FFFFFF" class="bordes">
  <tr>
    <th colspan="5" bgcolor="#b60101" scope="col"><span class="Estilo2">Patrullas</span></th>
  </tr>
  <tr>
    <td width="207" bgcolor="#b60101"><div align="center" class="Estilo2"><strong>Nombre</strong></div></td>
    <td width="180" bgcolor="#b60101"><div align="center" class="Estilo2"><strong>Representante</strong></div></td>
    <td width="169" bgcolor="#b60101"><div align="center" class="Estilo2"><strong>Telefono</strong></div></td>
    <th width="77" align="center" valign="middle" bgcolor="#b60101" class="Estilo2"  scope="col">Modificar</th>
    <th width="67" align="center" valign="middle" bgcolor="#b60101" class="Estilo2" scope="col">Eliminar</th>
  </tr>
  <?php do { ?>
    <tr>
      <td bgcolor="#f2f0f0"><?php echo $row_patrullas['nombre']; ?></td>
      <td bgcolor="#f2f0f0"><?php echo $row_patrullas['responsable']; ?></td>
      <td bgcolor="#f2f0f0"><?php echo $row_patrullas['telefonoR']; ?></td>
      <td bgcolor="#f2f0f0"><div align="center"><? echo "<a href='modificar_patrulla.php?id=$row_patrullas[id_patrulla]'>IR</a>" ?></div></td>
      <td bgcolor="#f2f0f0"><div align="center"><? echo "<a href='eliminar_patrulla.php?id=$row_patrullas[id_patrulla]'>IR</a>" ?></div></td>
    </tr>
    <?php } while ($row_patrullas = mysql_fetch_assoc($patrullas)); ?>
</table>
<p>
<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_patrullas > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_patrullas=%d%s", $currentPage, 0, $queryString_patrullas); ?>">Primero</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_patrullas > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_patrullas=%d%s", $currentPage, max(0, $pageNum_patrullas - 1), $queryString_patrullas); ?>">Anterior</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_patrullas < $totalPages_patrullas) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_patrullas=%d%s", $currentPage, min($totalPages_patrullas, $pageNum_patrullas + 1), $queryString_patrullas); ?>">Siguiente</a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_patrullas < $totalPages_patrullas) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_patrullas=%d%s", $currentPage, $totalPages_patrullas, $queryString_patrullas); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</p>
</body>
</html>
<?php
mysql_free_result($patrullas);
?>
