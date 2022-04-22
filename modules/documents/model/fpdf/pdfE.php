<?php
class PDF extends FPDF
{

	var $widths;
	var $aligns;
	var $height;
	var $logo;

	function setLogo($logo){
		$this->logo = $logo;
	}
	function setHeight($height){
		$this->height = $height;
	}
	function SetWidths($w)
	{
		//Tableau des largeurs de colonnes
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Tableau des alignements de colonnes
		$this->aligns=$a;
	}

	function Row($data)
	{
		//Calcule la hauteur de la ligne
		$nb=0;
		for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=$this->height*$nb;
		//Effectue un saut de page si nécessaire
		$this->CheckPageBreak($h);
		//Dessine les cellules
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Sauve la position courante
			$x=$this->GetX();
			$y=$this->GetY();
			//Dessine le cadre
			$this->Rect($x,$y,$w,$h);
			//Imprime le texte
			$this->MultiCell($w,$this->height,$data[$i],0,$a);
			//Repositionne à drote
			$this->SetXY($x+$w,$y);
		}
		//Va à la ligne
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//Si la hauteur h provoque un débordement, saut de page manuel
		if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
		//Calcule le nombre de lignes qu'occupe un MultiCell de largeur w
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

	//En-tête
	function Header()
	{
		$this->setHeight(4);
		if($this->logo)
		$this->Image( $this->logo,40,0,210 );
		$this->SetFont('Arial','B',15);
		$this->ln(55);
		$this->Cell(0,0,date('d/m/Y'),0,0,'C');
		$this->ln(10);
		$this->SetFont('Arial','B',6);
		$this->SetWidths(array(12,12,29,15,18,18,15,22,20,17,10,10,14,67));
		$this->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C','C'));
		$this->Row(array(
		utf8_decode('N° mandat'),
		utf8_decode('CP'),
		utf8_decode('Ville'),
		utf8_decode('Prix FAI'),
		utf8_decode('Superficie'),
		utf8_decode('Bornage'),
		utf8_decode('SHON accordée'),
		utf8_decode('Tout à l\'égout / Assainissement perso'),
		utf8_decode('Terrain vendu'),
		utf8_decode('Orientation'),
		utf8_decode('Pente'),
		utf8_decode('Façade'),
		utf8_decode('Profondeur'),
		utf8_decode('Texte')
		));
		/*
		 $this->Cell(20,10,utf8_decode('N° mandat'),1,0,'C');
		$this->Cell(20,10,utf8_decode('CP'),1,0,'C');
		$this->Cell(20,10,utf8_decode('Ville'),1,0,'C');
		$this->Cell(20,10,utf8_decode('Prix FAI'),1,0,'C');
		$this->Cell(20,10,utf8_decode('Superficie T'),1,0,'C');
		$this->Cell(19,10,utf8_decode('Bornage'),1,0,'C');
		$this->Cell(22,10,utf8_decode('SHON accordée'),1,0,'C');
		$this->Cell(19,10,utf8_decode('Tout à l\'égout'),1,0,'C');
		$this->Cell(20,10,utf8_decode('Terrain vendu'),1,0,'C');
		$this->Cell(20,10,utf8_decode('Orientation'),1,0,'C');
		$this->Cell(20,10,utf8_decode('Pente'),1,0,'C');
		$this->Cell(20,10,utf8_decode('Façade'),1,0,'C');
		$this->Cell(20,10,utf8_decode('Profondeur'),1,0,'C');
		$this->Cell(20,10,utf8_decode('Texte'),1,0,'C');
		*/
	}
	//Pied de page
	function Footer()
	{
		//    Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		//Police Arial italique 8
		$this->SetFont('Arial','I',8);
		//Numéro de page
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

	}
}


class PdfFicheImage extends FPDF
{

	var $widths;
	var $aligns;
	var $height;

	function setHeight($height){
		$this->height = $height;
	}
	function SetWidths($w)
	{
		//Tableau des largeurs de colonnes
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Tableau des alignements de colonnes
		$this->aligns=$a;
	}

	function Row($data)
	{
		//Calcule la hauteur de la ligne
		$nb=0;
		for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=$this->height*$nb;
		//Effectue un saut de page si nécessaire
		$this->CheckPageBreak($h);
		//Dessine les cellules
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Sauve la position courante
			$x=$this->GetX();
			$y=$this->GetY();
			//Dessine le cadre
			$this->Rect($x,$y,$w,$h);
			//Imprime le texte
			$this->MultiCell($w,$this->height,$data[$i],0,$a);
			//Repositionne à drote
			$this->SetXY($x+$w,$y);
		}
		//Va à la ligne
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//Si la hauteur h provoque un débordement, saut de page manuel
		if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
		//Calcule le nombre de lignes qu'occupe un MultiCell de largeur w
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

	//En-tête
	function Header()
	{
		$this->setHeight(4);
	}
	//Pied de page
	function Footer()
	{
		//    Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		//Police Arial italique 8
		$this->SetFont('Arial','I',8);
		//Numéro de page
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

	}
}
class PdfFicheAcq extends FPDF
{

	public $nomAcqPrincipal;

	function NbLines($w,$txt)
	{
		//Calcule le nombre de lignes qu'occupe un MultiCell de largeur w
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

	//En-tête
	function Header()
	{
		$this->SetFont('times','BU',25);
		$this->Cell(0,10,utf8_decode('FICHE ACQUÉREUR(S)'),0,1,'C');
	}
	//Pied de page
	function Footer()
	{
		//    Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		//Police Arial italique 8
		$this->SetFont('Arial','I',8);
		//Numéro de page
		$this->Cell(0,10, $this->nomAcqPrincipal,0,0,'L');
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');

	}
}


class PdfClassic extends FPDF
{

	public $ContentFooter;
	public $ContentHeader;
	
	function NbLines($w,$txt)
	{
		//Calcule le nombre de lignes qu'occupe un MultiCell de largeur w
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

	//En-tête
	function Header()
	{
		$this->SetFont('times','BU',25);
		$this->Cell(0,10,utf8_decode($this->ContentHeader),0,1,'C');
		$this->Ln(15);
		$this->SetFont('times','',12);
	}
	//Pied de page
	function Footer()
	{
		//    Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		//Police Arial italique 8
		$this->SetFont('Arial','I',8);
		//Numéro de page
		$this->Cell(0,10, utf8_decode($this->ContentFooter),0,0,'L');
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');

	}
}