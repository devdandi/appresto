<?php 

class Admin_model extends CI_Model {
	public $idpesanan;
	public $idmenu;

	public function __construct() {
		parent:: __construct();
	}

	public function addMenu($idmenu, $namamenu, $harga, $gambar, $desk) {
		$data = array('idmenu' => $idmenu, 
					  'namamenu' => $namamenu,
					  'harga' => $harga,
					  'gambar' => $gambar,
					  'desk' => $desk
			);
		$query = $this->db->insert('menu', $data);
		if (!$query) {
			echo "<script>alert('Data Gagal Ditambahkan')</script>";
		}
	}
	public function getMenu() {
		$query = $this->db->get('menu');
		return $query->result_array();
	}
	public function entryorder($idpelanggan, $namapelanggan, $jeniskelamin, $notelepon, $alamat) {
		$data1 = array('idpelanggan' => 'PLG-'.$idpelanggan,
					   'namapelanggan' => $namapelanggan,
					   'jeniskelamin' => $jeniskelamin,
					   'nohp' => $notelepon,
					   'alamat' => $alamat 
					);
		$test = $this->db->insert('pelanggan', $data1);
		if(!$test){
			echo "<script>alert('gagal')</script>";
		}
	}
	public function seeCart($pelanggan){
		$sql = $this->db->query("SELECT * FROM seecartv WHERE idpelanggan='$pelanggan'");
		return $sql->result_array();
	}
	public function proses($gels) {
		$sql = $this->db->query("SELECT * FROM pesanan WHERE idpesanan='$gels' ")->result_array();
		foreach($sql as $gel) :
			$idmenu = $gel['idmenu'];
			$sql2 = $this->db->query("SELECT * FROM menu WHERE idmenu='$idmenu'")->result_array();
			foreach($sql2 as $gel2) :
				return $hasil = $gel2['harga'] * $gel['jumlah'];
			endforeach;
		endforeach;
	}
	public function successT($idtransaksi, $idpesanan, $harga, $uang, $tanggal) {
		$data = array('idtransaksi' => $idtransaksi,
					  'idpesanan' => $idpesanan,
					  'total' => $harga,
					  'bayar' => $uang,
					  'tanggal' => $tanggal
					);
		$this->idpesanan = $idpesanan;
		$this->db->insert('transaksi', $data);
	}
	public function detail($idpesanan) {
		return $this->db->query("SELECT * FROM transaksi WHERE idpesanan='$idpesanan' ")->result_array();
	}
	public function cetak() {
		$sql = $this->db->query("SELECT pelanggan.idpelanggan, pelanggan.namapelanggan, pesanan.idpesanan, pesanan.idmenu, pesanan.jumlah, transaksi.idtransaksi, transaksi.total, transaksi.bayar, transaksi.tanggal FROM pelanggan JOIN pesanan ON pelanggan.idpelanggan = pesanan.idpelanggan JOIN transaksi ON pesanan.idpesanan=transaksi.idpesanan");
		return $sql->result_array();
	}
	public function dibayar($id){
		$this->db->query("UPDATE pesanan SET status_pesanan='Dibayar' WHERE idpelanggan='$id'");
	}
	public function register($id, $nama, $username, $password, $level){
		$sql = array(
			'iduser' => $id,
			'namauser' => $nama,
			'username' => $username, 
			'password' => $password,
			'level' => $level
		);
		$save = $this->db->insert("user", $sql);
		if($save){
			echo "<script>alert('Berhasil')</script>";
		}else{
			echo "<script>alert('Gagal')</script>";
		}
	}
	public function getPelanggan(){
		$sql = $this->db->get('pelanggan');
		return $sql->result_array();
	}
	public function cart($idpesanan, $idmenu, $idpelanggan, $jumlah, $iduser, $status_pesanan){
		$data1 = array(
			'idpesanan' => $idpesanan,
			'idmenu' => $idmenu,
			'idpelanggan' => $idpelanggan,
			'jumlah' => $jumlah,
			'iduser' => $iduser,
			'status_pesanan' => $status_pesanan
		);
		$sql = $this->db->insert('pesanan', $data1);
		if(!$sql){
			echo "<script>alert('Gagal')</script>";
		}
	}
	public function pesanan($idpelanggan) {
		return $this->db->query("SELECT * FROM pesanan WHERE idpelanggan='$idpelanggan' ")->result_array();
	}
	public function menus($idmenu){
		return $this->db->query("SELECT * FROM menu WHERE idmenu='$idmenu'")->result_array();
	}
	public function pelanggan($idpelanggan){
		return $this->db->query("SELECT * FROM pelanggan WHERE idpelanggan='$idpelanggan' ")->result_array();
	}
	// umethod untuk mengambil view
	public function carts_view($idpelanggan){
		return $this->db->query("SELECT * FROM carts_v WHERE idpelanggan='$idpelanggan' ")->result_array();
	}
	public function pay($idtransaksi, $idpesanan, $total, $bayar, $tanggal){
		$data1 = array(
			'idtransaksi' => $idtransaksi,
			'idpesanan' => $idpesanan,
			'total' => $total,
			'bayar' => $bayar,
			'tanggal' => $tanggal
		);
		$sql = $this->db->insert('transaksi', $data1);
		if(!$sql){
			echo "<script>alert('Gagal')/script>";
		}
	}
	public function vtransaksi($idpesanan){
		return $this->db->query("SELECT * FROM transaksi_v WHERE idpesanan='$idpesanan' ")->result_array();
	}
	public function grafik1(){
		return $this->db->query("SELECT * FROM v_grafik WHERE idmenu='3fwxj498k884'")->num_rows();
	}
	public function grafik2(){
		return $this->db->query("SELECT * FROM v_grafik WHERE idmenu='4gx8x84cq3uo'")->num_rows();
	}
	public function grafik3(){
		return $this->db->query("SELECT * FROM v_grafik WHERE idmenu='7tsxz7e22fo'")->num_rows();
	}
	public function grafik4(){
		return $this->db->query("SELECT * FROM v_grafik WHERE idmenu='b3ia6zqx988'")->num_rows();
	}
	public function datapelanggan(){
		return $this->db->query("SELECT pelanggan.idpelanggan, pelanggan.namapelanggan, menu.namamenu, pesanan.jumlah, transaksi.total, transaksi.bayar, transaksi.tanggal FROM pelanggan JOIN pesanan ON pelanggan.idpelanggan=pesanan.idpelanggan JOIN menu ON menu.idmenu=pesanan.idmenu JOIN transaksi ON pesanan.idpesanan=transaksi.idpesanan ")->result_array();
	}
	public function caripelanggan($nama){
		return $this->db->query("SELECT * FROM seecartv WHERE namapelanggan='$nama' ")->result_array();		
	}
}