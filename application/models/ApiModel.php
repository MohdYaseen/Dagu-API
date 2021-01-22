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
  
}
