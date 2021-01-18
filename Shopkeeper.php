<?php
	require_once("db_connection.php");
	require_once("shopkeeper_class.php");

	$conn = new db_connection();
	$conn->create_connection();
	$shopkeeper = new shopkeeper_class();
	
   //Start your session
   session_start();
   //Read your session (if it is set)
   if(!isset($_SESSION['username']) || $_SESSION['role'] != "shopkeeper")
      {
	 header("Location: index.php");
	  }else
	  {
	   global $user_login;
	  $user_login=$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shopkeeper</title>
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
                            

                            <a href="update_menu.php" class="btn btn-success btn-sm "><span class="glyphicon glyphicon-pencil"
							></span>Update Menu</a>
							<a href="shopkeeper_reset_password.php" class="btn btn-success btn-sm "><span class="glyphicon glyphicon-pencil"
							></span>Reset Password</a>
                       
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
				
				<h3 class="panel-title">Pay Bill</h3>
			    		
			 			</div>
		<form action="Shopkeeper.php" method ="post" enctype="multipart/form-data">
						</br>
			    			<div class="form-group">
			    				<input type="text" name="items" class="form-control input-sm" placeholder="Items">
			    			</div>
							<div class="form-group">
			    				<input type="text" name="bill" class="form-control input-sm" placeholder="Total Bill">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="username" class="form-control input-sm" placeholder="Username">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="pin" class="form-control input-sm" placeholder="Pin">
			    					</div>
			    				</div>
			    			</div>
							
						<button href="" name="make_transaction" type="submit" class="btn btn-success gradient pull-right"><span class=
"glyphicon glyphicon-log-in"></span> Proceed</button>
			    		</form>
						</br></br>
						<div class="default">		
			    			<?php	
								if(isset($_POST['make_transaction'])){
								$shopkeeper->make_transaction($conn);                  // calling make transaction function
								}
							?>

			  
			    		</div>
				</div>
    		</div>
			</br></br>
			<div class="col-md-7 col-xs-6 col-md-offset-2" >
				<form action="Shopkeeper.php" method ="post" enctype="multipart/form-data">
						</br>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="order_id" class="form-control input-sm" placeholder="Order Id">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<button href="" name="add_to_served" type="submit" class="btn btn-success gradient pull-right"><span 
class="glyphicon glyphicon-log-in"></span> Add to Served</button>
			    		
			    				</div>
			    			</div>
							
						</form>
						<div class="default">		
			    			<?php	
								if(isset($_POST['add_to_served'])){
								$shopkeeper->add_to_served($conn);                  // calling make transaction function
								}
							?>

			  
			    		</div>
        	<div class="panel panel-default">
        		<div class="panel-heading">
				
				<h3 class="panel-title">Pending Orders</h3>
			    		
			 			</div>
		                
						<?php 
							echo $shopkeeper->get_pending_orders($conn);?>
						</br></br>
						
				</div>
    		</div>
			
			
			
    	</div>
    </div>
	
	
	
	
	
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