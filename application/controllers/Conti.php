<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Conti extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Login check
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) redirect('login');
		$this->load->model('model_conti');
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
	
	public function index(){
		$this->data['title'] = 'Conti';
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('view_conti');
		$this->load->view('parts/view_footer');
	}
	
	public function categorie(){
		$this->data['categorie'] = $this->model_conti->get_categorie($_SESSION['id_esercizio']);
		$this->data['sottocategorie'] = $this->model_conti->get_sottocategorie($_SESSION['id_esercizio']);
		
		$this->data['title'] = 'Struttura preventivo';
		$this->data['breadcrumb']['Conti'] = site_url('conti');
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('conti/view_categorie');
		$this->load->view('parts/view_footer');
	}
	
	public function edit_categoria(){
		$data = array(
			'nome' => $this->input->post('nome'),
			'note' => $this->input->post('note'),
			'id_esercizio' => $_SESSION['id_esercizio']
		);
		$id = $this->input->post('id_categoria');
		$message = '';
		
		if($id == -1){
			$id = $this->model_conti->insert($data, 'categorie');
			$message = 'Categoria aggiunta';
		}else{
			if($this->input->post('action') == 'delete'){
				$this->model_conti->delete($id, 'categorie');
				$message = 'Categoria eliminata';
				$id = -1;
			}else{
				$this->model_conti->update($id, $data, 'categorie');
				$message = 'Categoria modificata';
			}
		}
		redirect('conti/categorie?success_message='.$message);
	}
	
	public function edit_sottocategoria(){
		$data = array(
			'nome' => $this->input->post('nome'),
			'note' => $this->input->post('note'),
			'id_categoria' => $this->input->post('id_categoria')
		);
		$id = $this->input->post('id_sottocategoria');
		$message = '';
		
		if($id == -1){
			$id = $this->model_conti->insert($data, 'sottocategorie');
			$message = 'Sottocategoria aggiunta';
		}else{
			if($this->input->post('action') == 'delete'){
				$this->model_conti->delete($id, 'sottocategorie');
				$message = 'Sottoategoria eliminata';
				$id = -1;
			}else{
				$this->model_conti->update($id, $data, 'sottocategorie');
				$message = 'Sottoategoria modificata';
			}
		}
		redirect('conti/categorie?success_message='.$message);
	}
	
	public function preventivi($idPreventivo = 0){
		$this->data['preventivi'] = $this->model_conti->get_preventivi($_SESSION['id_esercizio']);
		if($idPreventivo == 0){
			if(isset($this->data['preventivi'][0])){
				$idPreventivo = $this->data['preventivi'][0]['id'];
			}else{
				$idPreventivo = -1;
			}
		}
		$this->load->model('model_tabelle');
		$this->data['id_preventivo'] = $idPreventivo;
		$this->data['preventivo'] = $this->model_conti->get_preventivo($idPreventivo);
		$this->data['tabelle'] = $this->model_tabelle->get_tabelle($_SESSION['id_condominio']);
		$this->data['fornitori'] = $this->model_conti->get_fornitori($_SESSION['id_azienda']);
		
		$this->data['title'] = 'Preventivo';
		$this->data['breadcrumb']['Conti'] = site_url('conti');
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('conti/view_preventivi');
		$this->load->view('parts/view_footer');
	}
	
	public function edit_preventivo(){
		$data = array(
			'importo' => $this->input->post('importo'),
			'id_tabella' => $this->input->post('id_tabella'),
			'id_fornitore' => $this->input->post('id_fornitore'),
			'note' => $this->input->post('note')
		);
		$id = $this->input->post('id_preventivo');
		$message = '';
		
		$this->model_conti->update($id, $data, 'sottocategorie');
		$message = 'Preventivo modificato';
		
		redirect('conti/preventivi/'.$id.'?success_message='.$message);
	}
	
	public function registro_cassa($idTransazione = 0){
		$this->data['transazioni'] = $this->model_conti->get_transazioni($_SESSION['id_esercizio']);
		if($idTransazione == 0){
			if(isset($this->data['transazioni'][0])){
				$idTransazione = $this->data['transazioni'][0]['id'];
			}else{
				$idTransazione = -1;
			}
		}
		
		$this->data['id_transazione'] = $idTransazione;
		$this->data['transazione'] = $this->model_conti->get_transazione($idTransazione);
		$this->data['sottocategorie'] = $this->model_conti->get_preventivi($_SESSION['id_esercizio']);
		$this->data['totale_entrate'] = $this->model_conti->get_totale_entrate($_SESSION['id_esercizio']);
		$this->data['totale_uscite'] = $this->model_conti->get_totale_uscite($_SESSION['id_esercizio']);
		$this->data['totale_saldo'] = $this->model_conti->get_totale_saldo($_SESSION['id_esercizio']);
		$this->data['totale_non_pagato'] = $this->model_conti->get_totale_non_pagato($_SESSION['id_esercizio']);
		$this->data['saldo_iniziale'] = $this->model_conti->get_saldo_iniziale($_SESSION['id_esercizio']);
		$this->data['fornitori'] = $this->model_conti->get_fornitori($_SESSION['id_azienda']);
		$this->data['proprietari_conduttori'] = $this->model_conti->get_proprietari_conduttori($_SESSION['id_condominio']);
		
		$this->data['title'] = 'Registro cassa';
		$this->data['breadcrumb']['Conti'] = site_url('conti');
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('conti/view_registro_cassa');
		$this->load->view('parts/view_footer');
	}
	
	public function edit_transazione(){
		$data = array(
			'nome' => $this->input->post('nome'),
			'descrizione' => $this->input->post('descrizione'),
			'data_competenza' => $this->utils->data_php_to_sql($this->input->post('data_competenza')),
			'data_fattura' => $this->utils->data_php_to_sql($this->input->post('data_fattura')),
			'data_pagamento' => $this->utils->data_php_to_sql($this->input->post('data_pagamento')),
			'importo' => $this->input->post('importo'),
			'pagato' => $this->input->post('pagato'),
			'id_fornitore' => $this->input->post('id_fornitore'),
			'id_sottocategoria' => $this->input->post('id_sottocategoria'),
			'id_esercizio' => $_SESSION['id_esercizio'],
			'tipo' => $this->input->post('tipo'),
			'id_relazione_unita' => $this->input->post('id_relazione_unita'),
			'tipo_rata' => $this->input->post('tipo_rata'),
			'segno' => $this->input->post('segno')
		);
		if($this->input->post('tipo') == 'RATA'){
			$data['data_competenza'] = $this->utils->data_php_to_sql($this->input->post('data'));
		}
		
		$id = $this->input->post('id_transazione');
		$message = '';
		
		if($id == -1){
			$id = $this->model_conti->insert($data, 'transazioni');
			$message = 'Transazione aggiunta';
		}else{
			if($this->input->post('action') == 'delete'){
				$this->model_conti->delete($id, 'transazioni');
				$message = 'Transazione eliminata';
				$id = -1;
			}else{
				$this->model_conti->update($id, $data, 'transazioni');
				$message = 'Transazione modificata';
			}
		}
		redirect('conti/registro_cassa/'.$id.'?success_message='.$message);
	}
	
	public function preventivo_consuntivo(){
		$this->data['preventivo_consuntivo'] = $this->model_conti->get_preventivo_consuntivo($_SESSION['id_esercizio']);
		
		$this->data['title'] = 'Preventivo/Consuntivo';
		$this->data['breadcrumb']['Conti'] = site_url('conti');
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('conti/view_preventivo_consuntivo');
		$this->load->view('parts/view_footer');
	}
}
