<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_tabelle extends CI_Model {
	
	function get_tabelle($idEsercizio){
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query('SELECT id, nome, 
												(id=(SELECT id_tabella_straordinari FROM esercizi WHERE id='.$idEsercizio.')) AS straordinari,
												(id=(SELECT id_tabella_acquedotto FROM esercizi WHERE id='.$idEsercizio.')) AS acquedotto
								FROM tabelle WHERE id_esercizio = '.$idEsercizio.' ORDER BY nome');
		$res = $res->result_array();
		return $res;
	}
	
	function get_tabella($idTabella){
		// TODO controllo se quel condominio appartiene all'azienda che ha fatto login
		$idTabella = $this->db->escape_str($idTabella);
		
		$res = $this->db->query('SELECT * FROM tabelle WHERE id = '.$idTabella);
		$res = $res->result_array();
		if(isset($res[0]))
			return $res[0];
		else
			return array();
	}
	
	function get_dati_tabella($idTabella){
		$idTabella = $this->db->escape_str($idTabella);
		// TODO controllo se quel condominio appartiene all'azienda che ha fatto login
		$res = $this->db->query("SELECT d.id, d.id_relazione_unita, r.id_unita, CONCAT(p.cognome, ' ', p.nome) AS persona, r.rapporto, d.quota
						FROM dati_tabella d, relazioni_unita r, persone p
						WHERE d.id_relazione_unita=r.id AND r.id_persona=p.id AND
						(r.rapporto='PROPRIETARIO' OR r.rapporto='CONDUTTORE') AND d.id_tabella = ".$idTabella."
						ORDER BY r.id_unita, r.rapporto, p.cognome, p.nome");
		$res = $res->result_array();
		return $res;
	}
	
	function insert($data, $tabella){
		$this->db->insert($tabella, $data);
		return $this->db->insert_id();
	}
	
	function delete($id, $tabella){
		// TODO controllo se quel condominio appartiene all'azienda che ha fatto login
		$id = $this->db->escape_str($id);
		$this->db->where('id', $id);
		$this->db->delete($tabella);
	}
	
	function update($id, $data, $tabella){
		// TODO controllo se quel condominio appartiene all'azienda che ha fatto login
		$id = $this->db->escape_str($id);
		$this->db->where('id', $id);
		$this->db->update($tabella, $data);
	}
	
	function update_rows_dati($idTabella, $idCondominio){
		$idTabella = $this->db->escape_str($idTabella);
		$idCondominio = $this->db->escape_str($idCondominio);
		// Add new rows
		$res = $this->db->query("SELECT r.id
								FROM relazioni_unita r, unita u, gruppi g, palazzine pa
								WHERE r.id_unita=u.id AND u.id_gruppo=g.id AND g.id_palazzina=pa.id AND
								pa.id_condominio=".$idCondominio." AND (r.rapporto='PROPRIETARIO' OR r.rapporto='CONDUTTORE') AND
								r.id NOT IN (
								SELECT id_relazione_unita FROM dati_tabella WHERE id_tabella=".$idTabella."
								)");
		$res = $res->result_array();
		foreach($res as $value){
			$data = array(
				'quota' => 0,
				'id_tabella' => $idTabella,
				'id_relazione_unita'=> $value['id']
			);
			$this->db->insert('dati_tabella', $data);
		}
	}
}