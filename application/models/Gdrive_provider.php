<?php

Class Gdrive_Provider extends CI_Model {


public function auth() {

    
     print_r($this->google->authorize());


}

public function getProviderList(){
    
     $this->load->database();
    
     $uid = $this->session->userdata['uid'];
    
     $condition = "uid =" . "'" . $uid . "' AND type='2'";
          $this->db->select('*');
          $this->db->from('dg_user_platform');
          $this->db->where($condition);

          $query = $this->db->get();
    
          return json_encode($query->result());
    
}

public function getAccessToken(){
    
    $vendor_label = ($this->session->userdata['vendor_label']);
    
        $gdrive_auth = $this->google->getAccessToken();
       
        $gdrive_uid = $this->google->getAccountInfo($gdrive_auth);
    
          $this->load->database();
            
          $uid = $this->session->userdata['uid'];
          
          
          $up_data = array('uid' => $uid, 'type' => 2, 'label' => $vendor_label );
           
          $up_query = $this->db->insert_string('dg_user_platform', $up_data);
    
          $this->db->query($up_query);
          
          
          $upid = $this->db->insert_id();
          
          $condition = "puid =" . "'" . $gdrive_uid . "'";
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
                
              $upd_data = array('upid' => $upid, 'auth' => json_encode($gdrive_auth), 'puid' => $gdrive_uid );
    
              $upd_query = $this->db->insert_string('dg_user_platform_details', $upd_data);
              
              $this->db->query($upd_query);
              
              redirect('dashboard');
        
          }
          redirect('dashboard');
          
    
}

public function getAccountInfo(){
    
    print_r($this->google->getAccountInfo());
    
}


public function uploadFile($data){
    
          $this->load->database();
            
        //  print_r($data);
   
          $condition = "upid ='".$data['vender_group']."' ";
          $this->db->select('*');
          $this->db->from('dg_user_platform_details');
          $this->db->where($condition);
          $this->db->limit(1);
          $query = $this->db->get()->result();
        
          $res = (array) $query[0];
          
          $data['auth'] = json_decode($res['auth'], true);
        //   print_r($data);
          $this->google->uploadFile($data);
          
          redirect('dashboard');
          
    
}

public function listFolders($dir ,$auth){
    
    
       $this->load->database();
            


      $condition = "upid = '".$auth."'";
      $this->db->select('*');
      $this->db->from('dg_user_platform_details');
      $this->db->where($condition);
      $query = $this->db->get()->result();
      $res = (array) $query[0];
          
    
        
    
    
    $output = $this->google->listFolders($dir , $res['auth']);
   
    
    if(isset($_GET['o'])==1){
        
        print_r($output);
    }else{
    
   print_r('{"draw": 1,  "recordsTotal": '.count($output).',  "recordsFiltered": '.count($output).', "data":'.json_encode($output).'}');
    }
    
   //( $this->google->listFolders($dir));
    
}

public function getFile($target){
    
   print_r( $this->google->getfile($target));
    
}

}

?>
