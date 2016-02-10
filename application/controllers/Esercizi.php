<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Esercizi extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Login check
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) redirect('login');
		$this->data['breadcrumb']['Home'] = site_url('home');
		$this->load->library('utils');
		
		// Load quickmenu data
		$this->load->model('model_condomini');
		$this->load->model('model_esercizi');
		$this->data['condomini'] = $this->model_condomini->get_condomini($_SESSION['id_azienda']);
		$this->data['esercizi'] = $this->model_esercizi->get_esercizi($_SESSION['id_condominio']);
		$this->data['selected_conominio'] = $_SESSION['id_condominio'];
		$this->data['selected_esercizio'] = $_SESSION['id_esercizio'];
	}
	
	public function index($idEsercizio = 0){
		if($idEsercizio == 0){
			if(isset($this->data['esercizi'][0])){
				$idEsercizio = $this->data['esercizi'][0]['id'];
			}else{
				$idEsercizio = -1;
			}
		}
		$this->data['id_esercizio'] = $idEsercizio;
		$this->data['dati_esercizio'] = $this->model_esercizi->get_esercizio($idEsercizio);
		
		$this->data['title'] = 'Esercizi';
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('view_esercizi');
		$this->load->view('parts/view_footer');
	}
	
	public function edit(){
		$esercizio = array(
			'data_inizio' => $this->utils->data_php_to_sql($this->input->post('data_inizio')),
			'data_fine' => $this->utils->data_php_to_sql($this->input->post('data_fine')),
			'descrizione' => $this->input->post('descrizione'),
			'saldo_iniziale' => $this->input->post('saldo_iniziale')
		);
		$id = $this->input->post('id_esercizio');
		$message = '';
		
		if($id == -1){
			$esercizio['id_tabella_straordinari'] = NULL;
			$esercizio['id_tabella_acquedotto'] = NULL;
			$id = $this->model_esercizi->insert_esercizio($esercizio, $_SESSION['id_condominio']);
			$_SESSION['id_esercizio'] = $id;
			
			$this->load->model('model_tabelle');
			$data = array(
				'nome' => 'Prorpietà',
				'descrizione' => 'Tabella generata automaticamente alla creazione dell\'esercizio',
				'id_esercizio' => $id
			);
			$idTabella = $this->model_tabelle->insert($data, 'tabelle');
			$this->model_tabelle->update_rows_dati($idTabella, $_SESSION['id_condominio']);
			
			$this->model_esercizi->update_esercizio($id, array('id_tabella_straordinari' => $idTabella, 'id_tabella_acquedotto' => $idTabella));
			
			$message = 'Esercizio aggiunto';
		}else{
		if($this->input->post('action') == 'delete'){
				$this->model_esercizi->update_esercizio($id, array('id_tabella_straordinari' => NULL, 'id_tabella_acquedotto' => NULL));
				$this->model_esercizi->delete_esercizio($id);
				$message = 'Esercizio eliminato';
				$id = -1;
			}else{
				$this->model_esercizi->update_esercizio($id, $esercizio);
				$message = 'Esercizio modificato';
			}
		}
		redirect('esercizi/index/'.$id.'?success_message='.$message);
	}
}
