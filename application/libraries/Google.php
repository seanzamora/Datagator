<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH."libraries/Google/vendor/autoload.php");


class Google{


 public function __construct()
 {

 }
  
 public function authorize()
 {
 

        $client = new Google_Client();
        $client->setAuthConfigFile('/home/seanzamora/.credentials/drive_secret.json');
        $client->addScope(Google_Service_Drive::DRIVE);
         $client->setIncludeGrantedScopes(true);
        $client->setRedirectUri('http://usksbec7bab7.seanzamora.koding.io/dashboard');
        // $client->setScopes('email');
        
        $auth_url = $client->createAuthUrl();
        
        
        redirect($auth_url);


 }
 
 public function getAccessToken(){
     
        $client = new Google_Client();
        $client->setAuthConfigFile('/home/seanzamora/.credentials/drive_secret.json');
         $client->setIncludeGrantedScopes(true);
        $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);


        $access_token = $client->authenticate($_GET['code']);


        //CAUSED ERROR - NOT SURE IF REQUIRED 
        //$access_token = $client->getAccessToken();
       // $oauth =  $access_token['access_token'];
       
        // if($client->isAccessTokenExpired()){
        //     $client->refreshToken($client->getRefreshToken());
        //     $access_token = $client->getAccessToken();
        // }
        
 
       return $access_token;

 }
 
 
  public function getAccountInfo($token){
     
     $client = new Google_Client();
     $client->setAuthConfigFile('/home/seanzamora/.credentials/drive_secret.json');
     $client->setIncludeGrantedScopes(true);
     $client->addScope(Google_Service_Drive::DRIVE);
     
      $access_token = $client->getAccessToken();
      $client->setAccessToken($token);
      
     $drive_service = new Google_Service_Drive($client);
     
      $ticket = $drive_service->about->get();
      
      if ($ticket) {
        $data = $ticket->getRootFolderId();
        return $data; // user ID
      }
      return false;
     
     
 }

 public function listFolders($dir, $auth){
     
     $client = new Google_Client();
     $client->setAuthConfigFile('/home/seanzamora/.credentials/drive_secret.json');
      $client->setIncludeGrantedScopes(true);
     $client->addScope(Google_Service_Drive::DRIVE);
     
      $accessToken = (array)json_decode($auth);
      
 
      $access_token = $client->getAccessToken();
      $client->setAccessToken($accessToken);
      
   
        

      $drive_service = new Google_Service_Drive($client);
      $files_list = $drive_service->files->listFiles(array('spaces'=>'drive','fields'=>'items(title,iconLink,id,webContentLink,fileSize)','corpus'=>'DEFAULT'))->getItems();

    //   return $files_list;
    
    $res = array();
      
     foreach ($files_list as $key => $value){
         
         if($value['webContentLink'] == null){
             //print_r($value);
         }else{
             
             
             $value['webContentLink'] = '<a href="'.$value['webContentLink'].'">Download</a>';
             $value['iconLink'] = '<img src="'.$value['iconLink'].'" />';
             
             array_push( $res ,$value);
         }
         
     }
     
         return $res;
 }
 
 
  public function getFile($target){
      

        $client = new Google_Client();
        $client->setAuthConfigFile('/home/seanzamora/.credentials/drive_secret.json');
         $client->setIncludeGrantedScopes(true);
        $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
     
          $accessToken = Array ( "access_token" => "ya29.jgJx5rpkltJo0S1t26I0UV0-AC-X_VRN4Kdeqz9osFviJQi2T1ea03y0mt0R6-uLuQdR" , "token_type" => "Bearer", "expires_in" => 3600, "created" => 1456010412);
      
         $access_token = $client->getAccessToken();
      $client->setAccessToken($accessToken);
      
     $drive_service = new Google_Service_Drive($client);
      
      $fileId = "0ByeeOHyjJmtcZ2hIQVI5dHE5eEU";
      $request = $drive_service->files->get($fileId);
      $downloadUrl = $request->getWebContentLink();
      
      print_r("<script> window.open( '".$downloadUrl."' );</script>");
      
      //return $downloadUrl;
      
 }
 
 
  public function uploadFile($data){


      $client = new Google_Client();
      $client->setAuthConfigFile('/home/seanzamora/.credentials/drive_secret.json');
      $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
      
      $access_token = $client->getAccessToken();
      
      $client->setAccessToken($data['auth']);
      
      $drive_service = new Google_Service_Drive($client);
      
      $parentId = null;
      $target_dir = "/home/seanzamora/Web/upload/";
      $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
      move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
      

    
      $f = fopen($target_file, "rb");
      
      $file = new Google_Service_Drive_DriveFile();
      $file->setTitle($_FILES["file"]["name"]);
      $file->setMimeType($_FILES["file"]["type"]);
      // Set the parent folder.
      if ($parentId != null) {
        $parent = new Google_Service_Drive_ParentReference();
        $parent->setId($parentId);
        $file->setParents(array($parent));
      }
    
      try {
          
        $data = file_get_contents($target_file);
    
        $createdFile = $drive_service->files->insert($file, array(
          'data' => $data,
          'mimeType' => $_FILES["file"]["type"],
        ));
    
         return $createdFile;
         
      } catch (Exception $e) {
        print "An error occurred: " . $e->getMessage();
      }


     
 }
 
 

 }



?>
