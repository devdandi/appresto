<?php

class Admin extends CI_Controller {
	// deklarasi id pesananan
	public $pelanggan1;

	// method yang pertama kali dijalankan saat class diakses
	public function __construct() {
		parent:: __construct();
		$this->load->model('admin_model');
	}
	// method index
	public function index() {
		$data['judul'] = "HOME | Admin";
		$this->load->view('admin/index', $data);
	}
	// method untuk menambah menu makanan dan mengupload gambar
	public function entrybarang() {
		$data['judul'] = "Tambah Menu";
		$this->load->view('admin/entrybarang', $data);
		if (isset($_POST['submit'])) {
			$idmakanan = $this->input->post('idmakanan');
			$namamakanan = $this->input->post('namamakanan');
			$harga = $this->input->post('harga');
			$desk = $this->input->post('desk');
			$config['upload_path']          = 'img/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			$this->load->library('upload', $config);
			$gambar = $_FILES['gambar']['name'];
			$tmp = $_FILES['gambar']['tmp_name'];
			move_uploaded_file($tmp, "img/".$gambar);
			$this->admin_model->addMenu($idmakanan, $namamakanan, $harga, $gambar, $desk);

		}
	}
	// method logout
	public function logout() {
		$this->session->sess_destroy();
		redirect('home/login_page/?logout');
	}
	// method untuk menambahkan pelanggan dan pesanan
	public function entryorder() {
		$this->load->model('admin_model');
		// $data['idmenu'] = $this->admin_model->getMenu();
		$data['judul'] = "Entry Order";
		$this->load->view('admin/entryorder', $data);
		// mengambil data dari form
		if (isset($_POST['submit'])) {
			$idpelanggan = $this->input->post('idpelanggan');
			$namapelanggan = $this->input->post('namapelanggan');
			$jeniskelamin = $this->input->post('jeniskelamin');
			$notelepon = $this->input->post('notelepon');
			$alamat = $this->input->post('alamat');;
			$this->admin_model->entryorder($idpelanggan, $namapelanggan, $jeniskelamin, $notelepon, $alamat);
		}
	}
	// method untuk transaksi; yaitu untuk pemesanan makanan maupun minuman dan apakah barang dibeli atau tidak
	public function entrytransaksi() {
		$data['pesanan'] = $this->admin_model->getPelanggan();
		$data['judul'] = "Entry Transaksi";
		if(isset($_POST['submit'])){
			$pelanggan = $_POST['pelanggan'];
			$data['dandi'] = $this->admin_model->seeCart($pelanggan);
			$this->load->view('admin/entrytransaksi', $data);
			$this->admin_model->dibayar($pelanggan);
		}else if(isset($_POST['submit1'])){
			$nama = $_POST['nama'];
			$data['nama'] = $this->admin_model->caripelanggan($nama);
			$this->load->view('admin/entrytransaksi', $data);
		}else{
			$this->load->view('admin/entrytransaksi');
		}
	}
	// method untuk register, hanya bisa di akses oleh admin
	public function register(){
		$data['judul'] = "Register";
		$this->load->view('admin/register', $data);
		
		if(isset($_POST['submit'])) {
			$id = $_POST['id'];
			$nama = $_POST['nama'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$level = $_POST['level'];

			$this->load->admin_model->register($id, $nama, $username, $password, $level);
		}
	}
	// method untuk keranjang
	public function cart(){
		$data['judul'] = "Cart";
		$data['menu'] = $this->admin_model->getMenu();
		$data['pelanggan'] = $this->admin_model->getPelanggan();
		$this->load->view('admin/cart', $data);

		if(isset($_POST['submit'])){
			$idpesanan = $_POST['idpesanan'];
			$idmenu = $_POST['idmenu'];
			$idpelanggan = $_POST['idpelanggan'];
			$jumlah = $_POST['jumlah'];
			$iduser = $_POST['iduser'];
			$status_pesanan = $_POST['status_pesanan'];
			$this->pelanggan1 = $idpelanggan;
			$this->admin_model->cart($idpesanan, $idmenu, $idpelanggan, $jumlah, $iduser, $status_pesanan);
		}
	}
	// method untuk menghapus keranjang
	public function delete(){
		$id = $_GET['id'];
		$sql = $this->db->query("DELETE FROM pesanan WHERE idpesanan='$id' ");
		redirect('admin/entrytransaksi');
	}
	public function checkout(){
		$data['judul'] = "Checkout";
		$idpelanggan = $_GET['id'];
		$data['cart'] = $this->admin_model->carts_view($idpelanggan);
		$this->load->view('admin/checkout', $data);
		
	}
	public function pay(){
		if (isset($_POST['submit'])) {
			$idtransaksi = $_POST['idtransaksi'];
			$idpesanan = $_POST['idpesanan'];
			$total = $_POST['total'];
			$bayar = $_POST['bayar'];
			$tanggal = $_POST['tanggal'];
			$data['judul'] = "Payment";
			$this->admin_model->pay($idtransaksi, $idpesanan, $total, $bayar, $tanggal);
			$data['vtransaksi'] = $this->admin_model->vtransaksi($idpesanan);
			$this->load->view('admin/pay', $data);
		}	
	}
	public function cetak(){
		$data['judul'] = "Cetak Laporan";
		$this->load->view('admin/cetak', $data);
	}
	public function grafik(){
		$data['judul'] = "Grafik";
		$data['grafik1'] = $this->admin_model->grafik1();
		$data['grafik2'] = $this->admin_model->grafik2();
		$data['grafik3'] = $this->admin_model->grafik3();
		$data['grafik4'] = $this->admin_model->grafik4();
		$this->load->view('admin/grafik', $data);
	}
	public function datamenu(){
		$data['judul'] = "Data Makanan";
		$data['makanan'] = $this->admin_model->getMenu();
		$this->load->view('admin/datamenu', $data);
	}
	public function deletemenu(){
		$id = $_GET['id'];
		$this->db->query("DELETE FROM menu WHERE idmenu = '$id'");
		redirect('admin/datamenu');
	}
	public function datapelanggan(){
		$data['judul'] = "Data Pelanggan";
		$data['datapelanggan'] = $this->admin_model->datapelanggan();
		$this->load->view('admin/datapelanggan', $data);
	}
}