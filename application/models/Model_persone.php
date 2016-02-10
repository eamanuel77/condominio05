<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_persone extends CI_Model {
	
	function get_persone($idCondominio){
		$idCondominio = $this->db->escape_str($idCondominio);
		$res = $this->db->query('SELECT id, nome, cognome FROM persone WHERE id_condominio = '.$idCondominio.' ORDER BY cognome, nome');
		$res = $res->result_array();
		return $res;
	}
	
	function get_persona($idPersona){
		// TODO test che quella persona appartiene all'azienda
		$this->load->library('utils');
		$idPersona = $this->db->escape_str($idPersona);
		$res = $this->db->query('SELECT * FROM persone WHERE id = '.$idPersona);
		$res = $res->result_array();
		if(isset($res[0])){
			$res[0]['data_nascita'] = $this->utils->data_sql_to_php($res[0]['data_nascita']);
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