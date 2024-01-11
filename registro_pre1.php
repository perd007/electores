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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo2 {
	color: #FFFFFF;
	font-size: 18px;
}
.Estilo3 {
	font-size: 18px;
	font-weight: bold;
}
.Estilo4 {font-size: 18px}
-->
</style>
</head>
<link href="estilos.css" rel="stylesheet" type="text/css" />
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
						alert("Ingrese la cedula del elector");
						return false;
				}
				
				
				
		}
</script>

<body>
<form id="form1" name="form1" method="post" action="registro_pre.php" target="contenido" onsubmit="return validar()">
  <table width="324" border="0" align="center" cellpadding="1" cellspacing="2" class="bordes">
    <tr>
      <th height="28" colspan="2" bgcolor="#b60101" scope="col"><span class="Estilo2">Registro Pre-Electoral</span></th>
    </tr>
    
    <tr>
      <td width="113" height="27" bgcolor="#FFFFFF"><div align="right" class="Estilo3">Cedula:</div></td>
      <td width="197" bgcolor="#FFFFFF"><span class="Estilo4">
        <label>
        <input name="cedula" type="text" class="Estilo4" id="cedula" maxlength="8" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td height="28" colspan="2" bgcolor="#b60101">
        <div align="center" class="Estilo4">
          <input name="Submit" type="submit" class="Estilo4" value="CONSULTAR" />
      </div>     </td>
    </tr>
  </table>
</form>
</body>
</html>
