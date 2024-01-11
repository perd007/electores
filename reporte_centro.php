                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php require_once('Connections/conexion.php'); ?>
<?php include('Connections/conexion.php'); 
require('fpdf/fpdf.php');


//obtener registro


class PDF extends FPDF
	{
var $widths;
var $aligns;

//Funcion para definir el tamaño de las columnas
	function SetWidths($w)
	{
    $this->widths=$w;
}
	 
	function SetAligns($a)
	{
	    $this->aligns=$a;
}
//Funcion para Mostrar los datos en filas 
function Row($data)
	{
    $nb=0;
    for($i=0;$i<count($data);$i++)
	        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
   $h=4*$nb;
   $this->CheckPageBreak($h);
	    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
	        $x=$this->GetX();
        $y=$this->GetY();
	        $this->Rect($x,$y,$w,$h);
	        $this->MultiCell($w,4,$data[$i],0,$a);
	        $this->SetXY($x+$w,$y);
		


    }
	    $this->Ln($h);
	}
	 
	function CheckPageBreak($h)
	{
	    if($this->GetY()+$h>$this->PageBreakTrigger)
	        $this->AddPage($this->CurOrientation);
	}
	 
	function NbLines($w,$txt)
	{
	    $cw=&$this->CurrentFont['cw'];
	    if($w==0)
	        $w=$this->w-$this->rMargin-$this->x;
	    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	    $s=str_replace("\r",'',$txt);
	    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
	        $nb--;
    $sep=-1;
	    $i=0;
    $j=0;
	    $l=0;
	    $nl=1;
    while($i<$nb)
	    {
	        $c=$s[$i];
	        if($c=="\n")
	        {
            $i++;
	            $sep=-1;
	            $j=$i;
            $l=0;
	            $nl++;
	            continue;
	        }
        if($c==' ')
	            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
	        {
	            if($sep==-1)
	            {
	                if($i==$j)
	                    $i++;
	            }
	            else
	                $i=$sep+1;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	        }
	        else
	            $i++;
	    }
	    return $nl;
	}
	 //Funcion Ppara el Encabeado
	function Header()
	{
    	$this->Image('imagenes/banner.jpg',10,7,200);
	    $this->SetFont('Arial','B',10);
	    $this->Text(75,30,'Estadisticas por Centro de Votacion',0,'C', 0);
    $this->Ln(13);
	}
	 //funcion para el pie de Pagina
	function Footer()
	{
	    $this->SetY(-15);
	    $this->SetFont('Arial','B',10);
	    $this->Cell(100,10,'Alcaldia de Atures',0,0,'L');
	}
	}
	


// creamos el objeto FPDF
	$pdf=new PDF('p','mm','Letter'); // vertical, milimetros y tamaño
	$pdf->Open();
		 $pdf->SetFillColor(210,0,0);
	$pdf->AddPage(); // agregamos la pagina
	$pdf->SetMargins(10,10,10); // definimos los margenes en este caso estan en milimetros
	$pdf->Ln(10); // dejamos un pequeño espacio de 10 milimetros
	

//obtener los regsitro

mysql_select_db($database_conexion, $conexion);


// Para realizar esto utilizaremos la funcion Row()
	$pdf->SetFont('Times','B',9); // tipo y tamaño de letra
	$pdf->SetWidths(array(80,15,15,15,15,15,15,15,15,15,15)); // Definimos el tamaño de las columnas, tomando en cuenta que las declaramos en milimetros, ya que nuestra hoja esta en milimetro15s
	$pdf->SetDrawColor(210,0,0);
	$pdf->Row(array('Centro en Fernando Giron Tovar', 'Codigo', 'Electores', 'Mesas', 'Insc. PSUV','C', 'O', 'NI-NI', 'N.I.A')); // creamos nuestra fila con las columnas fecha(fecha de la visita al medico), medico(nombre del medico que nos atendio), consultorio y el diagnostico en esa visita
	$pdf->SetFont('Times','',9);
	$pdf->SetDrawColor(210,0,0);


//consulta parroquia Fenando Giron Tovar

    // Realizamos nuestra consulta
	$strConsulta2 = "SELECT * FROM centro_votacion where parroquia='Fernando Giron Tovar'";
	
	// ejecutamos la consulta
	$centros = mysql_query($strConsulta2, $conexion) or die(mysql_error());
		
	// listamos la tabla de centros 
	$numfilas = mysql_num_rows($centros);
for ($i=0; $i<$numfilas; $i++)   {       
	
	$fila = mysql_fetch_array($centros);                  



mysql_select_db($database_conexion, $conexion);
$query_electores = "SELECT * FROM elector where centro='$fila[id_centro]'";
$electores = mysql_query($query_electores, $conexion) or die(mysql_error());
$row_electores = mysql_fetch_assoc($electores);
$totalRows_electores = mysql_num_rows($electores);

mysql_select_db($database_conexion, $conexion);
$query_diagnostico_pre = "SELECT * FROM diagnostico_pre where id_pre='$row_electores[id_elector]'";
$diagnostico_pre = mysql_query($query_diagnostico_pre, $conexion) or die(mysql_error());
$row_diagnostico_pre = mysql_fetch_assoc($diagnostico_pre);
$totalRows_diagnostico_pre = mysql_num_rows($diagnostico_pre);

mysql_select_db($database_conexion, $conexion);
$query_mesas = "SELECT * FROM centro_votacion where id_centro='$fila[id_centro]' ";
$mesas = mysql_query($query_mesas, $conexion) or die(mysql_error());
$row_mesas = mysql_fetch_assoc($mesas);
$totalRows_mesas = mysql_num_rows($mesas);

mysql_select_db($database_conexion, $conexion);
$query_psuv = "SELECT * FROM elector where potica='Inscrito en el PSUV' and centro='$fila[id_centro]'";
$psuv = mysql_query($query_psuv, $conexion) or die(mysql_error());
$row_psuv = mysql_fetch_assoc($psuv);
$totalRows_psuv = mysql_num_rows($psuv);


mysql_select_db($database_conexion, $conexion);
$query_comprometido = "SELECT * FROM elector where potica='Comprometido con el PSUV' and centro='$fila[id_centro]'";
$comprometido = mysql_query($query_comprometido, $conexion) or die(mysql_error());
$row_comprometido = mysql_fetch_assoc($comprometido);
$totalRows_comprometido = mysql_num_rows($comprometido);

mysql_select_db($database_conexion, $conexion);
$query_simpatizante = "SELECT * FROM elector where potica='Simpatizante del PSUV' and centro='$fila[id_centro]'";
$simpatizante = mysql_query($query_simpatizante, $conexion) or die(mysql_error());
$row_simpatizante = mysql_fetch_assoc($simpatizante);
$totalRows_simpatizante = mysql_num_rows($simpatizante);

mysql_select_db($database_conexion, $conexion);
$query_otro = "SELECT * FROM elector where potica='Otro Factor ' and centro='$fila[id_centro]'";
$otro = mysql_query($query_otro, $conexion) or die(mysql_error());
$row_otro = mysql_fetch_assoc($otro);
$totalRows_otro = mysql_num_rows($otro);

mysql_select_db($database_conexion, $conexion);
$query_nini = "SELECT * FROM elector where potica='NINI' and centro='$fila[id_centro]'";
$nini = mysql_query($query_nini, $conexion) or die(mysql_error());
$row_nini = mysql_fetch_assoc($nini);
$totalRows_nini = mysql_num_rows($nini);


	// los mostramos con la función Row
	$pdf->Row(array($fila['nombre'], $fila['codigo'], $totalRows_electores, $row_mesas["mesas"], $totalRows_psuv, $totalRows_comprometido, $totalRows_otro,$totalRows_nini,$totalRows_simpatizante));
		}

// fin de la primera consulta


/**********************************************************************************************************/
//consulta parroquia Luis Alberto Gomez
$pdf->Ln(10); // dejamos un pequeño espacio de 10 milimetros
// Para realizar esto utilizaremos la funcion Row()

$pdf->SetFont('Times','B',9); // tipo y tamaño de letra

$pdf->Row(array('Centro en Luis Alberto Gomez', 'Codigo', 'Electores', 'Mesas', 'Insc. PSUV','C', 'O', 'NI-NI', 'N.I.A')); 

$pdf->SetFont('Times','',9);

    // Realizamos nuestra consulta
	$strConsulta2 = "SELECT * FROM centro_votacion where parroquia='Luis Alberto Gomez'";
	
	// ejecutamos la consulta
	$centros = mysql_query($strConsulta2, $conexion) or die(mysql_error());
		
	// listamos la tabla de centros 
	$numfilas = mysql_num_rows($centros);
for ($i=0; $i<$numfilas; $i++)   {       
	
	$fila = mysql_fetch_array($centros);                  



mysql_select_db($database_conexion, $conexion);
$query_electores = "SELECT * FROM elector where centro='$fila[id_centro]'";
$electores = mysql_query($query_electores, $conexion) or die(mysql_error());
$row_electores = mysql_fetch_assoc($electores);
$totalRows_electores = mysql_num_rows($electores);

mysql_select_db($database_conexion, $conexion);
$query_diagnostico_pre = "SELECT * FROM diagnostico_pre where id_pre='$row_electores[id_elector]'";
$diagnostico_pre = mysql_query($query_diagnostico_pre, $conexion) or die(mysql_error());
$row_diagnostico_pre = mysql_fetch_assoc($diagnostico_pre);
$totalRows_diagnostico_pre = mysql_num_rows($diagnostico_pre);

mysql_select_db($database_conexion, $conexion);
$query_mesas = "SELECT * FROM centro_votacion where id_centro='$fila[id_centro]' ";
$mesas = mysql_query($query_mesas, $conexion) or die(mysql_error());
$row_mesas = mysql_fetch_assoc($mesas);
$totalRows_mesas = mysql_num_rows($mesas);

mysql_select_db($database_conexion, $conexion);
$query_psuv = "SELECT * FROM elector where potica='Inscrito en el PSUV' and centro='$fila[id_centro]'";
$psuv = mysql_query($query_psuv, $conexion) or die(mysql_error());
$row_psuv = mysql_fetch_assoc($psuv);
$totalRows_psuv = mysql_num_rows($psuv);


mysql_select_db($database_conexion, $conexion);
$query_comprometido = "SELECT * FROM elector where potica='Comprometido con el PSUV' and centro='$fila[id_centro]'";
$comprometido = mysql_query($query_comprometido, $conexion) or die(mysql_error());
$row_comprometido = mysql_fetch_assoc($comprometido);
$totalRows_comprometido = mysql_num_rows($comprometido);

mysql_select_db($database_conexion, $conexion);
$query_simpatizante = "SELECT * FROM elector where potica='Simpatizante del PSUV' and centro='$fila[id_centro]'";
$simpatizante = mysql_query($query_simpatizante, $conexion) or die(mysql_error());
$row_simpatizante = mysql_fetch_assoc($simpatizante);
$totalRows_simpatizante = mysql_num_rows($simpatizante);

mysql_select_db($database_conexion, $conexion);
$query_otro = "SELECT * FROM elector where potica='Otro Factor ' and centro='$fila[id_centro]'";
$otro = mysql_query($query_otro, $conexion) or die(mysql_error());
$row_otro = mysql_fetch_assoc($otro);
$totalRows_otro = mysql_num_rows($otro);

mysql_select_db($database_conexion, $conexion);
$query_nini = "SELECT * FROM elector where potica='NINI' and centro='$fila[id_centro]'";
$nini = mysql_query($query_nini, $conexion) or die(mysql_error());
$row_nini = mysql_fetch_assoc($nini);
$totalRows_nini = mysql_num_rows($nini);


	// los mostramos con la función Row
	$pdf->Row(array($fila['nombre'], $fila['codigo'], $totalRows_electores, $row_mesas["mesas"], $totalRows_psuv, $totalRows_comprometido, $totalRows_otro,$totalRows_nini,$totalRows_simpatizante));
		}

// fin de la primera consulta


/**********************************************************************************************************/
//consulta parroquia Platanillal
$pdf->Ln(10); // dejamos un pequeño espacio de 10 milimetros
// Para realizar esto utilizaremos la funcion Row()

$pdf->SetFont('Times','B',9); // tipo y tamaño de letra

$pdf->Row(array('Centro en Platanillal', 'Codigo', 'Electores', 'Mesas', 'Insc. PSUV','C', 'O', 'NI-NI', 'N.I.A')); 

$pdf->SetFont('Times','',9);
    // Realizamos nuestra consulta
	$strConsulta2 = "SELECT * FROM centro_votacion where parroquia='Platanillal'";
	
	// ejecutamos la consulta
	$centros = mysql_query($strConsulta2, $conexion) or die(mysql_error());
		
	// listamos la tabla de centros 
	$numfilas = mysql_num_rows($centros);
for ($i=0; $i<$numfilas; $i++)   {       
	
	$fila = mysql_fetch_array($centros);                  



mysql_select_db($database_conexion, $conexion);
$query_electores = "SELECT * FROM elector where centro='$fila[id_centro]'";
$electores = mysql_query($query_electores, $conexion) or die(mysql_error());
$row_electores = mysql_fetch_assoc($electores);
$totalRows_electores = mysql_num_rows($electores);

mysql_select_db($database_conexion, $conexion);
$query_diagnostico_pre = "SELECT * FROM diagnostico_pre where id_pre='$row_electores[id_elector]'";
$diagnostico_pre = mysql_query($query_diagnostico_pre, $conexion) or die(mysql_error());
$row_diagnostico_pre = mysql_fetch_assoc($diagnostico_pre);
$totalRows_diagnostico_pre = mysql_num_rows($diagnostico_pre);

mysql_select_db($database_conexion, $conexion);
$query_mesas = "SELECT * FROM centro_votacion where id_centro='$fila[id_centro]' ";
$mesas = mysql_query($query_mesas, $conexion) or die(mysql_error());
$row_mesas = mysql_fetch_assoc($mesas);
$totalRows_mesas = mysql_num_rows($mesas);

mysql_select_db($database_conexion, $conexion);
$query_psuv = "SELECT * FROM elector where potica='Inscrito en el PSUV' and centro='$fila[id_centro]'";
$psuv = mysql_query($query_psuv, $conexion) or die(mysql_error());
$row_psuv = mysql_fetch_assoc($psuv);
$totalRows_psuv = mysql_num_rows($psuv);


mysql_select_db($database_conexion, $conexion);
$query_comprometido = "SELECT * FROM elector where potica='Comprometido con el PSUV' and centro='$fila[id_centro]'";
$comprometido = mysql_query($query_comprometido, $conexion) or die(mysql_error());
$row_comprometido = mysql_fetch_assoc($comprometido);
$totalRows_comprometido = mysql_num_rows($comprometido);

mysql_select_db($database_conexion, $conexion);
$query_simpatizante = "SELECT * FROM elector where potica='Simpatizante del PSUV' and centro='$fila[id_centro]'";
$simpatizante = mysql_query($query_simpatizante, $conexion) or die(mysql_error());
$row_simpatizante = mysql_fetch_assoc($simpatizante);
$totalRows_simpatizante = mysql_num_rows($simpatizante);

mysql_select_db($database_conexion, $conexion);
$query_otro = "SELECT * FROM elector where potica='Otro Factor ' and centro='$fila[id_centro]'";
$otro = mysql_query($query_otro, $conexion) or die(mysql_error());
$row_otro = mysql_fetch_assoc($otro);
$totalRows_otro = mysql_num_rows($otro);

mysql_select_db($database_conexion, $conexion);
$query_nini = "SELECT * FROM elector where potica='NINI' and centro='$fila[id_centro]'";
$nini = mysql_query($query_nini, $conexion) or die(mysql_error());
$row_nini = mysql_fetch_assoc($nini);
$totalRows_nini = mysql_num_rows($nini);


	// los mostramos con la función Row
	$pdf->Row(array($fila['nombre'], $fila['codigo'], $totalRows_electores, $row_mesas["mesas"], $totalRows_psuv, $totalRows_comprometido, $totalRows_otro,$totalRows_nini,$totalRows_simpatizante));
		}

// fin de la primera consulta




/**********************************************************************************************************/
//consulta parroquia Parhueña
$pdf->Ln(10); // dejamos un pequeño espacio de 10 milimetros
// Para realizar esto utilizaremos la funcion Row()

$pdf->SetFont('Times','B',9); // tipo y tamaño de letra

$pdf->Row(array('Centro en Parhueña', 'Codigo', 'Electores', 'Mesas', 'Insc. PSUV','C', 'O', 'NI-NI', 'N.I.A')); 

$pdf->SetFont('Times','',9);
    // Realizamos nuestra consulta
	$strConsulta2 = "SELECT * FROM centro_votacion where parroquia='Parhueña'";
	
	// ejecutamos la consulta
	$centros = mysql_query($strConsulta2, $conexion) or die(mysql_error());
		
	// listamos la tabla de centros 
	$numfilas = mysql_num_rows($centros);
for ($i=0; $i<$numfilas; $i++)   {       
	
	$fila = mysql_fetch_array($centros);                  



mysql_select_db($database_conexion, $conexion);
$query_electores = "SELECT * FROM elector where centro='$fila[id_centro]'";
$electores = mysql_query($query_electores, $conexion) or die(mysql_error());
$row_electores = mysql_fetch_assoc($electores);
$totalRows_electores = mysql_num_rows($electores);

mysql_select_db($database_conexion, $conexion);
$query_diagnostico_pre = "SELECT * FROM diagnostico_pre where id_pre='$row_electores[id_elector]'";
$diagnostico_pre = mysql_query($query_diagnostico_pre, $conexion) or die(mysql_error());
$row_diagnostico_pre = mysql_fetch_assoc($diagnostico_pre);
$totalRows_diagnostico_pre = mysql_num_rows($diagnostico_pre);

mysql_select_db($database_conexion, $conexion);
$query_mesas = "SELECT * FROM centro_votacion where id_centro='$fila[id_centro]' ";
$mesas = mysql_query($query_mesas, $conexion) or die(mysql_error());
$row_mesas = mysql_fetch_assoc($mesas);
$totalRows_mesas = mysql_num_rows($mesas);

mysql_select_db($database_conexion, $conexion);
$query_psuv = "SELECT * FROM elector where potica='Inscrito en el PSUV' and centro='$fila[id_centro]'";
$psuv = mysql_query($query_psuv, $conexion) or die(mysql_error());
$row_psuv = mysql_fetch_assoc($psuv);
$totalRows_psuv = mysql_num_rows($psuv);


mysql_select_db($database_conexion, $conexion);
$query_comprometido = "SELECT * FROM elector where potica='Comprometido con el PSUV' and centro='$fila[id_centro]'";
$comprometido = mysql_query($query_comprometido, $conexion) or die(mysql_error());
$row_comprometido = mysql_fetch_assoc($comprometido);
$totalRows_comprometido = mysql_num_rows($comprometido);

mysql_select_db($database_conexion, $conexion);
$query_simpatizante = "SELECT * FROM elector where potica='Simpatizante del PSUV' and centro='$fila[id_centro]'";
$simpatizante = mysql_query($query_simpatizante, $conexion) or die(mysql_error());
$row_simpatizante = mysql_fetch_assoc($simpatizante);
$totalRows_simpatizante = mysql_num_rows($simpatizante);

mysql_select_db($database_conexion, $conexion);
$query_otro = "SELECT * FROM elector where potica='Otro Factor ' and centro='$fila[id_centro]'";
$otro = mysql_query($query_otro, $conexion) or die(mysql_error());
$row_otro = mysql_fetch_assoc($otro);
$totalRows_otro = mysql_num_rows($otro);

mysql_select_db($database_conexion, $conexion);
$query_nini = "SELECT * FROM elector where potica='NINI' and centro='$fila[id_centro]'";
$nini = mysql_query($query_nini, $conexion) or die(mysql_error());
$row_nini = mysql_fetch_assoc($nini);
$totalRows_nini = mysql_num_rows($nini);


	// los mostramos con la función Row
	$pdf->Row(array($fila['nombre'], $fila['codigo'], $totalRows_electores, $row_mesas["mesas"], $totalRows_psuv, $totalRows_comprometido, $totalRows_otro,$totalRows_nini,$totalRows_simpatizante));
		}

// fin de la primera consulta



	//La ultima linea $pdf->Output(); lo que hace es cerrar el archivo y enviarlo al navegador.
$pdf->Output();


?>
