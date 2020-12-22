<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apis extends CI_Controller {

	public function __construct()	{
		parent::__construct();
		header('Content-Type: Application/json'); 
        $this->load->model('ApiModel', 'api');
  
	}
	
	public function getMenus()
    {   

        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 

            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                if ($params['hotel_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Hotel ID is Required');
                 } 
                 else {
                    $resp = $this->api->getMenus($params['hotel_id']);;
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }       
    }
  
	
}

/* End of file Apis.php */
/* Location: ./application/controllers/Apis.php */