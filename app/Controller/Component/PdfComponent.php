<?php

App::import('Vendor','xtcpdf'); 

class PdfComponent extends Component{
	
	var $name = 'Pdf';
	var $header = '';

	var $invoiceDimensions = array(
		'header' => array(
		
		),
		'margin' => array(
			'left' => 5,
			'top' => 5,
			'right' => 5,
			'bottom' => 3,
		),
		'addressBlock' => array(
			'company' => array(
				'width' => 90,
				'height' => 28,
				'x' => 115,
				'y' => 26,
			),
			'client' => array(
				'width' => 90,
				'height' => 28,
				'x' => 5,
				'y' => 26,
			),
		),
		'logo' => array(
			'width' => 28,
			'height' => 23,
			'x' => 175,
			'y' => 2,
		),
		'ordersTable' => array(
			'height' => 4,
			'ref' => 14,
			'qty' => 12,
			'licenses' => 20,
			'description' => 82,
			'unit_price' => 29,
			'total' => 27,
			'vat' => 13,
		),
		'summaryTable' => array(
			'spacer' => 129,
			'unit_price' => 29,
			'total' => 27,
			'vat' => 13,
		),
		'indexPageTableY' => 73,
		'newPageTableY' => 32
	);

	function setHeaderDetails($order, $type) {
		$userInitials =  substr(@$this->viewVars['currentUser']['User']['firstname'],0,1) . substr(@$this->viewVars['currentUser']['User']['lastname'],0,1);
		
		$this->header = 'AdyaAyurveda'."<br />";
		
		if($type == 'invoice'){
			$this->header .= __('Invoice');
		} else {
			$this->header .= __('Receipt');
		}

		$this->header .= ': '.$order['Order']['ref']."<br />";
		$this->header .= date('d-M-Y', strtotime($order['Order']['created']))."<br />";
	}

	function printLogo() {
		$this->PDF->Image(
			$this->url.'/img/logos/adyaayurveda_logo.jpg',
			$this->invoiceDimensions['logo']['x'],
			$this->invoiceDimensions['logo']['y'],
			$this->invoiceDimensions['logo']['width'],
			$this->invoiceDimensions['logo']['height']
		);
	}
	
	function printHeader() {
		$this->PDF->MultiCell(210, 30, $this->header, 0, 'L', 0, 1, 5, 5, true, 0, true);
		$this->printLogo();
	}

	function initPdf() {
		$this->PDF = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$this->PDF->SetCreator(PDF_CREATOR);
		$this->PDF->SetAuthor('AdyaAyurveda');
		$this->PDF->SetTitle(__('AdyaAyurveda Invoice'));
		$this->PDF->SetSubject(__('AdyaAyurveda Invoice'));
		$this->PDF->setPrintHeader(false);
		$this->PDF->setPrintFooter(false);
		$this->PDF->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$this->PDF->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->PDF->SetMargins(5, 5, 5);
		$this->PDF->SetFooterMargin(30);
		$this->PDF->SetAutoPageBreak(TRUE, 2);
		$this->PDF->setImageScale(PDF_IMAGE_SCALE_RATIO);
	}

	function generateInvoice($order, $type = 'invoice') {
		$this->initPdf();
		// debug($order);
		// die;

		$this->setHeaderDetails($order, $type);

		$this->PDF->Output(TMP.$order['Order']['id'].'.pdf', 'I');
	}
}