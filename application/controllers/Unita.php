<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Unita extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Login check
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) redirect('login');
		$this->load->model('model_unita');
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
	
	public function index($idUnita = 0){
		$this->data['unita'] = $this->model_unita->get_unita($_SESSION['id_condominio']);
		$this->data['gruppi'] = $this->model_unita->get_gruppi($_SESSION['id_condominio']);
		if($idUnita == 0){
			if(isset($this->data['unita'][0])){
				$idUnita = $this->data['unita'][0]['id'];
			}else{
				$idUnita = -1;
			}
		}
		$this->data['dati_unita'] = $this->model_unita->get_unita_singola($_SESSION['id_condominio'], $idUnita);
		$this->data['proprietari'] = $this->model_unita->get_relazione($idUnita, 'PROPRIETARIO');
		$this->data['conduttori'] = $this->model_unita->get_relazione($idUnita, 'CONDUTTORE');
		$this->data['usufruttuari'] = $this->model_unita->get_relazione($idUnita, 'USUFRUTTUARIO');
		$this->data['persone'] = $this->model_unita->get_persone($_SESSION['id_condominio']);
		$this->data['id_unita'] = $idUnita;
		
		$this->data['title'] = 'Unit&agrave;';
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('view_unita');
		$this->load->view('parts/view_footer');
	}
	
	public function edit(){
		$data = array(
			'tipo' => $this->input->post('tipo'),
			'id_gruppo' => $this->input->post('id_gruppo'),
			'interno' => $this->input->post('interno'),
			'subalterno' => $this->input->post('subalterno'),
			'piano' => $this->input->post('piano'),
			'note' => $this->input->post('note'),
			'foglio' => $this->input->post('foglio'),
			'particella' => $this->input->post('particella'),
			'categoria' => $this->input->post('categoria'),
			'rendita' => $this->input->post('rendita'),
			'frequenza_rate' => $this->input->post('frequenza_rate'),
			'categoria_acquedotto' => $this->input->post('categoria_acquedotto')
		);
		$id = $this->input->post('id_unita');
		$message = '';
		
		if($id == -1){
			$id = $this->model_unita->insert($data, 'unita');
			$message = 'Unità aggiunta';
		}else{
			if($this->input->post('action') == 'delete'){
				$this->model_unita->delete($id, 'unita');
				$message = 'Unità eliminata';
				$id = -1;
			}else{
				$this->model_unita->update($id, $data, 'unita');
				$message = 'Unità modificata';
			}
		}
		redirect('unita/index/'.$id.'?success_message='.$message);
	}
	
	public function edit_relazione($rapporto){
		$data = array(
			'id_unita' => $this->input->post('id_unita'),
			'id_persona' => $this->input->post('id_persona'),
			'rapporto' => $rapporto,
			'data_inizio' => $this->utils->data_php_to_sql($this->input->post('data_inizio'))
		);
		$id = $this->input->post('id_relazione');
		$idUnita = $this->input->post('id_unita');
		$message = '';
		
		if($id == -1){
			$id = $this->model_unita->insert($data, 'relazioni_unita');
			if($data['rapporto']== 'PROPRIETARIO' OR $data['rapporto']== 'CONDUTTORE'){
				$this->model_unita->update_tabelle($id, $_SESSION['id_condominio']);
			}
			
			$message = 'Relazione aggiunta';
		}else{
			if($this->input->post('action') == 'delete'){
				$this->model_unita->delete($id, 'relazioni_unita');
				$message = 'Relazione eliminata';
				$id = -1;
			}else{
				$this->model_unita->update($id, $data, 'relazioni_unita');
				$message = 'Relazione modificata';
			}
		}
		redirect('unita/index/'.$idUnita.'?success_message='.$message);
	}
}
