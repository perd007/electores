<?php require_once('Connections/conexion.php'); ?>
<? include("login.php"); ?>
<?php 
//validar usuario
if($validacion==true){
	if($reg==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Registros'); location.href='fondo.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='fondo.php'  </script>";
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO centro_votacion ( nombre, parroquia, direccion, codigo, mesas) VALUES ( %s, %s, %s, %s, %s)",
                     
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['parroquia'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['codigo'], "text"),
                       GetSQLValueString($_POST['mesas'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='fondo.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='fondo.php' </script>";
  exit;
  }

}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="*" rel="stylesheet" type="text/css" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo2 {color: #FFFFFF}
-->
</style>
</head>
<script language="javascript">

function validar(){

		if(document.form1.codigo.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('codigo').value)){
				alert('SOLO PUEDE INGRESAR NUMEROS EN EL CODIGO DEL CENTRO DE VOTACION');
				return false;
		   		}
				}
	
				if(document.form1.nombre.value==""){
						alert("Ingrese el nombre del centro de votacion");
						return false;
				}
				if(document.form1.direccion.value==""){
						alert("Ingrese la direccion del centro de votacion");
						return false;
				}
				if(document.form1.codigo.value==""){
						alert("Ingrese el codigo del centro de votacion");
						return false;
				}
				if(document.form1.mesas.value==""){
						alert("Ingrese la cantidad de mesas del centro de votacion");
						return false;
				}
				
				
				
				
		}
</script>

<body>
<form method="post" name="form1" onsubmit="return validar()" action="<?php echo $editFormAction; ?>">
  <table width="633" align="center" class="bordes" bordercolor="#f2f0f0">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2">Registro de Centros de Votacion </div></td>
    </tr>
    <tr valign="baseline">
      <td width="288" align="right" nowrap bgcolor="#f2f0f0"><strong>Nombre del Centro de Votacion:</strong></td>
      <td width="331" bgcolor="#f2f0f0"><input name="nombre" type="text" value="" size="40" maxlength="200"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#f2f0f0"><strong>Parroquia a la cual pertenece el centro:</strong></td>
      <td bgcolor="#f2f0f0"><label>
        <select name="parroquia" id="parroquia">
          <option value="Fernando Giron Tovar">Fernando Giron Tovar</option>
          <option value="Luis Alberto Gomez">Luis Alberto Gomez</option>
          <option value="Platanillal">Platanillal</option>
          <option value="Parhueña">Parhueña</option>
        </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap bgcolor="#f2f0f0" ><strong>Direccion del Centro de Votacion:</strong></td>
      <td bgcolor="#f2f0f0"><textarea name="direccion" onKeyDown="if(this.value.length &gt;= 300){ alert('Has superado el numero de caracteres permitido de este campo'); return false; }" cols="40"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#f2f0f0"><strong>Codigo del Centro de Votacion:</strong></td>
      <td bgcolor="#f2f0f0"><input name="codigo" id="codigo" type="text" value="" size="20" maxlength="20"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap bgcolor="#f2f0f0"><strong>Cantidad de mesas del Centro de Votacion:</strong></td>
      <td bgcolor="#f2f0f0"><input name="mesas" type="text" value="" size="10" maxlength="2"></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap bgcolor="#b60101"><div align="center">
        <input type="submit" value="GUARDAR DATOS">
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
