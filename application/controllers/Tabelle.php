<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Tabelle extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Login check
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) redirect('login');
		$this->load->model('model_tabelle');
		$this->data['breadcrumb']['Home'] = site_url('home');
		
		// Load quickmenu data
		$this->load->model('model_condomini');
		$this->load->model('model_esercizi');
		$this->data['condomini'] = $this->model_condomini->get_condomini($_SESSION['id_azienda']);
		$this->data['esercizi'] = $this->model_esercizi->get_esercizi($_SESSION['id_condominio']);
		$this->data['selected_conominio'] = $_SESSION['id_condominio'];
		$this->data['selected_esercizio'] = $_SESSION['id_esercizio'];
	}
	
	public function index($idTabella = 0){
		$this->data['tabelle'] = $this->model_tabelle->get_tabelle($_SESSION['id_esercizio']);
		if($idTabella == 0){
			if(isset($this->data['tabelle'][0])){
				$idTabella = $this->data['tabelle'][0]['id'];
			}else{
				$idTabella = -1;
			}
		}
		$this->data['id_tabella'] = $idTabella;
		$this->data['dati_tabella'] = $this->model_tabelle->get_tabella($idTabella);
		$this->data['dati_contenuto_tabella'] = $this->model_tabelle->get_dati_tabella($idTabella);
		
		$this->data['title'] = 'Tabelle';
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('view_tabelle');
		$this->load->view('parts/view_footer');
	}
	
	public function edit(){
		$data = array(
			'nome' => $this->input->post('nome'),
			'descrizione' => $this->input->post('descrizione'),
			'id_esercizio' => $_SESSION['id_esercizio']
		);
		$id = $this->input->post('id_tabella');
		$message = '';
		
		if($id == -1){
			$id = $this->model_tabelle->insert($data, 'tabelle');
			$this->model_tabelle->update_rows_dati($id, $_SESSION['id_condominio']);
			$message = 'Tabella aggiunta';
		}else{
			if($this->input->post('action') == 'delete'){
				$this->model_tabelle->delete($id, 'tabelle');
				$message = 'Tabella eliminata';
				$id = -1;
			}else{
				$this->model_tabelle->update($id, $data, 'tabelle');
				$message = 'Tabella modificata';
			}
		}
		redirect('tabelle/index/'.$id.'?success_message='.$message);
	}
	
	public function edit_straordinari($idTabella){
		$this->model_tabelle->update($_SESSION['id_esercizio'], array('id_tabella_straordinari' => $idTabella), 'esercizi');
		$message = 'Tabella predefinita modificata';
		redirect('tabelle/index/'.$idTabella.'?success_message='.$message);
	}
	
	public function edit_acquedotto($idTabella){
		$this->model_tabelle->update($_SESSION['id_esercizio'], array('id_tabella_acquedotto' => $idTabella), 'esercizi');
		$message = 'Tabella predefinita modificata';
		redirect('tabelle/index/'.$idTabella.'?success_message='.$message);
	}
	
	public function edit_dati(){
		$idTabella = $this->input->post('id_tabella');
		$message = '';
		
		if($this->input->post('action') == 'save'){
			$countDatiTabella = $this->input->post('count_dati_tabella');
			for($i=0; $i<$countDatiTabella; $i++){
				$data = array('quota' => $this->input->post('quota_'.$i));
				$id = $this->input->post('id_dato_tabella_'.$i);
				$this->model_tabelle->update($id, $data, 'dati_tabella');
			}
			$message = 'Dati salvati';
		}else{
			$this->model_tabelle->update_rows_dati($idTabella, $_SESSION['id_condominio']);
			$message = 'Dati aggiornati';
		}
		redirect('tabelle/index/'.$idTabella.'?success_message='.$message);
	}
}
