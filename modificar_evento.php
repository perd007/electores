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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE eventos SET fecha=%s, descripcion=%s WHERE id_evento=%s",
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['id_evento'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  
  //Guardamos Convocatorias
  $cont=1;
  while($_POST['cont']>=$cont){
	  
	 //cosultamos i el funcionario esta convocado
	$cedula=$_POST['cedula'.$cont];
	mysql_select_db($database_conexion, $conexion);
	$query_asistencia = "SELECT * FROM asistencia where evento='$_POST[codigo]' and funcionario='$cedula'";
	$asistencia = mysql_query($query_asistencia, $conexion) or die(mysql_error());
	$row_asistencia = mysql_fetch_assoc($asistencia);
	$totalRows_asistencia = mysql_num_rows($asistencia);
	//
	//si estaba y ya no esta lo eliminamos
	if($totalRows_asistencia>0 and $_POST['convocar'.$cont]==false){
		 
		$sql="delete from asistencia where evento='$_POST[codigo]' and funcionario='$cedula'";
		$verificar=mysql_query($sql,$conexion) or die(mysql_error());
		
	 }
	//
	  
	  //si el funcionario no estaba convocado lo ingresamos
	  if($totalRows_asistencia==0 and $_POST['convocar'.$cont]!=""){

	  		$insertSQL = sprintf("INSERT INTO asistencia (evento, funcionario, convocatoria) VALUES (%s, %s, 'SI')",
                       GetSQLValueString($_POST['codigo'], "text"),
                       GetSQLValueString($_POST['convocar'.$cont], "int"));

 		 	mysql_select_db($database_conexion, $conexion);
  		 	$Result2 = mysql_query($insertSQL, $conexion) or die(mysql_error());
	  
	}
	//
	
	
	 $cont++;
	
  }//fin del while
  
     if($Result2){
  echo "<script type=\"text/javascript\">alert ('Datos Actualizados');  location.href='' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='' </script>";
  exit;
  }
	
	
  
}




mysql_select_db($database_conexion, $conexion);
$query_evento = "SELECT * FROM eventos where codigo='$_GET[codigo]'";
$evento = mysql_query($query_evento, $conexion) or die(mysql_error());
$row_evento = mysql_fetch_assoc($evento);
$totalRows_evento = mysql_num_rows($evento);

if($row_evento["estado"]=="CERRADO"){
$disabled="disabled";	
}

mysql_select_db($database_conexion, $conexion);
$query_fun = "SELECT * FROM funcionarios";
$fun = mysql_query($query_fun, $conexion) or die(mysql_error());
$row_fun = mysql_fetch_assoc($fun);
$totalRows_fun = mysql_num_rows($fun);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<title>Documento sin título</title>
</head>
<style type="text/css"> 
    @import url("jscalendar-1.0/calendar-win2k-cold-1.css");
    </style>
<script type="text/javascript" src="jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="jscalendar-1.0/lang/calendar-es.js"></script>
<script language="javascript">

function validar(){

var cont=document.form1.cont.value;
var c=0;

	for(var i=1;i<=cont-1;i++){
		if(document.getElementById("convocar"+i).checked==true){
			c++;
		}	
	}


			if(c<=0){
						alert("Debe Convocar al Menos un Funcionario");
						return false;
			}
			


				if(document.form1.descripcion.value==""){
						alert("Ingrese una Descripcion");
						return false;
				}
			
			
				
				
				
		}
</script>
<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center" class="bordes">
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2">Cargar Eventos</div></td>
    </tr>
    <tr valign="baseline">
      <td width="125" align="right" nowrap="nowrap">Fecha:</td>
      <td width="230"><input name="fecha" type="text" id="fecha" value="<?php echo $row_evento['fecha']; ?>" size="20" maxlength="10" readonly="readonly" <?=$disabled?>/>
        <button type="submit" id="cal-button-1" title="Clic Para Escoger la fecha" <?=$disabled?>>Fecha</button>
        <script type="text/javascript">
							Calendar.setup({
							  inputField    : "fecha",
							  ifFormat   : "%Y-%m-%d",
							  button        : "cal-button-1",
							  align         : "Tr"
							});
						  </script></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" valign="middle" align="right">Descripcion:</td>
      <td><textarea name="descripcion" cols="40" rows="4" id="descripcion" onkeydown="if(this.value.length &gt;= 300){ alert('Has superado el numero de caracteres permitido de este campo'); return false; }" <?=$disabled?>><?php echo $row_evento['descripcion']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap"><input type="submit" value="ACTUALIZAR" <?=$disabled?>/></td>
    </tr>
  </table>
  <table width="747" align="center" class="bordes">
    <tr>
      <td colspan="4" align="center" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2">Convocar a Funcionarios</div></td>
    </tr>
    <tr>
      <td width="212" align="left"><strong>Funcionario</strong></td>
      <td width="99" align="center"><strong>Cedula</strong></td>
      <td width="350" align="center"><strong>Cargo</strong></td>
      <td width="64" align="center"><strong>Convocar</strong></td>
    </tr>
    <?php $id=1; do { 
	
	mysql_select_db($database_conexion, $conexion);
	$query_asistencia = "SELECT * FROM asistencia where evento='$row_evento[codigo]' and funcionario='$row_fun[cedula]'";
	$asistencia = mysql_query($query_asistencia, $conexion) or die(mysql_error());
	$row_asistencia = mysql_fetch_assoc($asistencia);
	$totalRows_asistencia = mysql_num_rows($asistencia);
	
	
	?>
    <tr>
      <td align="left"><?php echo utf8_encode($row_fun['nombres']); ?></td>
      <td align="center"><?php echo $row_fun['cedula']; ?><input type="hidden" name="cedula<?=$id?>" value="<?=$row_fun['cedula']?>" /></td>
      <td align="center"><?php echo utf8_encode($row_fun['cargo']); ?></td>
      <td align="center"><input <?php if ($row_asistencia['funcionario']==$row_fun['cedula']) {echo "checked=\"checked\"";} ?> name="convocar<?=$id?>" type="checkbox" id="convocar<?=$id?>" value="<?php echo $row_fun['cedula']; ?>" <?=$disabled?>/>
        </td>
    </tr>
    <?php $id++; } while ($row_fun = mysql_fetch_assoc($fun)); ?>
  </table>
  
  
  
  
<input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_evento" value="<?php echo $row_evento['id_evento']; ?>" />
  <input type="hidden" name="cont" value="<?=$id?>" />
  <input type="hidden" name="codigo" value="<?php echo $row_evento['codigo']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($evento);

mysql_free_result($asistencia);

mysql_free_result($fun);
?>
