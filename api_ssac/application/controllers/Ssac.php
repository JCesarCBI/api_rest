<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * 
	 */
	
	require(APPPATH.'/libraries/REST_Controller.php');
	
	class Ssac extends REST_Controller {
			
		function __construct() {
			parent::__construct();
			$this->load->model('ssac_model');
		}
		
		public function index_get()
		{
			$ssac = $this->ssac_model->get();
			
			if (!is_null($ssac)) {
				$this->response(array("response" => $ssac), 200);
			} else {
				$this->response(array("error" => "No hay ssacs"), 404);
			}	
		}
		
		public function find_get($folio)
		{
			if (!$folio) {
				$this->response(NULL, 400);
			}
			$ssac = $this->ssac_model->get($folio);
			
			if (!is_null($ssac)) {
				$this->response(array("response" => $ssac), 200);
			} else {
				$this->response(array("error" => "No se encuentra el ssac"), 404);
			}	
		}
		
		public function index_post()
		{
			if (! $this->post()) {
				$this->response('SSAC vacio', 400);
			}
			
			$ssac_id = $this->ssac_model->save($this->post());
			
			if (!is_null($ssac_id)) {
				$this->response(array("response" => $ssac_id), 200);
			} else {
				$this->response(array("error" => "Ha ocurrido un error"), 400);
			}
		}
		
	}
	
?>