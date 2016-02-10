<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_login extends CI_Model {
	
	function get_utente($idUtente){
		$res = $this->db->query('SELECT u.username, u.id_azienda, e.id_condominio, e.id AS id_esercizio
								FROM utenti u, aziende a, condomini c, esercizi e
								WHERE u.id_azienda=a.id AND a.id=c.id_azienda AND c.id=e.id_condominio AND
								u.id = '.$idUtente.' ORDER BY c.nome, e.data_inizio, e.data_fine');
		$res = $res->result_array();
		if(isset($res[0]))
			return $res[0];
		else
			return array();
	}
	
	function test_login($username, $password){
		$username = $this->db->escape_str($username);
		$password = $this->db->escape_str($password);
		$res = $this->db->query("SELECT id
								FROM utenti
								WHERE username = '".$username."' AND password = '".$password."'");
		$res = $res->result_array();
		return (isset($res[0]))? $res[0]['id'] : 0;
	}
}