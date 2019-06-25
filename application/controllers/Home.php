<?php 

class Home extends CI_Controller {
	public $idmenu;

	// method construct
	public function __construct() {
		parent:: __construct();
		$this->load->model('home_model');
		
	}
	// method untuk menampilkan halaman utama
	public function index() {
		$data['judul'] = "Home | PizzaID";
		$data['data_menu'] = $this->home_model->getData();
		$this->load->view('template/header', $data);
		$this->load->view('index', $data);
		$this->load->view('template/footer.php');
	}
	// method untuk menampilkan view login
	public function login_page() {
		$data['judul'] = "Login Pages";
		$this->load->view('template/header', $data);
		$this->load->view('login_page');
		$this->load->view('template/footer.php');

		// mengambil data dari form login
		if (isset($_POST['submit'])) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->home_model->login_action($username, $password);
		}
	}
	public function forbidden() {
		$data['judul'] = "Error";
		$this->load->view('forbidden', $data);
	}
}