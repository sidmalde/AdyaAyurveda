<?php

App::import('Vendor','xtcpdf'); 

class PdfComponent extends Component{
	
	var $name = 'Pdf';
	var $url = '';
	var $header = '';
	var $currentHeight = 5;
	var $totalHeight = 0;
	var $pageBreak = 180;
	var $vatRate = '20%';

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
				'width' => 100,
				'height' => 28,
				'x' => 105,
				'y' => 44,
			),
			'client' => array(
				'width' => 90,
				'height' => 28,
				'x' => 5,
				'y' => 44,
			),
		),
		'logo' => array(
			'width' => 60,
			'height' => 39,
			'x' => 145,
			'y' => 2,
		),
		'ordersTable' => array(
			'height' => 8,
			'ref' => 14,
			'qty' => 12,
			'description' => 130,
			'unit_price' => 29,
			'total' => 27,
			'vat' => 13,
		),
		'summaryTable' => array(
			'spacer' => 128,
			'unit_price' => 29,
			'vat' => 13,
			'total' => 27,
		),
		'indexPageTableY' => 95,
		'newPageTableY' => 32
	);

	var $invoiceFonts = array(
		'default' => array(
			'fontface' => 'helvetica',
			'size' => 14
		),
		'small' => array(
			'fontface' => 'helvetica',
			'size' => 11
		),
		'xsmall' => array(
			'fontface' => 'helvetica',
			'size' => 7
		),
	);

	function __construct(){
		// if(empty($_SERVER['SERVER_NAME'])){
		// 	$_SERVER['SERVER_NAME'] = 'www.ssl247.co.uk';
		// }
		// if(empty($_SERVER['HTTP_HOST'])){
		// 	$this->url = 'https://'.$_SERVER['SERVER_NAME'];
		// 	$this->paymentURLPrefix = 'www';
		// } elseif(strstr($_SERVER['HTTP_HOST'],'.',true) === 'www'){
		// 	$this->url = 'https://'.$_SERVER['SERVER_NAME'];
		// 	$this->paymentURLPrefix = 'www';
		// } elseif(strstr($_SERVER['HTTP_HOST'],'.',true) === 'staging'){
		// 	$this->url = 'https://'.$_SERVER['SERVER_NAME'];
		// 	$this->extraUrl = 'testing/';
		// 	$this->paymentURLPrefix = 'staging';
		// } else {
		// 	$this->extraUrl = 'testing/';
		// 	$this->paymentURLPrefix = 'staging';
		// }
			$this->url = 'http://'.$_SERVER['SERVER_NAME'];
	}

	function setFont($fontStyle = 'default', $fontWeight = '') {
		$this->PDF->SetFont($this->invoiceFonts[$fontStyle]['fontface'], $fontWeight, $this->invoiceFonts[$fontStyle]['size']);
	}

	function setHeaderDetails($invoice, $type) {
		$this->header = 'AdyaAyurveda'."<br />";
		
		if($type == 'invoice'){
			$this->header .= __('Invoice');
		} else {
			$this->header .= __('Receipt');
		}

		$this->header .= ': '.$invoice['Invoice']['ref']."<br />";
		$this->header .= date('d-M-Y', strtotime($invoice['Invoice']['created']))."<br />";
	}

	function setCurrentHeight($orderLabel) {
		if(strlen($orderLabel) >= 50){
			if(strlen($orderLabel) >= 90){
				$this->currentHeight = 14;
			} else {
				$this->currentHeight = 11;
			}
		} else {
			$this->currentHeight = 8;
		}
	}

	function nextPage($height, $pageBreak, $invoice = null, $printTableHeader = true){
		if($height >= $this->pageBreak){
			$this->setFont('small');
			$this->PDF->MultiCell(50, 10, __('Continued on next page'), 0, 'L', 0, 0, '', '', true,0,true,true,0,'B');
			$this->pageCount++;
			
			if (in_array($invoice['Invoice']['status'], array(18,22)) && $invoice['Invoice']['website_id'] == '4e57b5e3-a204-476d-b8e2-14f40988fb3a') {
				$this->PDF->MultiCell('', '','<a href="https://www.ssl247.fr/cgv">En acceptant ce devis, je déclare accepter et avoir pris connaissance des Conditions Générales de Vente</a>', 0, 'C', 0, 1, '', '257', true,'',true);
			}
			
			$this->printFooter(true);
			
			$this->PDF->AddPage();
			
			$this->totalHeight = 0;
			$this->setFont('default');
			
			$this->printHeader();
			
			if ($printTableHeader) {
				$this->printTableHeadings(true);
			}
		}
	}

	function printTableHeadings($isNewPage = false) {
		if ($isNewPage) {
			$startHeight = $this->invoiceDimensions['newPageTableY'];
		} else {
			$startHeight = $this->invoiceDimensions['indexPageTableY'];
		}
		$this->setFont('default', 'B');
		
		$this->PDF->MultiCell($this->invoiceDimensions['ordersTable']['ref'], $this->invoiceDimensions['ordersTable']['height'], __('Ref'), 1, 'C', 0, 0, 6, $startHeight, true);
		$this->PDF->MultiCell($this->invoiceDimensions['ordersTable']['qty'], $this->invoiceDimensions['ordersTable']['height'], __('Qty'), 1, 'C', 0, 0, '', '', true);
		$this->PDF->MultiCell($this->invoiceDimensions['ordersTable']['description'], $this->invoiceDimensions['ordersTable']['height'], __('Description'), 1, 'C', 0, 0, '', '', true);
		$this->PDF->MultiCell($this->invoiceDimensions['ordersTable']['total'], $this->invoiceDimensions['ordersTable']['height'], __('Total'), 1, 'C', 0, 0, '', '', true);
		$this->PDF->MultiCell($this->invoiceDimensions['ordersTable']['vat'], $this->invoiceDimensions['ordersTable']['height'], __('VAT'), 1, 'C', 0, 1, '', '', true);
		
		$this->setFont('small');
	}

	function printOrders($invoice) {
		$this->totalHeight = 0;
		// debug($invoice['Order']);
		foreach ($invoice['Order']['OrderItem'] as $orderItem) {
			$this->addRow($invoice, $orderItem, $this->pageBreak);
			$this->nextPage($this->totalHeight, $this->pageBreak, $invoice);
		}
	}

	function addRow($invoice, $order, $pageBreak){
		$orderLabel = __('%s %s %s', $order['Product']['name'], $order['Product']['quantity'], $order['Product']['measurement']);
		
		$this->setCurrentHeight($order['label']);
		
		$this->totalHeight += $this->currentHeight;
		
		$this->nextPage($this->totalHeight, $this->pageBreak, $invoice);
		
		$this->PDF->MultiCell($this->invoiceDimensions['ordersTable']['ref'], $this->currentHeight, $invoice['Order']['ref'], 1, 'R', 0, 0, 6, '',true);
		$this->PDF->MultiCell($this->invoiceDimensions['ordersTable']['qty'], $this->currentHeight, 1, 1, 'R', 0, 0, '', '',true);
		$this->PDF->MultiCell($this->invoiceDimensions['ordersTable']['description'], $this->currentHeight, $orderLabel, 1, 'L', 0, 0, '', '', true,'',true);
		$this->PDF->MultiCell($this->invoiceDimensions['ordersTable']['total'], $this->currentHeight, $this->Invoice->currency($order['sub_total'], 'GBP'), 1, 'R', 0, 0, '', '', true,'',true);
		$this->PDF->MultiCell($this->invoiceDimensions['ordersTable']['vat'], $this->currentHeight, $this->vatRate, 1, 'C', 0, 1, '', '', true);
	}

	function printTableSummary($invoice) {
		$currency = 'GBP';
		$dataSummary = array(
			__('Subtotal') => $invoice['Invoice']['subtotal'],
			__('VAT') => $invoice['Invoice']['vat'],
			__('Total') => $invoice['Invoice']['total'],
		);
		
		foreach ($dataSummary as $index => $value) {
			$this->PDF->MultiCell($this->invoiceDimensions['summaryTable']['spacer'], 8, '', 0, '', 0, 0);
			$this->setFont('default', 'B');
			$this->PDF->MultiCell($this->invoiceDimensions['summaryTable']['unit_price'], 8, $index, 1, 'R', 0, 0, '', '', true);
			$this->setFont('small');
			if (!empty($this->invoiceCurrency) && ($this->invoiceCurrency == 'EUR' || $this->invoiceCurrency == 'GBP')) {
				$this->PDF->MultiCell($this->invoiceDimensions['summaryTable']['total'], 8, $this->Invoice->currency($value, $currency), 1, 'R', 0, 0, '', '', true,'',true);
				$this->PDF->MultiCell($this->invoiceDimensions['summaryTable']['vat'], 8, '', 0, '', 0, 1);
			} else {
				$this->PDF->MultiCell($this->invoiceDimensions['summaryTable']['total'], 8, $this->Invoice->currency($value, $currency), 1, 'R', 0, 1, '', '', true,'',true);
			}
			$this->totalHeight += $this->currentHeight;
		}
	}

	function getAddress($invoice, $type = 'company') {
		$returnAddress = '';
		if ($type == 'company') {
			$returnAddress .= 'AdyaAyurveda' . "<br />";
			$returnAddress .= '1 drop lane' . "<br />";
			// $returnAddress .= '' . "<br />";
			$returnAddress .= 'Drop City' . "<br />";
			$returnAddress .= 'United Kingdom' . "<br />";
			$returnAddress .= __('Tel: %s', '000 0000 0000') . "<br />";
			$returnAddress .= __('Web: %s', 'www.adya-ayurveda.com') . "<br />";
			$returnAddress .= __('Email: %s', 'info@adya-ayurveda.com') . "<br />";
		} else {
			$returnAddress .= $invoice['User']['title'] . ' ' . $invoice['User']['firstname'] . ' ' . $invoice['User']['lastname'] . "<br />";
			$returnAddress .= $invoice['Invoice']['address_1']."<br />";
			if($invoice['Invoice']['address_2']){
				$returnAddress .= $invoice['Invoice']['address_2']."<br />";
			}
			if($invoice['Invoice']['address_3']){
				$returnAddress .= $invoice['Invoice']['address_3']."<br />";
			}
			if($invoice['Invoice']['city']){
				$returnAddress .= $invoice['Invoice']['city']."<br />";
			} else {
				//If city doesn't exist we must still ensure postcode is shown here
				if((!in_array($invoice['Invoice']['country'],array('GB','US','CA'))) && ($invoice['Invoice']['postcode'])){
					$returnAddress .= $invoice['Invoice']['postcode']."<br />";
				}
			}
			if($invoice['Invoice']['region']){
				$returnAddress .= $invoice['Invoice']['region']."<br />";
			}
			if(!empty($invoice['Invoice']['postcode'])){
				$returnAddress .= $invoice['Invoice']['country'].' '.$invoice['Invoice']['postcode']."<br />";
			}
		}
		return $returnAddress;
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

		$this->PDF->AddPage();
		$this->setFont('default');
		
	}

	function generateInvoice($invoice, $type = 'invoice') {
		App::import('Model', 'Invoice');
		$this->Invoice = new Invoice();

		$this->initPdf();
		// debug($invoice);
		// die;

		// Set Hedaer Details
		$this->setHeaderDetails($invoice, $type);
		$this->printHeader();

		$addressDimensions = $this->invoiceDimensions['addressBlock']['company'];
		$this->PDF->MultiCell($addressDimensions['width'], $addressDimensions['height'], $this->getAddress($invoice, 'company'), 0, 'R', 0, 1, $addressDimensions['x'], $addressDimensions['y'], true, '', true, '', 32, '', true);
		$addressDimensions = $this->invoiceDimensions['addressBlock']['client'];
		$this->PDF->MultiCell($addressDimensions['width'], $addressDimensions['height'], $this->getAddress($invoice, 'client'), 0, 'L', 0, 1, $addressDimensions['x'], $addressDimensions['y'], true,'',true);
		
		$this->printTableHeadings();
		$this->printOrders($invoice);
		$this->printTableSummary($invoice);

		$this->PDF->Output(TMP.$invoice['Invoice']['id'].'.pdf', 'I');
	}
}