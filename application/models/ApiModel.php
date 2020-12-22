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
  
}
