<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_esercizi extends CI_Model {
	
	function get_esercizi($idCondominio){
		$idCondominio = $this->db->escape_str($idCondominio);
		$res = $this->db->query("SELECT id, CONCAT(DATE_FORMAT(data_inizio, '%d/%m/%Y'), ' - ', DATE_FORMAT(data_fine, '%d/%m/%Y')) as nome FROM esercizi WHERE id_condominio = ".$idCondominio.' ORDER BY data_inizio');
		$res = $res->result_array();
		return $res;
	}
	
	function get_esercizio($idEsercizio){
		// TODO controllo se quel esercizio appartiene al condominio selezionato
		// TODO controllo se quel esercizio appartiene all'azienda loggata
		// TODO escape
		
		$this->load->library('utils');
		$idEsercizio = $this->db->escape_str($idEsercizio);
		$res = $this->db->query('SELECT * FROM esercizi WHERE id = '.$idEsercizio);
		$res = $res->result_array();
		if(isset($res[0])){
			$res[0]['data_inizio'] = $this->utils->data_sql_to_php($res[0]['data_inizio']);
			$res[0]['data_fine'] = $this->utils->data_sql_to_php($res[0]['data_fine']);
			return $res[0];
		}else
			return array();
	}
	
	function insert_esercizio($esercizio, $idCondominio){
		$esercizio['id_condominio'] = $idCondominio;
		$this->db->insert('esercizi', $esercizio);
		return $this->db->insert_id();
	}
	
	function delete_esercizio($id){
		// TODO controllo se quel esercizio appartiene all'azienda che ha fatto login
		$id = $this->db->escape_str($id);
		$this->db->where('id', $id);
		$this->db->delete('esercizi');
	}
	
	function update_esercizio($id, $esercizio){
		// TODO controllo se quel esercizio appartiene all'azienda che ha fatto login
		$id = $this->db->escape_str($id);
		$this->db->where('id', $id);
		$this->db->update('esercizi', $esercizio);
	}
}