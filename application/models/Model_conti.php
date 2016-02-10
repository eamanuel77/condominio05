<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_conti extends CI_Model {
	
	function get_categorie($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query('SELECT * FROM categorie WHERE id_esercizio = '.$idEsercizio.' ORDER BY nome');
		$res = $res->result_array();
		return $res;
	}
	
	function get_sottocategorie($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query('SELECT s.id, s.nome, s.id_categoria, s.note FROM sottocategorie s, categorie c
								WHERE s.id_categoria=c.id AND c.id_esercizio='.$idEsercizio.' ORDER BY c.nome, s.nome');
		$res = $res->result_array();
		return $res;
	}
	
	function get_preventivi($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query('SELECT c.nome AS nome_categoria, s.id_categoria, s.id, s.nome, s.note, s.importo, s.id_tabella, s.id_fornitore
								FROM sottocategorie s, categorie c
								WHERE s.id_categoria=c.id AND c.id_esercizio='.$idEsercizio.' ORDER BY c.nome, s.nome');
		$res = $res->result_array();
		return $res;
	}
	
	function get_preventivo($idPreventivo){
		$idPreventivo = $this->db->escape_str($idPreventivo);
		$res = $this->db->query('SELECT * FROM sottocategorie WHERE id='.$idPreventivo);
		$res = $res->result_array();
		if(isset($res[0]))
			return $res[0];
		else
			return array();
	}
	
	function get_transazioni($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query("SELECT t.id, t.tipo, t.nome, t.descrizione, DATE_FORMAT(t.data_competenza, '%d/%m/%Y') AS data_competenza, t.segno,
		DATE_FORMAT(t.data_fattura, '%d/%m/%Y') AS data_fattura, DATE_FORMAT(t.data_pagamento, '%d/%m/%Y') AS data_pagamento, t.id_relazione_unita,
								t.pagato, t.importo, t.id_sottocategoria, s.id_categoria, CONCAT(c.nome, ' > ', s.nome) AS nome_categoria
								FROM transazioni t, sottocategorie s, categorie c
								WHERE t.id_sottocategoria=s.id AND s.id_categoria=c.id AND
								t.id_esercizio=".$idEsercizio." ORDER BY t.data_competenza DESC");
		$res = $res->result_array();
		return $res;
	}
	
	function get_transazione($idTransazione){
		$this->load->library('utils');
		$idTransazione = $this->db->escape_str($idTransazione);
		$res = $this->db->query('SELECT * FROM transazioni WHERE id='.$idTransazione);
		$res = $res->result_array();
		if(isset($res[0])){
			$res[0]['data_competenza'] = $this->utils->data_sql_to_php($res[0]['data_competenza']);
			$res[0]['data_fattura'] = $this->utils->data_sql_to_php($res[0]['data_fattura']);
			$res[0]['data_pagamento'] = $this->utils->data_sql_to_php($res[0]['data_pagamento']);
			$res[0]['data'] = $res[0]['data_competenza'];
			return $res[0];
		}else
			return array();
	}
	
	function get_totale_entrate($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query('SELECT IFNULL(SUM(importo),0) AS totale FROM transazioni WHERE pagato=1 AND segno=0 AND id_esercizio='.$idEsercizio);
		$res = $res->result_array();
		if(isset($res[0]))
			return $res[0]['totale'];
		else
			return 0;
	}
	
	function get_totale_uscite($idEsercizio){
		$res = $this->db->query('SELECT IFNULL(SUM(importo),0) AS totale FROM transazioni WHERE pagato=1 AND segno=1 AND id_esercizio='.$idEsercizio);
		$res = $res->result_array();
		if(isset($res[0]))
			return $res[0]['totale'];
		else
			return 0;
	}
	
	function get_totale_non_pagato($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query('SELECT IFNULL(SUM(importo),0) AS totale FROM transazioni WHERE pagato=0 AND id_esercizio='.$idEsercizio);
		$res = $res->result_array();
		if(isset($res[0]))
			return $res[0]['totale'];
		else
			return 0;
	}
	
	function get_totale_saldo($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$saldo = $this->get_totale_entrate($idEsercizio) - $this->get_totale_uscite($idEsercizio);
		
		// aggiungo il saldo iniziale
		$res = $this->db->query('SELECT saldo_iniziale FROM esercizi WHERE id='.$idEsercizio);
		$res = $res->result_array();
		return ($res[0]['saldo_iniziale']+$saldo);
	
	}
	
	function get_saldo_iniziale($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query('SELECT saldo_iniziale FROM esercizi WHERE id='.$idEsercizio);
		$res = $res->result_array();
		if(isset($res[0]))
			return $res[0]['saldo_iniziale'];
		else
			return 0;
	}
	
	function get_preventivo_consuntivo($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query("SELECT s.id, s.nome AS nome_sottocategoria, s.id_categoria, c.nome AS nome_categoria, s.importo AS importo_preventivo, IFNULL(SUM(t.importo), 0) AS importo_consuntivo
								FROM  (categorie c JOIN sottocategorie s ON c.id=s.id_categoria) LEFT JOIN (SELECT * FROM transazioni t WHERE t.tipo='SERVIZIO' AND t.pagato=1) t ON s.id=t.id_sottocategoria
								WHERE c.id_esercizio=".$idEsercizio."
								GROUP BY c.id, s.id
								ORDER BY c.nome, s.nome");
		$res = $res->result_array();
		return $res;
	}
	
	function get_fornitori($idAzienda){
		$res = $this->db->query("SELECT id, ragione_sociale AS nome FROM fornitori WHERE id_azienda = ".$idAzienda." ORDER BY ragione_sociale");
		$res = $res->result_array();
		return $res;
	}
	
	function get_proprietari_conduttori($idCondominio){
		$idCondominio = $this->db->escape_str($idCondominio);
		$res = $this->db->query("SELECT r.id, CONCAT(u.id, ' > ', p.cognome, ' ', p.nome) as nome
									FROM relazioni_unita r, unita u, gruppi g, palazzine pa, persone p
									WHERE r.id_unita=u.id AND u.id_gruppo=g.id AND g.id_palazzina=pa.id AND r.id_persona=p.id AND
									pa.id_condominio=".$idCondominio." AND (r.rapporto='PROPRIETARIO' OR r.rapporto='CONDUTTORE')
									ORDER BY u.id, p.cognome, p.nome");
		$res = $res->result_array();
		return $res;
	}
	
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
}