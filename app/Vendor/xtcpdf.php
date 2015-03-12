<?php
App::import('Vendor', 'tcpdf/tcpdf');
class XTCPDF extends TCPDF {
	var	$xheadertext		= '';
	var	$xheadercolor		= array(0, 0, 200);
	var $xfootertext		= 'Copyright &copy; %d SSL247 Ltd. All rights reserved.';
	var $xfooterfont		= PDF_FONT_NAME_MAIN;
	var $xfooterfontsize	= 8;
	
	var $footerContent = '';
	var $headerContent = '';
	
	// function __construct() {
		// $this->setPageFormat(array(210, 297));
	// }
	
	
	/**
	 *	Overwrites the default header
	 *	set the text in the view using
	 *		$tcpdf->xheadertext		= 'YOUR ORGANIZATION';
	 *	set the fill color in the view using
	 *		$tcpdf->xheadercolor	= array(0, 0, 100); (r, g, b)
	 *	set the font in the view using
	 *		$tcpdf->setHeaderFont(array('YourFont', '', fontsize));
	 */
	function Header() {
		if (!empty($this->headerContent)) {
			// Position at 25 mm from bottom
			$this->SetY(0);
			$html = $this->headerContent;
			$this->writeHTML($html, true, false, true, false, '');
		} else {
			list($r, $g, $b) = $this->xheadercolor;
			$this->SetY(10); // shouldn't be needed due to page margin, but helas, otherwise it's at the page top
			$this->SetFillColor($r, $g, $b);
			$this->SetTextColor(0, 0, 0);
			$this->Cell(0, 20, '', 0, 1, 'C', 1);
			$this->Text(15, 26, $this->xheadertext);
		}
	}
	
	/**
	 *	Overwrites the default footer
	 *	set the text in the view using
	 *		$tcpdf->xfootertext		= 'Copyright © %d YOUR ORGANIZATION. All rights reserved.';
	 */
	public function Footer() {
		if (!empty($this->footerContent)) {
			// Position at 30 mm from bottom
			$this->SetY(-25);
			$html = $this->footerContent;
			$this->writeHTML($html, true, false, true, false, '');
			// Position at 20 mm from bottom
			// $this->SetY(-10);
		} else {
			$year		= date('Y');
			$footertext	= sprintf($this->xfootertext, $year);
			$this->SetY(-20);
			$this->SetTextColor(0, 0, 0);
			$this->SetFont($this->xfooterfont, '', $this->xfooterfontsize);
			$this->Cell(0, 8, $footertext, 'T', 1, 'C');
		}
	}
}
?>