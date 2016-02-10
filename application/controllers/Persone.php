<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Persone extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Login check
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) redirect('login');
		$this->load->model('model_persone');
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
	
	public function index($idPersona = 0){
		$this->data['persone'] = $this->model_persone->get_persone($_SESSION['id_condominio']);
		if($idPersona == 0){
			if(isset($this->data['persone'][0])){
				$idPersona = $this->data['persone'][0]['id'];
			}else{
				$idPersona = -1;
			}
		}
		$this->data['dati_persona'] = $this->model_persone->get_persona($idPersona);
		$this->data['id_persona'] = $idPersona;
		
		$this->data['title'] = 'Anagrafica';
		$this->data['breadcrumb']['Unità'] = site_url('unita');
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('view_persone');
		$this->load->view('parts/view_footer');
	}
	
	public function edit(){
		$data = array(
			'id_condominio' => $_SESSION['id_condominio'],
			'nome' => $this->input->post('nome'),
			'cognome' => $this->input->post('cognome'),
			'codice_fiscale' => $this->input->post('codice_fiscale'),
			'indirizzo_residenza' => $this->input->post('indirizzo_residenza'),
			'indirizzo_domicilio' => $this->input->post('indirizzo_domicilio'),
			'cap_residenza' => $this->input->post('cap_residenza'),
			'cap_domicilio' => $this->input->post('cap_domicilio'),
			'citta_residenza' => $this->input->post('citta_residenza'),
			'citta_domicilio' => $this->input->post('citta_domicilio'),
			'provincia_residenza' => $this->input->post('provincia_residenza'),
			'provincia_domicilio' => $this->input->post('provincia_domicilio'),
			'nazione_residenza' => $this->input->post('nazione_residenza'),
			'nazione_domicilio' => $this->input->post('nazione_domicilio'),
			'data_nascita' => $this->utils->data_php_to_sql($this->input->post('data_nascita')),
			'metodo_invio' => $this->input->post('metodo_invio'),
			'metodo_pagamento' => $this->input->post('metodo_pagamento'),
			'email' => $this->input->post('email'),
			'telefono' => $this->input->post('telefono'),
			'cellulare' => $this->input->post('cellulare')
		);
		$id = $this->input->post('id_persona');
		$message = '';
		
		if($id == -1){
			$id = $this->model_persone->insert($data, 'persone');
			$message = 'Persona aggiunta';
		}else{
			if($this->input->post('action') == 'delete'){
				$this->model_persone->delete($id, 'persone');
				$message = 'Persona eliminata';
				$id = -1;
			}else{
				$this->model_persone->update($id, $data, 'persone');
				$message = 'Persona modificata';
			}
		}
		redirect('persone/index/'.$id.'?success_message='.$message);
	}
}
