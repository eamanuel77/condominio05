<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_fornitori extends CI_Model {
	
	function get_fornitori($idAzienda){
		$res = $this->db->query("SELECT id, ragione_sociale, CONCAT(cognome_titolare, ' ', nome_titolare) AS titolare, telefono, cellulare FROM fornitori WHERE id_azienda = ".$idAzienda." ORDER BY ragione_sociale");
		$res = $res->result_array();
		return $res;
	}
	
	function get_fornitore($idFornitore){
		// TODO test che quella persona appartiene all'azienda
		$this->load->library('utils');
		$idFornitore = $this->db->escape_str($idFornitore);
		$res = $this->db->query('SELECT * FROM fornitori WHERE id = '.$idFornitore);
		$res = $res->result_array();
		if(isset($res[0])){
			$res[0]['data_nascita_titolare'] = $this->utils->data_sql_to_php($res[0]['data_nascita_titolare']);
			return $res[0];
		}else
			return array();
	}
	
	function insert($data, $table){
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	
	function delete($id, $table){
		// TODO la persona appartiene all'azienda loggata?
		$id = $this->db->escape_str($id);
		$this->db->where('id', $id);
		$this->db->delete($table);
	}
	
	function update($id, $data, $table){
		// TODO la persona appartiene all'azienda loggata?
		$id = $this->db->escape_str($id);
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	}
}