<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Condomini extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Login check
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) redirect('login');
		$this->data['breadcrumb']['Home'] = site_url('home');
		
		// Load quickmenu data
		$this->load->model('model_condomini');
		$this->load->model('model_esercizi');
		$this->data['condomini'] = $this->model_condomini->get_condomini($_SESSION['id_azienda']);
		$this->data['esercizi'] = $this->model_esercizi->get_esercizi($_SESSION['id_condominio']);
		$this->data['selected_conominio'] = $_SESSION['id_condominio'];
		$this->data['selected_esercizio'] = $_SESSION['id_esercizio'];
	}
	
	public function index($idCondominio = 0){
		if($idCondominio == 0){
			if(isset($this->data['condomini'][0])){
				$idCondominio = $_SESSION['id_condominio'];
			}else{
				$idCondominio = -1;
			}
		}
		$this->data['id_condominio'] = $idCondominio;
		$this->data['dati_condominio'] = $this->model_condomini->get_condominio($idCondominio);
		$this->data['palazzine'] = $this->model_condomini->get_palazzine($idCondominio);
		$this->data['gruppi'] = $this->model_condomini->get_gruppi($idCondominio);
		
		$this->data['title'] = 'Condomini';
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('view_condomini');
		$this->load->view('parts/view_footer');
	}
	
	public function edit(){
		$data = array(
			'nome' => $this->input->post('nome'),
			'indirizzo' => $this->input->post('indirizzo'),
			'citta' => $this->input->post('citta'),
			'cap' => $this->input->post('cap'),
			'provincia' => $this->input->post('provincia'),
			'codice_fiscale' => $this->input->post('codice_fiscale'),
			'iban' => $this->input->post('iban'),
			'banca' => $this->input->post('banca'),
			'codice_cc' => $this->input->post('codice_cc'),
			'id_azienda' => $_SESSION['id_azienda']
		);
		$id = $this->input->post('id_condominio');
		$message = '';
		
		if($id == -1){
			$id = $this->model_condomini->insert($data, 'condomini');
			$_SESSION['id_condominio'] = $id;
			$message = 'Condominio aggiunto';
		}else{
			if($this->input->post('action') == 'delete'){
				$this->model_condomini->set_null_esercizi($id);
				$this->model_condomini->delete($id, 'condomini');
				$message = 'Condominio eliminato';
				$id = -1;
			}else{
				$this->model_condomini->update($id, $data, 'condomini');
				$message = 'Condominio modificato';
			}
		}
		redirect('condomini/index/'.$id.'?success_message='.$message);
	}
	
	public function edit_palazzina(){
		$data = array(
			'descrizione' => $this->input->post('descrizione'),
			'id_condominio' => $this->input->post('id_condominio')
		);
		$id = $this->input->post('id_palazzina');
		$idCondominio = $this->input->post('id_condominio');
		
		$message = '';
		
		if($id == -1){
			$id = $this->model_condomini->insert($data, 'palazzine');
			$message = 'Palazzina aggiunta';
		}else{
			if($this->input->post('action') == 'delete'){
				$this->model_condomini->delete($id, 'palazzine');
				$message = 'Palazzina eliminata';
				$id = -1;
			}else{
				$this->model_condomini->update($id, $data, 'palazzine');
				$message = 'Palazzina modificata';
			}
		}
		redirect('condomini/index/'.$idCondominio.'?success_message='.$message);
	}
	
	public function edit_gruppo(){
		$data = array(
			'descrizione' => $this->input->post('descrizione'),
			'id_palazzina' => $this->input->post('id_palazzina')
		);
		$id = $this->input->post('id_gruppo');
		$idCondominio = $this->input->post('id_condominio');
		$message = '';
		
		if($id == -1){
			$id = $this->model_condomini->insert($data, 'gruppi');
			$message = 'Gruppo aggiunto';
		}else{
			if($this->input->post('action') == 'delete'){
				$this->model_condomini->delete($id, 'gruppi');
				$message = 'Gruppo eliminato';
				$id = -1;
			}else{
				$this->model_condomini->update($id, $data, 'gruppi');
				$message = 'Gruppo modificato';
			}
		}
		redirect('condomini/index/'.$idCondominio.'?success_message='.$message);
	}
}
