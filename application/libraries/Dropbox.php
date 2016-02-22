<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once (APPPATH."libraries/Dropbox/autoload.php");

use \Dropbox as dbx;

class Dropbox{


 public function __construct()
 {
      
 }
  
 public function authorize()
 {
      
    $appInfo = dbx\AppInfo::loadFromJsonFile(APPPATH."libraries/Dropbox/app-info.json");

    $webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");
      
    $authorizeUrl = $webAuth->start();
    
    print_r("<script>  dropboxPopup = window.open('".$authorizeUrl."', 'Dropbox Authorization', 'height=500,width=600,menubar=0,resizable=0,scrollbars=0,location=0,toolbar=0'); </script>");
 
 }

 public function getAccessToken($authCode){
     
     $appInfo = dbx\AppInfo::loadFromJsonFile(APPPATH."libraries/Dropbox/app-info.json");

     $webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");

     list($accessToken, $userId) = $webAuth->finish($authCode);
     
     
     return $accessToken;
     
     

 }
 
 public function getAccountInfo(){
     
    $accessToken = "5aXoPXR2mRAAAAAAAAAAFeQPxrlibg-pqD09RKW7gdYbJOfbDZTMHreNK1FwvsA8";
     
    $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
    $accountInfo = $dbxClient->getAccountInfo();
    return $accountInfo;

     
     
 }
 
 public function uploadFile($data){
     
     
    $dbxClient = new dbx\Client( $data['auth'], "PHP-Example/1.0");

    $target_dir = "/home/seanzamora/Web/upload/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    
    $f = fopen($target_file, "rb");
    
    $result = $dbxClient->uploadFile("/".basename($_FILES["file"]["name"]), dbx\WriteMode::add(), $f);
    
    fclose($f);
    
    return ($result);

     
 }
 
 public function listFolders($dir, $auth){
     

          $accessToken = $auth;
         
          $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
          
          if($dir){
             $dirListing = $dbxClient->getMetadataWithChildren($dir);
          }else{
             $dirListing = $dbxClient->getMetadataWithChildren('/');
          }
          
          return $dirListing;
      
      
     
 }
 
 public function getFile($target , $auth){
     
       $accessToken = $auth;
     
       $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
       $target_dir = "/home/seanzamora/Web/upload/";
       //$target = "/BackgroundAvatar.jpg";
      
        $f = fopen($target_dir.$target, "w+b");
        
        $result = $dbxClient->getFile($target, $f);
        
        fclose($f);
        
        header('Content-Type: image/jpeg');
        readfile("http://169.44.73.149/upload".$target);
     
     
 }
 
}

?>
