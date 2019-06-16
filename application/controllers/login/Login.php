<?php
defined('BASEPATH') or exit('No direct access allowed');

class Login extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
//		$this->load->library('guzzle');
	}
	
	public function index(){
		$form_param = 
			array(
				'name' => null,
				'pass' => 'wayne',
				'type' => 'USER'
			);
		
//		$data['data'] = json_decode($this->guzzle_get("/api/user",null,"GET", null, null));
		$data['data'] = json_decode($this->guzzle_get("/api/user",null,"POST", null, $form_param));
		$this->load->view('login/login', $data);
	}
	
	public function insert(){
		
		$this->load->view('login/login');
	}
	
	public function guzzle_get($url, $uri, $method, $body, $form_param){
		$resturl = "http://localhost:8090/pesantren/pesantren-restcore";
		$resturl = $resturl . $url;
		$client = new GuzzleHttp\Client(['base_uri' => $resturl]);
		
		$response = null;
		
		if($method === "GET"){
			$response = $client->request('GET',$uri, 
				array(
					'auth' => 
						array(
							'admin',
							'1234'
						),
					'headers' => 
						array(
							'X-API-KEY' => 'CODEX@123'
						)
				));
		}
		else if($method === "POST"){
			$response = $client->request('POST',$uri, 
				array(
					'auth' => 
						array(
							'admin',
							'1234'
						),
					'headers' => 
						array(
							'X-API-KEY' => 'CODEX@123'
						),
					'body' => $body,
					'form_params' => $form_param
				));
		}
		else if($method === "PUT"){
			$response = $client->request('PUT',$uri, 
				array(
					'auth' => 
						array(
							'admin',
							'1234'
						),
					'headers' => 
						array(
							'X-API-KEY' => 'CODEX@123'
						),
					'body' => $body,
					'form_params' => 
						array(
							'name' => $form_param['name'],
							'pass' => $form_param['pass'],
							'type' => $form_param['type']
						)
				));
		}
		
		return $response->getBody()->getContents();
	}
	
}

?>