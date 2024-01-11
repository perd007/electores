<?php require_once('Connections/conexion.php'); ?>
<? include("login.php"); ?>
<?php 
//validar usuario
if($validacion==true){
	if($cons==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Consultas'); location.href='' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href=''  </script>";
 exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo2 {
	color: #FFFFFF;
	font-size: 18px;
}
.Estilo4 {font-size: 18px}

-->
</style>
</head>
<script language="javascript">

function validar(){

		
	if(document.form1.cedula.value!=""){
			 var filtro = /^(\d)+$/i;
		      if (!filtro.test(document.getElementById('cedula').value)){
				alert('SOLO PUEDE INGRESAR NUMEROS EN LA CEDULA DEL ELECTOR');
				return false;
		   		}
				}
				
				 if(document.form1.cedula.value==""){
		   alert("DEBE INGRESAR UNA CEDULA");
		   return false;
		   }
				
			
				
		}
</script>

<body>
<form id="form1" name="form1" method="post" action="consulta_eleccedu2.php" target="contenido" onsubmit="return validar()">
  <table width="324" border="0" align="center" cellpadding="1" cellspacing="2" class="bordes">
    <tr>
      <th colspan="2" valign="middle" bgcolor="#b60101" scope="col"><span class="Estilo2">Cedulad del Elector</span></th>
    </tr>
    <tr>
      <td width="119" valign="middle" bgcolor="#f2f0f0"><div align="right" class="Estilo4 Estilo3"><strong>Cedula:</strong></div></td>
      <td width="191" valign="middle" bgcolor="#f2f0f0"><span class="Estilo4">
        <label>
        <input name="cedula" type="text" class="Estilo4" id="cedula" size="15" maxlength="9" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="middle" bgcolor="#b60101"><span class="Estilo4">
        <label>
        <input name="button" type="submit" class="Estilo4" id="button" value="Buscar" />
        </label>
      </span></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>