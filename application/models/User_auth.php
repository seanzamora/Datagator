<?php 

Class User_auth extends CI_Model {

public function registration_insert($data) {
    
  $this->load->database();

 $condition = "username ='" . $_POST['username']."'";

$this->db->select('*');
$this->db->from('dg_users');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 0) {

    $this->db->insert('dg_users', $_POST);
    
    if ($this->db->affected_rows() > 0) {
     
       redirect('/');
        return true;
    }

  } else {
      
       redirect('/');
       return false;
  }
}


public function login($data) {

    if($_POST){
          $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
          $this->load->database();
          $this->db->select('*');
          $this->db->from('dg_users');
          $this->db->where($condition);
          $this->db->limit(1);
          $query = $this->db->get();
            
          if ($query->num_rows() == 1) {
              
             $results =  $query->result();
             $res = (array) $results[0];
             
                 $user_session = array(
                          'username'  => $data['username'],
                          'uid'=> $res['id'] ,
                          'logged_in' => TRUE
                  );

                  $this->session->set_userdata($user_session);

                  redirect('/dashboard/index');

          } else {
            redirect('/');
            return false;

          }
        }
}


public function user_data($username) {

    $condition = "user_name =" . "'" . $username . "'";
    $this->db->select('*');
    $this->db->from('user_login');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
        return $query->result();
    } else {
        return false;
    }
}

}

?>
