<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_altro extends CI_Model {
	
	function get_azienda($idAzienda){
		$res = $this->db->query('SELECT * FROM aziende WHERE id = '.$idAzienda);
		$res = $res->result_array();
		if(isset($res[0]))
			return $res[0];
		else
			return array();
	}
	
	function insert($data, $table){
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	
	function delete($id, $table){
		$id = $this->db->escape_str($id);
		// TODO controllo se quel esercizio appartiene all'azienda che ha fatto login
		$this->db->where('id', $id);
		$this->db->delete($table);
	}
	
	function update($id, $data, $table){
		$id = $this->db->escape_str($id);
		// TODO controllo se quel esercizio appartiene all'azienda che ha fatto login
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	}
}