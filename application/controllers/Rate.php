<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Rate extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Login check
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) redirect('login');
		$this->load->model('model_rate');
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
		$this->data['title'] = 'Rate';
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('view_rate');
		$this->load->view('parts/view_footer');
	}
	
	public function aggiorna_dati_ordinari(){
		$this->model_rate->update_dati_rate_ordinarie($_SESSION['id_esercizio'], $_SESSION['id_condominio']);
		
		$message = 'Dati aggiornati';
		redirect('rate/rate_ordinarie?success_message='.$message);
	}
	
	public function aggiorna_dati_acquedotto(){
		$this->model_rate->update_dati_acquedotto($_SESSION['id_esercizio'], $_SESSION['id_condominio']);
		
		$message = 'Dati aggiornati';
		redirect('rate/rate_acquedotto?success_message='.$message);
	}
	
	public function rate_ordinarie(){
		$this->model_rate->update_dati_rate_ordinarie($_SESSION['id_esercizio'], $_SESSION['id_condominio']);
		$this->data['rate'] = $this->model_rate->get_rate_ordinarie($_SESSION['id_esercizio']);
		$this->data['scadenza_rate'] = $this->model_rate->get_scadenza_rate($_SESSION['id_esercizio']);
		$this->data['rate'] = $this->model_rate->get_stato_pagamento_rate($_SESSION['id_esercizio'], $this->data['rate'], $this->data['scadenza_rate']);
		
		$this->data['title'] = 'Rate ordinarie';
		$this->data['breadcrumb']['Rate'] = site_url('rate');
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('rate/view_rate_ordinarie');
		$this->load->view('parts/view_footer');
	}
	
	public function rate_straordinarie(){
		$this->data['rate_straordinarie'] = $this->model_rate->get_rate_straordinarie($_SESSION['id_esercizio'], $_SESSION['id_condominio']);
		$this->data['scadenza_rate'] = $this->model_rate->get_scadenza_rate($_SESSION['id_esercizio']);
		
		$this->data['title'] = 'Rate straordinarie';
		$this->data['breadcrumb']['Rate'] = site_url('rate');
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('rate/view_rate_straordinarie');
		$this->load->view('parts/view_footer');
	}
	
	public function rate_acquedotto(){
		$this->model_rate->update_dati_acquedotto($_SESSION['id_esercizio'], $_SESSION['id_condominio']);
		$this->data['rate_acquedotto'] = $this->model_rate->get_rate_acquedotto($_SESSION['id_esercizio']);
		$this->data['scadenza_rate'] = $this->model_rate->get_scadenza_rate($_SESSION['id_esercizio']);
		$this->data['rate_acquedotto'] = $this->model_rate->get_stato_pagamento_rate_acquedotto($_SESSION['id_esercizio'], $this->data['rate_acquedotto'], $this->data['scadenza_rate']);
		
		$this->data['title'] = 'Rate acquedotto';
		$this->data['breadcrumb']['Rate'] = site_url('rate');
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('rate/view_rate_acquedotto');
		$this->load->view('parts/view_footer');
	}
	
	public function edit_scadenze_ordinarie(){
		$data = array();
		for($i=1; $i<=12; $i++){
			$data['scadenza_rata'.$i] = $this->utils->data_php_to_sql($this->input->post('scadenza_rata'.$i));
		}
		$id = $_SESSION['id_esercizio'];
		$message = 'Scadenze modificate';
		
		$this->model_rate->update($id, $data, 'esercizi');
		
		redirect('rate/rate_ordinarie?success_message='.$message);
	}
	
	public function edit_scadenza_straordinaria(){
		$data = array('scadenza_straordinaria' => $this->utils->data_php_to_sql($this->input->post('scadenza_straordinaria')));
		$id = $_SESSION['id_esercizio'];
		$message = 'Scadenza modificata';
		
		$this->model_rate->update($id, $data, 'esercizi');
		
		redirect('rate/rate_straordinarie?success_message='.$message);
	}
	
	public function edit_acquedotto(){
		// scadenze
		$data = array();
		for($i=1; $i<=4; $i++){
			$data['scadenza_acquedotto'.$i] = $this->utils->data_php_to_sql($this->input->post('scadenza_acquedotto'.$i));
		}
		$id = $_SESSION['id_esercizio'];
		$this->model_rate->update($id, $data, 'esercizi');
		
		// rate
		
		for($i=0; $i<$this->input->post('count_rate_acquedotto'); $i++){
			$data = array(
				'rata1' => $this->input->post('rata1_'.$i),
				'rata2' => $this->input->post('rata2_'.$i),
				'rata3' => $this->input->post('rata3_'.$i),
				'rata4' => $this->input->post('rata4_'.$i)
			);
			
			$id = $this->input->post('id_rata_acquedotto_'.$i);
			$this->model_rate->update($id, $data, 'rate_acquedotto');
		}
		
		
		$message = 'Rate e scadenze modificate';
		redirect('rate/rate_acquedotto?success_message='.$message);
	}
}
