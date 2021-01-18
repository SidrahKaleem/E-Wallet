<?php
	require_once("student_class.php");
	require_once("person.php");

	$person=new person();
	$std = new student_class();
	
   //Start your session
   session_start();
   //Read your session (if it is set)
   if(!isset($_SESSION['username']) || $_SESSION['role'] != "customer")
      {
	 header("Location: index.php");
	  }else
	  {
	   global $user_login;
	  $user_login=$_SESSION['username'];
	  
	  //$_SESSION['username']=$user_login;
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Customer</title>
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
                            
							<a href="customer_reset_pin.php" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> Reset Pin</a>
                             <a href="customer_reset_password.php" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> Reset Password</a>
							 <a href="customer_change_picture.php" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> Update Picture</a>
							 <a href="logout.php" class="btn btn-success btn-sm "><span class="glyphicon glyphicon-off"></span> logout</a>
							 
							

			
                        </ul>
                  <!--	  /.nav-collapse -->
                </div>
  
            </header>

</div><!--menu-->


<div class="container">


        <div class="row centered-form">
		
					
				
			
			<div class="col-md-5 col-xs-12 col-md-offset-3" >
					<div align="center" >
						<img src="user_images/<?php echo $person->getimage($user_login)?>" class="img-rounded" width="304" height="236" >
					</div>
					<br/>
        	<div class="panel panel-default">
						
			 			<div class="panel-body">
						</br>
						
						<div class col-md-offset-3" >
			    			<button type="button" class="btn btn-block btn-success outline">Remaining Balance Rs  : <?php echo $std->view_balance($user_login);
							
							?> </button>
						</br></br>
						
						
						
						<a href="customer_record.php" class="btn btn-block btn-success gradient"><span class="glyphicon glyphicon-saved "></span> View Purchase Record</a>
						</br></br>
						<a href="view_menu_customer.php" class="btn btn-block btn-success gradient"><span class="glyphicon glyphicon-saved "></span> View Menu</a>
						
						</br></br>
						
						<button type="button" class="btn btn-block btn-success outline">Rank : <?php echo $std->view_rank($user_login);?> </button>
						</br></br>
						</br>
						
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
//$var = $std-> get_bal($user_login);
//$int = (int)filter_var($var, FILTER_SANITIZE_NUMBER_INT);

//echo $int;
require_once("db_connection.php");
$connect=new db_connection();
$conn=$connect->create_connection();
//$conn=$this->create_connection();
$sql_balance= "SELECT balance from user_tb where username = '{$user_login}' ";
$balance = mysqli_query($conn,$sql_balance);
		$subject=mysqli_fetch_assoc($balance);
		$blnc=$subject["balance"];

 

							if ($blnc < 500)
							{
							 
								$a="Your Balance is low, Please Recharge your Account";
								echo "<script>alert('{$a}');</script>";
							 
							}
		
}
?>