<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_unita extends CI_Model {
	
	function get_unita($idCondominio){
		$idCondominio = $this->db->escape_str($idCondominio);
		
		$res = $this->db->query('SELECT u.id, tipo, interno, piano
								FROM palazzine p, gruppi g, unita u
								WHERE p.id = g.id_palazzina AND g.id = u.id_gruppo AND
								p.id_condominio = '.$idCondominio.' ORDER BY u.id');
		$res = $res->result_array();
		foreach($res as $key => $value){
			$res2 = $this->db->query("SELECT p.id, CONCAT(cognome, ' ', nome) AS nome
								FROM relazioni_unita r, persone p
								WHERE r.id_persona = p.id AND rapporto = 'PROPRIETARIO' AND r.id_unita = ".$value['id']." ORDER BY cognome, nome");
			$res2 = $res2->result_array();
			$res[$key]['proprietari'] = '';
			foreach($res2 as $value2){
				$res[$key]['proprietari'] .= $value2['nome'].' - ';
			}
			$res[$key]['proprietari'] = substr($res[$key]['proprietari'], 0, -3);
		}
		return $res;
	}
	
	function get_unita_singola($idCondominio, $idUnita){
		$idCondominio = $this->db->escape_str($idCondominio);
		$idUnita = $this->db->escape_str($idUnita);
		$res = $this->db->query('SELECT c.nome as nome_condominio, c.id as id_condominio,
									p.descrizione as descrizione_palazzina,
									g.descrizione as descrizione_gruppo, id_palazzina,
									u.id as id_unita, tipo, id_gruppo, interno, subalterno, piano, note, foglio, particella, categoria, rendita, frequenza_rate, categoria_acquedotto
								FROM condomini c, palazzine p, gruppi g, unita u
								WHERE c.id = p.id_condominio AND p.id = g.id_palazzina AND g.id = u.id_gruppo AND
								c.id = '.$idCondominio.' AND u.id = '.$idUnita);
		$res = $res->result_array();
		if(isset($res[0]))
			return $res[0];
		else
			return array();
	}
	
	function get_gruppi($idCondominio){
		$idCondominio = $this->db->escape_str($idCondominio);
		// TODO controllo se quel condominio appartiene all'azienda che ha fatto login
		$res = $this->db->query("SELECT g.id, CONCAT(p.descrizione, ' > ', g.descrizione) AS nome
								FROM palazzine p, gruppi g
								WHERE p.id = g.id_palazzina AND p.id_condominio = ".$idCondominio." ORDER BY p.descrizione, g.descrizione");
		$res = $res->result_array();
		return $res;
	}
	
	function insert($data, $table){
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	
	function delete($id, $table){
		// TODO controllo se quel esercizio appartiene all'azienda che ha fatto login
		$id = $this->db->escape_str($id);
		$this->db->where('id', $id);
		$this->db->delete($table);
	}
	
	function update($id, $data, $table){
		// TODO controllo se quel esercizio appartiene all'azienda che ha fatto login
		$id = $this->db->escape_str($id);
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	}
	
	function get_relazione($idUnita, $rapporto){
		$idUnita = $this->db->escape_str($idUnita);
		$res = $this->db->query("SELECT r.id, id_persona, nome, cognome, DATE_FORMAT(data_inizio, '%d/%m/%Y') AS data_inizio
								FROM relazioni_unita r, persone p
								WHERE r.id_persona = p.id AND r.rapporto = '".$rapporto."' AND r.id_unita = ".$idUnita." ORDER BY p.cognome, p.nome");
		$res = $res->result_array();
		return $res;
	}
	
	function get_persone($idCondominio){
		$idCondominio = $this->db->escape_str($idCondominio);
		$res = $this->db->query("SELECT id, CONCAT(id, ' > ', cognome, ' ', nome) AS nome
								FROM persone
								WHERE id_condominio = ".$idCondominio." ORDER BY cognome, nome");
		$res = $res->result_array();
		return $res;
	}
	
	function update_tabelle($idRelazioneUnita, $idEsercizio){
		$idRelazioneUnita = $this->db->escape_str($idRelazioneUnita);
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query("SELECT id FROM tabelle WHERE id_esercizio=".$idEsercizio);
		$res = $res->result_array();
		
		$data = array('quota' =>'0', 'id_relazione_unita' => $idRelazioneUnita);
		foreach($res as $value){
			$data['id_tabella'] = $value['id'];
			$this->insert($data, 'dati_tabella');
		}
	}
}