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
                    $resp = $this->api->getMenus($params['hotel_id']);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }       
    }

    public function customerRegistration()
    {   
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
               
                $params = json_decode(file_get_contents('php://input'), TRUE);              
                $exist = $this->api->checkEmailExist($params['email']);
                if($exist){
                    $resp = array('status' => 400,'message' =>  'Email ID already exist');
                }
                else{
                    if ($params['title'] == "") {                    
                        $resp = array('status' => 400,'message' =>  'Title is Required');
                     } 
                    else if ($params['fname'] == "") {                    
                        $resp = array('status' => 400,'message' =>  'First Name is Required');
                    }
                    else if ($params['lname'] == "") {                    
                        $resp = array('status' => 400,'message' =>  'Last Name is Required');
                    }
                    else if ($params['email'] == "") {                    
                        $resp = array('status' => 400,'message' =>  'Email ID is Required');
                    }
                    else if ($params['password'] == "") {                    
                        $resp = array('status' => 400,'message' =>  'Password is Required');
                    }                                
                    else if ($params['device_type'] == "") {                    
                        $resp = array('status' => 400,'message' =>  'Device type is Required');
                    }                              
                    else {                 
                        $data = array('title' => $params['title'], 
                                      'fname' => $params['fname'],
                                      'lname' => $params['lname'],
                                      'email' => $params['email'],
                                      'password' => md5($params['password']),
                                      'device_type' => $params['device_type']                               
                                    );
                        $resp = $this->api->customerRegistration($data);
                    }
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }       
    }
    public function customerLogin()
    {   
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client();
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
               if ($params['email'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Email ID is Required');
                }               
                else if ($params['password'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Password is Required');
                }                
                else {
                   
                    $resp = $this->api->customerLogin($params['email'],$params['password']);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }       
    }
    public function customerFacebookGoogleLogin()
    {
       $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client();
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                if ($params['email'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Email ID is Required');
                }
                else if ($params['device_type'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Device type is Required');
                }     
                else if ($params['logintype'] == "") {
                    $resp = array('status' => 400,'message' =>  'Login type is Required');  
                }  
                else {
                     $data = array(
                                'email' => $params['email'],
                                'logintype' => $params['logintype'], 
                                'device_type' => $params['device_type']                               
                            );
                    $resp = $this->api->customerFacebookGoogleLogin($data);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }    
    }

    public function gerServices()
    {
       $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client();
            if($check_auth_client === true){
                $resp = $this->api->gerServices();               
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }    
    }
  
  public function getMedicalServices()
  {
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'GET'){
        echo json_encode(array('status' => 400,'message' => 'Bad request.'));
    } 
    else {
        $check_auth_client = $this->api->check_auth_client();
        if($check_auth_client === true){
            $resp = $this->api->getMedicalServices();               
            echo json_encode($resp);
        }
       else{
        echo $check_auth_client;
       }
    }    
  }

  public function getRestaurant()
  {
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'GET'){
        echo json_encode(array('status' => 400,'message' => 'Bad request.'));
    } 
    else {
        $check_auth_client = $this->api->check_auth_client();
        if($check_auth_client === true){
            $resp = $this->api->getRestaurant();               
            echo json_encode($resp);
        }
       else{
        echo $check_auth_client;
       }
    }    
  }
  public function getNotProfit()
  {
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'GET'){
        echo json_encode(array('status' => 400,'message' => 'Bad request.'));
    } 
    else {
        $check_auth_client = $this->api->check_auth_client();
        if($check_auth_client === true){
            $resp = $this->api->getNotProfit();               
            echo json_encode($resp);
        }
       else{
        echo $check_auth_client;
       }
    }    
  }
  
  public function getServiceBusinessList()
    {           
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                if ($params['serviceid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Service ID is Required');
                 } 
                 else {
                    $resp = $this->api->getServiceBusinessList($params['serviceid']);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }       
    }

    public function makeAnAppointment()
    {           
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                if ($params['serviceid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Service ID is Required');
                 } 
                 else {
                    $resp = $this->api->getServiceBusinessList($params['serviceid']);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }       
    }

     public function restaurantOrders()
    {           
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                if ($params['serviceid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Service ID is Required');
                 } 
                 else {
                    $resp = $this->api->getServiceBusinessList($params['serviceid']);
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