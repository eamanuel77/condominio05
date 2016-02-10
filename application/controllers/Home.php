<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Login check
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) redirect('login');
		$this->data['breadcrumb']['Home'] = site_url('home');
		$this->load->model('model_home');
		// TODO inserire la conferma su tutti i tasti di cancellazione
		// TODO modificare tutti gli input aggiungendo il limite sui caratteri e i tipo numeric con limite
		// TODO inserire e gestire i vincoli di integrità referenziale
		
		// Load quickmenu data
		$this->load->model('model_condomini');
		$this->load->model('model_esercizi');
		$this->data['condomini'] = $this->model_condomini->get_condomini($_SESSION['id_azienda']);
		$this->data['esercizi'] = $this->model_esercizi->get_esercizi($_SESSION['id_condominio']);
		$this->data['selected_conominio'] = $_SESSION['id_condominio'];
		$this->data['selected_esercizio'] = $_SESSION['id_esercizio'];
	}
	
	public function index(){
		$this->data['non_pagate'] = $this->model_home->get_non_pagate();
		$this->data['scadenza_rate'] = $this->model_home->get_scadenze_rate();
		
		$this->data['title'] = 'Home';
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('view_home');
		$this->load->view('parts/view_footer');
	}
	
	public function edit($idCondominio, $idEsercizio){
		if($idCondominio != $_SESSION['id_condominio']){
			// condominio changed
			$_SESSION['id_condominio'] = $idCondominio;
			$esercizi = $this->model_esercizi->get_esercizi($_SESSION['id_condominio']);
			$_SESSION['id_esercizio'] = $esercizi[0]['id'];
		}else{
			// esercizio changed
			$_SESSION['id_esercizio'] = $idEsercizio;
		}
		
		redirect('home');
	}
}
