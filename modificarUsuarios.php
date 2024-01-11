<?php require_once('Connections/conexion.php'); ?>
<? include("login.php"); ?>
<?php 
//validar usuario
if($validacion==true){
	if($Admi==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para modificar Usuarios Registros');location.href='fondo.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido'); location.href='fondo.php' </script>";
 exit;
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

$m=$_POST["modificar"];
$c=$_POST["consultar"];
$e=$_POST["eliminar"];
$r=$_POST["registrar"];
$a=$_POST["administrar"];

//validar permisos
if($m!=""){
$m=1;
}
else{
$m=0;
}
//
if($c!=""){
$c=1;
}
else{
$c=0;
}
//
if($e!=""){
$e=1;
}
else{
$e=0;
}
//
if($r!=""){
$r=1;
}
else{
$r=0;
}
//
if($a!=""){
$a=1;
}
else{
$a=0;
}
//chequear usuario
 mysql_select_db($database_conexion, $conexion);
$sqlV="select usuario from seguridad where usuario='$_POST[login]' and id_seg!='$_POST[id_seg]'";
$resultadoV=mysql_query($sqlV, $conexion) or die(mysql_error());
$verificar=mysql_fetch_assoc($resultadoV);


if($verificar["usuario"]==$_POST['login']){
echo "<script type=\"text/javascript\">alert ('Usuario ya Registrado'); location.href='consultaUsuarios.php' </script>";
 exit;

}

//validar que no sea el unico usario con permisos administrativos y que se le valla a eliminar
 mysql_select_db($database_conexion, $conexion);
$query_usuario = "SELECT * FROM seguridad where administrar=1 and usuario!='$_POST[login]'";
$usuario = mysql_query($query_usuario, $conexion) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

if($totalRows_usuario<1){
echo"<script type=\"text/javascript\">alert ('Debe dejar al menos un usuario  con permisos administrativos'); location.href='consultaUsuarios.php' </script>";
}

  $updateSQL = sprintf("UPDATE seguridad SET usuario=%s, clave=%s, modificar=%s, consultar=%s, registrar=%s, eliminar=%s, nombre=%s, cedula=%s, administrar=%s WHERE id_seg=%s",
                       GetSQLValueString($_POST['login'], "text"),
                       GetSQLValueString($_POST['clave'], "text"),
                       GetSQLValueString($m, "int"),
                       GetSQLValueString($c, "int"),
                       GetSQLValueString($r, "int"),
                       GetSQLValueString($e, "int"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['cedula'], "int"),
                       GetSQLValueString($a, "int"),
                       GetSQLValueString($_POST['id_seg'], "int"));

 mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  if($Result1){
  	//verificar si usuario actual
		if($HTTP_COOKIE_VARS["usr"]==$_POST['login']){
 echo "<script type=\"text/javascript\">alert ('Datos Modificados. Debe iniciar sesion nuevamente');  location.href='cerrarSesion.php' </script>";		}else{
 			 echo "<script type=\"text/javascript\">alert ('Datos Modificados');  location.href='consultaUsuarios.php' </script>";
  }
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='consultaUsuarios.php' </script>";
  exit;
  }
}

//recibimos codigo
$cod=$_GET["id"];
 mysql_select_db($database_conexion, $conexion);
$query_usuarios = "SELECT * FROM seguridad where id_seg=$cod";
$usuarios = mysql_query($query_usuarios,  $conexion) or die(mysql_error());
$row_usuarios = mysql_fetch_assoc($usuarios);
$totalRows_usuarios = mysql_num_rows($usuarios);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="estilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo5 {font-weight: bold}
.Estilo6 {
	color: #FFFFFF;
	font-weight: bold;
}


-->
</style>
</head>

<script language="javascript">
<!--
function validar(){

if(document.form1.cedula.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('cedula').value)){
				alert('Solo puede ingresar numeros en la cedula de alumno!!!');
				return false;
		   		}
				}

		   if(document.form1.login.value==""){
		   alert("DEBE INGRESAR UN LOGIN");
		   return false;
		   }
		    if(document.form1.clave.value==""){
		   alert("DEBE INGRESAR UNA CLAVE");
		   return false;
		   }
		   if(document.form1.cedula.value==""){
		   alert("DEBE INGRESAR LA CEDULA");
		   return false;
		   }
		   if(document.form1.nombre.value==""){
		   alert("DEBE INGRESAR EL NOMBRE DEL USUARIO");
		   return false;
		   }
		 
		  
		 	  if(document.form1.modificaciones.checked==false) { 
			 	
			  		if(document.form1.eliminaciones.checked==false){
						
			 				if(document.form1.consultas.checked==false){ 
							
								if(document.form1.registros.checked==false){ 
			 					
		   						alert("DEBE INGRESAR ALGUN PERMISO PARA ESTE USUARIO");
		   						return false;
									}
								}
							
						}
					
				
			}
   }
   
//-->
</script>

<body>
<form method="post" name="form1" onSubmit="return validar()" action="<?php echo $editFormAction; ?>">
  <table align="center" class="bordes">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap bgcolor="#b60101"><div align="center" class="Estilo6">Modificacion de Usuarios </div></td>
    </tr>
    <tr valign="baseline">
      <td width="191" align="right" nowrap><div align="right"><strong><span class="Estilo5">Usuario:</span></strong></div></td>
      <td width="307"><input name="login" type="text" class="Estilo5" id="login" value="<?php echo $row_usuarios['usuario']; ?>" size="32" maxlength="10"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="Estilo5"><strong>Clave:</strong></span></td>
      <td><input name="clave" type="text" class="Estilo5" value="<?php echo $row_usuarios['clave']; ?>" size="32" maxlength="10"></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap align="right"><strong>Nombre:</strong></td>
      <td><input name="nombre" type="text" class="Estilo5" value="<?php echo $row_usuarios['nombre']; ?>" size="32" maxlength="20"></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap align="right"><strong>Cedula:</strong></td>
      <td><input name="cedula" type="text" class="Estilo5" value="<?php echo $row_usuarios['cedula']; ?>" size="32" maxlength="8"></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap bgcolor="#b60101"><div align="center" class="Estilo6">Permisos</div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap>
	    <span class="Estilo5">
	  <?php $seleccion="checked='checked'"; ?>
	  </span>
	    <table width="385" border="0" align="center">
          <tr>
            <td width="210"><strong>
              <input name="registrar" type="checkbox" class="Estilo5" id="registrar" value="registros" <?php if($row_usuarios['registrar']==1) echo $seleccion; ?> />
            Registros</strong></td>
            <td width="165"><strong>
              <input name="consultar" type="checkbox" <?php if($row_usuarios['consultar']==1) echo $seleccion; ?> id="consultar" value="consultas" />
            Consultas</strong></td>
          </tr>
          <tr>
            <td><strong>
              <input name="modificar" type="checkbox" class="Estilo5" id="modificar" value="modificaciones"  <?php if($row_usuarios['modificar']==1) echo $seleccion; ?> />
             Modificaciones</strong></td>
            <td><strong>
              <input name="eliminar" type="checkbox" <?php if($row_usuarios['eliminar']==1) echo $seleccion; ?> id="eliminar" value="eliminaciones" />
             Eliminaciones</strong></td>
          </tr>
          <tr>
            <td height="29"><span class="Estilo5">
<input name="administrar" type="checkbox" <?php if($row_usuarios['administrar']==1) echo $seleccion; ?> id="administrar" value="administar" />              
Administrar Usuarios </span></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap bgcolor="#b60101"><div align="center" class="Estilo5">
        <a href="consultaUsuarios.php">
        <input name="Submit" type="button" value="Regresar" />
        </a>
        <input type="submit" value="Modificar Datos">
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_seg" value="<?php echo $row_usuarios['id_seg']; ?>">
   <input type="hidden" name="cod" value="<?php echo $cod; ?>" />
   <input type="hidden" name="usr" value="<?php echo $row_usuarios['usuario'];; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($usuarios);
?>
