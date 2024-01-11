<?php require_once('Connections/conexion.php'); ?>
<?php
header( 'Content-Type: text/html;charset=utf-8' );  
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	//creamos un codigo para elevento
		mysql_select_db($database_conexion, $conexion);
		$query_eve = "SELECT *,MAX(id_evento) FROM eventos";
		$eve = mysql_query($query_eve, $conexion) or die(mysql_error());
		$row_eve = mysql_fetch_assoc($eve);
		
		if($row_eve["MAX(id_evento)"]==0){ 
		$nun=1;
		$correlativo="Evento".$nun;
		}else{
		$nun= 1 + $row_eve["MAX(id_evento)"];
		$correlativo="Evento".$nun;	
		}
		
		//
	
  $insertSQL = sprintf("INSERT INTO eventos (fecha, codigo, descripcion) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['fecha'], "date"),
					   GetSQLValueString($correlativo, "text"),
                       GetSQLValueString($_POST['descripcion'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  
  
  //Guardamos Convocatorias
  $cont=1;
  while($_POST['cont']>=$cont){
	  
	 	 if($_POST['convocar'.$cont]==true){
	  	$insertSQL = sprintf("INSERT INTO asistencia (evento, funcionario, convocatoria) VALUES (%s, %s, 'SI')",
                       GetSQLValueString($correlativo, "text"),
                       GetSQLValueString($_POST['convocar'.$cont], "int"));

 		 mysql_select_db($database_conexion, $conexion);
  		 $Result2 = mysql_query($insertSQL, $conexion) or die(mysql_error());
	  }
	   $cont++;
	}
	
	  if($Result2){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='' </script>";
  exit;
  }
  //
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
<title>Documento sin título</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
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
<form action="<?php echo $editFormAction; ?>" method="post" onsubmit="return validar()" name="form1" id="form1">
  <table align="center" class="bordes">
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap" bgcolor="#b60101"><div align="center" class="Estilo1 Estilo2">Cargar Eventos</div></td>
    </tr>
    <tr valign="baseline">
      <td width="125" align="right" nowrap="nowrap">Fecha:</td>
      <td width="230"><input name="fecha" type="text" id="fecha" value="<?=date("Y-m-d");?>" size="20" maxlength="10" readonly="readonly" />
        <button type="submit" id="cal-button-1" title="Clic Para Escoger la fecha">Fecha</button>
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
      <td><textarea name="descripcion" cols="40" rows="4" id="descripcion" onkeydown="if(this.value.length &gt;= 300){ alert('Has superado el numero de caracteres permitido de este campo'); return false; }"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap"><input type="submit" value="CARGAR" /></td>
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
    <?php $id=1; do { ?>
      <tr>
        <td align="left"><?php echo utf8_encode($row_fun['nombres']); ?></td>
        <td align="center"><?php echo $row_fun['cedula']; ?></td>
        <td align="center"><?php echo utf8_encode($row_fun['cargo']); ?></td>
        <td align="center"><input name="convocar<?=$id?>" type="checkbox"  id="convocar<?=$id?>" value="<?php echo $row_fun['cedula']; ?>" />
        </td>
      </tr>
      <?php $id++; } while ($row_fun = mysql_fetch_assoc($fun)); ?>
  </table>
  <p>&nbsp;</p>
  <p>
    <input type="hidden" name="MM_insert" value="form1" />
     <input type="hidden" name="cont" value="<?=$id?>" />
  </p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($fun);
?>
