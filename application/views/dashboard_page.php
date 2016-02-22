<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Welcome to Datagator</title><!-- Bootstrap -->
    <link href="/includes/css/bootstrap.min.css" rel="stylesheet">
    <link href=
    "https://cdnjs.cloudflare.com/ajax/libs/uikit/2.24.3/css/uikit.min.css"
    rel="stylesheet">
    <link href=
    "https://cdn.datatables.net/1.10.11/css/dataTables.uikit.min.css" rel=
    "stylesheet">
    <link href="/includes/css/main.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
         <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
     <![endif]-->

    <style>
    </style>
</head>

<body>
    <div class="header">
        <div class="col-md-12">
        
        <center>
        
        <img src="/includes/logo.png">

        </center>
        
       
        </div>
    </div>


    <div class="container">
    
          
            <div class=" col-md-6">
            <div>
                <h3>Add Cloud Storage Account</h3>


                <form action="/dashboard/add_vendor" method="post">
                
                    <input type="text" placeholder="Label Your Account" class="form-control" name="label" required/>
                    <br>
                    <select class="form-control" id="vendor" name="vendor" required>
                        <option value="1">
                            Dropbox
                        </option>

                        <option value="2">
                            Google Drive
                        </option>
                    </select><br>
                    <input class="btn" name="submit" type="submit" value=
                    "Add Cloud Storage Account"><br>
                </form>
                
               
                </p>
                </div>
            </div>


            <div class=" col-md-6">
            <div>
            <h3>Upload File To Selected Account</h3>
                <form action="/dashboard/uploadFile" enctype=
                "multipart/form-data" id="uploader_main" method="post" name=
                "uploader_main">
                    <select class="form-control" id="vendor" name="vendor" required>
                        <option value="0">
                            Select a Platform
                        </option>

                        <option value="1">
                            Dropbox
                        </option>

                        <option value="2">
                            Google Drive
                        </option>
                    </select><br>
                    <select class="form-control" id="vender_group" name=
                    "vender_group" disabled required>
                        <option value="0">Select a Platform First</option>
                        </select><br>
                    <input class="form-control" id="file" name="file" type=
                    "file" required><br>
                    <input class="btn" name="submit" type="submit" value=
                    "Upload File">
                </form>

     </div>
            
        </div>


        <div class="col-md-12">
            <?php echo $vendor_tabs_obj; ?>
     
        </div>
        
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js">
    </script> 
    <script src=
    "https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js">
    </script> 
    <script src=
    "https://cdn.datatables.net/1.10.11/js/dataTables.uikit.min.js">
    </script> 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
     
    <script src="/includes/js/bootstrap.min.js">
    </script> 
    <script src="/includes/js/main.js">
    </script>
    <script src="/includes/js/jquery.validate.min.js">
    </script>
</body>
</html>