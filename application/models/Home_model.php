<?php 
class Home_model extends CI_Model {

	public function __construct() {
		parent:: __construct();
	}
	// mengambil data makanan untuk ditampikan di index home
	public function getData() {
		$query = $this->db->query('SELECT * FROM menu');
		return $query->result_array();
	}

	// validasi login dari controller
	public function login_action($username, $password) {
		$query = $this->db->query("SELECT * FROM user WHERE username='$username' AND password='$password' ");
		$cek = $query->num_rows();

		// pengecekan level
		if ($cek > 0) {
			$lev = $query->result_array();
			foreach($lev as $nows) :
				if ($nows['level'] == "pemilik") {
				 	$data = array('username' => $username,
				 				  'level' => 'pemilik',
				 				  'nama' => $nows['namauser']
				 				);
				 	$this->session->set_userdata($data);
				 	redirect('admin/index/?pemilik');
				 }elseif ($nows['level'] == "kasir") {
				 	$data = array('username' => $username,
				 				  'level' => 'kasir',
				 				  'nama' => $nows['namauser'] 
				 				);
				 	$this->session->set_userdata($data);
				 	redirect('admin/index/?kasir');
				 }elseif ($nows['level'] == "admin") {
				 	$data = array('username' => $username,
				 				  'level' => 'admin' ,
				 				  'nama' => $nows['namauser']
				 				);
				 	$this->session->set_userdata($data);
				 	redirect('admin/index/?admin');
				 }elseif ($nows['level'] == "pelayan") {
				 	$data = array('username' => $username,
				 				  'level' => 'pelayan',
				 				  'nama' => $nows['namauser'] 
				 				);
				 	$this->session->set_userdata($data);
				 	redirect('admin/index/?pelayan');
				 }else{
				 	redirect('home/login_page/?message=login_failed');
				 }
			endforeach;
		}
		
	}
	
}