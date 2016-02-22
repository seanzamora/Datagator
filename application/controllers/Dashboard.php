<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
 


    
	public function index()
	{
	   if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['username']);
        
        } else if($_GET['code']){

            header("location: http://169.44.73.149/dashboard/access_token?code=".$_GET['code']);
            
            // if (isset($this->session->userdata['logged_in'])) {
            //     $username = ($this->session->userdata['username']);
            // }else{
            //     header("location: /");
            // }
            
    
        }else {
            header("location: /");
        }
        
            
          $this->load->database();
            
          $uid = $this->session->userdata['uid'];
          
          
          $condition = "uid = '" . $uid . "'";
          $this->db->select('*');
          $this->db->from('dg_user_platform');
          $this->db->where($condition);
          $query = $this->db->get()->result();
          $res = (array) $query;
          
         

          $data['vendor_tabs'] = '';
          
          $data['vendor_tabs_content'] = '';
          
          foreach ( $res as $key => $value){
              
              
              $res = (array) $value;
             
              
              if($res['type'] == 1){
              
              $data['vendor_tabs'] .= '<li role="presentation" class=""><a href="#vendor-'.$res['id'].'" aria-controls="home" role="tab" data-toggle="tab" data-vendor="'.$res['id'].'">Dropbox - '.$res['label'].'</a></li>';
              
             $data['vendor_tabs_content'] .= '<div role="tabpanel" class="tab-pane" id="vendor-'.$res['id'].'">
             
             
              
            <table id="vendor_file_list-'.$res['id'].'" class="uk-table uk-table-hover uk-table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Filename</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Filename</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Download</th>
                        </tr>
                    </tfoot>
                </table>
                
                
             <script>
                  setTimeout(function(){
                $(document).ready(function(){
     
                        //   $("#vendor_file_list-'.$res['id'].' tfoot th").each(function() {
                        //       $(this).toggleClass("sorting")
                        //         var title = $("#finder thead th").eq($(this).index()).text();
                        //           $(this).html(\'<input type="text" class="form-control" placeholder="\' + title + \'"" />\');
                        //     });
                            
                            $("#vendor_file_list-'.$res['id'].' thead th").each(function() {
                                  $(this).toggleClass("sorting")
                                var title = $("#finder thead th").eq($(this).index()).text();
                                 $(this).prepend(\'<input type="text" class="form-control" placeholder="" + title + "" />\');
                            });
                        
                            var dir_list_'.$res['id'].' = $("#vendor_file_list-'.$res['id'].'").DataTable( {
                            "autoWidth": false,
                                "scrollY":        "500px",
                                 "scrollCollapse": true,
                                "paging":         false,
                         
                                "start": 0,
                                "ajax":  "/dashboard/listFolders?vendor=1&auth='.$res['id'].'",
                                "columns": [
                                            { "data": "name" },
                                            { "data": "icon" },
                                            { "data": "size" },
                                            { "data": "path" }
                                        ],
                                        "initComplete": function( settings, json ) {
                                                  
                                                  }
                                        
                         
                            });
                            
                          $("#vendor_file_list-'.$res['id'].' thead th").toggleClass("sorting")
                            dir_list_'.$res['id'].'.columns().eq(0).each(function(colIdx) {
                                    $("input", dir_list_'.$res['id'].'.column(colIdx).footer()).on("keyup change", function() {
                                        
                                        dir_list_'.$res['id'].'
                                                .column(colIdx)
                                                .search(this.value)
                                                .draw();
                                    });
                                    
                                    $("input", dir_list_'.$res['id'].'.column(colIdx).header()).on("keyup change", function() {
                                        
                                        dir_list_'.$res['id'].'
                                                .column(colIdx)
                                                .search(this.value)
                                                .draw();
                                    });
                            })
                        
                    
                });
            },500)   
             </script>
             
             </div>';
              
              }else{
                  
            $data['vendor_tabs'] .= '<li role="presentation" class=""><a href="#vendor-'.$res['id'].'" aria-controls="vendor-'.$res['id'].'" role="tab" data-toggle="tab" data-vendor="'.$res['id'].'">Google Drive - '.$res['label'].'</a></li>';
             
              $data['vendor_tabs_content'] .= '<div role="tabpanel" class="tab-pane" id="vendor-'.$res['id'].'">
              
               
                 <table id="vendor_file_list-'.$res['id'].'" class="uk-table uk-table-hover uk-table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            
                            <th>Type</th>
                            <th>Filename</th>
                            <th>Size</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            
                            <th>Type</th>
                            <th>Filename</th>
                            <th>Size</th>
                            <th>Download</th>
                        </tr>
                    </tfoot>
                </table>


                  
                <script>
                setTimeout(function(){
                $(document).ready(function(){
                
                            //   $("#vendor_file_list-'.$res['id'].' tfoot th").each(function() {
                            //   $(this).toggleClass("sorting")
                            //     var title = $("#finder thead th").eq($(this).index()).text();
                            //     $(this).html(\'<input type="text" class="form-control" placeholder="\' + title + \'"" />\');
                            // });
                            
                            $("#vendor_file_list-'.$res['id'].' thead th").each(function() {
                                  $(this).toggleClass("sorting")
                                var title = $("#finder thead th").eq($(this).index()).text();
                                $(this).prepend(\'<input type="text" class="form-control" placeholder="" + title + "" />\');
                            });
                            
                            var dir_list_'.$res['id'].' = $("#vendor_file_list-'.$res['id'].'").DataTable( {
                            "autoWidth": false,
                                "scrollY":        "500px",
                                "scrollCollapse": true,
                                "paging":         false,
                                "start": 0,
                                "ajax":  "/dashboard/listFolders?vendor=2&auth='.$res['id'].'",
                                "columns": [
                                            { "data": "iconLink" },
                                            { "data": "title" },
                                            { "data": "fileSize" },
                                            { "data": "webContentLink" }
                                        ],
                                        "initComplete": function( settings, json ) {
                                                   
                                                  }
                                        
                            
                            });
                            
                            
                            
                            $("#vendor_file_list-'.$res['id'].' thead th").toggleClass("sorting")
                            dir_list_'.$res['id'].'.columns().eq(0).each(function(colIdx) {
                                    $("input", dir_list_'.$res['id'].'.column(colIdx).footer()).on("keyup change", function() {
                                        
                                        dir_list_'.$res['id'].'
                                                .column(colIdx)
                                                .search(this.value)
                                                .draw();
                                    });
                                    
                                    $("input", dir_list_'.$res['id'].'.column(colIdx).header()).on("keyup change", function() {
                                        
                                        dir_list_'.$res['id'].'
                                                .column(colIdx)
                                                .search(this.value)
                                                .draw();
                                    });
                            })  
                            
                            dir_list_'.$res['id'].'.columns.adjust().draw();
                        
                    });
                },500)
                </script>
              </div>';
                  
              }
              
              
          }
          

           $data['vendor_tabs_obj'] = '<div>

                          <!-- Nav tabs -->
                              <ul class="nav nav-tabs" role="tablist">
                               '.$data['vendor_tabs'].'
                               </ul>
                            
                              <!-- Tab panes -->
                              <div class="tab-content">'.$data['vendor_tabs_content'];
                                
                                     if(count($res) == 0){
                                
                                 $data['vendor_tabs_obj'] .='<h2>TO BROWSE ADD A CLOUD STORAGE ACCOUNT ABOVE. <h2>';
                                    }
                            
                                
            $data['vendor_tabs_obj'] .=  '</div></div>';
                            
                            //print_r($data['vendor_tabs_obj']);
                            
                       
        
		$this->load->view('dashboard_page',  $data);
		

	}
	
	

	
	public function get_vendors(){
	    
	     if(isset($_GET['vendor'])){
            
            if( $_GET['vendor'] == 1 ){
                
                $this->load->model('dropbox_provider');
              	print_r($this->dropbox_provider->getProviderList());
                
            }else if($_GET['vendor'] == 2 ){
                
                $this->load->model('gdrive_provider');
        		print_r($this->gdrive_provider->getProviderList());
        		
            }
        }
	    
	}

	public function add_vendor(){
	    
	    $data['label'] = $_POST['label'];
	    
	    $this->session->set_userdata('vendor_label', $data['label']);
	
        if(isset($_POST['vendor'])){
            
            if( $_POST['vendor'] == 1 ){
                $this->load->model('dropbox_provider');
              	$this->dropbox_provider->auth();
                
            }else if($_POST['vendor'] == 2 ){
                
                $this->load->model('gdrive_provider');
        		$this->gdrive_provider->auth();
        		
            }
        }
        
        	$this->load->view('dashboard/add_vendor', $data);
       
            

	}
	
    public function access_token(){
        
        $data['label'] = $_POST['label'];
        
            if(isset($_POST['vendor'])){
            
            if( $_POST['vendor'] == 1 ){
                
        		$this->load->model('dropbox_provider');
                $this->dropbox_provider->getAccessToken();
                
            } 
        }
     
        if(isset($_GET['code'])){
                
	            $this->load->model('gdrive_provider');
	        	$this->gdrive_provider->getAccessToken();
        		
          }
         

    }
    
     public function get_account(){
            
		$this->load->model('dropbox_provider');
        $this->dropbox_provider->getAccountInfo();
        
    }
    
    public function uploadFile(){
        
        $error = 0;
        
        if( isset($_POST['vendor']) == 0){ $error = 1; }
        
        if( $_POST['vender_group'] == 0){ $error = 1; }
        
        print_r($_POST['vender_group']);
        print_r($error);
        
            if($error == 1){
                 redirect('dashboard');
            }else{
        
               print_r('TEST');
                    
                            if( $_POST['vendor'] == 1 ){
                                $this->load->model('dropbox_provider');
                              	$this->dropbox_provider->uploadFile($_POST);
                                
                            }else if($_POST['vendor'] == 2 ){
                                
                                $this->load->model('gdrive_provider');
                		        $this->gdrive_provider->uploadFile($_POST);
                        		
                            }
                    
            }
        
        
    }
    
    public function listFolders($dir = null, $auth = null){
        
        
            if( $_GET['vendor'] == 1 ){
             
           		$this->load->model('dropbox_provider');
    	    	$this->dropbox_provider->listFolders($dir,$_GET['auth']);
                
            }else if($_GET['vendor'] == 2 ){
                
           		$this->load->model('gdrive_provider');
	        	$this->gdrive_provider->listFolders($dir, $_GET['auth']);
        		
            }

    }
    
       public function get_file(){
            
        $this->load->model('dropbox_provider');
		
		print_r($this->dropbox_provider->getFile( $_GET['target'] , $_GET['auth']));
		
// 		$this->load->model('gdrive_provider');
// 		$this->gdrive_provider->getFile($target);
		
        
        
    }


}
