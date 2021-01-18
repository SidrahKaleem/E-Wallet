<?php
require_once("db_connection.php");
require_once("person.php");
$person = new person();

$conn = new db_connection();
//$conn=$conn->create_connection();
		session_start();
		if(isset($_SESSION['role']))
		{
		if($_SESSION['role'] == "customer")
		{
			echo "<script> window.location=\"http://localhost/E-Wallet1/Customer.php\" </script>";
		}
		else if($_SESSION['role'] == "accountant")
		{
			echo "<script> window.location=\"http://localhost/E-Wallet1/Accountant.php\" </script>";
		}
		else if($_SESSION['role'] == "shopkeeper")
		{
			echo "<script> window.location=\"http://localhost/E-Wallet1/Shopkeeper.php\" </script>";
		}
		else if($_SESSION['role']== "faculty")
		{	
			echo "<script> window.location=\"http://localhost/E-Wallet1/Faculty.php\" </script>";
		}
		else if ($_SESSION['role'] == "admin")
		{	
			echo "<script> window.location=\"http://localhost/E-Wallet1/Admin.php\" </script>";
		}
		}else

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>E-Wallet</title>
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
               
                </div>
  
            </header>

</div><!--menu-->


<div class="container">
        <div class="row centered-form">
		
		
        <div class="col-md-4 col-xs-12 ">
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Login </h3>
			 			</div>
			 			<div class="panel-body">
			    		<form action="index.php" method ="post" enctype="multipart/form-data">
			    			<div class="row">
			    				<div class="col-xs-12 col-md-12">
			    					<div class="form-group">
			                <input type="text" name="l_username" class="form-control input-sm floatlabel" placeholder="Username">
			    					</div>
			    				</div>
			    				
			    			</div>

			    			

			    			<div class="row">
			    				<div class="col-xs-12 col-md-12">
			    					<div class="form-group">
			    						<input type="password" name="l_password" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			  
			    			</div>
			    			<button href="" name="signin" type="submit" class="btn btn-success gradient pull-right"><span class="glyphicon glyphicon-log-in"></span> Proceed</button>
			    		
			    		</form>
						
			    	</div>
	    		</div>
    		</div>
			
			
			
			<div class="col-md-4 " >
			
</div>			
			
			<div class="col-md-4 col-xs-12" >
	
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Signup </h3>
			 			</div>
			 			<div class="panel-body">
			    		<form action="index.php" method ="post" enctype="multipart/form-data">
			    			<div class="form-group">
			    				<input type="text" name="full_name" class="form-control input-sm" placeholder="Full Name">
			    			</div>
							<div class="form-group">
			    				<input type="email" name="email" class="form-control input-sm" placeholder="Email Address">
			    			</div>
							<div class="form-group">
			    				<input type="username" name="username" class="form-control input-sm" placeholder="Username">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="confirm_password" class="form-control input-sm" placeholder="Confirm Password">
			    					</div>
			    				</div>
			    			</div>
							<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="pin" class="form-control input-sm" placeholder="Pin">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="confirm_pin" class="form-control input-sm" placeholder="Confirm Pin">
			    					</div>
			    				</div>
			    			</div>
							<fieldset id="profilepic_controls">
								<div class "well"><font size="5" color="white" > Select Profile Picture </font> 
								</div>
								<div style= "top:50px; color: white;"data-role="fieldcontain" data-controltype="camerainput">
								<input type="file" name="image" id="camerainput1" accept="image/*" capture>
								</div>
							</fieldset>
			    			
			    			<button href="" name="signup" type="submit" class="btn btn-success gradient pull-right"><span class="glyphicon glyphicon-log-in"></span> Proceed</button>
			    		
			    		</form>
						</br></br>
						<div class="default">		
			    			<?php	
								if(isset($_POST['signup'])){
								$person->signup($conn);                  // calling sign up function
								}
							?>

			  
			    		</div>
						</br>
						
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

if(isset($_POST['signin']))
{
	$u_name=$_POST['l_username'];
	$password=$_POST['l_password'];
	$conn=$conn->create_connection();
	
	$log_query1="SELECT * FROM shopkeeper_tb WHERE sk_username='{$u_name}' AND password='{$password}'";
	$result1 = mysqli_query($conn,$log_query1);
	$row2=mysqli_fetch_assoc($result1);

	$log_query="SELECT * FROM user_tb WHERE username='{$u_name}' AND password='{$password}'";
	$result = mysqli_query($conn,$log_query);

		$row=mysqli_fetch_assoc($result);
		$role=$row['category'];
		$status=$row['status'];
	if(mysqli_num_rows($result) > 0)
	{
		if($role == "customer" && $status == "active")
		{
			$_SESSION['username']=$u_name;
			$_SESSION['role']=$role;

			echo "<script> window.location=\"http://localhost/E-Wallet1/Customer.php\" </script>";
		}
		else if($role == "customer" && $status == "notactive")
		{
			$a="Your account is not active.";
			echo "<script>alert('{$a}');</script>";
		}
		else if($role == "accountant")
		{
			$_SESSION['username']=$u_name;
			$_SESSION['role']=$role;
			echo "<script> window.location=\"http://localhost/E-Wallet1/Accountant.php\" </script>";
		}
		else if($role == "faculty")
		{	
			$_SESSION['username']=$u_name;
			$_SESSION['role']=$role;
			echo "<script> window.location=\"http://localhost/E-Wallet1/Faculty.php\" </script>";
		}
		else if($role == "admin")
		{	
			$_SESSION['username']=$u_name;
			$_SESSION['role']=$role;
			echo "<script> window.location=\"http://localhost/E-Wallet1/Admin.php\" </script>";
		}
		else
		{
			echo "<script> window.location=\"additional_check.php\"</script>";
		}

	}
	else if (mysqli_num_rows($result1) > 0)
		{
		$_SESSION['username']=$u_name;
		$_SESSION['role']="shopkeeper";
		echo "<script> window.location=\"http://localhost/E-Wallet1/Shopkeeper.php\" </script>";
		}
   else
    {
		$a="Username/Password not found.";
		echo "<script>alert('{$a}');</script>";
		session_unset();
		session_destroy();
	}


}

?>