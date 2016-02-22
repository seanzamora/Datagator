<?php

Class Dropbox_Provider extends CI_Model {
    

public function getProviderList(){
    
     $this->load->database();
    
     $uid = $this->session->userdata['uid'];
    
     $condition = "uid =" . "'" . $uid . "' AND type='1'";
          $this->db->select('*');
          $this->db->from('dg_user_platform');
          $this->db->where($condition);

          $query = $this->db->get();
    
          return json_encode($query->result());
    
}


public function auth() {
    
    
   if(isset($_POST['access_token']) && isset($_POST['vendor'] )){


          $this->load->database();
            
          $uid = $this->session->userdata['uid'];
          
          
          $up_data = array('uid' => $uid, 'type' => $_POST['vendor'] , 'label' => $_POST['label'] );
           
          $up_query = $this->db->insert_string('dg_user_platform', $up_data);

          $this->db->query($up_query);
          
          
          $upid = $this->db->insert_id();
          
          $vendor_id = $this->getAccountInfo();
          
          $condition = "puid = '" . $vendor_id['uid']. "'";
          $this->db->select('*');
          $this->db->from('dg_user_platform_details');
          $this->db->where($condition);
          $this->db->limit(1);
          $query = $this->db->get();
            
          if ($query->num_rows() == 1) {
              
              
              $this->db->where('id', $upid);
              $this->db->delete('dg_user_platform');
              
              $error = 'Storage platform already in use.';
              
               //TODO : RETURN ERROR TO DASHBOARD
              redirect('dashboard');
              
          }else{
              
              $auth_token = $this->getAccessToken($_POST['access_token']);
                
              $upd_data = array('upid' => $upid, 'auth' => $auth_token, 'puid' => $vendor_id['uid'] );
    
              $upd_query = $this->db->insert_string('dg_user_platform_details', $upd_data);
              
              
         
              $this->db->query($upd_query);
              
              redirect('dashboard');
        
          }
          
          
           
           
     }else  if(isset($_POST['vendor'])){
         
         print_r($this->dropbox->authorize());
     
     }

}

public function getAccessToken($token){
    return $this->dropbox->getAccessToken($token);
    
}

public function getAccountInfo(){
    
    return $this->dropbox->getAccountInfo();
    
}


public function uploadFile($data){
    
    if(isset($_POST['vender_group']) == 0 || isset($_POST['vendor']) == 0){
                
                redirect('dashboard');
                
            }
    
    
        $this->load->database();
            
          print_r($data);
   
          $condition = "upid ='".$data['vender_group']."' ";
          $this->db->select('*');
          $this->db->from('dg_user_platform_details');
          $this->db->where($condition);
          $this->db->limit(1);
          $query = $this->db->get()->result();
        
          $res = (array) $query[0];
          
          $data['auth'] = trim($res['auth']);
          
        //   print_r($res['auth']);
    
          $this->dropbox->uploadFile($data);
          
          redirect('dashboard');
    
}

public function listFolders($dir, $auth){
    
    
     $this->load->database();
            


      $condition = "upid = '".$auth."'";
      $this->db->select('*');
      $this->db->from('dg_user_platform_details');
      $this->db->where($condition);
      $query = $this->db->get()->result();
      $res = (array) $query[0];
          
    

    
    $output = $this->dropbox->listFolders($dir, $res['auth']);
    
    if(isset($_GET['o'])==1){
        
        print_r($output);
        
    }else{
        
        $response = $output['contents'];
        
        $res_array = array();
        
        foreach ($response as $key => $value){
            
            $value['name'] =  $value['path'];
            $value['path'] = '<a href="/dashboard/get_file?auth='.$auth.'&target='.$value['path'].'" download="'.$value['path'].'">Download</a>';
            
            array_push( $res_array ,$value);
            
        }
        
        // $response['path'] = 
        
    
   print_r('{"draw": 1,  "recordsTotal": '.count($output['contents']).',  "recordsFiltered": '.count($output['contents']).', "data":'.json_encode($res_array).'}');
    }
    
}

public function getFile($target, $auth){
    
    
    
      $this->load->database();
    
      $condition = "upid = '".$auth."'";
      $this->db->select('*');
      $this->db->from('dg_user_platform_details');
      $this->db->where($condition);
      $query = $this->db->get()->result();
      $res = (array) $query[0];
        
    
    //print_r($res);
    print_r( $this->dropbox->getfile($target , $res['auth']));
    
}

}

?>
