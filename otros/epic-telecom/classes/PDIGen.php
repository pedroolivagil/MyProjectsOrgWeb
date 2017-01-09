<?php 
require_once('pdf/fpdf17/fpdf.php');
require_once('pdf/fpdi16/fpdi.php');
class PDIGen extends FPDI {
	public $page;
	public $totalPages;
	public $tplIdx;
	public $lugar;
	public $current_font;
	
	private function headers(){
		$this->SetAuthor('Epic Solutions SL');
		$this->SetCreator('Epic Telecom');
		$this->SetTitle('Contrato producto seleccionado');
		$this->SetSubject('Contrato pendiente de aprobación por nuestros técnicos', true);
	}
	
	private function setFontConf(){
		$this->SetFont($this->current_font);
		$this->SetTextColor(50);
		$this->SetFontSize(FONTDEFAULT);
	}
	
	public function __construct($name, $font = 'LiberationSerif'){
		parent::__construct();
		/*$this->addFont($font, '', $font.'.php');
		$this->addFont($font, 'B', $font.'b.php');
		$this->addFont($font, 'BI', $font.'bi.php');
		$this->addFont($font, 'I', $font.'i.php');*/
		$this->current_font = 'Arial';//$font;
		$this->setSourceFile($name);
		$this->headers();
    }
	
	public function addPage1(){
		$tempID = $this->importPage(1, '/MediaBox');
		$this->AddPage();
		$this->useTemplate($tempID);
		$this->setFontConf();
	}
	
	public function addPage2($name){
		$this->totalPages = $this->setSourceFile($name);
		$tempID = $this->importPage(1, '/MediaBox');
		$this->AddPage();
		$this->useTemplate($tempID);
		$this->setFontConf();
	}
	
	public function addLastPages($x, $y){
		for ($pageNo = 2; $pageNo <= $this->totalPages; $pageNo++) {
			$tempID = $this->importPage($pageNo, '/MediaBox');
			$this->AddPage();
			$this->useTemplate($tempID);
			$this->setFontConf();
		}
		$this->printDate($x, $y);
	}
	
	public function setText($x, $y, $text, $style = ''){
		$text = utf8_decode($text);
		$this->SetFont($this->current_font, $style);
		$this->SetXY($x, $y);
		$this->Write(1, $text);
		$this->setFont('');
	}
	
	public function setCell($x, $y, $w, $h=0, $text, $align='', $border=0, $style = '', $ln=0, $fill=false, $link=''){
		$text = utf8_decode($text);
		$this->setCell_noUtf8($x, $y, $w, $h, $text, $align, $border, $style, $ln, $fill, $link);
	}
	
	public function setMultiCell($x, $y, $w, $h, $txt, $align='J', $border=0, $style = '', $fill=false){
		$this->SetFont($this->current_font, $style);
		$text = utf8_decode($txt);
		$this->SetXY($x, $y);
		$this->MultiCell($w, $h, $text, $border, $align, $fill);
	}
	
	public function setCell_noUtf8($x, $y, $w, $h=0, $text, $align='', $border=0, $style = '', $ln=0, $fill=false, $link=''){
		$this->SetDrawColor(0,132,0);
		$this->SetFont($this->current_font, $style);
		$this->SetXY($x, $y);
		$this->Cell($w, $h, $text, $border, $ln, $align, $fill, $link);
	}
	
	public function printDate($x, $y){
		$this->SetFont($this->current_font, '', FONTDEFAULT-1);	
		$this->SetTextColor(90);
		$this->setXY($x + 38, $y);
		$this->Cell(31,5,$this->lugar,0,'','C');						// Lugar			
		$this->setXY($x + 72.7, $y);
		$this->Cell(9,5,date('d'),0,'','C');							// dia
		$this->setXY($x + 86.5, $y);
		$this->Cell(24,5,Tools::getMonth(date('n')),0,'','C');			// mes		
		$this->setXY($x + 115.6, $y);
		$this->Cell(9.4,5,date('Y'),0,'','C');							// año		
		$this->SetTextColor(FONTCOLORDEF);
		$this->SetFontSize(FONTDEFAULT);
	}
	
	public function printTotal($x,$y,$totalPrice=0,$totalEntry=false){
		$this->setFontSize(FONTEXTRA);
		$this->setXY($x, $y);
		$this->Cell(36, 5, $totalPrice, 0, '','R');
		$this->setFontSize(FONTDEFAULT);
        if($totalEntry){
            $this->setXY($x, $y+5);
            $this->Cell(36, 7, $totalEntry, 0, '','R');            
        }
	}
}
?>