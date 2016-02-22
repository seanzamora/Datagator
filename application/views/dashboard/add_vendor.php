<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
    if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['username']);
    } else {
        header("location: /");
    }
?>

<?php if(!isset($_POST['vendor'])){redirect('dashboard');}?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <head>
    	<meta charset="utf-8">
    	<title>Welcome to Datagator</title>


    	<!-- Bootstrap -->
    	 <link href="/includes/css/bootstrap.min.css" rel="stylesheet">
        <link href="/includes/css/main.css" rel="stylesheet">
    	 <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    	 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	 <!--[if lt IE 9]>
    		 <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    		 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	 <![endif]-->

    </head>
  </head>
  <body>

   <div class="header">
        <div class="col-md-12">
        
        <center>
        
        <img src="/includes/logo.png">

        </center>
        
       
        </div>
    </div>
<div class="container" style="max-width:500px;">
			<div class="col-md-12">
                    <h3 style="color:#fff;    margin-top: 0!important;">Enter Authorization Key</h3>

                     <form action="/dashboard/add_vendor" method="post">
    
            <input name="label" type="hidden" value="<?php echo $label ; ?>">
            <input name="vendor" type="hidden" value="<?php echo isset($_POST['vendor']) ; ?>">
            <input  class="form-control" name="access_token" id="access_token" type="text" value="" placeholder="Enter your Authorization Key Here" required><br>
            <input name="submit"  type="submit" value="Add Account" onclick="dropboxPopup.close()" class="btn">
            
        </form><br>
         <center><p style="color:#fff;"><em>NOTE: Please allow popups when notified, Then refresh this page. </em><br><br>
               <img src="/includes/chrome-pop-up-blocker-notification.png" style="    border-radius: 10px;"></center>


			</div>
	</div>
	
	
       

    	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	 <script src="/includes/js/jquery.min.js"></script>
    	 <!-- Include all compiled plugins (below), or include individual files as needed -->
    	 <script src="/includes/js/bootstrap.min.js"></script>
    <script src="/includes/js/jquery.validate.min.js">    </script>
  </body>
</html>
