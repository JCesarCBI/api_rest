<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	 
	class Ssac_model extends CI_Model {
			
		function __construct() {
			parent::__construct();
		}
		
		public function get($folio = NULL)
		{
			if (!is_null($folio)) {
				$query = $this->db->SELECT("*")->FROM("ssac")->WHERE("folio", $folio)->get();
				if ($query->num_rows() === 1) {
					return $query->row_array();
				}
				return NULL;
			}
			$query = $this->db->SELECT("*")->FROM("ssac")->get();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
			return NULL;
		}
		
		public function save($ssac)
		{
			$this->db->set(
				$this->_setSsac($ssac))
			->insert("ssac", $ssac);
			if ($this->db->affected_rows() === 1) {
				return $this->db->insert_id();
			}
			return NULL;
		}
		
		
		function _setSsac($ssac)
		{
			return array(
			"folio" => $ssac["folio"],
			"nombre" => $ssac["nombre"],
			"ape_paterno" => $ssac["ape_paterno"],
			"ape_materno" => $ssac["ape_materno"],
			"id_sexo" => $ssac["id_sexo"],
			"email" => $ssac["email"],
			"calle" => $ssac["calle"],
			"num_ext" => $ssac["num_ext"],
			"num_int" => $ssac["num_int"],
			"id_cp" => $ssac["id_cp"],
			"geo_lat" => $ssac["geo_lat"],
			"geo_long" => $ssac["geo_long"],
			"solicitud" => $ssac["solicitud"],
			"fecha" => $ssac["fecha"],
			"hora" => $ssac["hora"]
			);
		}
	}
?>