<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiModel extends CI_Model
{
    var $client_service = "frontend-deguclient";
    var $auth_key       = "BigBoss_2020";

    public function check_auth_client(){
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);
        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            return json_encode(array('status' => 401,'message' => 'Unauthorized.'));
        }
    }  
    public function getMenus($id)
    {  
        $this->db->where('businessid', $id);
        $query = $this->db->select("businessid as hotel_id, itemname as name,price,image,description")->get('business_items');
        return array('status' => 200,'menulist' => $query->result());
      
    }
    public function checkEmailExist($email){
       $this->db->where('email', $email);
       $query = $this->db->select("*")->get('customer_base');
       return $query->row();
    }
    public function customerRegistration($data){
        $id= $this->db->insert('customer_base',$data);
        if($id){
            return array('status' => 200,'message' => "Registration Successfully!");
        }
        else{
            return array('status' => 400,'message' => "Error Occured!");
        }
    }

    public function customerLogin($email, $pass)
    {
       $this->db->where('email', $email);
       $this->db->where('password', md5($pass));
       $this->db->where('status', 'Active');
       $query = $this->db->select("title, fname,lname,email,device_type,logintype")->get('customer_base');
       return array('status' => 200,'userdetails' => $query->row());
    }

    public function customerFacebookGoogleLogin($data)
    {
       $id= $this->checkEmailExist($data['email']);
       if($id){
           $this->db->where('email', $data['email']);          
           $this->db->where('status', 'Active');
           $query = $this->db->select("id,title, fname,lname,email,device_type,logintype")->get('customer_base');
           return array('status' => 200,'userdetails' => $query->row());
        }
       else{
            $reg= $this->db->insert('customer_base',$data);
            if($reg){
               $this->db->where('email', $data['email']);          
               $this->db->where('status', 'Active');
               $query = $this->db->select("title, fname,lname,email,device_type,logintype")->get('customer_base');
               return array('status' => 200,'userdetails' => $query->row());
            }
            else{
                return array('status' => 400,'message' => "Error Occured!");
            }
       }
    }

    public function gerServices(){ 
        $this->db->where('status', 'Active'); 
        $this->db->where('type','Business');         
        $query = $this->db->select("serviceid,servicename")->get('services');
        return array('status' => 200,'servicelist' => $query->result());
    }
    public function getMedicalServices(){ 
      $this->db->where('status', 'Active');
      $this->db->where('type','Medical');
      $query = $this->db->select("serviceid,servicename")->get('services');
      return array('status' => 200,'servicelist' => $query->result());
    }
    public function getRestaurant(){ 
      $this->db->where('status', 'Active');
      $this->db->where('type','Restaurant'); 
      $query = $this->db->select("serviceid,servicename")->get('services');
      return array('status' => 200,'servicelist' => $query->result());
    }
    public function getNotProfit(){ 
      $this->db->where('status', 'Active');
      $this->db->where('type','NonProfit'); 
      $query = $this->db->select("serviceid,servicename")->get('services');
      return array('status' => 200,'servicelist' => $query->result());
    }

    public function getServiceBusinessList($id){
      $this->db->where('status', 'Active');
      $this->db->where('serviceid',$id); 
      $query = $this->db->select("businessid,name,address,websiteurl,image")->get('business');
      return array('status' => 200,'businesslist' => $query->result());
    }

    public function makeAnAppointment($data){
      $id= $this->db->insert('business_appointment',$data);
      if($id){
          return array('status' => 200,'message' => "Make Appointment Successfully!");
      }
      else{
          return array('status' => 400,'message' => "Error Occured!");
      }
    }

    public function getTimeSlot(){
      $this->db->where('status', 'Active');
      $query = $this->db->select("timeslotid,formtime,totime")->get('timeslot');
      return array('status' => 200,'timeslot' => $query->result());
    }

     public function addCustomerAddress($data){
      $id= $this->db->insert('customer_address',$data);
      if($id){
          return array('status' => 200,'message' => "Address Added Successfully!");
      }
      else{
          return array('status' => 400,'message' => "Error Occured!");
      }
    }
   public function updateCustomerAddress($data){
      $id= $this->db->update('customer_address',$data);
      if($id){
          return array('status' => 200,'message' => "update Added Successfully!");
      }
      else{
          return array('status' => 400,'message' => "Error Occured!");
      }
    }
      public function deleteCustomerAddress($data){
      $id= $this->db->delete('customer_address',$data);
      if($id){
          return array('status' => 200,'message' => "Deleted Successfully!");
      }
      else{
          return array('status' => 400,'message' => "Error Occured!");
      }
    }
  

     public function restaurantOrders($data){
      $id= $this->db->insert('business_orders',$data);
      if($id){
          return array('status' => 200,'message' => "Order Successfully Placed!");
      }
      else{
          return array('status' => 400,'message' => "Error Occured!");
      }
    }

    // public function cutomerWiseOrderDetails($data){
    //      $this->db->where('userid', $id);
    //     $query = $this->db->select("id as customer_id, fname,")->get('customer_base');
    //     return array('status' => 200,'cutomerorderlist' => $query->result());
    // }

    public function cutomerWiseOrderDetails($id){
        $this->db->where('user_id', $id);
        $query = $this->db->select("order_id,businessid,add_id,products,carddetailsid,timeslotid,taxid,transaction_id, transaction_amount, transaction_date, payment_type, payment_status,order_status, order_type")->get('business_orders');
        $orders= $query->result();
        
        foreach($orders as $order){
            $products=json_decode($order->products);           
            $prod_final=array();
            foreach($products as $pro){
                $this->db->where('business_items.itemid', $pro->item_id);
                $query = $this->db->select("business_items.itemid, business_items.itemname,business_items.image,business_items.description,business_items.price")->get('business_items');              
                $prod_final[]= $query->row_array();
               
            }     
            $business=$this->db->select('name')->from('business')->where('businessid',$order->businessid)->get()->row();  
            $customer_address=$this->db->select('email, firstname, lastname, phonenumber')->from('customer_address')->where('add_id',$order->add_id)->get()->row(); 
            $customer_card_details=$this->db->select('cartnumber,expirydate,cvv,zipcode')->from('customer_card_details')->where('carddetailsid
              ',$order->carddetailsid)->get()->row(); 
             $timeslotid=$this->db->select('formtime,totime')->from('timeslot')->where('timeslotid',$order->timeslotid)->get()->row();
              $taxid=$this->db->select('taxname,percentage')->from('tax')->where('taxid',$order->taxid)->get()->row(); 
            $finalarr[]=array(
                        "order_id"=>$order->order_id,
                        "transaction_id"=>$order->transaction_id,
                        "transaction_amount"=>$order->transaction_amount,
                        "transaction_date"=>$order->transaction_date,
                        "payment_type"=>$order->payment_type,
                        "payment_status"=>$order->payment_status,
                        "order_type"=>$order->order_type,
                        "order_status"=>$order->order_status,
                        "businessid"=>$order->businessid,
                        "business_name"=>$business->name,
                        "products"=>$prod_final,
                        "adderess"=>$customer_address,
                        "payment_deatils"=> $customer_card_details,
                        "timeslot"=>$timeslotid,
                        "tax"=>$taxid
            );            
        }
        return $finalarr;
    }



    public function businessWiseOrderDetails($id){
        $this->db->where('businessid', $id);
        $query = $this->db->select("order_id,businessid,products,transaction_id,user_id, transaction_amount, transaction_date, payment_type, payment_status,order_status, order_type")->get('business_orders');
        $orders= $query->result();
        
        foreach($orders as $order){
            $products=json_decode($order->products);           
            $prod_final=array();
            foreach($products as $pro){
                $this->db->where('business_items.itemid', $pro->item_id);
                $query = $this->db->select("business_items.itemid, business_items.itemname,business_items.image,business_items.description,business_items.price")->get('business_items');              
                $prod_final[]= $query->row_array();
               
            }     
            $business=$this->db->select('user_id')->from('business_orders')->where('user_id',$order->user_id)->get()->row();
           $customer_address=$this->db->select('email, firstname, lastname, phonenumber')->from('customer_address')->where('add_id',$order->add_id)->get()->row(); 
           $customer_card_details=$this->db->select('cartnumber,expirydate,cvv,zipcode')->from('customer_card_details')->where('carddetailsid
              ',$order->carddetailsid)->get()->row(); 
           $timeslotid=$this->db->select('formtime,totime')->from('timeslot')->where('timeslotid',$order->timeslotid)->get()->row();
                 $taxid=$this->db->select('taxname,percentage')->from('tax')->where('taxid',$order->taxid)->get()->row(); 
           $finalarr[]=array(
                        "order_id"=>$order->order_id,
                        "transaction_id"=>$order->transaction_id,
                        "transaction_amount"=>$order->transaction_amount,
                        "transaction_date"=>$order->transaction_date,
                        "payment_type"=>$order->payment_type,
                        "payment_status"=>$order->payment_status,
                        "order_type"=>$order->order_type,
                        "order_status"=>$order->order_status,
                        "businessid"=>$order->businessid,
                        "user_name"=>$business->user_id,
                        "products"=>$prod_final,
                        "adderess"=>$customer_address,
                        "payment_deatils"=> $customer_card_details,
                        "timeslot"=>$timeslotid,
                        "tax"=>$taxid
            );            
        }
        return $finalarr;
    }
     public function getRestautrantCategory($id){
      $this->db->where('status', 'Active');
      $this->db->where('businessid',$id); 
      $query = $this->db->select("item_catid,cat_name")->get('item_category');
      return array('status' => 200,'itemlist' => $query->result());
    }



 public function addCustPaymentDetails($data){
      $id= $this->db->insert('customer_card_details',$data);
      if($id){
          return array('status' => 200,'message' => "Details added Successfully!");
      }
      else{
          return array('status' => 400,'message' => "Error Occured!");
      }
    }
     public function updateCustPaymentDetails($data){
      $id= $this->db->update('customer_card_details',$data);
      if($id){
          return array('status' => 200,'message' => "update Successfully!");
      }
      else{
          return array('status' => 400,'message' => "Error Occured!");
      }
    }
      public function deleteCustPaymentDetails($data){
      $id= $this->db->delete('customer_card_details',$data);
      if($id){
          return array('status' => 200,'message' => "Deleted Successfully!");
      }
      else{
          return array('status' => 400,'message' => "Error Occured!");
      }
    }
  
  
    public function getMenuLists($id){
      $this->db->where('status', 'Active');
      $this->db->where('itemid',$id); 
      $query = $this->db->select("businessid,itemname")->get('business_items');
      return array('status' => 200,'menulist' => $query->result());
    }

}
