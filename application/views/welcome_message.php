<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>


	<!-- Bootstrap -->
	 <link href="includes/css/bootstrap.min.css" rel="stylesheet">
     <link href="/includes/css/main.css" rel="stylesheet">
	 <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	 <!--[if lt IE 9]>
		 <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	 <![endif]-->

</head>
<body>

   <div class="header">
        <div class="col-md-12">
        
        <center><img src="/includes/logo.png"></center>
        </div>
    </div>

	<div class="container" style="max-width:500px;">
			<div class="col-md-12">
                    <h3 style="color:#fff;">LOG IN </h3>
					<form action="/index.php/welcome/login" method="post">
						<input type="text" class="form-control" name="username" required><br>
						<input type="password" class="form-control" name="password" required><br>
						<input type="submit" value="login" class="btn">&nbsp;&nbsp;&nbsp;<a href="/register" style="color:#fff">New, Register a account?</a>
					</form>

			</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	 <script src="includes/js/jquery.min.js"></script>
	 <!-- Include all compiled plugins (below), or include individual files as needed -->
	 <script src="includes/js/bootstrap.min.js"></script>
	  <script src="/includes/js/jquery.validate.min.js">    </script>

</body>
</html>
