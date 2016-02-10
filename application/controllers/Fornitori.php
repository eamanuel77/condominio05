<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Fornitori extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Login check
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) redirect('login');
		$this->load->model('model_fornitori');
		$this->load->library('utils');
		$this->data['breadcrumb']['Home'] = site_url('home');
		
		// Load quickmenu data
		$this->load->model('model_condomini');
		$this->load->model('model_esercizi');
		$this->data['condomini'] = $this->model_condomini->get_condomini($_SESSION['id_azienda']);
		$this->data['esercizi'] = $this->model_esercizi->get_esercizi($_SESSION['id_condominio']);
		$this->data['selected_conominio'] = $_SESSION['id_condominio'];
		$this->data['selected_esercizio'] = $_SESSION['id_esercizio'];
	}
	
	public function index($idFornitore = 0){
		$this->data['fornitori'] = $this->model_fornitori->get_fornitori($_SESSION['id_azienda']);
		if($idFornitore == 0){
			if(isset($this->data['fornitori'][0])){
				$idFornitore = $this->data['fornitori'][0]['id'];
			}else{
				$idFornitore = -1;
			}
		}
		$this->data['dati_fornitore'] = $this->model_fornitori->get_fornitore($idFornitore);
		$this->data['id_fornitore'] = $idFornitore;
		
		$this->data['title'] = 'Fornitori';
		$this->data['breadcrumb']['Conti'] = site_url('conti');
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('view_fornitori');
		$this->load->view('parts/view_footer');
	}
	
	public function edit(){
		$data = array(
			'ragione_sociale' => $this->input->post('ragione_sociale'),
			'tipo' => $this->input->post('tipo'),
			'indirizzo' => $this->input->post('indirizzo'),
			'cap' => $this->input->post('cap'),
			'citta' => $this->input->post('citta'),
			'provincia' => $this->input->post('provincia'),
			'nazione' => $this->input->post('nazione'),
			'codice_fiscale' => $this->input->post('codice_fiscale'),
			'piva' => $this->input->post('piva'),
			'email' => $this->input->post('email'),
			'telefono' => $this->input->post('telefono'),
			'cellulare' => $this->input->post('cellulare'),
			'metodo_pagamento' => $this->input->post('metodo_pagamento'),
			'banca' => $this->input->post('banca'),
			'ritenuta_acconto' => $this->input->post('ritenuta_acconto'),
			'nome_titolare' => $this->input->post('nome_titolare'),
			'cognome_titolare' => $this->input->post('cognome_titolare'),
			'data_nascita_titolare' => $this->utils->data_php_to_sql($this->input->post('data_nascita_titolare')),
			'note_titolare' => $this->input->post('note_titolare'),
			'note' => $this->input->post('note'),
			'id_azienda' => $_SESSION['id_azienda']
		);
		$id = $this->input->post('id_fornitore');
		$message = '';
		
		if($id == -1){
			$id = $this->model_fornitori->insert($data, 'fornitori');
			$message = 'Fornitore aggiunto';
		}else{
			if($this->input->post('action') == 'delete'){
				$this->model_fornitori->delete($id, 'fornitori');
				$message = 'Fornitore eliminato';
				$id = -1;
			}else{
				$this->model_fornitori->update($id, $data, 'fornitori');
				$message = 'Fornitore modificato';
			}
		}
		redirect('fornitori/index/'.$id.'?success_message='.$message);
	}
}
