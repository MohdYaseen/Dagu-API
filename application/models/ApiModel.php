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
            return json_encode(array('statusCode' => 401,'errorMessage' => 'Unauthenticated user.'));
        }
    }  
    public function getRestautrantMenu($id){
      $this->db->where('status', 'Active');
      $this->db->where('businessid',$id); 
      $query = $this->db->select("item_catid,cat_name")->get('item_category');
      return array('statusCode' => 200,'response'=>array('itemlist' => $query->result()));
    } 
    public function getMenuItems($id,$item_catid)
    {  
        $this->db->where('businessid', $id);
        $this->db->where('item_catid',$item_catid); 
        $query = $this->db->select("businessid as hotel_id, itemname as name,price,image,description")->get('business_items');
        return array('statusCode' => 200,'response'=>array('menulist' => $query->result()));
      
    }
    public function checkEmailExist($email){
       $this->db->where('email', $email);
       $query = $this->db->select("*")->get('customer_base');
       return $query->row();
    }
    public function customerRegistration($data){
        $id= $this->db->insert('customer_base',$data);
        if($id){
            return array('statusCode' => 200,'response'=>array('Message' => "Registration Successfully!"));
        }
        else{
            return array('statusCode' => 400,'errorMessage' => "Error Occured!");
        }
    }

    public function customerLogin($email, $pass)
    {
       $this->db->where('email', $email);
       $this->db->where('password', md5($pass));
       $this->db->where('status', 'Active');
       $query = $this->db->select("title, fname,lname,email,device_type,logintype")->get('customer_base')->row();
      if($query){
        return array('statusCode' => 200,'response'=>array('userdetails' => $query));
      }
      else{
        return array('statusCode' => 400,'errorMessage' => "Username and Password is not correct!");
      }
    }

    public function customerFacebookGoogleLogin($data)
    {
       $id= $this->checkEmailExist($data['email']);
       if($id){
           $this->db->where('email', $data['email']);          
           $this->db->where('status', 'Active');
            $this->db->where('logintype', $data['logintype']);
           $query = $this->db->select("id,title, fname,lname,email,device_type,logintype")->get('customer_base')->row();
          if($query){
            return array('statusCode' => 200,'response'=>array('userdetails' => $query));
          }
          else{
            return array('statusCode' => 400,'errorMessage' => "Username not correct!");
          }   
        }
       else{
            $reg= $this->db->insert('customer_base',$data);
            if($reg){
               $this->db->where('email', $data['email']);          
               $this->db->where('status', 'Active');
               $query = $this->db->select("title, fname,lname,email,device_type,logintype")->get('customer_base');
               return array('statusCode' => 200,'response'=>array('userdetails' => $query->row()));
            }
            else{
                return array('statusCode' => 400,'errorMessage' => "Error Occured!");
            }
       }
    }

    public function gerServices(){ 
        $this->db->where('status', 'Active'); 
        $this->db->where('type','Business');         
        $query = $this->db->select("serviceid,servicename")->get('services');
        return array('statusCode' => 200,'response'=>array('servicelist' => $query->result()));
    }
    public function getMedicalServices(){ 
      $this->db->where('status', 'Active');
      $this->db->where('type','Medical');
      $query = $this->db->select("serviceid,servicename")->get('services');
      return array('statusCode' => 200,'response'=>array('servicelist' => $query->result()));
    }
    public function getRestaurant(){ 
      $this->db->where('status', 'Active');
      $this->db->where('type','Restaurant'); 
      $query = $this->db->select("serviceid,servicename")->get('services');
      return array('statusCode' => 200,'response'=>array('servicelist' => $query->result()));
    }
    public function getNotProfit(){ 
      $this->db->where('status', 'Active');
      $this->db->where('type','NonProfit'); 
      $query = $this->db->select("serviceid,servicename")->get('services');
      return array('statusCode' => 200,'response'=>array('servicelist' => $query->result()));
    }

    public function getServiceBusinessList($id){
      $this->db->where('status', 'Active');
      $this->db->where('serviceid',$id); 
      $query = $this->db->select("businessid,name,address,websiteurl,image")->get('business');
      return array('statusCode' => 200,'response'=>array('businesslist' => $query->result()));
    }

    public function makeAnAppointment($data){
      $id= $this->db->insert('business_appointment',$data);
      if($id){
          return array('statusCode' => 200,'response'=>array('Message' => "Make Appointment Successfully!"));
      }
      else{
          return array('statusCode' => 400,'errorMessage' => "Error Occured!");
      }
    }

    public function getTimeSlot(){
      $this->db->where('status', 'Active');
      $query = $this->db->select("timeslotid,formtime,totime")->get('timeslot');
      return array('statusCode' => 200,'response'=>array('timeslot' => $query->result()));
    }
     
    public function getTaxes(){
      $this->db->where('status', 'Active');
      $query = $this->db->select("taxid,taxname,percentage")->get('tax');
      return array('statusCode' => 200,'response'=>array('taxlist' => $query->result()));
    }

     public function addCustomerAddress($data){
      $id= $this->db->insert('customer_address',$data);
      if($id){
          return array('statusCode' => 200,'response'=>array('Message' => "Address Added Successfully!"));
      }
      else{
          return array('statusCode' => 400,'errorMessage' => "Error Occured!");
      }
    }
   public function updateCustomerAddress($data){
           $this->db->where('add_id',$data['add_id']);
      $id= $this->db->update('customer_address',$data);
      if($id){
          return array('statusCode' => 200,'response'=>array('Message' => "update Added Successfully!"));
      }
      else{
          return array('statusCode' => 400,'errorMessage' => "Error Occured!");
      }
    }
      public function deleteCustomerAddress($id){
        $this->db->where('add_id',$id);
      $id= $this->db->delete('customer_address');
      if($id){
          return array('statusCode' => 200,'response'=>array('Message' => "Deleted Successfully!"));
      }
      else{
          return array('statusCode' => 400,'errorMessage' => "Error Occured!");
      }
    }
    public function getCustomerAddress($id){   
      $this->db->where('user_id',$id); 
      $query = $this->db->select("add_id,email,firstname,lastname,phonenumber")->get('customer_address');
      return array('statusCode' => 200,'response'=>array('CustomerAddressDetails' => $query->result()));
    }

     public function restaurantOrders($data){
      $id= $this->db->insert('business_orders',$data);
      if($id){
          return array('statusCode' => 200,'response'=>array('Message' => "Order Successfully Placed!"));
      }
      else{
          return array('statusCode' => 400,'errorMessage' => "Error Occured!");
      }
    }

    public function cutomerWiseOrderDetails($id){
        $this->db->where('user_id', $id);
        $query = $this->db->select("order_id,businessid,add_id,products,carddetailsid,timeslotid,taxid,transaction_id, transaction_amount,couponcode,couponcode_id, transaction_date, payment_type, payment_statusCode,order_statusCode, order_type")->get('business_orders');
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
               $couponcode=$this->db->select('couponcode,couponcode_id')->from('couponcode')->where('couponcode_id',$order->couponcode_id)->get()->row(); 
            $finalarr[]=array(
                        "order_id"=>$order->order_id,
                        "transaction_id"=>$order->transaction_id,
                        "transaction_amount"=>$order->transaction_amount,
                        "transaction_date"=>$order->transaction_date,
                        "payment_type"=>$order->payment_type,
                        "payment_statusCode"=>$order->payment_statusCode,
                        "order_type"=>$order->order_type,
                        "order_statusCode"=>$order->order_statusCode,
                        "businessid"=>$order->businessid,
                        "business_name"=>$business->name,
                        "products"=>$prod_final,
                        "adderess"=>$customer_address,
                        "payment_deatils"=> $customer_card_details,
                        "timeslot"=>$timeslotid,
                        "tax"=>$taxid,
                        "couponcode"=>$couponcode
            );            
        }
         return array('statusCode' => 200,'response'=>$finalarr);
       
    }



    public function businessWiseOrderDetails($id){
        $this->db->where('businessid', $id);
        $query = $this->db->select("order_id,businessid,products,transaction_id,user_id,couponcode,couponcode_id, transaction_amount, transaction_date, payment_type, payment_statusCode,order_statusCode, order_type")->get('business_orders');
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
                   $couponcode=$this->db->select('couponcode,couponcode_id')->from('couponcode')->where('couponcode_id',$order->couponcode_id)->get()->row(); 
           $finalarr[]=array(
                        "order_id"=>$order->order_id,
                        "transaction_id"=>$order->transaction_id,
                        "transaction_amount"=>$order->transaction_amount,
                        "transaction_date"=>$order->transaction_date,
                        "payment_type"=>$order->payment_type,
                        "payment_statusCode"=>$order->payment_statusCode,
                        "order_type"=>$order->order_type,
                        "order_statusCode"=>$order->order_statusCode,
                        "businessid"=>$order->businessid,
                        "user_name"=>$business->user_id,
                        "products"=>$prod_final,
                        "adderess"=>$customer_address,
                        "payment_deatils"=> $customer_card_details,
                        "timeslot"=>$timeslotid,
                        "tax"=>$taxid,
                        "couponcode"=>$couponcode
            );            
        }
        return array('statusCode' => 200,'response'=>$finalarr);
    }
   



    public function addCustPaymentDetails($data){
      $id= $this->db->insert('customer_card_details',$data);
      if($id){
          return array('statusCode' => 200,'response'=>array('Message' => "Payment Details added Successfully!"));
      }
      else{
          return array('statusCode' => 400,'errorMessage' => "Error Occured!");
      }
    }

     public function updateCustPaymentDetails($data){
      $this->db->where('carddetailsid',$data['carddetailsid'] );
      $id= $this->db->update('customer_card_details',$data);
      if($id){
          return array('statusCode' => 200,'response'=>array('Message' => "Payment Details update Successfully!"));
      }
      else{
          return array('statusCode' => 400,'errorMessage' => "Error Occured!");
      }
    }
      public function deleteCustPaymentDetails($id){
        $this->db->where('carddetailsid',$id );
      $id= $this->db->delete('customer_card_details');
      if($id){
          return array('statusCode' => 200,'response'=>array('Message' => "Deleted Successfully!"));
      }
      else{
          return array('statusCode' => 400,'errorMessage' => "Error Occured!");
      }
    }
    public function getCustPaymentDetails($id){
      $this->db->where('user_id',$id); 
      $query = $this->db->select("carddetailsid,cartnumber,expirydate,cvv,zipcode")->get('customer_card_details');
      return array('statusCode' => 200,'response'=>array('CustomerPaymentDetails' => $query->result()));
    }

    public function applyCouponcode($Code){
      $coupons= $this->db->select('couponcode_id,couponcode,percentage')
                    ->from('couponcode')
                    ->where('couponcode',$Code)
                     ->where('status','Active')
                    ->get()->row();
      if($coupons){
          return array('statusCode' => 200,
            'response'=>array('couponcode_id'=>$coupons->couponcode_id,
            'couponcode'=>$coupons->couponcode,
            'percentage'=>$coupons->percentage,
            'Message' => "Code is valid!"));
      }
      else{
          return array('statusCode' => 400,'errorMessage' => "Code is Invalid!");
      }
    }
    

    public function addWishlist($data){
      $exits = $this->db->select('*')
              ->from('wishlist')
              ->where('itemid',$data['itemid'])
               ->where('user_id',$data['user_id'])
              ->get()
              ->row();
      if($exits){
         return array('statusCode' => 400,'errorMessage' => "This item already exists in whishlist");
      }
      else{
        $id= $this->db->insert('wishlist',$data);
        if($id){
            return array('statusCode' => 200,'response'=>array('Message' => "Wishlist Added Successfully!"));
        }
        else{
            return array('statusCode' => 400,'errorMessage' => "Error Occured!");
        }
      }
    }

   public function getWishlist($user_id){
      $this->db->select('b.name  as business_name,c.itemid,i.cat_name,c.itemname,c.price,c.image,c.description');
      $this->db->join("business_items as c","c.itemid=p.itemid");
      $this->db->join("business as b","b.businessid=c.businessid");
      $this->db->join("item_category as i","i.item_catid=c.item_catid");
      $this->db->from("wishlist as p");
      $this->db->where('p.user_id',$user_id);
      $query = $this->db->get();
      return array('statusCode' => 200,'response'=>array('itemlist' => $query->result()));
    }

  public function getNonProfitServices($id){
    $this->db->where('status','Active');
    $this->db->where('serviceid',$id); 
    $query = $this->db->select("trust_id,trust_name,trust_address,image")->get('trust');
    return array('statusCode' => 200,'response'=>array('ServiceDetails' => $query->result()));
  }

}
