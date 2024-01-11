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
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
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
	    $this->SetFont('Arial','B',12);
	    $this->Text(75,30,'Reporde de Asistencias',0,'C', 0);
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
	$pdf=new PDF('P','mm','Letter'); // vertical, milimetros y tamaño
	$pdf->Open();
	$pdf->SetFillColor(210,0,0);
	$pdf->AddPage(); // agregamos la pagina
	$pdf->SetMargins(10,10,10); // definimos los margenes en este caso estan en milimetros
	$pdf->Ln(10); // dejamos un pequeño espacio de 10 milimetros
	

//obtener los regsitro

mysql_select_db($database_conexion, $conexion);


// Para realizar esto utilizaremos la funcion Row()
	$pdf->SetDrawColor(250,250,250);
	$pdf->SetWidths(array(200)); 
	$pdf->SetAligns(array('C'));
	$pdf->Row(array("EVENTO: ".$_GET["evento"]));
	$pdf->Ln(3);
	
	$pdf->SetDrawColor(250,250,250);
	$pdf->SetWidths(array(200)); 
	$pdf->SetAligns(array('L'));
	$pdf->Row(array("FECHA: ".$_GET["fecha"]));
	$pdf->Ln(3);
	
	$pdf->SetFont('Times','B',12); // tipo y tamaño de letra
	$pdf->SetWidths(array(50,50,50,50)); 
	$pdf->SetAligns(array('C','C','C','C'));
	$pdf->SetDrawColor(210,0,0);
	$pdf->Row(array('Funcionario',  'Cargo', 'Cargo', utf8_encode('Asistencia'))); // creamos nuestra fila con las columnas fecha(fecha de la visita al medico), medico(nombre del medico que nos atendio), consultorio y el diagnostico en esa visita
	$pdf->SetFont('Times','',9);
	$pdf->SetDrawColor(210,0,0);




    // Realizamos nuestra consulta
	
	mysql_select_db($database_conexion, $conexion);
		$query_fun = "SELECT * FROM funcionarios";
		$fun = mysql_query($query_fun, $conexion) or die(mysql_error());
		$row_fun = mysql_fetch_assoc($fun);
		$totalRows_fun = mysql_num_rows($fun);	
	
	do {
		
		
		mysql_select_db($database_conexion, $conexion);
		$query_asistencia = "SELECT * FROM asistencia where evento='$_GET[codigo]' and funcionario='$row_fun[cedula]'";
		$asistencia = mysql_query($query_asistencia, $conexion) or die(mysql_error());
		$row_asistencia = mysql_fetch_assoc($asistencia);
		$totalRows_asistencia = mysql_num_rows($asistencia);
		
	if($totalRows_asistencia>0){
		$pdf->SetAligns(array('L','L','L','C'));
		$pdf->Row(array(utf8_encode($row_fun['nombres']), $row_fun['cedula'], utf8_encode($row_fun['cargo']), $row_asistencia['asistio']));	
	}//fin del if
	
		
	} while ($row_fun = mysql_fetch_assoc($fun)); 
	
$pdf->Output();


?>