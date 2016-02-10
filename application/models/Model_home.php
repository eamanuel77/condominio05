<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_home extends CI_Model {
	
	function get_non_pagate(){
		$res = $this->db->query("SELECT t.nome, DATE_FORMAT(data_competenza, '%d/%m/%Y') AS data_competenza, importo,
									CONCAT(c.nome, ' > ', DATE_FORMAT(e.data_inizio, '%d/%m/%Y'), ' - ', DATE_FORMAT(e.data_fine, '%d/%m/%Y')) AS esercizio
								FROM transazioni t, esercizi e, condomini c
								WHERE t.id_esercizio=e.id AND e.id_condominio=c.id AND
								pagato=0 ORDER BY data_competenza");
		$res = $res->result_array();
		return $res;
	}
	
	function get_scadenze_rate(){
		$ret = array();
		// for each condomini (totale preventivo, nome condominio) on each esercizio
		$res = $this->db->query("SELECT co.id, co.nome, SUM(s.importo) AS totale_preventivo
								FROM condomini co, esercizi e, categorie c, sottocategorie s
								WHERE co.id=e.id_condominio AND e.id=c.id_esercizio AND c.id=s.id_categoria
								GROUP BY co.id"); // per esercizio??
		$res = $res->result_array();
		foreach($res as $value){
			$res1 = $this->db->query("SELECT r.id, CONCAT(p.cognome, p.nome) AS nome, r.id_unita, u.frequenza_rate, SUM(quota/millesimi) AS frazione_millesimi, totale_versato
									FROM relazioni_unita r, persone p, unita u, dati_tabella d, (
																									SELECT id_tabella, SUM(quota) AS millesimi
																									FROM dati_tabella
																									GROUP BY id_tabella
																								) mt,
																								(
																									SELECT id_relazione_unita, SUM(importo) AS totale_versato
																									FROM transazioni t
																									WHERE tipo_rata='ORDINARIA' AND tipo='RATA' AND pagato=1
																									GROUP BY id_relazione_unita /* ///////// per esercizio??? */
																								) t
									WHERE p.id=r.id_persona AND r.id_unita=u.id AND d.id_relazione_unita=r.id AND mt.id_tabella=d.id_tabella AND
									(r.rapporto='PROPRIETARIO' OR r.rapporto='CONDUTTORE') AND u.id IN (
																									SELECT u.id
																									FROM unita u, gruppi g, palazzine pa
																									WHERE u.id_gruppo=g.id AND g.id_palazzina=pa.id AND pa.id_condominio=".$value['id']."
																								)
									GROUP BY r.id");
			$res1 = $res1->result_array();
			
		}
			// for each proprietario/conduttore ( nome, id_unita, versato, frazione millessimi)
			// for each res
				// moltiplico frazione millesimi per totale preventivo
				// genero la rata in base al tipo di frazionamento rate
				// vedo il mese corrente e calcolo quanti mesi sono passati dall'inizio dell'anno
				// converto i mesi passati in numero di rate da pagare
				// calcolo il totale che doveva pagare fin ora
				// se ha versato meno del previsto lo aggiungo all'array ret
		
		return $ret;
	}
}