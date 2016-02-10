<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_condomini extends CI_Model {
	
	function get_condomini($idAzienda){
		$res = $this->db->query('SELECT id, nome FROM condomini WHERE id_azienda = '.$idAzienda.' ORDER BY nome');
		$res = $res->result_array();
		return $res;
	}
	
	function get_condominio($idCondominio){
		// TODO controllo se quel condominio appartiene all'azienda che ha fatto login
		$idCondominio = $this->db->escape_str($idCondominio);
		
		$res = $this->db->query('SELECT * FROM condomini WHERE id = '.$idCondominio);
		$res = $res->result_array();
		if(isset($res[0]))
			return $res[0];
		else
			return array();
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
	
	function get_palazzine($idCondominio){
		// TODO controllo se quel condominio appartiene all'azienda che ha fatto login
		$idCondominio = $this->db->escape_str($idCondominio);
		$res = $this->db->query('SELECT * FROM palazzine WHERE id_condominio = '.$idCondominio.' ORDER BY descrizione');
		$res = $res->result_array();
		return $res;
	}
	
	function get_gruppi($idCondominio){
		// TODO controllo se quel condominio appartiene all'azienda che ha fatto login
		$idCondominio = $this->db->escape_str($idCondominio);
		$res = $this->db->query('SELECT g.id, g.descrizione, g.id_palazzina 
						FROM palazzine p, gruppi g WHERE p.id=g.id_palazzina AND id_condominio = '.$idCondominio.' ORDER BY g.id_palazzina, g.descrizione');
		$res = $res->result_array();
		return $res;
	}
	
	function set_null_esercizi($idCondominio){
		$idCondominio = $this->db->escape_str($idCondominio);
		// TODO controllo se quel condominio appartiene all'azienda che ha fatto login
		$this->db->where('id_condominio', $idCondominio);
		$this->db->update('esercizi', array('id_tabella_straordinari' => NULL, 'id_tabella_acquedotto' => NULL));
	}
}