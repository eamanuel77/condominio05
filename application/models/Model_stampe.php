<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_stampe extends CI_Model {
	
	function generatePDF($filename, $htmlString, $landscape=0){
		require_once('application/libraries/dompdf/dompdf_config.inc.php');
		/*
		// Load PDF from html file
		$htmlString = '';
		ob_start();
		include('pdf_export.html');
		$htmlString .= ob_get_clean();
		*/
		
		$dompdf = new DOMPDF();
		$dompdf->load_html($htmlString);
		if($landscape)
			$dompdf->set_paper('a4', 'landscape');
		else
			$dompdf->set_paper('a4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename, array("Attachment" => 0));
	}
	
	function get_head($title){
		$this->load->model('model_condomini');
		$this->load->model('model_esercizi');
		
		$condominio = $this->model_condomini->get_condominio($_SESSION['id_condominio']);
		$esercizio = $this->model_esercizi->get_esercizio($_SESSION['id_esercizio']);
		
		$htmlString = '';
		$htmlString .= '
			<!DOCTYPE html>
			<html>
				<head>
				<style type="text/css">
					.right			{text-align: right;}
					.center			{text-align: center;}
					.paddingl		{padding-left: 50px}
					.highlighted	{background-color: #ff8;}
					table			{width: 100%; border-collapse: collapse;}
					.bt				{border-top: 1px solid black;}
					.bb				{border-bottom: 1px solid black;}
					.bl				{border-left: 1px solid black;}
					.br				{border-right: 1px solid black;}
					.bc				{border: 1px solid black;}
					h2				{margin: 0;}
					p				{margin: 0;}
					.bold			{font-weight: bold}
				</style>
				</head>
				<body>
					<h3>'.$condominio['nome'].' - Codice Fiscale: '.$condominio['codice_fiscale'].'</h3>
					<p>'.$condominio['indirizzo'].' - '.$condominio['cap'].' '.$condominio['citta'].'</p>
					<br/>
					<table>
						<tr>
							<td><h2>'.$title.'</h2></td><td class="right">Esercizio: '.$esercizio['data_inizio'].' - '.$esercizio['data_fine'].'</td>
						</tr>
					</table>
					<p class="bt"></p> <br/> <br/>';
		return $htmlString;
	}
	
	function get_footer(){
		$this->load->model('model_altro');
		
		$azienda = $this->model_altro->get_azienda($_SESSION['id_azienda']);
		
		$htmlString = '';
		$htmlString .= '
					</table>
					<br>
					<p>Amministratore pro-tempore: '.$azienda['nome'].'</p>
					<p>Professione esercitata ai sensi della legge 14 gennaio 2013, n.4(G.U. n.22 del 26-1-2013)</p>
				</body>
			</html>
			';
		return $htmlString;
	}
	
	function get_riparto_spese_bilancio_preventivo($idEsercizio){
		$res = $this->db->query("SELECT u.piano, CONCAT(p.cognome, ' ', p.nome) AS nome_persona, r.rapporto
								FROM categorie c, sottocategorie s, dati_tabella d, relazioni_unita r, persone p,
									unita u
								WHERE c.id=s.id_categoria AND s.id_tabella=d.id_tabella AND r.id=d.id_relazione_unita AND
									r.id_persona=p.id AND u.id=r.id_unita AND
									c.id_esercizio=".$idEsercizio."
								GROUP BY r.id, c.id
								ORDER BY u.piano, r.rapporto, p.cognome, p.nome");
		$res = $res->result_array();
		return $res;
	}
}