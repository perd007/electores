<?php require_once('Connections/conexion.php'); ?>
<? include("login.php"); ?>
<?php 
//validar usuario
if($validacion==true){
	if($Admi==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para consultar usuarios Registros');location.href='fondo.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido'); location.href='fondo.php' </script>";
 exit;
}
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_usuarios = 10;
$pageNum_usuarios = 0;
if (isset($_GET['pageNum_usuarios'])) {
  $pageNum_usuarios = $_GET['pageNum_usuarios'];
}
$startRow_usuarios = $pageNum_usuarios * $maxRows_usuarios;


mysql_select_db($database_conexion, $conexion);

$query_usuarios = "SELECT * FROM seguridad";
$query_limit_usuarios = sprintf("%s LIMIT %d, %d", $query_usuarios, $startRow_usuarios, $maxRows_usuarios);
$usuarios = mysql_query($query_limit_usuarios, $conexion) or die(mysql_error());
$row_usu = mysql_fetch_assoc($usuarios);

if (isset($_GET['totalRows_usuarios'])) {
  $totalRows_usuarios = $_GET['totalRows_usuarios'];
} else {
  $all_usuarios = mysql_query($query_usuarios);
  $totalRows_usuarios = mysql_num_rows($all_usuarios);
}
$totalPages_usuarios = ceil($totalRows_usuarios/$maxRows_usuarios)-1;

$queryString_usuarios = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_usuarios") == false && 
        stristr($param, "totalRows_usuarios") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_usuarios = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_usuarios = sprintf("&totalRows_usuarios=%d%s", $totalRows_usuarios, $queryString_usuarios);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="estilos.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--

.Estilo2 {color: #FFFFFF}
-->
</style>
</head>
<script language="javascript">
<!--

function validar(){

			var valor=confirm('¿Esta seguro de Eliminar este Usuario?');
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
<table width="727" border="0" align="center" cellpadding="0" cellspacing="0" class="bordes">
  <tr bgcolor="#00CCFF">
    <th colspan="9" bgcolor="#b60101" ><div class="Estilo13 Estilo2">Usuarios</div></th>
  </tr>
  <tr>
    <td colspan="2"><div align="center" class="Estilo9" ><strong>Login y Contrase&ntilde;as </strong></div></td>
    <td colspan="5"><div align="center" class="Estilo9" ><strong>Permisos que Posee el Usuario </strong></div></td>
    <td colspan="2"><div align="center" class="Estilo9" ><strong>Opciones</strong></div></td>
  </tr>
  <tr bgcolor="#00CCFF">
    <td width="105" bgcolor="#b60101"><span class="Estilo2"><strong>Usuario</strong></span></td>
    <td width="93" bgcolor="#b60101"><span class="Estilo2"><strong>Clave</strong></span></td>
    <td width="81" bgcolor="#b60101"><div align="center" class="Estilo2"><strong>Modificar</strong></div></td>
    <td width="67" bgcolor="#b60101"><div align="center" class="Estilo2"><strong>Eliminar</strong></div></td>
    <td width="86" bgcolor="#b60101"><div align="center" class="Estilo2"><strong>Registrar</strong></div></td>
    <td width="85" bgcolor="#b60101"><div align="center" class="Estilo2" ><strong>Consultar</strong></div></td>
    <td width="87" bgcolor="#b60101"><div align="center" class="Estilo2" ><strong>Administrar</strong></div></td>
    <td width="60" bgcolor="#b60101"><div align="center" class="Estilo2"><strong>Op1</strong></div></td>
    <td width="59" bgcolor="#b60101"><div align="center" class="Estilo2" ><strong>Op2</strong></div></td>
  </tr>
  <?php do { 
  	$m=$row_usu["modificar"];
$r=$row_usu["registrar"];
$e=$row_usu["eliminar"];
$c=$row_usu["consultar"];
$a=$row_usu["administrar"];
//validar permisos
if($m!=0){
$m="si";
}
else{
$m="no";
}

if($c!=0){
$c="si";
}
else{
$c="no";
}

if($e!=0){
$e="si";
}
else{
$e="no";
}

if($r!=0){
$r="si";
}
else{
$r="no";
}

if($a!=0){
$a="si";
}
else{
$a="no";
}

  
  	$modulo=$cont%2;
			
			if($modulo!=0){
			$color="#FFFFFF";
			}else{
			$color="#FFFFFF";
			}
			
	
	  ?>
  <tr bgcolor="<?php echo $color; ?>" >
      <td><div align="center" class="Estilo10"><span class="Estilo4"><?php echo $row_usu['usuario']; ?></span></div></td>
      <td><div align="center" class="Estilo10"><span class="Estilo4"><?php echo $row_usu['clave']; ?></span></div></td>
      <td><div align="center" class="Estilo11">
        <div align="center"><?php echo $m; ?></div>
      </div></td>
      <td><div align="center" class="Estilo11">
        <div align="center"><?php echo $e; ?></div>
      </div></td>
      <td><div align="center" class="Estilo11">
        <div align="center"><?php echo $r; ?></div>
      </div></td>
      <td><div align="center" class="Estilo11">
        <div align="center"><?php echo $c; ?></div>
      </div></td>
      <td><div align="center" class="Estilo11">
        <div align="center"><?php echo $a; ?></div>
      </div></td>
      <td><div align="center"><span class="Estilo11"><?php echo "<a href='modificarUsuarios.php?id=$row_usu[id_seg]'>Modificar</a>"; ?></span></div></td>
      <td><div align="center"><span class="Estilo11"><?php echo "<a onClick='return validar()' href='eliminarUsuarios.php?id=$row_usu[id_seg]'>Eliminar</a>"; ?></span></div></td>
      <?php $cont++;} while ($row_usu = mysql_fetch_assoc($usuarios)); ?>
      </tr>
</table>
<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_usuarios > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_usuarios=%d%s", $currentPage, 0, $queryString_usuarios); ?>">Primero</a>
        <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_usuarios > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_usuarios=%d%s", $currentPage, max(0, $pageNum_usuarios - 1), $queryString_usuarios); ?>">Anterior</a>
        <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_usuarios < $totalPages_usuarios) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_usuarios=%d%s", $currentPage, min($totalPages_usuarios, $pageNum_usuarios + 1), $queryString_usuarios); ?>">Siguiente</a>
        <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_usuarios < $totalPages_usuarios) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_usuarios=%d%s", $currentPage, $totalPages_usuarios, $queryString_usuarios); ?>">&Uacute;ltimo</a>
        <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($usuarios);
?>
