<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="fscript.js"></script>
<style type="text/css">
<!--
UNKNOWN {
        FONT-SIZE: small
}
#header {
        FONT-SIZE: 93%; BACKGROUND: url(bg.gif) #dae0d2 repeat-x 50% bottom; FLOAT: left; WIDTH: 100%; LINE-HEIGHT: normal
}
#header UL {
        PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 10px; LIST-STYLE-TYPE: none
}
#header LI {
        PADDING-RIGHT: 0px; PADDING-LEFT: 9px; BACKGROUND: url(left.gif) no-repeat left top; FLOAT: left; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 0px
}
#header A {
        PADDING-RIGHT: 15px; DISPLAY: block; PADDING-LEFT: 6px; FONT-WEIGHT: bold; BACKGROUND: url(right.gif) no-repeat right top; FLOAT: left; PADDING-BOTTOM: 4px; COLOR: #765; PADDING-TOP: 5px; TEXT-DECORATION: none
}
#header A {
        FLOAT: none
}
#header A:hover {
        COLOR: #333
}
#header #current {
        BACKGROUND-IMAGE: url(left_on.gif)
}
#header #current A {
        BACKGROUND-IMAGE: url(right_on.gif); PADDING-BOTTOM: 5px; COLOR: #333
}
-->
</style>
</head>
<body>


<?php
include("fphp.php");


?>

<table width="905" align="center">
  <tr>
   	<td>
			<div id="header">
			<ul>
			<!-- CSS Tabs -->
			<li><a  onclick="document.getElementById('tab1').style.display='block'; document.getElementById('tab2').style.display='none'; document.getElementById('tab3').style.display='none'; document.getElementById('tab4').style.display='none';" href="#">Datos Personales</a></li>			
			<li><a onclick="document.getElementById('tab2').style.display='block'; document.getElementById('tab1').style.display='none'; document.getElementById('tab3').style.display='none'; document.getElementById('tab4').style.display='none';" href="#">Datos Personales...</a></li>			
			<li><a onclick="document.getElementById('tab3').style.display='block'; document.getElementById('tab2').style.display='none'; document.getElementById('tab1').style.display='none'; document.getElementById('tab4').style.display='none';" href="#">Organizaci&oacute;n</a></li>			
			<li><a onclick="document.getElementById('tab4').style.display='block'; document.getElementById('tab2').style.display='none'; document.getElementById('tab3').style.display='none'; document.getElementById('tab1').style.display='none';" href="#">Datos Laborales</a></li>
			</ul>
			</div>
		</td>
	</tr>
</table>

<div name="tab1" id="tab1" style="display:block;">
<table width="905" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td valign='top'>
			<div style="width:750px" class="divFormCaption">Datos Generales</div>
			<table width="750" class="tblForm">
			  <tr>
			    <td class="tagForm">Persona:</td>
			    <td><input name="persona" type="text" id="persona" size="10" readonly /></td>
			    <td class="tagForm">Empleado:</td>
			    <td><input name="empleado" type="text" id="empleado" size="10" readonly /></td>
			  </tr>
			  <tr>
			    <td class="tagForm">Apellido Paterno:</td>
			    <td><input name="apellido1" type="text" id="apellido1" size="25" maxlength="20" onkeyup="setBusqueda(this.form);" />*</td>
			    <td class="tagForm">Materno:</td>
			    <td><input name="apellido2" type="text" id="apellido2" size="25" maxlength="20" onkeyup="setBusqueda(this.form);" /></td>
			  </tr>
			  <tr>
			    <td class="tagForm">Nombres:</td>
			    <td><input name="nombres" type="text" id="nombres" size="40" maxlength="30" onkeyup="setBusqueda(this.form);" />*</td>
			    <td class="tagForm">Sexo:</td>
			    <td>
						<select name="sexo">
							<?php getSexo('', 0); ?>
						</select>
					</td>
			  </tr>
			  <tr>
			    <td class="tagForm">Nombre B&uacute;squeda:</td>
			    <td colspan="3"><input name="busqueda" type="text" id="busqueda" size="70" maxlength="70" />*</td>
			  </tr>
			</table>
			
			<div style="width:750px" class="divFormCaption">Nacimiento</div>
			<table width="750" class="tblForm">
				<tr>
			    <td class="tagForm">Pais:</td>
			    <td>
						<select name="pais1" id="pais1" class="selectMed" onchange="getOptions_4(this.id, 'estado1', 'municipio1', 'ciudad1'); setLNAC(this.form);">
							<option value=""></option>
							<?php getPaises('', 0); ?>
						</select>*
					</td>
			    <td class="tagForm">Estado:</td>
			    <td>
						<select name="estado1" id="estado1" class="selectMed" disabled>
							<option value=""></option>
						</select>*
					</td>
			  </tr>
				<tr>
			    <td class="tagForm">Municipio:</td>
			    <td>
						<select name="municipio1" id="municipio1" class="selectMed" disabled>
							<option value=""></option>
						</select>*
					</td>
			    <td class="tagForm">Ciudad:</td>
			    <td>
						<select name="ciudad1" id="ciudad1" class="selectMed" disabled>
							<option value=""></option>
						</select>*
					</td>
			  </tr>
			  <tr>
			    <td class="tagForm">Fecha:</td>
			    <td><input name="fnac" type="text" id="fnac" size="15" maxlength="10" onKeyUp="getEdad(this.form, this.value);" />*<em>(dd-mm-yyyy)</em></td>
			    <td class="tagForm">Edad:</td>
			    <td>
						<input name="anac" type="text" id="anac" size="5" readonly />a
						<input name="mnac" type="text" id="mnac" size="5" readonly />m
						<input name="dnac" type="text" id="dnac" size="5" readonly />d
					</td>
			  </tr>
			  <tr>
			    <td class="tagForm">Lugar de Nac.:</td>
			    <td colspan="3"><input name="lnac" type="text" id="lnac" size="100" readonly /></td>
			  </tr>
			</table>
			
			<div style="width:750px" class="divFormCaption">Domicilio Local</div>
			<table width="750" class="tblForm">
			  <tr>
			    <td class="tagForm">Direcci&oacute;n:</td>
			    <td colspan="3"><input name="dir" type="text" id="dir" size="100" maxlength="75" />*</td>
			  </tr>
				<tr>
			    <td class="tagForm">Pais:</td>
			    <td>
						<select name="pais2" id="pais2" class="selectMed" onchange="getOptions_4(this.id, 'estado2', 'municipio2', 'ciudad2')">
							<option value=""></option>
							<?php getPaises('', 0); ?>
						</select>*
					</td>
			    <td class="tagForm">Estado:</td>
			    <td>
						<select name="estado2" id="estado2" class="selectMed" disabled>
							<option value=""></option>
						</select>*
					</td>
			  </tr>
				<tr>
			    <td class="tagForm">Municipio:</td>
			    <td>
						<select name="municipio2" id="municipio2" class="selectMed" disabled>
							<option value=""></option>
						</select>*
					</td>
			    <td class="tagForm">Ciudad:</td>
			    <td>
						<select name="ciudad2" id="ciudad2" class="selectMed" disabled>
							<option value=""></option>
						</select>*
					</td>
			  </tr>
			</table>
			<table width="750" class="tblForm">
			  <tr>
			    <td class="tagForm">Tel&eacute;fono:</td>
			    <td colspan="3"><input name="tel1" type="text" id="tel1" size="25" maxlength="20" /></td>
			    <td class="tagForm">Celular:</td>
			    <td colspan="3"><input name="tel2" type="text" id="tel2" size="25" maxlength="20" /></td>
			    <td class="tagForm">Fax:</td>
			    <td colspan="3"><input name="tel3" type="text" id="tel3" size="25" maxlength="20" /></td>
			  </tr>
			</table>
			
			<div style="width:750px" class="divFormCaption">Documentos</div>
			<table width="750" class="tblForm">
				<tr>
			    <td class="tagForm">Tipo Doc.:</td>
			    <td>
						<select name="tdoc" id="tdoc" class="selectMed">
							<option value=""></option>
							<?php getMiscelaneos('', "DOCUMENTOS", 0); ?>
						</select>*
					</td>
			    <td class="tagForm">Nro. Documento:</td>
			    <td colspan="3"><input name="ndoc" type="text" id="ndoc" size="25" maxlength="20" />*</td>
			  </tr>
				<tr>
			    <td class="tagForm">Nacionalidad:</td>
			    <td>
						<select name="nac" id="nac" class="selectMed">
							<option value=""></option>
							<?php getMiscelaneos('', "NACION", 0); ?>
						</select>*
					</td>
			    <td class="tagForm">Doc. Fiscal:</td>
			    <td><input name="rif" type="text" id="rif" size="25" maxlength="20" /></td>
			  </tr>
			  <tr>
			    <td class="tagForm">e-mail:</td>
			    <td colspan="3"><input name="email" type="text" id="email" size="45" maxlength="30" /></td>
			  </tr>
			  <tr>
			    <td class="tagForm">Foto:</td>
			    <td colspan="3"><input name="foto" type="text" id="foto" size="75" onchange="setFoto();" /></td>
			  </tr>
			  <tr>
				  <td class="tagForm">&Uacute;ltima Modif.:</td>
				  <td colspan="3">
						<input name="ult_usuario" type="text" id="ult_usuario" size="30" readonly />
						<input name="ult_fecha" type="text" id="ult_fecha" size="25" readonly />
					</td>
				</tr>
			</table>
		</td>
		
		<td valign="top">
			<div style="width:150px" class="divFormCaption">Foto</div>
			<table width="150" class="tblForm">
			  <tr><td height="90" align="center" valign="center"><img src="<?=$path_blank."/blank.png"?>" name="img_foto" width="80" height="80" id="img_foto" /></td></tr>
			</table>
			<div style="width:150px" class="divFormCaption">Estado Registro</div>
			<table width="150" class="tblForm">
				<tr>
				  <td><input name="statusreg" type="radio" value="A" checked />Activo</td>
				</tr>
				<tr>
				  <td><input name="statusreg" type="radio" value="I" />Inactivo</td>
				</tr>			
			<?php
			echo "
				<tr>
			    <td height='287' align='center' valign='bottom'>
						<input type='submit' value='Guardar Registro' style='width:125px;' />
						<input name='bt_cancelar' type='button' id='bt_cancelar' value='Cancelar' style='width:125px;' onclick='cargarPagina(this.form, \"empleados.php?filtro=".$_POST['filtro']."&limit=".$_POST['limit']."&ordenar=".$_POST['ordenar']."\");' />
					</td>
				</tr>";
			?>
			</table>		
		</td>
	</tr>
</table><br />
<div style="width:905px" class="divMsj">Campos Obligatorios *</div>
</div>

<div name="tab2" id="tab2" style="display:none;">
<div style="width:905px" class="divFormCaption">Otros Datos Personales</div>
<table width="905" class="tblForm">
	<tr>
		<td class="tagForm">Grupo Sangu&iacute;neo:</td>
		<td>
			<select name="gsan" id="gsan" class="selectMed">
				<option value=""></option>
				<?php getMiscelaneos('', "SANGRE", 0); ?>
			</select>
		</td>
		<td class="tagForm">Situaci&oacute;n Domicilio:</td>
		<td>
			<select name="sitdom" id="sitdom" class="selectMed">
				<option value=""></option>
				<?php getMiscelaneos('', "SITDOM", 0); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="tagForm">Estado Civil:</td>
		<td>
			<select name="edocivil" id="edocivil" class="selectMed">
				<option value=""></option>
				<?php getMiscelaneos('', "EDOCIVIL", 0); ?>
			</select>*
		</td>
		<td class="tagForm">Fecha Edo. Civil:</td>
		<td><input name="fedocivil" type="text" id="fedocivil" size="15" maxlength="10" /><i>(dd-mm-yyyy)</i>
		</td>
	</tr>
</table>
<div style="width:905px" class="divFormCaption">Otros Datos Personales</div>
<table width="905" class="tblForm">
	<tr>
		<td colspan="4">Contacto # 1</td>
		<td colspan="3">Contacto # 2</td>
	</tr>	
	<tr>
		<td class="tagForm">Nombre:</td>
		<td colspan="3"><input name="nomcon1" type="text" id="nomcon1" size="45" maxlength="30" /></td>
		<td colspan="3"><input name="nomcon2" type="text" id="nomcon2" size="45" maxlength="30" /></td>
	</tr>	
	<tr>
		<td class="tagForm">Direcci&oacute;n:</td>
		<td colspan="3"><input name="dircon1" type="text" id="dircon1" size="45" maxlength="50" /></td>
		<td colspan="3"><input name="dircon2" type="text" id="dircon2" size="45" maxlength="50" /></td>
	</tr>
	<tr>
		<td class="tagForm">Tel&eacute;fono:</td>
		<td><input name="telcon1" type="text" id="telcon1" size="20" maxlength="15" /></td>
		<td class="tagForm">Celular:</td>
		<td><input name="celcon1" type="text" id="celcon1" size="20" maxlength="15" /></td>
		<td><input name="telcon2" type="text" id="telcon2" size="20" maxlength="15" /></td>
		<td class="tagForm">Celular:</td>
		<td><input name="celcon2" type="text" id="celcon2" size="20" maxlength="15" /></td>
	</tr>
	<tr>
		<td class="tagForm">Parentesco:</td>
		<td colspan="3">
			<select name="parent1" id="parent1" class="selectMed">
				<option value=""></option>
				<?php getMiscelaneos('', "PARENT", 0); ?>
			</select>
		</td>
		<td colspan="3">
			<select name="parent2" id="parent2" class="selectMed">
				<option value=""></option>
				<?php getMiscelaneos('', "PARENT", 0); ?>
			</select>
		</td>
	</tr>	
</table>

<div style="width:905px" class="divFormCaption">Licencia de Conducir</div>
<table width="905" class="tblForm">	<tr>
		<td class="tagForm">Tipo de Licencia:</td>
		<td>
			<select name="tlic" id="tlic" class="selectMed">
				<option value=""></option>
				<?php getMiscelaneos('', "TIPOLIC", 0); ?>
			</select>
		</td>
		<td class="tagForm">Nro. de Licencia:</td>
		<td><input name="nlic" type="text" id="nlic" size="45" maxlength="30" /></td>
	</tr>
	<tr>	
		<td class="tagForm">Fecha de Expiraci&oacute;n:</td>
		<td>
			<input name="flic" type="text" id="flic" size="15" maxlength="10" /><i>(dd-mm-yyyy)</i>
		</td>
		<td colspan="2"><input name="auto" type="checkbox" id="auto" value="S" /> &iquest;Posee Auto?</td>
	</tr>
</table>
<div style="width:905px" class="divFormCaption">Observaciones Adicionales</div>
<table width="905" class="tblForm">
	<tr><td align="center"><textarea name="obs" id="obs" style="width:98%" rows="2"></textarea></td></tr>
</table><br />
<div style="width:905px" class="divMsj">Campos Obligatorios *</div>
</div>


<div name="tab3" id="tab3" style="display:none;">
<div style="width:905px" class="divFormCaption">Organizaci&oacute;n</div>
<table width="905" class="tblForm">
	<tr>
		<td class="tagForm" width="125">Organismo:</td>
		<td>
			<input type="hidden" name="horganismo" id="horganismo" />
			<select name="organismo" id="organismo" class="selectBig" onchange="getOptions_2(this.id, 'dependencia')">
				<option value=""></option>
				<?php getOrganismos('', 0); ?>
			</select>*
		</td>
	</tr>
	<tr>
		<td class="tagForm">Dependencia:</td>
		<td onclick="document.getElementById('ccosto').value=''; document.getElementById('nomccosto').value='';">
			<input type="hidden" name="hdependencia" id="hdependencia" />
			<select name="dependencia" id="dependencia" class="selectBig" disabled>
				<option value=""></option>
			</select>*
		</td>
	</tr>
	<tr>
		<td class="tagForm">Centro de Costo:</td>
		<td>
        	<input type="text" name="ccosto" id="ccosto" size="7" readonly />
			<input type="text" name="nomccosto" id="nomccosto" style="width:235px;" />
			<input type="button" value="..." onclick="cargarVentana(this.form, 'listado_centro_costos.php?cod=ccosto&nom=nomccosto&origen=empleados&dependencia='+document.getElementById('dependencia').value, 'height=600, width=850, left=100, top=50, resizable=yes');" />
		</td>
	</tr>
</table>
<div style="width:905px" class="divFormCaption">Planilla</div>
<table width="905" class="tblForm">
	<tr>
		<td class="tagForm">Tipo N&oacute;mina:</td>
		<td>
			<select name="tnom" id="tnom" class="selectSma">
				<option value=""></option>
				<?php getTNomina('', 0); ?>
			</select>*
		</td>
		<td class="tagForm">Perfil N&oacute;mina:</td>
		<td>
			<select name="pnom" id="pnom" class="selectSma">
				<option value=""></option>
				<?php getPNomina('', 0); ?>
			</select>*
		</td>
	</tr>
	<tr>
		<td class="tagForm">Tipo de Pago:</td>
		<td>
			<input type="hidden" name="htpago" id="htpago" />
			<select name="tpago" id="tpago" class="selectSma">
				<option value=""></option>
				<?php getTPago('', 0); ?>
			</select>*
		</td>
		<td class="tagForm">Tipo de Trabajador:</td>
		<td>
			<input type="hidden" name="httra" id="httra" />
			<select name="ttra" id="ttra" class="selectSma">
				<option value=""></option>
				<?php getTTrabajador('', 0); ?>
			</select>*
		</td>
	</tr>
</table>

<div style="width:905px" class="divFormCaption">Horario de Trabajo</div>
<table width="905" class="tblForm">
	<tr>
		<td class="tagForm" width="150">Carnet Provisional:</td>
		<td><input type="text" name="codcarnet" id="codcarnet" size="8" maxlength="4" /></td>
	</tr>
</table><br />
<div style="width:905px" class="divMsj">Campos Obligatorios *</div>
</div>

<div name="tab4" id="tab4" style="display:none;">
<div style="width:905px" class="divFormCaption">Ingreso</div>
<table width="905" class="tblForm">
	<tr>
		<td class="tagForm" width="200">Fecha de Ingreso:</td>
		<td><input name="fingreso" type="text" id="fingreso" size="15" maxlength="10" />*<i>(dd-mm-yyyy)</i>
		</td>
	</tr>
</table>
<div style="width:905px" class="divFormCaption">Cese</div>
<table width="905" class="tblForm">
	<tr>
    <td class="tagForm" width="200">Situaci&oacute;n del Trab.:</td>
    <td>
			<input type="hidden" name="hsittra" id="hsittra" />
			<input name="sittra" type="radio" value="A" checked onclick="setCese(this.form);" /> Activo
			<input name="sittra" type="radio" value="I" onclick="setCese(this.form);" /> Inactivo
		</td>
		<td class="tagForm">Motivo del Cese:</td>
		<td>
			<select name="tcese" id="tcese" class="selectBig" disabled>
				<option value=""></option>
				<?php getTCese('', 0); ?>
			</select>*
		</td>
	</tr>

</table>
<div style="width:905px" class="divFormCaption">Estructura del Puesto</div>

<div style="width:905px" class="divMsj">Campos Obligatorios *</div>
</div>




</body>
</html>