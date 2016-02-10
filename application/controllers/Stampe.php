<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Stampe extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		// Login check
		if(!isset($_SESSION['connected']) || $_SESSION['connected'] == false) redirect('login');
		$this->data['breadcrumb']['Home'] = site_url('home');
		$this->load->model('model_stampe');
		
		// Load quickmenu data
		$this->load->model('model_condomini');
		$this->load->model('model_esercizi');
		$this->data['condomini'] = $this->model_condomini->get_condomini($_SESSION['id_azienda']);
		$this->data['esercizi'] = $this->model_esercizi->get_esercizi($_SESSION['id_condominio']);
		$this->data['selected_conominio'] = $_SESSION['id_condominio'];
		$this->data['selected_esercizio'] = $_SESSION['id_esercizio'];
	}
	
	public function index(){
		$this->data['title'] = 'Stampe';
		$this->data['breadcrumb'][$this->data['title']] = '';
		$this->load->view('parts/view_head', $this->data);
		$this->load->view('view_stampe');
		$this->load->view('parts/view_footer');
	}
	
	// ----------------------------------------------------------------------------------------------------------------
	
	public function bilancioConsuntivo(){
		// Retrieve data
		$this->load->model('model_conti');
		
		
		$preventivi_consuntivi = $this->model_conti->get_preventivo_consuntivo($_SESSION['id_esercizio']);
		
		
		// Bild PDF
		$htmlString = '';
		$htmlString .= $this->model_stampe->get_head('Bilancio consuntivo');
		$htmlString .= '
					<table>
						<tr>
							<td class="bb"></td>
							<td class="bc highlighted center">Importi</td>
							<td class="bc highlighted center">Totale</td>
						</tr>
						';
		$categoria = 0;
		$totale_categoria = 0;
		$totale = 0;
		foreach($preventivi_consuntivi as $value){
			if($categoria != $value['id_categoria']){
				if($categoria != 0){
					$htmlString .= '
						<tr>
							<td class="paddingl br"></td>
							<td class="br right"></td>
							<td class="br right">'.$totale_categoria.' &euro;</td>
						</tr>
						';
						$totale_categoria = 0;
				}
				
				$categoria = $value['id_categoria'];
				$htmlString .= '
						<tr>
							<td class="bt br bold">'.$value['nome_categoria'].'</td>
							<td class="bt br right"></td>
							<td class="bt br right"></td>
						</tr>
						';
			}
			$htmlString .= '
						<tr>
							<td class="paddingl br">'.$value['nome_sottocategoria'].'</td>
							<td class="br right">'.$value['importo_consuntivo'].' &euro;</td>
							<td class="br right"></td>
						</tr>
						';
			$totale += $value['importo_consuntivo'];
			$totale_categoria += $value['importo_consuntivo'];
		}
		$htmlString .= '
						<tr>
							<td class="paddingl br"></td>
							<td class="br right"></td>
							<td class="br right">'.$totale_categoria.' &euro;</td>
						</tr>
						';
		$htmlString .= '
						<tr>
							<td class="bt"></td>
							<td class="bc highlighted center">Totale</td>
							<td class="bc highlighted center">'.$totale.' &euro;</td>
						</tr>
						';
		$htmlString .= $this->model_stampe->get_footer();
		
		//echo $htmlString;
		$this->model_stampe->generatePDF('bilancio_preventivo.pdf', $htmlString);
	}
	
	// ----------------------------------------------------------------------------------------------------------------
	
	public function bilancioPreventivo(){
		// Retrieve data
		$this->load->model('model_conti');
		
		$preventivi = $this->model_conti->get_preventivi($_SESSION['id_esercizio']);
		
		// Bild PDF
		$htmlString = '';
		$htmlString .= $this->model_stampe->get_head('Bilancio preventivo');
		$htmlString .= '
					<table>
						<tr>
							<td class="bb"></td>
							<td class="bc highlighted center">Importi</td>
							<td class="bc highlighted center">Totale</td>
						</tr>
						';
		$categoria = 0;
		$totale_categoria = 0;
		$totale = 0;
		foreach($preventivi as $value){
			if($value['importo'] > 0){
				if($categoria != $value['id_categoria']){
					if($categoria != 0){
						$htmlString .= '
							<tr>
								<td class="paddingl br"></td>
								<td class="br right"></td>
								<td class="br right">'.$totale_categoria.' &euro;</td>
							</tr>
							';
							$totale_categoria = 0;
					}
					
					$categoria = $value['id_categoria'];
					$htmlString .= '
							<tr>
								<td class="bt br bold">'.$value['nome_categoria'].'</td>
								<td class="bt br right"></td>
								<td class="bt br right"></td>
							</tr>
							';
				}
				$htmlString .= '
							<tr>
								<td class="paddingl br">'.$value['nome'].'</td>
								<td class="br right">'.$value['importo'].' &euro;</td>
								<td class="br right"></td>
							</tr>
							';
				$totale += $value['importo'];
				$totale_categoria += $value['importo'];
			}
		}
		$htmlString .= '
						<tr>
							<td class="paddingl br"></td>
							<td class="br right"></td>
							<td class="br right">'.$totale_categoria.' &euro;</td>
						</tr>
						';
		$htmlString .= '
						<tr>
							<td class="bt"></td>
							<td class="bc highlighted center">Totale</td>
							<td class="bc highlighted center">'.$totale.' &euro;</td>
						</tr>
						';
		$htmlString .= $this->model_stampe->get_footer();
		//echo $htmlString;
		$this->model_stampe->generatePDF('bilancio_preventivo.pdf', $htmlString);
	}
	
	// ----------------------------------------------------------------------------------------------------------------
	
	public function ripartoSpeseBilancioPreventivo(){
		// Retrieve data
		$this->load->model('model_conti');
		
		$categorie = $this->model_conti->get_categorie($_SESSION['id_esercizio']);
		$spese = $this->model_stampe->get_riparto_spese_bilancio_preventivo($_SESSION['id_esercizio']);
		
		// Bild PDF
		$htmlString = '';
		$htmlString .= $this->model_stampe->get_head('Riparto spese bilancio preventivo');
		$htmlString .= '
					<table>
						<tr>
							<td class="bc highlighted center">Piano</td>
							<td class="bt bb bl highlighted center">Proprietario</td>
							<td class="bt bb br highlighted center">Conduttore</td>
							';
		foreach($categorie as $value){
			$htmlString .= '
							<td class="bc highlighted center">'.$value['nome'].'</td>
							';
		}
		$htmlString .= '
							<td class="bc highlighted center">Totale spesa</td>
							<td class="bc highlighted center">Rata x12</td>
						</tr>
						';
		$categoria = 0;
		$totale_categoria = 0;
		$totale = 0;
		foreach($spese as $value){
			$htmlString .= '
						<tr>
							<td class="bl center">'.$value['piano'].'</td>
							';
			if($value['rapporto']=='PROPRIETARIO'){
				$htmlString .= '
							<td class="bl">'.$value['nome_persona'].'</td><td class="br"></td>
							';
			}else{
				$htmlString .= '
							<td class="bl"></td><td class="br">'.$value['nome_persona'].'</td>
							';
			}
			$htmlString .= '
						</tr>
							';
		}
		$htmlString .= '
						<tr>
							<td class="bt"></td>
							<td class="bc highlighted center">Totale</td>
							<td class="bc highlighted center">'.$totale.' &euro;</td>
						</tr>
						';
		$htmlString .= $this->model_stampe->get_footer();
		//echo $htmlString;
		$this->model_stampe->generatePDF('bilancio_preventivo.pdf', $htmlString, 1);
	}
}
