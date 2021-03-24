<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apis extends CI_Controller {

    public function __construct()   {
        parent::__construct();
        header('Content-Type: Application/json'); 
        $this->load->model('ApiModel', 'api');
  
    }
   
    public function getRestautrantMenu(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
            $params = json_decode(file_get_contents('php://input'), TRUE); 
               if ($params['hotel_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Business ID is Required');
                 }                 
                 else {
                    $resp = $this->api->getRestautrantMenu($params['hotel_id']);
                }
                echo json_encode($resp);
           }
           else{
            echo $check_auth_client;
           }
        }
    }
    public function getMenuItems()
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
                if ($params['item_catid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Category ID is Required');
                 } 
                 else {
                    $resp = $this->api->getMenuItems($params['hotel_id'],$params['item_catid']);
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

    public function getBusiness()
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
                if ($params['businessid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Business ID is Required');
                 } 
                 else if ($params['firstname'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'First Name is Required');
                 } 
                 else if ($params['lastname'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Last Name is Required');
                 } 
                 else if ($params['email'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Email is Required');
                 }                 
                 else if ($params['phonenumber'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Phone Number is Required');
                 } 
                else if ($params['comment'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Comment is Required');
                 }                 
                 else {
                    $resp = $this->api->makeAnAppointment($params);
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
                if ($params['user_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'User ID is Required');
                 } 
                 else if ($params['businessid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'business ID is Required');
                 }  
                   else if ($params['add_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Address ID is Required');
                 } 
                   else if ($params['timeslotid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Timeslot ID is Required');
                 } 
                  else if ($params['taxid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Tax ID is Required');
                 } 
                   else if ($params['carddetailsid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Payment ID is Required');
                 }                  
                 else if ($params['products'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Products  is Required');
                 } 
                 else if ($params['transaction_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'transaction_id is Required');
                 } 
                 else if ($params['transaction_amount'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'transaction amount is Required');
                 } 
                 else if ($params['transaction_date'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'transaction date is Required');
                 } 
                 else if ($params['payment_type'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'payment type is Required');
                 } 
                 else if ($params['payment_status'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'payment status is Required');
                 } 
                 else if ($params['order_type'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'order type is Required');
                 } 
                
                 else {
                    $params['products'] = json_encode($params['products']);
                    $resp = $this->api->restaurantOrders($params);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }       
    }
    public function getTaxes()
    {           
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){              
                $resp = $this->api->getTaxes();               
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }       
    }
    public function getTimeSlot()
    {           
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){              
                $resp = $this->api->getTimeSlot();               
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }       
    }


    public function cutomerWiseOrderDetails(){
           $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
            $params = json_decode(file_get_contents('php://input'), TRUE); 
             if ($params['user_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'customer ID is Required');
                 } 
                 else{
                    $resp = $this->api->cutomerWiseOrderDetails($params['user_id']);
                 }
              
                echo json_encode($resp);
           }
           else{
            echo $check_auth_client;
           }
       }

}
    public function businessWiseOrderDetails(){
           $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
            $params = json_decode(file_get_contents('php://input'), TRUE); 
             if ($params['businessid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'customer ID is Required');
                 } 
                 else{
                    $resp = $this->api->businessWiseOrderDetails($params['businessid']);
                 }
              
                echo json_encode($resp);
           }
           else{
            echo $check_auth_client;
           }
       }

}
    
    public function addCustomerAddress(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE);               
                if ($params['user_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'User ID is Required');
                 } 
                 else if ($params['firstname'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'First Name is Required');
                 } 
                 else if ($params['lastname'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Last Name is Required');
                 } 
                 else if ($params['email'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Email is Required');
                 }                 
                 else if ($params['phonenumber'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Phone Number is Required');
                 }                               
                 else {
                    $resp = $this->api->addCustomerAddress($params);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }   
    }


    public function updateCustomerAddress(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE); 
                 if ($params['add_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Address ID is Required');
                 }              
                else if ($params['user_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'User ID is Required');
                 } 
                 else if ($params['firstname'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'First Name is Required');
                 } 
                 else if ($params['lastname'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Last Name is Required');
                 } 
                 else if ($params['email'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Email is Required');
                 }                 
                 else if ($params['phonenumber'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Phone Number is Required');
                 }                               
                 else {
                    $resp = $this->api->updateCustomerAddress($params);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }   
    }
   

     public function deleteCustomerAddress(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE); 
                 if ($params['add_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Address ID is Required');
                 }                                   
                 else {
                    $resp = $this->api->deleteCustomerAddress($params['add_id']);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }   
    }

    public function getCustomerAddress(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE);               
                if ($params['user_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'User ID is Required');
                 }                                             
                 else {
                    $resp = $this->api->getCustomerAddress($params['user_id']);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }   
    }
        public function addCustPaymentDetails(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE);               
                if ($params['user_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'User ID is Required');
                 } 
                 else if ($params['cartnumber'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'cart number is Required');
                 } 
                 else if ($params['expirydate'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'expiry date is Required');
                 } 
                 else if ($params['cvv'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'CVV is Required');
                 }                 
                 else if ($params['zipcode'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'zipcode is Required');
                 }                               
                 else {
                    $resp = $this->api->addCustPaymentDetails($params);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }   
    }
    public function updateCustPaymentDetails(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE);   
                 if ($params['carddetailsid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'card id is Required');
                 }             
                else if ($params['user_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'User ID is Required');
                 } 
                 else if ($params['cartnumber'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'cart number is Required');
                 } 
                 else if ($params['expirydate'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'expiry date is Required');
                 } 
                 else if ($params['cvv'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'CVV is Required');
                 }                 
                 else if ($params['zipcode'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'zipcode is Required');
                 }                               
                 else {
                    $resp = $this->api->updateCustPaymentDetails($params);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }   
    }


      public function deleteCustPaymentDetails(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE); 
                 if ($params['carddetailsid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'card ID is Required');
                 }                                   
                 else {
                    $resp = $this->api->deleteCustPaymentDetails($params['carddetailsid']);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }   
    }

    public function getCustPaymentDetails(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE); 
                 if ($params['user_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'card ID is Required');
                 }                                   
                 else {
                    $resp = $this->api->getCustPaymentDetails($params['user_id']);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }   
    }

    public function applyCouponcode(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
            $params = json_decode(file_get_contents('php://input'), TRUE); 
               if ($params['couponcode'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Couponcode is Required');
                 } 
                 else {
                    $resp = $this->api->applyCouponcode($params['couponcode']);
                }
                echo json_encode($resp);
           }
           else{
            echo $check_auth_client;
           }
       }

}


        public function addWishlist(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE);               
                if ($params['user_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'User ID is Required');
                 } 
                 else if ($params['itemid'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'cart number is Required');
                 }                       
                 else {                   
                    $resp = $this->api->addWishlist($params);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }   
    }
     public function getWishlist()
    {           
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            echo json_encode(array('status' => 400,'message' => 'Bad request.'));
        } 
        else {
            $check_auth_client = $this->api->check_auth_client(); 
            if($check_auth_client === true){
                $params = json_decode(file_get_contents('php://input'), TRUE);
                if ($params['user_id'] == "") {                    
                    $resp = array('status' => 400,'message' =>  'Hotel ID is Required');
                 } 
                 else {
                    $resp = $this->api->getWishlist($params['user_id']);
                }
                echo json_encode($resp);
            }
           else{
            echo $check_auth_client;
           }
        }       
    }

    public function getNonProfitServices(){
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
                    $resp = $this->api->getNonProfitServices($params['serviceid']);
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