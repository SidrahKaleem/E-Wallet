<?php
	require_once("person.php");
	$per = new person();
		
   //Start your session
   session_start();
   //Read your session (if it is set)
   if(!isset($_SESSION['username']) || $_SESSION['role'] != "customer")
      {
	 header("Location: index.php");
	  }else
	  {
	   global $user_login ;
	   $user_login=$_SESSION['username'];
	  
	  
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reset Pin</title>
		<link rel="icon" href="logo.png" type="image/gif" sizes="16x16">
        <!-- CSS -->
		<link href="font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet" >
		<link href="css/buttons.css" rel="stylesheet">
		
	
		
		
      

    </head>

    <body>
	<div id="fullscreen_bg" class="fullscreen_bg">
	
<div class="header_top"></div>

<div class="menu">
    <header class="container">
     <div class="navbar navbar-inner">
                <div class="container">
 <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
                    
					   
					   <img src="logo.png" height="100" width="100" >

     </div>
                    
				
					<div class="collapse navbar-collapse pull-right" id="main-menu">
                        <ul class="nav">
                            

                           <a href="Customer.php" class="btn btn-success btn-sm "><span class="glyphicon glyphicon-home"></span> Home</a> 
                           <a href="logout.php" class="btn btn-success btn-sm "><span class="glyphicon glyphicon-off"></span> logout</a>
                        </ul>
                  <!--	  /.nav-collapse -->
                </div>
  
            </header>

</div><!--menu-->


<div class="container">


        <div class="row centered-form">
		
				
			
			<div class="col-md-5 col-xs-12 col-md-offset-3" >
	
       <div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Reset pin</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="post" action="customer_reset_pin.php">
			    			<div class="row">
			    			
			    			</div>

							<div class="row">
			    				<div class="col-xs-12 col-md-12">
			    					<div class="form-group">
			    						<input type="password" name="new_pin" class="form-control input-sm" placeholder="New Pin">
			    					</div>
			    				</div>
			  
			    			</div><div class="row">
			    				<div class="col-xs-12 col-md-12">
			    					<div class="form-group">
			    						<input type="password" name="confirm_pin" class="form-control input-sm" placeholder="Confirm New Pin">
			    					</div>
			    				</div>
			  
			    			</div>
			    			
			    			<button href="customer_reset_pin.php" type="submit" name="reset_pin" class="btn btn-success gradient pull-right"><span class="glyphicon glyphicon-log-in"></span> Proceed</button>
			    		
			    		</form>
						
						</br></br>
						<div class="default">		
			    		<?php 
						if(isset($_POST['reset_pin'])){
						$per->reset_pin($user_login,trim($_POST['new_pin']),trim($_POST['confirm_pin']));
						}
						?> 
			    		</div>
			    	</div>
	    		</div>
    		</div>


			

</body>
	

 
                
 

        <!-- Javascript -->
        
        <script src="js/jquery-1.10.2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="http://www.clubdesign.at/floatlabels.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>

<?php 
}
?>