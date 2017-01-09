<?php error_reporting(E_ALL ^ E_NOTICE);
define('DOWNLOAD', 'D');
define('SHOWBROWSER', 'I');
define('SAVETOURL', 'F');
define('TOSTRING', 'S');
require_once('fpdf.php');

class PDFGen extends FPDF {
	private $url;
	
	public function __construct() {
		parent::__construct();
		$this->AddPage();
		$this->SetFont('Arial', '', 16);
		$this->SetAuthor('epic telecom');
		$this->SetCreator('epic telecom');
		$this->SetTitle('Contrato producto');
		$this->SetSubject('Contrato pendiente de aprobación por nuestros técnicos', true);
		$this->AliasNbPages();
		$this->setUrlName('example.pdf');
	}
	
	public function getUrl() {
		return $this->url;
	}
	
	public function setUrlName($url) {
		$this->url = $url;
	}
	
	public function breakLine($h = 20){
		$this->Ln($h);
	}
	
	public function Header() {
		$this->Image('../../img/logo-epictelecom.jpg', 10, 8, 100);
		$this->breakLine();
	}
	
	//Pie de página
	public function Footer() {
		$this->SetY(-10);
		$this->SetFont('Arial','I',8);
		$this->Cell(0,10,'Page '.$this->PageNo()."/{nb}",0,0,'C');
	}
	
	public function Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '') {
		$txt = utf8_decode($txt);
		parent::Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
	}
}
$pdf = new PDFGen();
$pdf->breakLine();
$text = "!Holá¡ ¿como está?";
$pdf->Write(0, $text);

// generar la salida del pdf
$pdf->Output($pdf->getUrl(), SHOWBROWSER);
?>