<?php 

class ReportPdf extends CI_Controller{


	public function __construct() {
		// $this->load->model('admin_model');
		parent:: __construct();
		$this->load->library('pdf');
	}
	public function index() {

		$pdf = new FPDF('l', 'mm', 'A5');
		$pdf->AddPage();

		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(175, 5, 'LAPORAN PEMBELIAN DI PIZZA', 0,1,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(175,5,'CETAKAN LAPORAN BULANAN',0,1,'C');

		 $pdf->Cell(10,7,'',0,1);
		 
		 $pdf->SetFont('Arial','B',10);
		 $pdf->Cell(60,6,'Nama Pelanggan',1,0);
		 $pdf->Cell(33,6,'Nama Menu',1,0);
		 $pdf->Cell(30,6,'Total',1,0);
		 $pdf->Cell(30,6,'tanggal',1,1);
		 // $pdf->Cell(30,6,'Subtotal',1,1);
		 $pdf->SetFont('Arial','',10);
		 if (isset($_GET['submit'])) {
		 	$dari_tanggal = $_GET['dari_tanggal'];
		 	$sampai_tanggal = $_GET['sampai_tanggal'];
		 	$sql = $this->db->query("SELECT * FROM report WHERE tanggal BETWEEN '$dari_tanggal' AND '$sampai_tanggal'")->result_array();
		 	$subtotal = 0;
		 	foreach($sql as $dandi){
		 		$pdf->Cell(60,6,$dandi['namapelanggan'],1,0);
		 		$pdf->Cell(33,6,$dandi['namamenu'],1,0);
		 		$pdf->Cell(30,6,$dandi['total'],1,0);
		 		$pdf->Cell(30,6,$dandi['tanggal'],1,1);

		 		$pdf->Cell(30,6,'Subtotal',1,0);
		 		$pdf->Cell(30,6,$subtotal+=$dandi['total'],1,1);

		 	}
		 }
		 $pdf->Output('report.pdf', 'D');
	}

}