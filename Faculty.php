<?php
	require_once("db_connection.php");
	require_once("student_class.php");
	require_once("person.php");

	$person= new person();
	$conn = new db_connection();
	$conn->create_connection();
	$std = new student_class();
	
   //Start your session
   session_start();
   //Read your session (if it is set)
   if(!isset($_SESSION['username']) || $_SESSION['role'] != "faculty")
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
        <title>Faculty</title>
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
                            

                             <a href="faculty_reset_pin.php" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> Reset Pin</a>
							 
							 <a href="faculty_reset_password.php" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> Reset Password</a>
							 <a href="faculty_change_picture.php" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-pencil"></span> Update Picture</a>
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
        		<div class="panel-heading">
				
				
			    		
			 			</div>
		
			 			<div class="panel-body">
						</br>
						
						<div class col-md-offset-3" >
			    			<button type="button" class="btn btn-block btn-success outline">Remaining Balance : <?php echo $std->view_balance($user_login);?> </button>
						</br></br>
						
						
						<a href="faculty_purchase_record.php" class="btn btn-block btn-success gradient"><span class="glyphicon glyphicon-saved "></span> View Purchase Record</a>
						</br></br>
						<a href="view_menu.php" class="btn btn-block btn-success gradient"><span class="glyphicon glyphicon-saved "></span> View Menu</a>
						</br></br>
						
						
						
						<a href="cafe_order_online.php" class="btn btn-block btn-success gradient"><span class="glyphicon glyphicon-saved "></span> Cafe Order Online</a>
						
						
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

}
?>