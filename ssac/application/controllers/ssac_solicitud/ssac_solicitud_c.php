<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ssac_solicitud_c extends CI_Controller {
	public function __construct() {
		parent::__construct();
    	 $this->load->library(array('user_agent')); 
    	//$this->load->model('login_m');
    }

    /**
    * index: Carga la vista de sesión para poder iniciar sesión.
    * @param  [] []
    * @return [] 
    * @author [ALEJ ] <[netochuy23@gmail.com]>
    * @version [1.0] [ssac-CDMX]
    **/
	function index(){
        $cat_sexo=$this->etiquetas->cat_sexo();
        $datos['cat_sexo']=$cat_sexo;
        $dentro_df_solicitud=$this->etiquetas->dentro_df_solicitud();
        $datos['dentro_df_solicitud']=$dentro_df_solicitud;
       
        if($this->agent->mobile()){
            $datos['es_mobil']=1;
        }else{
            $datos['es_mobil']=0;
        }

		$this->load->view('ssac_solicitud/cabecera_solicitud_v');
		$this->load->view('ssac_solicitud/solicitud_v',$datos);
		$this->load->view('ssac_solicitud/footer_solicitud_v');
	}

	public function traer_rango_edades(){
		$username = 'admin';
		$password = '1234';
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_URL, 'http://localhost/ssac/api_ssac/index.php/ssac/edades');  
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$edades = json_decode(curl_exec($ch),true);
						
		// echo('<pre>');
			// var_dump($data);
		// echo('</pre>');
										
		curl_close($ch);
	}
	
	public function traer_colonias_delegacion(){
		if(isset($_POST['cp'])){
			$cp=$_POST['cp'];
			// $cp = '01110';
			
			$username = 'admin';
			$password = '1234';
				
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
  			curl_setopt($ch, CURLOPT_URL, 'http://localhost/api_ssac/index.php/ssac/colonias/'.$cp);  
  			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				  
			$colonia_delegacion = json_decode(curl_exec($ch),true);  
				
			// echo('<pre>');
				// var_dump($data);
			// echo('</pre>');  
				
			curl_close($ch);
		}
	}
	
	public function guardar_ssac() {
		$fecha_actual = date('Y-m-d');
		$hora_actual = date("H:i:s");
		
		$postData = array(
			'id_ssac' => '1',
			'id_cat_edad' => '4',
			'id_cat_delegacion' => '5',
			'id_colonia' => '659',
			'nombre_solicitante' => 'Cesar',
			'ape_paterno_solicitante' => 'Padilla',
			'ape_materno_solicitante' => 'Dorantes',
			'es_mujer' => '1',
			'email_solicitante' => 'jcesarcbi@gmail.com',
			'codigo_postal_solicitante' => '04910',
			'calle_solicitud' => 'María Luisa Martinez',
			'num_ext_solicitud' => 'Mz. 44 Lt. 4',
			'num_int_solicitud' => '',
			'geo_latitud' => '19.320293',
			'geo_longitud' => '-99.109946',
			'descripcion_solicitud' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce consequat erat et lectus efficitur, non hendrerit sapien volutpat. Aenean nibh dui, molestie sed egestas id, interdum a nulla. Nunc justo enim, molestie ut sodales in, euismod vitae nisi. Nulla semper laoreet metus, quis vehicula lectus lacinia id. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus id neque felis. In tincidunt arcu id nulla mattis, ut gravida lectus euismod. Mauris porta tortor lacus, ut pretium elit tincidunt a.',
			'fecha_solicitud' => $fecha_actual,
			'hora_solicitud' => $hora_actual,
			'estatus' => '1'
		);
			
		$username = 'admin';
    	$password = '1234';
						
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($ch, CURLOPT_URL, "http://localhost/ssac/api_ssac/index.php/ssac");  
		curl_setopt($ch, CURLOPT_HEADER, FALSE);  
		curl_setopt($ch, CURLOPT_POST, TRUE);  
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				
		$data = json_decode(curl_exec($ch),true);
			
		// echo('<pre>');
				// var_dump($data);
		// echo('</pre>');
			
		curl_close($ch);
	}

}/*Fin controlador*/