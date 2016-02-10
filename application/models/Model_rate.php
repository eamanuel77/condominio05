<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_rate extends CI_Model {
	
	function insert($data, $tabella){
		$this->db->insert($tabella, $data);
		return $this->db->insert_id();
	}
	
	function delete($id, $tabella){
		$id = $this->db->escape_str($id);
		// TODO controllo se quel condominio appartiene all'azienda che ha fatto login
		// TODO escape
		$this->db->where('id', $id);
		$this->db->delete($tabella);
	}
	
	function update($id, $data, $tabella){
		$id = $this->db->escape_str($id);
		// TODO controllo se quel condominio appartiene all'azienda che ha fatto login
		$this->db->where('id', $id);
		$this->db->update($tabella, $data);
	}
	
	function get_rate_ordinarie($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query("SELECT rata1, rata2, rata3, rata4, rata5, rata6, rata7, rata8, rata9, rata10, rata11, rata12,
										(rata1+rata2+rata3+rata4+rata5+rata6+rata7+rata8+rata9+rata10+rata11+rata12) AS totale_rate,
										((rata1+rata2+rata3+rata4+rata5+rata6+rata7+rata8+rata9+rata10+rata11+rata12)-totale_versato) AS saldo,
										CONCAT(p.cognome, ' ', p.nome) AS nome_persona, totale_versato, r.rapporto, r.id_unita
								FROM rate ra, relazioni_unita r, persone p
								WHERE ra.id_relazione_unita=r.id AND r.id_persona=p.id AND
									id_esercizio = ".$idEsercizio."
								ORDER BY r.id_unita, r.rapporto, p.cognome, p.nome");
		$res = $res->result_array();
		return $res;
	}
	
	function get_rate_straordinarie($idEsercizio, $idCondominio){
		// Update tabella straordinari
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query("SELECT id_tabella_straordinari AS id_tabella FROM esercizi WHERE id = ".$idEsercizio);
		$res = $res->result_array();
		$this->load->model('model_tabelle');
		$this->model_tabelle->update_rows_dati($res[0]['id_tabella'], $idCondominio);
		
		// Get totale da pagare
		$res = $this->db->query("SELECT IFNULL(SUM(importo),0) AS totale FROM transazioni
									WHERE tipo='SERVIZIO' AND tipo_rata='STRAORDINARIA' AND id_esercizio = ".$idEsercizio);
		$res = $res->result_array();
		$totale_straordinari = $res[0]['totale'];
		
		// Get rate straordinarie
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query("SELECT r.id, r.id_unita, CONCAT(p.cognome, ' ', p.nome) AS nome_persona,
									(d.quota*".$totale_straordinari."/mt.millesimi) AS totale_spese, IFNULL(v.versato,0) AS versato
								FROM (relazioni_unita r, persone p, esercizi e, dati_tabella d, 
										(
											SELECT id_tabella, SUM(quota) AS millesimi
											FROM dati_tabella
											GROUP BY id_tabella
										) mt) LEFT JOIN
										(
											SELECT id_relazione_unita AS id, IFNULL(SUM(importo),0) AS versato
											FROM transazioni
											WHERE tipo='RATA' AND id_esercizio=".$idEsercizio." AND tipo_rata='STRAORDINARIA'
											GROUP BY id_relazione_unita
										) v ON v.id=r.id
								WHERE r.id_persona=p.id AND d.id_relazione_unita=r.id AND e.id_tabella_straordinari=d.id_tabella AND
									mt.id_tabella=d.id_tabella AND
									e.id = ".$idEsercizio."
								ORDER BY r.id_unita, r.rapporto, p.cognome, p.nome");
		$res = $res->result_array();
		return $res;
	}
	
	function get_rate_acquedotto($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query("SELECT acq.id, r.id_unita, CONCAT(p.cognome, ' ', p.nome) AS nome_persona,
									rata1, rata2, rata3, rata4, u.categoria_acquedotto,
									(rata1+rata2+rata3+rata4) AS totale_rate, IFNULL(v.versato,0) AS versato
								FROM (rate_acquedotto acq, relazioni_unita r, persone p, unita u) LEFT JOIN
									(
										SELECT id_relazione_unita AS id, IFNULL(SUM(importo),0) AS versato
										FROM transazioni
										WHERE tipo='RATA' AND tipo_rata='ACQUEDOTTO' AND id_esercizio=".$idEsercizio."
									) v ON v.id=r.id
								WHERE acq.id_relazione_unita=r.id AND r.id_persona=p.id AND r.id_unita=u.id AND
									acq.id_esercizio = ".$idEsercizio."
								ORDER BY r.id_unita, r.rapporto, p.cognome, p.nome");
		$res = $res->result_array();
		return $res;
	}
	
	function update_dati_rate_ordinarie($idEsercizio, $idCondominio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$idCondominio = $this->db->escape_str($idCondominio);
		
		// cancella vecchi dati
		$this->db->where('id_esercizio', $idEsercizio);
		$this->db->delete('rate');
		
		// preleva tutte le relazioni unita
		$res = $this->db->query("SELECT r.id, CONCAT(p.cognome, ' ',p.nome) AS nome_persona, r.id_unita, u.frequenza_rate
								FROM relazioni_unita r, persone p, unita u, gruppi g, palazzine pa
								WHERE r.id_persona=p.id AND r.id_unita=u.id AND u.id_gruppo=g.id AND g.id_palazzina=pa.id AND
									pa.id_condominio =".$idCondominio);
		$res = $res->result_array();
		foreach($res as $value){
			// riga da inserire nel db
			$row = array();
			
			// calcoalre totale da pagare
			$res = $this->db->query("SELECT IFNULL(SUM(d.quota*s.importo/mt.millesimi),0) AS totale_rate
								FROM dati_tabella d, sottocategorie s, (
													SELECT id_tabella, SUM(quota) AS millesimi
													FROM dati_tabella
													GROUP BY id_tabella
												) mt, categorie c
								WHERE d.id_tabella=mt.id_tabella AND s.id_tabella=d.id_tabella AND s.id_categoria=c.id AND
								d.id_relazione_unita=".$value['id']." AND c.id_esercizio=".$idEsercizio);
			$res = $res->result_array();
			$totale_rate = $res[0]['totale_rate'];
			
			// calcolare singole rate e arrotondarle
			switch($value['frequenza_rate']){
				case 'MENSILE':
					$singola_rata = $totale_rate/12;
					$centesimi = ($singola_rata - floor($singola_rata))*12; // raccolgo i centesimi
					$centesimi = ceil($centesimi * 100) / 100; // arrotondo i centesimi
					$singola_rata = floor($singola_rata); // taglio la rata generica
					$row['rata1'] = $singola_rata + $centesimi;
					$row['rata2'] = $row['rata3'] = $row['rata4'] = $row['rata5'] = $row['rata6'] = $singola_rata;
					$row['rata7'] = $row['rata8'] = $row['rata9'] = $row['rata10'] = $row['rata11'] = $row['rata12'] = $singola_rata;
					break;
				case 'BIMESTRALE':
					$singola_rata = $totale_rate/6;
					$centesimi = ($singola_rata - floor($singola_rata))*6; // raccolgo i centesimi
					$centesimi = ceil($centesimi * 100) / 100; // arrotondo i centesimi
					$singola_rata = floor($singola_rata); // taglio la rata generica
					$row['rata2'] = $singola_rata + $centesimi;
					$row['rata4'] = $row['rata6'] = $row['rata8'] = $row['rata10'] = $row['rata12'] = $singola_rata;
					break;
				case 'TRIMESTRALE':
					$singola_rata = $totale_rate/4;
					$centesimi = ($singola_rata - floor($singola_rata))*4; // raccolgo i centesimi
					$centesimi = ceil($centesimi * 100) / 100; // arrotondo i centesimi
					$singola_rata = floor($singola_rata); // taglio la rata generica
					$row['rata3'] = $singola_rata + $centesimi;
					$row['rata6'] = $row['rata9'] = $row['rata12'] = $singola_rata;
					break;
				case 'ANNUALE':
					$row['rata12'] = ceil($totale_rate * 100) / 100;
					break;
				default: die('Not implemented');
			}
			
			// calcolare il versato
			$res = $this->db->query("SELECT IFNULL(SUM(importo),0) AS totale_versato
								FROM transazioni
								WHERE id_relazione_unita=".$value['id']." AND id_esercizio=".$idEsercizio." AND tipo='RATA'");
			$res = $res->result_array();
			$row['totale_versato'] = $res[0]['totale_versato'];
			
			// salvare i risultati in tabella
			$row['id_esercizio'] = $idEsercizio;
			$row['id_relazione_unita'] = $value['id'];
			$this->db->insert('rate', $row);
		}
	}
	
	function update_dati_acquedotto($idEsercizio, $idCondominio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$idCondominio = $this->db->escape_str($idCondominio);
		// Add new rows
		$res = $this->db->query("SELECT r.id
								FROM relazioni_unita r, unita u, gruppi g, palazzine pa
								WHERE r.id_unita=u.id AND u.id_gruppo=g.id AND g.id_palazzina=pa.id AND
									pa.id_condominio=".$idCondominio." AND (r.rapporto='PROPRIETARIO' OR r.rapporto='CONDUTTORE') AND
									r.id NOT IN (
										SELECT id_relazione_unita FROM rate_acquedotto WHERE id_esercizio=".$idEsercizio."
									)");
		$res = $res->result_array();
		foreach($res as $value){
			$data = array(
				'rata1' => 0, 'rata2' => 0, 'rata3' => 0, 'rata4' => 0,
				'id_esercizio' => $idEsercizio,
				'id_relazione_unita'=> $value['id']
			);
			$this->db->insert('rate_acquedotto', $data);
		}
	}
	
	function get_scadenza_rate($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query("SELECT * FROM esercizi WHERE id=".$idEsercizio);
		$res = $res->result_array();
		if(isset($res[0]))
			return $res[0];
		else
			return 0;
	}
	
	// il parametro $rate è il risulatato della funzione 'get_rate' di questo file
	// il parametro $scadenzaRate è il risulatato della funzione 'get_scadenza_rate' di questo file
	function get_stato_pagamento_rate($idEsercizio, $rate, $scadenzaRate){
		$now = new DateTime("now");
		
		foreach($rate as $key=>$value){
			$versato_rimasto = $value['totale_versato'];
			for($i=1; $i<=12; $i++){
				$versato_rimasto -= $value['rata'.$i];
				
				if($versato_rimasto>=0){
					$rate[$key]['stato_pagamento'.$i] = 'PAGATO';
				}else{
					if(date_create($scadenzaRate['scadenza_rata'.$i]) < $now){
						$rate[$key]['stato_pagamento'.$i] = 'NON_PAGATO';
					}else{
						$rate[$key]['stato_pagamento'.$i] = 'NON_SCADUTO';
					}
				}
			}
		}
		return $rate;
	}
	
	// il parametro $rate è il risulatato della funzione 'get_rate_acquedotto' di questo file
	// il parametro $scadenzaRate è il risulatato della funzione 'get_scadenza_rate' di questo file
	function get_stato_pagamento_rate_acquedotto($idEsercizio, $rate, $scadenzaRate){
		$now = new DateTime("now");
		
		foreach($rate as $key=>$value){
			$versato_rimasto = $value['versato'];
			for($i=1; $i<=4; $i++){
				$versato_rimasto -= $value['rata'.$i];
				
				if($versato_rimasto>=0){
					$rate[$key]['stato_pagamento'.$i] = 'PAGATO';
				}else{
					if(date_create($scadenzaRate['scadenza_acquedotto'.$i]) < $now){
						$rate[$key]['stato_pagamento'.$i] = 'NON_PAGATO';
					}else{
						$rate[$key]['stato_pagamento'.$i] = 'NON_SCADUTO';
					}
				}
			}
		}
		return $rate;
	}
}