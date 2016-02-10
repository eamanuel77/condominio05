<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Altro extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Login check
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) redirect('login');
		$this->load->model('model_altro');
		$this->data['breadcrumb']['Home'] = site_url('home');
		
		// Load quickmenu data
		$this->load->model('model_condomini');
		$this->load->model('model_esercizi');
		$this->data['condomini'] = $this->model_condomini->get_condomini($_SESSION['id_azienda']);
		$this->data['esercizi'] = $this->model_esercizi->get_esercizi($_SESSION['id_condominio']);
		$this->data['selected_conominio'] = $_SESSION['id_condominio'];
		$this->data['selected_esercizio'] = $_SESSION['id_esercizio'];
	}
	
	public function index(){
		$this->data['title'] = 'Altro';
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('view_altro');
		$this->load->view('parts/view_footer');
	}
	
	public function azienda(){
		$this->data['dati_azienda'] = $this->model_altro->get_azienda($_SESSION['id_azienda']);
		$this->data['id_azienda'] = $_SESSION['id_azienda'];
		
		$this->data['title'] = 'Azienda';
		$this->data['breadcrumb']['Altro'] = site_url('altro');
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('altro/view_azienda');
		$this->load->view('parts/view_footer');
	}
	
	public function edit_azienda(){
		$data = array(
			'nome' => $this->input->post('nome'),
			'indirizzo' => $this->input->post('indirizzo'),
			'citta' => $this->input->post('citta'),
			'cap' => $this->input->post('cap'),
			'provincia' => $this->input->post('provincia'),
			'piva' => $this->input->post('piva'),
			'codice_fiscale' => $this->input->post('codice_fiscale'),
			'telefono' => $this->input->post('telefono'),
			'cellulare' => $this->input->post('cellulare'),
			'fax' => $this->input->post('fax'),
			'email' => $this->input->post('email'),
			'pec' => $this->input->post('pec'),
			'website' => $this->input->post('website'),
			'descrizione' => $this->input->post('descrizione')
		);
		$id = $this->input->post('id_azienda');
		$message = '';
		
		$this->model_altro->update($id, $data, 'aziende');
		$message = 'Azienda modificata';
		
		redirect('altro/azienda/'.$id.'?success_message='.$message);
	}
	
	public function utenti(){
		$this->data['title'] = 'Utenti';
		$this->data['breadcrumb']['Altro'] = site_url('altro');
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('altro/view_utenti');
		$this->load->view('parts/view_footer');
	}
	
	public function backup(){
		// Load the DB utility class
		$this->load->dbutil();
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup();
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('studio_condominale_backup.zip', $backup);
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('studio_condominale_backup.zip', $backup);
	}
}
