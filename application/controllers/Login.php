<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_login');
	}
	
	public function index(){
		$_SESSION['username'] = '';
		$_SESSION['connected'] = false;
		$_SESSION['id_utente'] = 0;
		$_SESSION['id_azienda'] = 0;
		$_SESSION['id_condominio'] = 0;
		$_SESSION['id_esercizio'] = 0;
		
		$this->load->view('view_login');
	}
	
	public function edit(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// TODO add password encryption
		$this->load->library('encryption');
		$idUtente = $this->model_login->test_login($username, $password);
		if($idUtente > 0){
			// login success
			$_SESSION['connected'] = true;
			$_SESSION['id_utente'] = $idUtente;
			$user_data = $this->model_login->get_utente($idUtente);
			$_SESSION['username'] = $user_data['username'];
			$_SESSION['id_azienda'] = $user_data['id_azienda'];
			$_SESSION['id_condominio'] = $user_data['id_condominio'];
			$_SESSION['id_esercizio'] = $user_data['id_esercizio'];
			redirect('home');
		}else{
			// login fail
			redirect('login');
		}
	}
}
